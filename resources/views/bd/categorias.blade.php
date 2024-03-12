@extends('../layouts.frontend')
@section('content')
    <h1>BD MySQL Categorias</h1>
    <x-flash />
    <p class="d-flex justify-content-end">
        <a href="{{route('bd_categorias_add')}}" class="btn btn-success">Crear</a>
    </p>
    <div class="table-responsive">
        <table class="table table-bordered table-striped table-hover">
            <thead>
                <tr>
                    <th scope="col">Id</th>
                    <th scope="col">Name</th>
                    <th scope="col">Slug</th>
                    <th scope="col"></th>
                </tr>
            </thead>
            <tbody>
                @foreach($datos as $dato)
                    <tr>
                        <td scope="row">{{$dato->id}}</td>
                        <td scope="row">{{$dato->nombre}}</td>
                        <td scope="row">{{$dato->slug}}</td>
                        <td  scope="row" colspan="2">
                            <a href="{{route('bd_categorias_edit',['id'=>$dato->id])}}" class="btn btn-success">Editar</a> 
                            <a href="javascript:void(0)" onclick="confirmaAlertas('Realmente desea eliminar el registro','{{route('bd_categorias_delete',['id'=>$dato->id])}}')" class="btn btn-danger">Eliminar</a></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection