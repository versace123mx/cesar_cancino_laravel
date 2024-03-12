@extends('../layouts.frontend')
@section('content')
    <h1>Utiles</h1>
    <ul>
        <li><a href="{{route('utiles_pdf')}}">PDF</a></li>
        <li><a href="{{route('utiles_excel')}}">EXCEL</a></li>
        <li><a href="{{route('bd_productos_buscador')}}">Cliente Rest con guzzlehttp</a></li>
        <li><a href="{{route('bd_productos_buscador')}}">Cliente SOAP</a></li>
    </ul>
@endsection