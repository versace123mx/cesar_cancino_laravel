<?php

namespace App\Http\Controllers;

use App\Models\ProductosFotos;
use Illuminate\Http\Request;

class ProductosFotosController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $datos = ProductosFotos::orderBy('id','desc')->get();
        return response()->json($datos,200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if(empty($_FILES['foto']['tmp_name'])){
            $array=
                    array(
                            'response'=>array(
                                'estado'=>'Bad Request',
                                'mensaje'=>'La foto es obligatoria'
                            )
                        );
            return response()->json($array, 400);
        }
        if($_FILES["foto"]["type"] == 'image/jpeg' or $_FILES["foto"]["type"] == 'image/png' or $_FILES["foto"]["type"] == 'image/jpg'){

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
    
            copy($_FILES['foto']['tmp_name'],'uploads/productos/'.$archivo);
            ProductosFotos::create([
                'productos_id' => $request->input('producto_id'),
                'nombre' => $archivo,
            ]);

            $array=array
                    (
                        'estado'=>'ok',
                        'mensaje'=>'Se cargo la imagen exitosamente.', 
                    ); 
            return response()->json( $array, 200);

        }else{
            $array=
                    array(
                            'response'=>array(
                                'estado'=>'Bad Request',
                                'mensaje'=>'La foto no tiene un formato valido'
                            )
                        );
            return response()->json($array, 400);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
