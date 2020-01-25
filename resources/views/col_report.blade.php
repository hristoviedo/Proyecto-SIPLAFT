@extends('layouts.col')

@section('content.col')

<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4"> {{-- Inicio del main --}}
    <div class="py-5 text-center">
      {{-- <img src="{{ asset('img/logo.png') }}" class="img-fluid img-small" alt="Responsive image"> --}}
      <h2>Reporte Mensual de Transacciones</h2>
      <p class="">En esta sección exportará las transacciones según el mes y año en formato .xlsx</p>
    </div>
    <div class="panel panel-default">
        <div class="panel-body col-xs-8">
            <div class="text-center">
                <form action="{{ route('transactions.export.excel') }}" method="POST">
                    @csrf
                    {{ Form::label('month', 'Escoja el mes y año a reportar') }}
                    <select name="month">
                        <option value="1">ENERO</option>
                        <option value="2">FEBRERO</option>
                        <option value="3">MARZO</option>
                        <option value="4">ABRIL</option>
                        <option value="5">MAYO</option>
                        <option value="6">JUNIO</option>
                        <option value="7">JULIO</option>
                        <option value="8">AGOSTO</option>
                        <option value="9">SEPTIEMBRE</option>
                        <option value="10">OCTUBRE</option>
                        <option value="11">NOVIEMBRE</option>
                        <option value="12">DICIEMBRE</option>
                    </select>
                    {{ Form::selectRange('year', 2025, 1950, 2020, array('class' => 'year')) }}
                    <br>
                    <button type="submit" class="btn btn-default btn-color">Crear Reporte</button>
                </form>
            </div>
        </div>
    </div>
  </main> {{-- Fin del main --}}
@endsection {{-- Fin de la seccion --}}
