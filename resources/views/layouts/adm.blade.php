@extends('layouts.app') {{-- Usa la plantilla principal app.blade.php --}}

@section('content') {{-- Inicio de la seccion --}}

<div class="container-fluid">
    <div class="row">
        <nav class="col-md-2 d-none d-md-block bg-light sidebar">
            <div class="sidebar-sticky">
                <ul class="nav flex-column">
                    <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
                        <span><b>Tablas</b></span>
                    </h6>
                    <li class="nav-item">
                        <a class="nav-link link__color" href="{{ route('adm.record') }}">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-home"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg>
                            Historial <span class="sr-only">(current)</span>
                        </a>
                    </li>
                    {{-- <li class="nav-item">
                        <a class="nav-link link__color" href="#">
                            <svg  width="20" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-users"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle></svg>
                            Perfil
                        </a>
                    </li> --}}
                    <li class="nav-item">
                        <a class="nav-link link__color" href="{{ route('adm.user') }}">
                                <svg  width="20" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-users"><line x1="17" y1="11" x2="7" y2="11"></line><line x1="12" y1="5" x2="12" y2="16"></line><circle cx="12" cy="11" r="11"></svg>
                                    Usuarios
                                </a>
                    </li>
                    {{-- <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
                        <span><b>Reportería</b></span>
                    </h6>
                    <li class="nav-item">
                        <a class="nav-link link__color" href="#">
                            <svg  width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file-text"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg>
                            Reportes
                        </a>
                    </li> --}}
                    <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
                        <span><b>Ayuda</b></span>
                    </h6>
                    <li class="nav-item">
                        <a class="nav-link link__color" href="{{ route('adm.manual') }}">
                            <svg  width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-plus-circle"><circle cx="12" cy="12" r="10"></circle></svg>
                            Manual de Usuario
                        </a>
                    </li>
                </ul>
    </div>
</nav>
@yield('content.adm') {{-- Contenido de la páginas que usen la plantilla --}}
</div>
</div>

@endsection {{-- Fin de la seccion --}}
