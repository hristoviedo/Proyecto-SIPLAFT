@extends('layouts.app') {{-- Usa la plantilla principal app.blade.php --}}

@section('content') {{-- Inicio de la seccion --}}

<div  id="col" class="container-fluid">
    <div class="row">
      <nav class="col-md-2 d-none d-md-block bg-light sidebar"> {{-- Inicio de la barra de navegación lateral --}}
        <div class="sidebar-sticky">
          <ul class="nav flex-column"> {{-- Inicio de la lista de elementos en la barra de navegación --}}
            <li class="nav-item"> {{-- Item #1 página principal del colaborador --}}
              <a class="nav-link link__color" href="col.client"> {{-- Enlazado a la ruta /home.col --}}
                    <svg  width="20" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-users"><line x1="17" y1="11" x2="7" y2="11"></line><line x1="12" y1="5" x2="12" y2="16"></line><circle cx="12" cy="11" r="11"></svg>
                        Enviar Lista de Clientes <span class="sr-only">(current)</span>
              </a>
            </li>
            <li class="nav-item"> {{-- Item #1 página principal del colaborador --}}
              <a class="nav-link link__color" href="col.transaction"> {{-- Enlazado a la ruta /home.col --}}
                    <svg  width="20" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-users"><line x1="17" y1="11" x2="7" y2="11"></line><line x1="12" y1="5" x2="12" y2="16"></line><circle cx="12" cy="11" r="11"></svg>
                        Enviar Lista de Transacciones <span class="sr-only">(current)</span>
              </a>
            </li>
            <li class="nav-item">
                <a class="nav-link link__color" href="{{ route('col.simulation') }}">
                    <svg  width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file-text"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg>
                Pre-Evaluación
                </a>
            </li>
            <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
                <span><b>Reportería</b></span>
            </h6>
            <li class="nav-item">
                <a class="nav-link link__color" href="{{ route('col.report') }}">
                  <svg  width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file-text"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg>
                  Reporte Mensual
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link link__color" href="{{ route('col.report.all') }}">
                  <svg  width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file-text"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg>
                  Reporte Completo
                </a>
            </li>
            {{-- <li class="nav-item"> {{-- Item #2 perfil del colaborador
                <a class="nav-link link__color" href="#">
                    <svg  width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-users"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle></svg>
                Perfil
                </a>
            </li> --}}
            <li class="nav-item"> {{-- Item #3 página de ayuda del colaborador (pendiente) --}}
            <a class="nav-link link__color" href="{{ route('col.manual') }}">
                  <svg  width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-plus-circle"><circle cx="12" cy="12" r="10"></circle></svg>
              Manual de Usuario
              </a>
          </li>
          </ul>{{-- Fin de la lista de elementos en la barra de navegación --}}
        </div>
      </nav>{{-- Fin de la barra de navegación lateral --}}

      @yield('content.col') {{-- Contenido de la páginas que usen la plantilla --}}

    </div>
  </div>
@endsection {{-- Fin de la seccion --}}
