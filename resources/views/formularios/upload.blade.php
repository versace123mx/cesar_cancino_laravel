@extends('../layouts.frontend')
@section('content')
    <h1>Simple</h1>
    <x-flash/>
    <form action="{{route('formularios_upload_post')}}" method="POST" name="form" enctype="multipart/form-data">
        @csrf
        <div class="col-12 my-3">
            <label for="foto">Archivo: </label>
            <input type="file" name="foto" id="foto" class="form-control">
        </div>
        <div class="col-12 my-3">
            <button class="btn btn-primary" type="submit">Enviar</button>
        </div>
    </form>
@endsection