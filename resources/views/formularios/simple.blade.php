@extends('../layouts.frontend')
@section('content')
    <h1>Simple</h1>
    <x-flash/>
    <form action="{{route('formularios_simple_post')}}" method="POST" name="form">
        @csrf
        <div class="form-group">
            <label for="pais">Pais</label>
            <select name="pais" id="" class="form-select @error('pais') is-invalid @enderror" value="{{old('pais')}}" aria-label="Default select example">
                <option selected value="">Selecciona una opccion del Menu</option>
                @foreach($paises as $pais)
                    <option value="{{$loop->index}}">{{$pais['nombre']}}</option>
                @endforeach
            </select>
            @yield('pais')
        </div>
        <div class="form-group">
            <label for="nombre">Nombre</label>
            <input type="text" name="nombre" id="nombre" class="form-control @error('nombre') is-invalid @enderror" value="{{old('nombre')}}">
            @yield('nombre')
        </div>

        <div class="form-group">
            <label for="correo">Email</label>
            <input type="text" name="correo" id="correo" class="form-control @error('correo') is-invalid @enderror" value="{{old('correo')}}">
            @yield('correo')
        </div>
        <div class="mb-3">
            <label for="descripcion" class="form-label">Descripcción</label>
            <textarea class="form-control @error('descripcion') is-invalid @enderror" id="descripcion" placeholder="Ingresa aqui tu descripcion:"  name="descripcion" >{{old('descripcion')}}</textarea>
            @yield('descripcion')
        </div>
        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" name="password" id="password" class="form-control @error('password') is-invalid @enderror"" value="{{old('password')}}">
            @yield('password')
        </div>
        <div class="form-group my-3">
            <label for="intereses">Intereses</label>
            <div class="form-check">
                @foreach ($intereses as $interes)
                    <input type="checkbox" name="interes_{{$loop->index}}" id="interes_{{$loop->index}}" class="form-check-input" value="{{$interes['id']}}"/>
                    <label for="interes_{{$loop->index}}" class="form-check-label">{{$interes['nombre']}}</label>
                    <br/>
                @endforeach
            </div>
        </div>
        <div class="col-12 my-3">
            <button class="btn btn-primary" type="submit">Enviar</button>
        </div>
    </form>
@endsection