<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function home_inicio(){

        $texto = 'Hola Culoncita';
        $numero = 12;
        $paises = [
            array(
                'nombre' => 'Chile','dominio' => 'cl',
            ),
            array(
                'nombre' => 'Peru','dominio' => 'pe',
            ),
            array(
                'nombre' => 'Venezuela','dominio' => 've',
            ),
            array(
                'nombre' => 'Mexico','dominio' => 'mx',
            ),
            array(
                'nombre' => 'España','dominio' => 'es',
            )
            ];
        return view('home.home',compact('texto','numero','paises'));
    }

    public function hola_inicio(){
        echo "Hola desde Hola_inicio";
    }

    public function home_parametros($id,$slug){
        echo "id=".$id.' | slug = '.$slug. ' | page = '.$_GET['page'];
    }
}
