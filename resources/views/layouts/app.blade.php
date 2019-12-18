{{-- Inicio de la plantilla principal --}}
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}"> {{-- Lenguaje predeterminado = ES --}}
<head> {{-- Inicio del head --}}
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'SIPLAFT') }}</title> {{-- Nombre de la aplicación [Ver /.env] --}}

    <!-- Icono de la web -->
    <link rel="shortcut icon" href="{{ asset('/img/logo.png') }}">

    <!-- Styles -->
    <link href="{{ asset('/css/styles.css') }}" rel="stylesheet">

    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

</head> {{-- Fin del head --}}
<body> {{-- Inicio del body --}}
    <div>
        <nav class="navbar navbar-expand-md navbar-light shadow-sm navbar-color"> {{-- Inicio de la barra de navegación superior --}}
            <div class="container">
                <a class="navbar-brand" href="{{ route('welcome') }}"> {{-- Enlace a la raiz --}}
                    <img src="{{ asset('img/logo.png') }}" class="img-fluid img-small" alt="Responsive image"> {{-- Logo de la aplicación [Ver /public/img/logo.png]--}}
                    {{ config('app.name', 'SIPLAFT') }} {{-- Nombre de la aplicación [Ver /.env]--}}
                </a>
                {{-- Botón responsive --}}
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        {{-- Inicio de guest (invitado) --}}
                        @guest {{-- Usuario no autenticado --}}
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('INICIAR SESIÓN') }}</a>
                            </li>

                            {{-- @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('REGISTRARSE') }}</a>
                                </li>
                            @endif --}}
                        @else {{-- Usuario autenticado --}}
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest {{-- Fin de guest (invitado) --}}
                    </ul>
                </div>
            </div>
        </nav>
        {{-- Inicio del main --}}
        <main class="py-4">
            @yield('content') {{-- Contenido de la páginas que usen la plantilla --}}
        </main> {{-- Fin del main --}}
        {{-- Inicio del footer --}}
        <footer class="mt-auto py-2 page-footer" id="copyright">
            <small>Copyright &copy; 2019 - SIPLAFT - Todos los derechos reservados</small>
        </footer> {{-- Fin del footer --}}
        <!-- Scripts -->
        <script src="{{ asset('/js/app.js') }}" defer></script>
    </div>
</body> {{-- Fin del body --}}
</html>
{{-- Fin de la plantilla principal --}}
