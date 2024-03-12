<?php

namespace App\Http\Controllers;

use App\Models\Categorias;
use App\Models\Productos;
use App\Models\ProductosFotos;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class BdController extends Controller
{
    public function bd_inicio(){
        return view('bd.home');
    }

    public function bd_categorias(){
        $datos = Categorias::orderBy('id','desc')->get();
        //dd($datos);
        return view('bd.categorias',compact('datos'));
    }

    public function bd_categorias_add(){
        return view('bd.categorias_add');
    }

    public function bd_categorias_add_post(Request $request){

        $request->validate([
            'nombre' => 'required|max:50',
            'slug' => 'required|max:50'
        ],[
            'nombre.required' => 'El campo nombre esta vacio.',
            'nombre.max' => 'El campo nombre tiene mas de 50 caracteres.',
            'slug.required' => 'El campo slug esta vacio',
            'slug.max' => 'El campo slug tiene mas de 50 caracteres.',
        ]);


        $dato = new Categorias();
        $dato->nombre = $request->input('nombre');
        $dato->slug = Str::slug($request->input('slug'));
        $dato->save();

        $request->session()->flash('css','success');
        $request->session()->flash('mensaje','Se agrego correctamente el registro.');
        return redirect()->route('bd_categorias');

    }

    public function bd_categorias_edit($id){
        $categoria = Categorias::where(['id'=>$id])->firstOrFail(); #si no encuentra nada manda un status 400 firstOrFail
        return view('bd.categorias_edit',compact('categoria'));
    }

    public function bd_categorias_edit_post(Request $request, $id){

        //Ejecutamos las validaciones
        $request->validate([
            'nombre' => 'required|max:50',
            'slug' => 'required|max:50'
        ],[
            'nombre.required' => 'El campo nombre esta vacio.',
            'nombre.max' => 'El campo nombre tiene mas de 50 caracteres.',
            'slug.required' => 'El campo slug esta vacio',
            'slug.max' => 'El campo slug tiene mas de 50 caracteres.',
        ]);


        //Verificamos si existe el id
        $categoria = Categorias::where(['id'=>$id])->firstOrFail(); #si no encuentra nada manda un status 400 firstOrFail

        Categorias::where('id',$id)
                    ->update([
                        'nombre' => $request->input('nombre'),
                        'slug' => Str::slug($request->input('slug'))
                    ]);

        $request->session()->flash('css','success');
        $request->session()->flash('mensaje','Se Actualizo correctamente el registro id='.$id);
        return redirect()->route('bd_categorias');

    }

    public function bd_categorias_delete(REQUEST $request, $id){

        if(Productos::where(['categorias_id'=>$id])->count() == 0){

            Categorias::where(['id'=>$id])->delete();
            $request->session()->flash('css','success');
            $request->session()->flash('mensaje','Se Elimino correctamente el la categoria id='.$id);
            return redirect()->route('bd_categorias');

        }else{
            /*si la categoria tiene un producto no se podria eliminar*/
            $request->session()->flash('css','success');
            $request->session()->flash('mensaje','No es posible eliminar el registro');
            return redirect()->route('bd_categorias');
        }

    }

    public function bd_productos(){
        $datos = Productos::orderBy('id','desc')->get();
        //dd($datos);
        return view('bd.productos',compact('datos'));

    }

    public function bd_productos_add(){
        $categorias = Categorias::select('id','nombre')->get();
        return view('bd.productos_add',compact('categorias'));
    }

    public function bd_productos_add_post(Request $request){

        $request->validate([
            'nombre' => 'required|min:6',
            'precio' => 'required|numeric',
            'descripcion' => 'required|min:5',
        ],[
            'nombre.required' => 'El campo nombre esta vacio.',
            'nombre.min' => 'El campo nombre tiene requiere minimo 6 caracteres.',
            'precio.required' => 'El campo precio esta vacio.',
            'precio.numeric' => 'El campo precio debe ser numerico.',
            'descripcion.required' => 'El campo descripcion esta vacio.',
            'descripcion:min' => 'El campo descripcion debe tener un minimo de 5 caracteres.',
        ]);


        $dato = new Productos();
        $dato->nombre = $request->input('nombre');
        $dato->categorias_id = $request->input('categoria');
        $dato->precio = $request->input('precio');
        $dato->stock = $request->input('stock');
        $dato->descripcion = $request->input('descripcion');
        $dato->slug = Str::slug($request->input('nombre'));
        $dato->fecha = now();
        $dato->save();

        $request->session()->flash('css','success');
        $request->session()->flash('mensaje','Se agrego correctamente el registro.');
        return redirect()->route('bd_productos');

    }

    public function bd_productos_edit($id){
        $producto = Productos::where(['id'=>$id])->firstOrFail(); #si no encuentra nada manda un status 400 firstOrFail
        $categorias = Categorias::select('id','nombre')->get();
        return view('bd.productos_edit',compact('producto','categorias'));
    }

    public function bd_productos_edit_post(Request $request,$id){

        $request->validate([
            'nombre' => 'required|min:6',
            'precio' => 'required|numeric',
            'descripcion' => 'required|min:5',
        ],[
            'nombre.required' => 'El campo nombre esta vacio.',
            'nombre.min' => 'El campo nombre tiene requiere minimo 6 caracteres.',
            'precio.required' => 'El campo precio esta vacio.',
            'precio.numeric' => 'El campo precio debe ser numerico.',
            'descripcion.required' => 'El campo descripcion esta vacio.',
            'descripcion:min' => 'El campo descripcion debe tener un minimo de 5 caracteres.',
        ]);

        Productos::where(['id'=>$id])->firstOrFail(); #si no encuentra nada manda un status 400 firstOrFail

        Productos::where('id',$id)
                    ->update([
                        'nombre' => $request->input('nombre'),
                        'categorias_id' => $request->input('categoria'),
                        'precio' => $request->input('precio'),
                        'stock' => $request->input('stock'),
                        'descripcion' => $request->input('descripcion'),
                        'slug' => Str::slug($request->input('slug')),
                    ]);

        $request->session()->flash('css','success');
        $request->session()->flash('mensaje','Se edito correctamente el registro. id = '.$id);
        return redirect()->route('bd_productos');

    }

    public function bd_productos_delete(REQUEST $request, $id){

        Productos::where(['id'=>$id])->firstOrFail(); #si no encuentra nada manda un status 400 firstOrFail

        if(!ProductosFotos::where(['productos_id'=>$id])->count()){

            Productos::where(['id'=>$id])->delete();
            $request->session()->flash('css','success');
            $request->session()->flash('mensaje','Se Elimino correctamente el producto id='.$id);
            return redirect()->route('bd_productos');

        }else{

            $request->session()->flash('css','danger');
            $request->session()->flash('mensaje','No se pudo eliminar el registro id = ' . $id .'.    Ya que este tiene asociada una o varias fotos.');
            return redirect()->route('bd_productos');

        }

    }

    public function bd_productos_categoria($id){
        $categoria = Categorias::where(['id'=>$id])->firstOrFail(); #si no encuentra nada manda un status 400 firstOrFail
        $datos = Productos::where(['categorias_id'=>$id])->orderBy('id','desc')->get();
        $foto = ProductosFotos::where(['productos_id'=>$id])->get();
        return view('bd.productos_categorias',compact('datos','categoria','foto'));
    }

    public function bd_productos_fotos($id){
        $producto = Productos::where(['id'=>$id])->firstOrFail(); #si no encuentra nada manda un status 400 firstOrFail
        $fotos = ProductosFotos::where(['productos_id' => $id])->orderBy('id','desc')->get();
        return view('bd.productos_fotos',compact('producto','fotos'));

    }

    public function bd_productos_fotos_post(Request $request, $id){
        $productos = Productos::where(['id'=>$id])->firstOrFail(); #si no encuentra nada manda un status 400 firstOrFail
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

        copy($_FILES['foto']['tmp_name'],'uploads/productos/'.$archivo);
        ProductosFotos::create([
            'productos_id' => $id,
            'nombre' => $archivo,
        ]);
        $request->session()->flash('css','success');
        $request->session()->flash('mensaje','Se subio el archivo correctamente.');
        return redirect()->route('bd_productos_fotos',['id'=>$id]);

    }

    public function bd_productos_fotos_delete(REQUEST $request, $producto_id,$foto_id){
        $productos = Productos::where(['id'=>$producto_id])->firstOrFail(); #si no encuentra nada manda un status 400 firstOrFail
        $foto = ProductosFotos::where(['id'=>$foto_id])->firstOrFail(); #si no encuentra nada manda un status 400 firstOrFail
        unlink(getcwd().'/uploads/productos/'.$foto->nombre);

        ProductosFotos::where(['id'=>$foto_id])->delete();
        $request->session()->flash('css','success');
        $request->session()->flash('mensaje','Ha sido eliminad@ correctamente.');
        return redirect()->route('bd_productos_fotos',['id'=>$producto_id]);
    }

    public function bd_productos_paginacion(){
        $datos = Productos::orderBy('id','desc')->paginate(2); #si no encuentra nada manda un status 400 firstOrFail
        return view('bd.productos_paginacion',compact('datos'));
    }

    public function bd_productos_buscador(){
        if(isset($_GET['b'])){
            $b= $_GET['b'];
            $datos = Productos::where('nombre','like','%'.$b.'%')->orderBy('id','desc')->get(); #si no encuentra nada manda un status 400 firstOrFail
        }else{
            $b='';
            $datos = Productos::orderBy('id','desc')->get(); #si no encuentra nada manda un status 400 firstOrFail
        }
        
        return view('bd.buscador',compact('datos','b'));
    }


}
