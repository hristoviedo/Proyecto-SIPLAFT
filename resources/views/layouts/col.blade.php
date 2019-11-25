@extends('layouts.app') {{-- Usa la plantilla principal app.blade.php --}}

@section('content') {{-- Inicio de la seccion --}}

<div  id="col" class="container-fluid">
    <div class="row">
      <nav class="col-md-2 d-none d-md-block bg-light sidebar"> {{-- Inicio de la barra de navegación lateral --}}
        <div class="sidebar-sticky">
          <ul class="nav flex-column"> {{-- Inicio de la lista de elementos en la barra de navegación --}}
            <li class="nav-item"> {{-- Item #1 página principal del colaborador --}}
              <a class="nav-link" href="col.client"> {{-- Enlazado a la ruta /home.col --}}
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-home"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg>
                Subir Lista de Clientes <span class="sr-only">(current)</span>
              </a>
            </li>
            <li class="nav-item"> {{-- Item #1 página principal del colaborador --}}
              <a class="nav-link" href="col.transaction"> {{-- Enlazado a la ruta /home.col --}}
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-home"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg>
                Subir Lista de Transacciones <span class="sr-only">(current)</span>
              </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('col.simulation') }}">
                    <svg  width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file-text"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg>
                Pre-Evaluación
                </a>
            </li>
            <li class="nav-item"> {{-- Item #2 perfil del colaborador --}}
                <a class="nav-link" href="#">
                    <svg  width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-users"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle></svg>
                Perfil
                </a>
            </li>
            <li class="nav-item"> {{-- Item #3 página de ayuda del colaborador (pendiente) --}}
              <a class="nav-link" href="#">
                  <svg  width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-plus-circle"><circle cx="12" cy="12" r="10"></circle></svg>
              Ayuda
              </a>
          </li>
          </ul>{{-- Fin de la lista de elementos en la barra de navegación --}}
        </div>
      </nav>{{-- Fin de la barra de navegación lateral --}}

      @yield('content.col') {{-- Contenido de la páginas que usen la plantilla --}}

    </div>
  </div>
@endsection {{-- Fin de la seccion --}}
