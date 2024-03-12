@extends('../layouts.frontend')
@section('content')
    <h1>BD MySQL Produtos Edit</h1>
    <x-flash />
    <form action="{{route('bd_productos_edit_post',['id'=>$producto->id])}}" method="POST" name="productos" autocomplete="off">
        @csrf
        <div class="form-group my-3">
            <label for="nombre">Nombre Producto</label>
            <input type="text" name="nombre" id="nombre" class="form-control @error('nombre') is-invalid @enderror" value="{{$producto->nombre}}">
            @yield('nombre')
        </div>
        <div class="form-group my-3">
            <label for="categoria">Selecciona Categoria</label>
            <select class="form-select" aria-label="Default select example" name="categoria">
                @foreach ($categorias as $categoria)
                    <option value="{{$categoria->id}}" {{ ($categoria->id == $producto->categorias_id) ? "selected":"" }} >{{$categoria->nombre}}</option>
                @endforeach
            </select>
            @yield('categoria')
        </div>

        <div class="form-group my-3">
            <label for="precio">Precio</label>
            <input type="text" name="precio" id="precio" onkeypress="return soloNumeros(event)" class="form-control @error('precio') is-invalid @enderror" value="{{$producto->precio}}">
            @yield('precio')
        </div>
        <div class="form-group my-3">
            <label for="stock">Stock</label>
            <select class="form-select" aria-label="Default select example" name="stock">
                @for($i = 1; $i <= 100; $i++)
                    <option value="{{$i}}" {{ ($i == $producto->stock) ? "selected":"" }} >{{$i}}</option>
                @endfor
            </select>
            @yield('stock')
        </div>
        <div class="form-group my-3">
            <label for="descripcion" class="form-label">Descripcción</label>
            <textarea class="form-control @error('descripcion') is-invalid @enderror" id="descripcion" placeholder="Ingresa aqui tu descripcion:"  name="descripcion" >{{$producto->descripcion}}</textarea>
            @yield('descripcion')
        </div>
        <div class="col-12 my-3">
            <button class="btn btn-primary" type="submit">Guardar</button>
        </div>
    </form>
@endsection