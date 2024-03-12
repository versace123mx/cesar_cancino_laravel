<?php

namespace App\Http\Controllers;

use App\Models\Productos;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class ApiProductosController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $datos = Productos::orderBy('id','desc')->get();
        return response()->json($datos,200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $json = json_decode(file_get_contents('php://input'),true);
        if(!is_array($json ))
        {
            $array=
                    array(
                            'response'=>array(
                                'estado'=>'Bad Request',
                                'mensaje'=>'La peticion HTTP no trae datos para procesar ' 
                            )
                        );
            return response()->json($array, 400);
        }
       //crear el registro
        Productos::create(
            [
                'nombre'=>$request->input('nombre'),
                'slug'=>Str::slug($request->input('nombre')),
                'descripcion' =>$request->input('descripcion'),
                'precio' => $request->input('precio'),
                'categorias_id' => $request->input('categorias_id'),
                'fecha' => now()
            ]
        );
       //retornar un json
        $array=array
                    (
                        'estado'=>'ok',
                        'mensaje'=>'Se creó el registro exitosamente', 
                    ); 
        return response()->json( $array, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $datos = Productos::where(['id'=>$id])->get();
        if(count($datos)){
            return response()->json($datos,200);
        }else{
            $array=array
                    (
                        'estado'=>'Error',
                        'mensaje'=>'Dato no encontrado',
                    );

            return response()->json($array,401);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //Si traigo los datos con el get no puedo hacer save
        $datos = Productos::where(['id'=>$id])->first();
        if(!is_object($datos)){
            $array=array
            (
                'estado'=>'Error',
                'mensaje'=>'Dato no encontrado',
            );

            return response()->json($array,400);

        }

        $datos->nombre = $request->input('nombre');
        $datos->slug = Str::slug($request->input('nombre'),'-');
        $datos->precio = $request->input('precio');
        $datos->descripcion = $request->input('descripcion');
        $datos->categorias_id = $request->input('categorias_id');
        $datos->save();


        $array=array
                (
                    'estado'=>'ok',
                    'mensaje'=>'Se creó el registro exitosamente', 
                ); 
        return response()->json( $array, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
