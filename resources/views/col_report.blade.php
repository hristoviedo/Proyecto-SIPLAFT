@extends('layouts.col')

@section('content.col')

<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4"> {{-- Inicio del main --}}
    <div class="py-5 text-center">
      {{-- <img src="{{ asset('img/logo.png') }}" class="img-fluid img-small" alt="Responsive image"> --}}
      <h2>Reporte de Transacciones</h2>
      <p class="">En esta sección exportará las transacciones según el mes y año en formato .xlsx</p>
    </div>
    <div class="panel panel-default">
        <div class="panel-body col-xs-12">
            <div class="col-md-5 center-block">
                <form action="{{ route('transactions.export.excel') }}" method="POST">
                    @csrf
                    <label for="month">Fecha</label>
                    <input type="number" name="month" id="month" placeholder="Número del 1-12">
                    <input type="number" name="year" id="year" placeholder="Ejemplo: 2020">
                    <button type="submit" class="btn btn-default btn-primary">Crear Reporte</button>
                </form>
            </div>
        </div>
    </div>
  </main> {{-- Fin del main --}}
@endsection {{-- Fin de la seccion --}}
