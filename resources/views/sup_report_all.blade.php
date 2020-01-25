@extends('layouts.sup')

@section('content.sup')

<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4"> {{-- Inicio del main --}}
    <div class="py-5 text-center">
      {{-- <img src="{{ asset('img/logo.png') }}" class="img-fluid img-small" alt="Responsive image"> --}}
      <h2>Reporte Completo de Transacciones por Inmobiliaria</h2>
      <p class="">En esta sección exportará las transacciones de las inmobiliarias en formato .xlsx</p>
    </div>
    <div class="text-center">
        <a class="btn btn-color" role="button" href="{{ route('transactions.all.excel.sup') }}">
            <p class="">Crear Reporte</p>
        </a>
    </div>
  </main> {{-- Fin del main --}}
@endsection {{-- Fin de la seccion --}}
