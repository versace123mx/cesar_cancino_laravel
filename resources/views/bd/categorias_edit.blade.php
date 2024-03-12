@extends('../layouts.frontend')
@section('content')
    <h1>BD MySQL Categorias Edit</h1>
    <x-flash />
    <form action="{{route('bd_categorias_edit_post',['id'=>$categoria->id])}}" method="POST" name="categorias" autocomplete="off">
        @csrf
        <div class="form-group my-3">
            <label for="nombre">Nombre Categoria</label>
            <input type="text" name="nombre" id="nombre" class="form-control @error('nombre') is-invalid @enderror" value="{{$categoria->nombre}}">
            @yield('nombre')
        </div>
        <div class="form-group my-3">
            <label for="slug">Slug</label>
            <input type="text" name="slug" id="slug" class="form-control @error('slug') is-invalid @enderror" value="{{$categoria->slug}}">
            @yield('slug')
        </div>
        <div class="col-12 my-3">
            <button class="btn btn-primary" type="submit">Enviar</button>
        </div>
    </form>
@endsection