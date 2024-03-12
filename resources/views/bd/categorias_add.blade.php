@extends('../layouts.frontend')
@section('content')
    <h1>BD MySQL Categorias</h1>
    <x-flash />
    <form action="{{route('bd_categorias_add_post')}}" method="POST" name="categorias" autocomplete="off">
        @csrf
        <div class="form-group my-3">
            <label for="nombre">Nombre Categoria</label>
            <input type="text" name="nombre" id="nombre" class="form-control @error('nombre') is-invalid @enderror" value="{{old('nombre')}}">
            @yield('nombre')
        </div>
        <div class="form-group my-3">
            <label for="slug">Slug</label>
            <input type="text" name="slug" id="slug" class="form-control @error('slug') is-invalid @enderror" value="{{old('slug')}}">
            @yield('slug')
        </div>
        <div class="col-12 my-3">
            <button class="btn btn-primary" type="submit">Enviar</button>
        </div>
    </form>
@endsection