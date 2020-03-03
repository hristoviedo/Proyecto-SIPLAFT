@extends('layouts.col') {{-- Usa la plantilla col.blade.php --}}

@section('content.col') {{-- Inicio de la seccion --}}

<div id="col_client" role="main" class="col-md-9 ml-sm-auto col-lg-10 px-5"> {{-- Inicio del main --}}
    <div class="py-3 text-center">
      {{-- <img :src="imageForm"> --}}
      <h2>Actualizar Transacción</h2>
      <p class=""><strong>Con este formulario actualizará una transacción</strong></p>
    </div>
    <div class="row justify-content-center">
      <div class="col-md-10">
        <h4 class="mb-3">Datos de la transacción</h4>
        <div class="mostrar_ocultar">
            {{-- Inicio de la condición --}}
            @if (count($errors) > 0) {{-- ¿Existe un algún error que mostrar? --}}
                <div class="alert alert-danger" role="alert">
                    <button type="button" class="close" data-dismiss="alert">x</button>
                    <p class="lead">Error al actualizar transacción</p> {{-- Muestra los errores --}}
                    <ul> {{-- Muestra la lista de errores --}}
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                  </ul>
                </div>
            @endif {{-- Fin de la condición --}}
            {{-- Inicio de la condición --}}
            @if (Session::has('message')) {{-- ¿Existe un mensaje que mostrar? --}}
                <div class="alert alert-success" role="alert">
                    <button type="button" class="close" data-dismiss="alert">x</button>
                    <p class="lead">{{ Session::get('message') }}</p> {{-- Muestra el mensaje --}}
                </div>
            @endif {{-- Fin de la condición --}}
        </div>
        @foreach($transaction as $transactionUpdate)
        <form class="border p-3 form" method="POST" action="/transactions/{{ $transactionUpdate->id }}">
            @csrf
            @method('PUT')
            <div class="form-group row">
                <div class="col-md-6 mb-3">
                    <label for="identity">Identidad</label>
                    <input name="identity" id="identity" value="{{ $transactionUpdate->identity }}" class="form-control" type="text" disabled required/>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="name">Nombre del Cliente</label>
                    <input name="name" id="name" value="{{ $transactionUpdate->name }}" class="form-control text-uppercase" type="text" disabled required/>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-md-4 mb-3">
                    <label for="apartment_number">No de Apartamento</label>
                    <input name="apartment_number" id="apartment_number" class="form-control text-uppercase" type="text" maxlength="10" value="{{ $transactionUpdate->apartment_number }}" placeholder="EJEMPLO: 9-9999" autofocus required/>
                </div>
                <div class="col-md-4 mb-3">
                    <label for="operation_date">Fecha de Operación</label>
                    <input name="operation_date" id="operation_date" class="form-control" type="date" value="{{ $transactionUpdate->operation_date }}" placeholder="dia-mes-año" required/>
                </div>
                <div class="col-md-4 mb-3">
                    <label for="transfer_date">Fecha de Traspaso</label>
                    <input name="transfer_date" id="transfer_date" class="form-control" type="date" value="{{ $transactionUpdate->transfer_date }}" placeholder="dia-mes-año" required/>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-md-3 mb-3">
                    <label class="" for="intermediary_bank">Banco Intermediario</label>
                    <input name="intermediary_bank" id="intermediary_bank" class="form-control text-uppercase" maxlength="30" value="{{ $transactionUpdate->intermediary_bank }}" placeholder="EJEMPLO: BAC" onKeyUp="this.value=this.value.toUpperCase();" required/>
                </div>
                <div class="col-md-3 mb-3">
                    <label class="" for="amount">Monto de la Transacción</label>
                    <input name="amount" id="amount" class="form-control text-uppercase" v-money="money" maxlength="11" style="text-align: right" value="{{ $transactionUpdate->amount }}" placeholder=""/>
                </div>
                <div class="col-md-3 mb-3">
                    <label class="" for="currency">Moneda</label>
                    <input name="currency" id="currency" class="form-control text-uppercase" maxlength="45" value="{{ $transactionUpdate->currency }}" placeholder="EJEMPLO: LEMPIRAS" onKeyUp="this.value=this.value.toUpperCase();"/>
                </div>
                <div class="col-md-3 mb-3">
                    <label class="" for="cash">¿Efectivo?</label>
                    <select name="cash" class="form-control">
                        @if( $transactionUpdate->cash  == 1)
                                <option value="1" default selected>SÍ</option>
                                <option value="0">NO</option>
                            @else
                                <option value="0" default selected>NO</option>
                                <option value="1">SÍ</option>
                        @endif
                    </select>
                </div>
            </div>
            <div class="row">
                <div class="col">
                </div>
                <div class="col">
                </div>
                <div class="col-auto">
                <button type="submit" class="btn btn-success">Actualizar</button>
                </div>
                <div class="col-auto">
                    <a class="btn btn-danger" role="button" href="{{ route('col.transaction.table') }}">
                        <p class="">Cancelar</p>
                    </a>
                </div>
            </div>
        </form>
        @endforeach
      </div>
    </div>
</div> {{-- Fin del div --}}
@endsection {{-- Fin de la seccion --}}
