@extends('../layouts.frontend')
@section('content')
    <h1>Registro</h1>
    <x-flash />
    <form action="{{route('acceso_registro_post')}}" method="POST" autocomplete="off">
        @csrf
    <div class="form-group">
        <label for="nombre">Nombre:</label>
        <input type="text" name="nombre" id="nombre" class="form-control" value="{{old('nombre')}}">
        <label for="correo">Correo:</label>
        <input type="text" name="correo" id="correo" class="form-control" value="{{old('correo')}}">
        <label for="telefono">Telefono:</label>
        <input type="text" name="telefono" id="telefono" class="form-control" value="{{old('telefono')}}">
        <label for="direccion">Direccion:</label>
        <input type="text" name="direccion" id="direccion" class="form-control" value="{{old('direccion')}}">
        <label for="password">Password:</label>
        <input type="password" name="password" id="password" class="form-control" >
        <label for="password2">Repite Password:</label>
        <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" >
    </div>
    <div class="my-3">
        <input type="submit" value="Enviar" class="btn btn-primary">
    </div>
    </form>
@endsection