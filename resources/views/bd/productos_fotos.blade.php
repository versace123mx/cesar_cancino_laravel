@extends('../layouts.frontend')
@section('content')
    <h1>Fotos del Producto {{$producto->nombre}}</h1>
    <x-flash />
    <div class="row my-3">
        <form action="{{route('bd_productos_fotos_post',['id'=>$producto->id])}}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="row my-3">
                <div class="form-group izquierda">
                    <label for="foto">Foto</label>
                    <input type="file" name="foto" id="foto" class="form-control"/>
                </div>
            </div>
            <input type="submit" value="Enviar" class="btn btn-primary" />
        </form>
    </div>
    @if(count($fotos))
        <div class="row">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Foto</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($fotos  as $foto)
                        <tr>
                            <td>
                                <img src="{{asset('uploads/productos')}}/{{$foto->nombre}}" width="200" height="200">
                            </td>
                            <td  scope="row" colspan="2">
                                <a href="javascript:void(0)" onclick="confirmaAlertas('Realmente desea eliminar el registro','{{route('bd_productos_fotos_delete',['producto_id'=>$producto->id,'foto_id'=>$foto->id])}}')" class="btn btn-danger">Eliminar</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @else
    <div class="row">
        <h4>No hay fotos a mostrar, Carga fotos.</h4>
    </div>
    @endif
@endsection