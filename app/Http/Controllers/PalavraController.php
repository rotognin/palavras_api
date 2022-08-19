<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Palavra;
use App\Http\Controllers\InfoController as Info;
use App\Models\Info as InfoModel;

class PalavraController extends Controller
{
    public function aleatoria()
    {
        $info = InfoModel::find(1);
        
        if ($info->palavras_ativas == 0){
            $json = array(
                'resultado' => 'ERRO',
                'mensagem' => 'Não existem palavras disponíveis'
            );

            return response()->json(json_encode($json), 200);
        }

        $maximo = $info->palavras_ativas - 1;
        $sorteio = rand(0, $maximo);

        $palavra_obj = Palavra::where('status', 1)->skip($sorteio)->take(1)->get();
        $palavra = $palavra_obj[0]->palavra;

        $json = array(
            'resultado' => 'OK',
            'palavra' => $palavra,
            'letras' => strlen($palavra)
        );

        return response()->json(json_encode($json), 200);
    }

    public function palavra(Request $request, string $palavra)
    {
        $palavra_obj = Palavra::where('palavra', $palavra)->first();

        if ($palavra_obj){
            $json = array(
                'palavra' => $palavra_obj->palavra,
                'letras' => $palavra_obj->letras
            );
        } else {
            $json = array(
                'mensagem' => 'Nao encontrada'
            );
        }
        
        return response()->json(json_encode($json), 200);
    }

    public function adicionar(Request $request)
    {
        $palavra = strtolower($request->palavra ?? '');
        $tipo = strtolower($request->tipo ?? '');
        $local = strtolower($request->local ?? 'indefinido');
        $continuar = true;
        $retorno = '';

        if ($palavra == ''){
            $retorno = $this->montarRetorno('A palavra não foi enviada', true);
            $continuar = false;
        }

        if ($continuar){
            if (!$this->verificarTipoCampo($palavra)){
                $retorno = $this->montarRetorno('Campo palavra incorreto', true);
                $continuar = false;
            }
        }

        if ($continuar){
            if (!preg_match('/^[a-z-]+$/', $palavra)){
                $retorno = $this->montarRetorno('Palavra inválida', true);
                $continuar = false;
            }
        }

        if ($continuar){
            $palavra_check = Palavra::where('palavra', $palavra)->first() ?? false;

            if ($palavra_check){
                $retorno = $this->montarRetorno('Essa palavra já está cadastrada', true);
                $continuar = false;
            }
        }

        if ($continuar){
            if ($tipo == ''){
                $retorno = $this->montarRetorno('O tipo não foi enviado', true);
                $continuar = false;
            }
        }

        if ($continuar){
            if (!preg_match('/^[a-z ]+$/', $tipo)){
                $retorno = $this->montarRetorno('O tipo é inválido', true);
                $continuar = false;
            }
        }

        if ($continuar){
            if (!$this->verificarTipoCampo($tipo)){
                $retorno = $this->montarRetorno('Campo tipo incorreto', true);
                $continuar = false;
            }
        }

        if ($continuar){
            if (!$this->verificarTipoCampo($local)){
                $retorno = $this->montarRetorno('Campo local incorreto');
                $continuar = false;
            }
        }

        if ($continuar){
            if (!preg_match('/^[a-z ]+$/', $local)){
                $retorno = $this->montarRetorno('O local é inválido', true);
                $continuar = false;
            }
        }

        if ($continuar){
            // Adicionar palavra no banco
            $palavra_obj = new Palavra();
            $palavra_obj->palavra = $palavra;
            $palavra_obj->letras = strlen($palavra);
            $palavra_obj->tipo = $tipo;
            $palavra_obj->local = $local;
            $palavra_obj->status = 1;

            if ($palavra_obj->save()){
                Info::atualizar();
            }

            $retorno = $this->montarRetorno('Palavra adicionada com sucesso');
        }

        return response()->json(json_encode($retorno, 200));
    }

    private function verificarTipoCampo($campo)
    {
        return gettype($campo) == 'string';
    }

    private function montarRetorno(string $mensagem, bool $erro = false)
    {
        $sucesso = ($erro) ? 'ERRO' : 'OK';
        
        $retorno = array(
            'sucesso' => $sucesso,
            'mensagem' => $mensagem
        );

        return $retorno;
    }

    public function excluir(string $palavra)
    {
        $palavra_obj = Palavra::where('palavra', $palavra)->first();
        
        if (!$palavra_obj){
            $json = array(
                'sucesso' => 'ERRO',
                'mensagem' => 'Palavra não encontrada'
            );
        } else {
            $palavra_obj->delete();

            $json = array(
                'sucesso' => 'OK',
                'mensagem' => 'Palavra excluida',
                'palavra' => $palavra
            );

            Info::atualizar();
        }

        return response()->json(json_encode($json), 200);
    }

    public function ativar(Request $request, string $palavra)
    {
        return $this->alterarStatus($palavra, 1);
    }

    public function inativar(Request $request, string $palavra)
    {
        return $this->alterarStatus($palavra, 0);
    }

    private function alterarStatus(string $palavra, int $status)
    {
        $palavra_obj = Palavra::where('palavra', $palavra)->first();

        if (!$palavra_obj){
            $json = array(
                'mensagem' => 'Palavra não encontrada'
            );
            return response()->json(json_encode($json), 200);
        }

        $palavra_obj->status = $status;
        $palavra_obj->save();

        Info::atualizar();

        $mensagem = ($status == 1) ? 'Palavra ativada com sucesso' : 'Palavra inativada com sucesso';

        $json = array(
            'mensagem' => $mensagem
        );

        return response()->json(json_encode($json), 200);
    }
}