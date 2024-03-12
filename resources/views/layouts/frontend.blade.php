<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.84.0">
    <title>Blog Template · Bootstrap v5.0</title>

    <!-- Bootstrap core CSS -->
    <link href="{{asset('css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('css/jquery-confirm.css')}}" rel="stylesheet">

    <!-- Favicons -->
    <link rel="icon" href="{{asset('images/favicon.ico')}}">

    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }
    </style>

    
    <!-- Custom styles for this template -->
    <link href="https://fonts.googleapis.com/css?family=Playfair&#43;Display:700,900&amp;display=swap" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="{{asset('css/blog.css')}}" rel="stylesheet">
  </head>
  <body>
    
<div class="container">
  <header class="blog-header py-3">
    <div class="row flex-nowrap justify-content-between align-items-center">
      <div class="col-4 pt-1">
        <a class="link-secondary" href="#">Subscribe</a>
      </div>
      <div class="col-4 text-center">
        <a class="blog-header-logo text-dark" href="#">Large</a>
      </div>
      <div class="col-4 d-flex justify-content-end align-items-center">
        <a class="link-secondary" href="#" aria-label="Search">
          <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="mx-3" role="img" viewBox="0 0 24 24"><title>Search</title><circle cx="10.5" cy="10.5" r="7.5"/><path d="M21 21l-5.2-5.2"/></svg>
        </a>
        <a class="btn btn-sm btn-outline-secondary" href="#">Sign up</a>
      </div>
    </div>
  </header>

  <div class="nav-scroller py-1 mb-2">
    <nav class="nav d-flex justify-content-between">
      <a class="p-2 link-secondary" href="{{route('home_inicio')}}">Home</a>
      <a class="p-2 link-secondary" href="{{route('hola_inicio')}}">Hola Inicio</a>
      <a class="p-2 link-secondary" href="{{route('home_parametros',['id'=>25,'slug'=>'segundoParametro']) }}?page=12">Ruta con parametros</a>
      <a class="p-2 link-secondary" href="{{route('formularios_inicio')}}">Formulario</a>
      <a class="p-2 link-secondary" href="{{route('helper_inicio')}}">Helper</a>
      <a class="p-2 link-secondary" href="{{route('bd_inicio')}}">BD</a>
      <a class="p-2 link-secondary" href="{{route('bd_productos_paginacion')}}">Paginacion</a>
      <a class="p-2 link-secondary" href="{{route('utiles_inicio')}}">Utiles</a>
      @if (Auth::check())
      <p>Hola {{Auth::user()->name}} tu perfil es ({{session('perfil')}}) </p>
        <a class="p-2 link-secondary" href="{{route('protegida_inicio')}}">Protegida1</a>
        <a class="p-2 link-secondary" href="{{route('protegida_otra')}}">Protegida2</a>
        <a class="p-2 link-secondary" href="javascript:void(0)" onclick="confirmaAlertas('Deseas Salir','{{route('acceso_salir')}}')">Logout</a>
      @else
        <a class="p-2 link-secondary" href="{{route('acceso_registro')}}">Registro</a>
        <a class="p-2 link-secondary" href="{{route('acceso_login')}}">Login</a>
      @endif
    </nav>
  </div>
</div>

<main class="container">
{{-- contenido --}}
@yield('content')
{{-- fin contenido --}} 
</main>



<footer class="blog-footer">
  <p>Blog template built for Gustavo Marchena</p>
</footer>


    <script src="{{asset('js/jquery-3.7.1.min.js')}}"></script>
    <script src="{{asset('js/bootstrap.min.js')}}"></script>
    <script src="{{asset('js/jquery-confirm.js')}}"></script>
    <script src="{{asset('js/sweetalert2.js')}}"></script>
    <script src="{{asset('js/personal.js')}}"></script>
  </body>
</html>
