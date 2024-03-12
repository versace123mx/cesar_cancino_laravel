@extends('../layouts.frontend')
@section('content')
    <h1>Registro</h1>
    <x-flash />
    <form action="{{route('acceso_login_post')}}" method="POST" autocomplete="off">
        @csrf
    <div class="form-group">
        <label for="correo">Correo:</label>
        <input type="text" name="correo" id="correo" class="form-control" value="{{old('correo')}}">
        <label for="password">Password:</label>
        <input type="password" name="password" id="password" class="form-control" >
    </div>
    <div class="my-3">
        <input type="submit" value="Enviar" class="btn btn-primary">
    </div>
    </form>
@endsection