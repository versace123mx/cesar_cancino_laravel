@extends('../layouts.frontend')
@section('content')
    <h1>BD MySQL Buscador</h1>
    <h3>Resultados para el termini: <strong>{{$b}}</strong></h3>
    <x-flash />
    <div class="col-6">
        <!--<form action="" method="GET" name="form_buscador">-->
            <div class="input-group mb-3">
                <input type="text" class="form-control" id="b" name="b" placeholder="Buscar....." value="{{$b}}">
                <button class="btn btn-primary" type="button" id="button-addon2" onclick="buscadorInterno('{{route('bd_productos_buscador')}}') ">Buscar</button>
                <!--<input  type="submit" value="Enviar">-->
            </div>
        <!--</form>-->
    </div>
    <p class="d-flex justify-content-end">
        <a href="{{route('bd_productos_add')}}" class="btn btn-success">Crear</a>
    </p>
    <div class="table-responsive">
        <table class="table table-bordered table-striped table-hover">
            <thead>
                <tr>
                    <th scope="col">Id</th>
                    <th scope="col">Categoria</th>
                    <th scope="col">Name</th>
                    <th scope="col">Precio</th>
                    <th scope="col">Stock</th>
                    <th scope="col">Descripcion</th>
                    <th scope="col">Fecha</th>
                    <th scope="col">Fotos</th>
                    <th scope="col">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($datos as $dato)
                    <tr>
                        <td scope="row">{{$dato->id}}</td>
                        <td scope="row"><a href="{{route('bd_productos_categoria',['id'=>$dato->categorias_id])}}">{{$dato->Categorias->nombre}}</a></td><!-- Este datos esta traido de la relacion de categorias con producto-->
                        <td scope="row">{{$dato->nombre}}</td>
                        <td scope="row">{{number_format($dato->precio,0,'','.')}}</td>
                        <td scope="row">{{$dato->stock}}</td>
                        <td scope="row">{{substr($dato->descripcion,0,100)}}...</td>
                        <td scope="row">{{date("d/m/Y", strtotime($dato->fecha))}}</td>
                        <td scope="row">{{$dato->foto}}</td>
                        <td  scope="row" colspan="2">
                            <a href="{{route('bd_productos_edit',['id'=>$dato->id])}}" class="btn btn-success">Editar</a>
                            <a href="javascript:void(0)" onclick="confirmaAlertas('Realmente desea eliminar el registro','{{route('bd_productos_delete',['id'=>$dato->id])}}')" class="btn btn-danger">Eliminar</a></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection