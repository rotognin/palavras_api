<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PalavraController as Palavra;

Route::get('palavra', [Palavra::class, 'aleatoria']);
Route::get('palavra/{palavra}', [Palavra::class, 'palavra']);

/*
    Padrão para adicionar
    {
        "palavra": "xxxxxxxxxx",
        "tipo": "xxxxxx xx xxxxxxxx",
        "local": "xxxxxxxxxxx"
    }
*/
Route::post('adicionar', [Palavra::class, 'adicionar']);

Route::delete('excluir/{palavra}', [Palavra::class, 'excluir']);

Route::put('ativar/{palavra}', [Palavra::class, 'ativar']);
Route::put('inativar/{palavra}', [Palavra::class, 'inativar']);

Route::fallback(function(){
    $json = array(
        'resultado' => 'ERRO',
        'mensagem' => 'Rota nao cadastrada. Favor verificar a documentacao da API'
    );

    echo json_encode($json);
});
