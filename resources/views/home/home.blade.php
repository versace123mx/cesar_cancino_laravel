<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h3>Imagen Logo</h3>
    <img src="{{asset('images/laravel.jpg')}}" alt="" width="10%">
    <hr>
    {{$texto}}
    <hr>
    <h1>Declaracion de Varibles</h1>
    @php
        $contador = 1;
    @endphp
    <h4>Valor de contador = {{$contador}}</h4>
    <hr>
    <h1>Siclos en PHP Blade</h1>
    <ul>
        @for ($i = 1; $i < $numero; $i++)
            <li>The current value is {{ $i }}</li>
        @endfor
    </ul>
    <hr>
    {{var_dump($paises)}}
    <hr>
    @foreach ($paises as $pais)
        <p>Pais: {{$loop->index}} - {{ $pais['nombre'] }} | Domion: {{$pais['dominio']}} </p>
    @endforeach
    <hr>
    <h3>Condicional Ternario</h3>
    <!-- El $numero biene del bindeo que se le manda a la vista -->
    {{-- Comentario en blade --}}
    {{ $numero == 18 ? 'el numero es 12':'El numero no es 12'}}
    <hr>
    <h3>Condicional if</h3>
    @if ($numero == 15)
        <p>El numero es 15</p>
    @elseif($numero == 12)
        <p>El numero es 12</p>
    @endif
    <hr>
    @include('home.incluido'){{--Esto casi no se usa--}}
    <hr>
    <x-componente />
    <hr>
    <h3>Enlaces</h3>
    <a href="{{route('home_inicio')}}">Home</a>
    <br>
    <a href="{{ route('home_parametros',['id'=>25,'slug'=>'segundoParametro']) }}?page=12">Con parametros</a>
</body>
</html>