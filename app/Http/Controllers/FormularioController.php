<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class FormularioController extends Controller
{
    public function formularios_inicio(){
        return view('formularios.home');
    }

    public function formularios_simple(){
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

            $intereses = [
                array(
                    'nombre' => 'Deportes','id' => 1,
                ),
                array(
                    'nombre' => 'Musica','id' => 2,
                ),
                array(
                    'nombre' => 'Religion','id' => 3,
                ),
                array(
                    'nombre' => 'Comida','id' => 4,
                ),
                array(
                    'nombre' => 'Viajes','id' => 5,
                )
                ];

        return view('formularios.simple',compact('paises','intereses'));
    }

    public function formularios_simple_post(Request $request){
        $request->validate([
            'nombre' => 'required|min:6',
            'correo' => 'required|email:rfc,dns',
            'descripcion' => 'required',
            'password' => 'required|min:6',
            'pais' => 'required'
        ],[
            'nombre.required' => 'El campo nombre esta vacio',
            'nombre.min' => 'El campo nombre tiene que tener minimo 6 caracteres',
            'correo.required' => 'El campo correo esta vacio',
            'correo.email' => 'El campo correo el rfc es invalid',
            'descripcion.required' => 'El campo descripcion esta vacio',
            'password.required' => 'El campo password esta vacio',
            'pais.required' => 'El campo pais esta vacio',
        ]);
        $intereses = [
            array(
                'nombre' => 'Deportes','id' => 1,
            ),
            array(
                'nombre' => 'Musica','id' => 2,
            ),
            array(
                'nombre' => 'Religion','id' => 3,
            ),
            array(
                'nombre' => 'Comida','id' => 4,
            ),
            array(
                'nombre' => 'Viajes','id' => 5,
            )
            ];

            foreach($intereses as $key => $interes){
                if(isset($_POST['interes_'.$key])){
                    echo $_POST['interes_'.$key].'<br/>';
                }
            }
        die($request);

    }

    public function formularios_flash(){
        return view('formularios.flash');
    }

    public function formularios_flash2(Request $request){
        $request->session()->flash('css','success');
        $request->session()->flash('mensaje','mensaje con flash desde ñandu');
        return redirect()->route('formularios_flash3');

    }

    public function formularios_flash3(){
        return view('formularios.flash3');
    }

    public function formularios_upload(){
        return view('formularios.upload');
    }

    public function formularios_upload_post(Request $request){

        $request->validate([
            'foto' => 'required|mimes:jpg,png,jpeg|max:2048'
        ],[
            'foto.required' => 'El campo foto esta vacio',
            'foto.mimes' => 'El campo foto debe ser jpg, png o jpeg',
            'foto.max' => 'El tamaño de la foto debe de ser menor a 2048',
        ]);

        switch($_FILES['foto']['type']){
            case 'image/png':
                $archivo = time().'_.png';
            break;
            case 'image/jpg':
                $archivo = time().'_.jpg';
            break;
            case 'image/jpeg':
                $archivo = time().'_.jpeg';
            break;
        }
        /*
        $ruta = '../../../public/uploads/udemy/udemy25/';
        if( !File::exists(storage_path('../../../public/uploads/udemy/')) ){
            File::makeDirectory($ruta);
        }
        dd('Crea archivo');
        */
        copy($_FILES['foto']['tmp_name'],'uploads/udemy/'.$archivo);
        $request->session()->flash('css','success');
        $request->session()->flash('mensaje','Se subio el archivo correctamente.');
        return redirect()->route('formularios_upload');

    }


}
