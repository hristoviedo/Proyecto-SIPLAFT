@extends('layouts.col') {{-- Usa la plantilla col.blade.php --}}

@section('content.col') {{-- Inicio de la seccion --}}
  <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4"> {{-- Inicio del main --}}
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3">
        <h1 class="h2">Enviar lista de clientes</h1>
    </div>
    <div class="mostrar_ocultar">
        {{-- Inicio de la condición --}}
        @if (Session::has('message')) {{-- ¿Existe un mensaje que mostrar? --}}
            <div class="alert alert-success" role="alert">
              <p class="lead importacion__message">{{ Session::get('message') }}</p> {{-- Muestra el mensaje --}}
            </div>
        @endif {{-- Fin de la condición --}}
    </div>
    <div class="input-group custom-file">

        {{-- Inicio del formulario --}}
        <form action="{{ route('client.import.excel') }}" method="POST" enctype="multipart/form-data"> {{-- Manda el excel a la ruta /carga --}}

            @csrf {{-- Token generado --}}

            <div>
              {{-- Input de tipo File que solo acepta archivos de excel y es requerido --}}
            <input type="file" accept=".xlsx" name="file" class="custom-file-input" id="customFile" required>

            {{-- Label que cambia según el nombre del archivo (pendiente de configurar js) --}}
            <label class="custom-file-label" for="customFile"></label>
            </div>

            <div class="text-center">
              {{-- Botón para subir la lista de clientes --}}
            <button class="btn btn-lg  btn-subir btn-color" id="button">
              {{-- <span class="spinner-border spinner-border-sm mr-2"></span> --}}
              Enviar
            </button>
            </div>
        </form>{{-- Fin del formulario --}}
    </div>
  </main> {{-- Fin del main --}}
@endsection {{-- Fin de la seccion --}}
