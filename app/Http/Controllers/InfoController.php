<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Palavra as Palavra;
use App\Models\Info as Info;

class InfoController extends Controller
{
    public static function atualizar()
    {
        // Atualizar a quantidade de palavras ativas e inativas
        $palavras_ativas = Palavra::where('status', '1')->count();
        $palavras_inativas = Palavra::where('status', '0')->count();

        $info = Info::find(1);

        if (!$info){
            $info = new Info();
        }

        $info->palavras_ativas = $palavras_ativas;
        $info->palavras_inativas = $palavras_inativas;

        $info->save();
    }
}
