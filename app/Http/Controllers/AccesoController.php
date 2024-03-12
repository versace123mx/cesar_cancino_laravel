<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserMetadata;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AccesoController extends Controller
{
    public function acceso_login(){
        return view('acceso.login');
    }
    public function acceso_login_post(Request $request){
        $request->validate([
            'correo' => 'required|email:rfc,dns',
            'password' => 'required|min:6'
        ],[
            'correo.required'=>'El campo correo esta vacio',
            'correo.email'=>'El correo ingresado no es valido',
            'password.required' => 'El campo password esta vacio',
            'password.min' => 'El campo password requiere al menos 6 caracteres',

        ]);

        if(Auth::attempt(['email'=>$request->input('correo'),'password'=>$request->input('password')])){
            $usuario = UserMetadata::where(['users_id'=>Auth::id()])->first();
            session(['users_metadata_id'=>$usuario->id]);
            session(['perfil'=>$usuario->perfil->nombre]);
            session(['perfil_id'=>$usuario->perfil->id]);
            return redirect()->intended('/template');
        }else{
            $request->session()->flash('css','danger');
            $request->session()->flash('mensaje','Las credenciales no son validas.');
            return redirect()->route('acceso_login');
        }
    }

    public function acceso_registro(){
        return view('acceso.registro');
    }

    public function acceso_registro_post(Request $request){

        $request->validate([
            'nombre' => 'required|min:6',
            'correo' => 'required|email:rfc,dns|unique:users,email',
            'telefono' => 'required|numeric',
            'direccion' => 'required',
            'password' => 'required|min:6|confirmed'
        ],[
            'nombre.required'=>'El campo nombre esta vacio',
            'nombre.min' => 'El campo nombre debe tener al menos 6 caracteres',
            'correo.required'=>'El campo correo esta vacio',
            'correo.email'=>'El correo ingresado no es valido',
            'correo.unique'=>'El correo ingresado ya esta siendo utilizado',
            'telefono.required'=>'El campo telefono esta vacio',
            'telefono.numeric'=>'El campo telefono solo acepta numeros',
            'direccion.required'=>'El campo direccion esta vacio',
            'password.required' => 'El campo password esta vacio',
            'password.min' => 'El campo password requiere al menos 6 caracteres',
            'password.confirmed' => 'Las contraseñas ingresadas no coinciden',
        ]);

        $user = User::create(
            [
                'name' => $request->input('nombre'),
                'email' => $request->input('correo'),
                'password' => Hash::make($request->input('password')),
            ]
            );
        UserMetadata::create([
            'users_id' => $user->id,
            'telefono' => $request->input('telefono'),
            'direccion' => $request->input('direccion'),
            'perfil_id' => 2,
        ]);

        $request->session()->flash('css','success');
        $request->session()->flash('mensaje','Se ha creado el registro correctamente.');
        return redirect()->route('acceso_registro');

    }

    public function acceso_salir(Request $request){
        Auth::logout();
        $request->session()->forget('users_metadata_id');
        $request->session()->forget('perfil_id');
        $request->session()->forget('perfil');
        $request->session()->flash('css','success');
        $request->session()->flash('mensaje','Se ha cerrado la session correctamente.');
        return redirect()->route('acceso_login');
    }
}
