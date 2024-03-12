@extends('../layouts.frontend')
@section('content')
    <h1>BD MySQL Productos y Categoria</h1>
    <x-flash />
    <div class="table-responsive">

        @if (count($datos))
            <p>Nombre de la categoria: <strong>{{$categoria->nombre}}</strong>  |  numero de Productos que pertenecen a la categoria: <strong>{{count($datos)}}</strong></p>
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
                            <td scope="row"><a href="{{route('bd_productos_categoria',['id'=>$dato->id])}}">{{$dato->Categorias->nombre}}</a></td><!-- Este datos esta traido de la relacion de categorias con producto-->
                            <td scope="row">{{$dato->nombre}}</td>
                            <td scope="row">{{number_format($dato->precio,0,'','.')}}</td>
                            <td scope="row">{{$dato->stock}}</td>
                            <td scope="row">{{substr($dato->descripcion,0,100)}}...</td>
                            <td scope="row">{{date("d/m/Y", strtotime($dato->fecha))}}</td>
                            <td scope="row">
                                <a href="{{route('bd_productos_fotos',['id'=>$dato->id])}}">ver</a>
                            </td>
                            <td  scope="row" colspan="2">
                                <a href="{{route('bd_productos_edit',['id'=>$dato->id])}}" class="btn btn-success">Editar</a> 
                                <a href="javascript:void(0)" onclick="confirmaAlertas('Realmente desea eliminar el registro','{{route('bd_productos_delete',['id'=>$dato->id])}}')" class="btn btn-danger">Eliminar</a></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <div class="my-5">
                <h3>No hay datos para esta categoria</h3>
            </div>
        @endif


    </div>
@endsection