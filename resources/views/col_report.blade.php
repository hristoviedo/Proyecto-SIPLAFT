@extends('layouts.col')

@section('content.col')

<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4"> {{-- Inicio del main --}}
    <div class="py-5 text-center">
      {{-- <img src="{{ asset('img/logo.png') }}" class="img-fluid img-small" alt="Responsive image"> --}}
      <h2>Reporte Mensual de Transacciones</h2>
      <p class="">En esta sección exportará las transacciones según el mes y año en formato .xlsx</p>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-md-4"></div>
            <div class="col-md-4 text-center">
                <form action="{{ route('transactions.export.excel') }}" method="POST">
                    @csrf
                    <div class="form-group row">
                        <label for="month" class="col-md-3 col-form-label text-md-right">Mes: </label>
                        <div class="col-md-7">
                            <select name="month" class="form-control" id="month">
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
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="year" class="col-md-3 col-form-label text-md-right">Año: </label>
                        <div class="col-md-7">
                            {{ Form::selectRange('year', 2025, 1990, 2020, array('class' => 'year form-control', 'id' =>'year')) }}
                        </div>
                    </div>
                    <br>
                    <button type="submit" class="btn btn-default btn-color">Crear Reporte</button>
                </form>
            </div>
            <div class="col-md-4"></div>
        </div>
    </div>
  </main> {{-- Fin del main --}}
@endsection {{-- Fin de la seccion --}}
