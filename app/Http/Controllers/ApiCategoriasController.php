<?php

namespace App\Http\Controllers;

use App\Models\Categorias;
use App\Models\Productos;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class ApiCategoriasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $datos = Categorias::orderBy('id','desc')->get();
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
        Categorias::create(
            [
                'nombre'=>$request->input('nombre'),
                'slug'=>Str::slug($request->input('nombre'))
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
        $datos = Categorias::where(['id'=>$id])->get();
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
        $json = json_decode(file_get_contents('php://input'),true);
        if(!is_array($json ))
        {
       		$array=
		        	array
		        	(
		        		'response'=>array
			        	(
			        		'estado'=>'Bad Request',
			        		'mensaje'=>'La peticion HTTP no trae datos para procesar '
			        	)
		        	)
		        ;  	
		    return response()->json($array, 400);
        }
        $datos = Categorias::where(['id'=>$id])->firstOrFail();
        $datos->nombre = $request->input('nombre');
        $datos->slug = Str::slug($request->input('nombre'));
        $datos->save();
        $array=
		        	array
		        	(
		        		'response'=>array
			        	(
			        		'estado'=>'ok',
			        		'mensaje'=>'Se modifico correctamente.'
			        	)
		        	)
		        ;
        return response()->json($array,200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $datos = Categorias::where(['id'=>$id])->firstOrFail();
        if(Productos::where(['categorias_id'=>$id])->count() == 0){
            Categorias::where(['id'=>$id])->delete();
            $array=
                array
		        	(
		        		'response'=>array
			        	(
			        		'estado'=>'ok',
			        		'mensaje'=>'Se elimino correctamente.'
			        	)
		        	)
		        ;
        return response()->json($array,200);
        }else{
            $array=
            array
            (
                'response'=>array
                (
                    'estado'=>'Bad Request',
                    'mensaje'=>'No se puede eliminar el registro '
                )
            );

            return response()->json($array, 400);
        }
    }


}
