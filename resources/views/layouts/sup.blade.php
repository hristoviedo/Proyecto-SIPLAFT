@extends('layouts.app') {{-- Extiende de app.blade.php --}}

@section('content') {{-- Contenido agregada --}}

<div class="container-fluid"> {{-- id usado por Vuejs --}}
    <div class="row">
      <nav class="col-md-2 d-none d-md-block bg-light">
        <div class="">
          <ul class="nav flex-column">
            <li class="nav-item">
              <a class="nav-link" href="{{ route('sup.client') }}">
                <svg  width="20" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-users"><line x1="17" y1="11" x2="7" y2="11"></line><line x1="12" y1="5" x2="12" y2="16"></line><circle cx="12" cy="11" r="11"></svg>
                    Tabla de Clientes <span class="sr-only">(current)</span>
              </a>
              <a class="nav-link" href="{{ route('sup.transaction') }}">
                <svg  width="20" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-users"><line x1="17" y1="11" x2="7" y2="11"></line><line x1="12" y1="5" x2="12" y2="16"></line><circle cx="12" cy="11" r="11"></svg>
                    Tabla de Transacciones <span class="sr-only">(current)</span>
              </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">
                    <svg  width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-users"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle></svg>
                Perfil de Usuario
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">
                    <svg  width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-plus-circle"><circle cx="12" cy="12" r="10"></circle></svg>
                Ayuda
                </a>
            </li>
          </ul>
        </div>
      </nav>
      @yield('content.sup') {{-- Contenido de la páginas que usen la plantilla --}}
    </div>
  </div>

@endsection
