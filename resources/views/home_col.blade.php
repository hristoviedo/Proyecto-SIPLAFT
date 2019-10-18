@extends('layouts.app') {{-- Usa la plantilla principal app.blade.php --}}

@section('content') {{-- Inicio de la seccion --}}

<div class="container-fluid">
    <div class="row">
      <nav class="col-md-2 d-none d-md-block bg-light sidebar"> {{-- Inicio de la barra de navegación lateral --}}
        <div class="sidebar-sticky">
          <ul class="nav flex-column"> {{-- Inicio de la lista de elementos en la barra de navegación --}}
            <li class="nav-item"> {{-- Item #1 página principal del colaborador --}}
              <a class="nav-link" href="home.col"> {{-- Enlazado a la ruta /home.col --}}
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-home"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg>
                Subir Archivo <span class="sr-only">(current)</span>
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

    <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4"> {{-- Inicio del main --}}
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3">
            <h1 class="h2">Subir archivo</h1>
        </div>
        <div>
            {{-- Inicio de la condición --}}
            @if (Session::has('message')) {{-- ¿Existe un mensaje que mostrar? --}}
                <p class="lead importacion__message">{{ Session::get('message') }}</p> {{-- Muestra el mensaje --}}
            @endif {{-- Fin de la condición --}}
        </div>
        <div class="input-group custom-file">

            {{-- Inicio del formulario --}}
            <form action="{{ route('client.import.excel') }}" method="POST" enctype="multipart/form-data"> {{-- Manda el excel a la ruta /carga --}}

                @csrf {{-- Token generado --}}

                {{-- Input de tipo File que solo acepta archivos de excel y es requerido --}}
                <input type="file" accept=".xlsx" name="file" class="custom-file-input" id="customFile" required>

                {{-- Label que cambia según el nombre del archivo (pendiente de configurar js) --}}
                <label class="custom-file-label" for="customFile"></label>

                {{-- Botón para subir la lista de clientes --}}
                <button class="btn btn-block btn-subir btn-color" id="button">Importar Clientes</button>
            </form>{{-- Fin del formulario --}}
        </div>
      </main> {{-- Fin del main --}}
    </div>
  </div>
@endsection {{-- Fin de la seccion --}}
