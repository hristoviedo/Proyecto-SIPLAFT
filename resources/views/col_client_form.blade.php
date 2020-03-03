@extends('layouts.col') {{-- Usa la plantilla col.blade.php --}}

@section('content.col') {{-- Inicio de la seccion --}}

<div id="col_client" role="main" class="col-md-9 ml-sm-auto col-lg-10 px-5"> {{-- Inicio del main --}}
    <div class="py-3 text-center">
      {{-- <img :src="imageForm"> --}}
      <h2>Registrar Nuevo Cliente</h2>
      <p class=""><strong>Con este formulario creará un nuevo cliente</strong></p>
    </div>
    <div class="row justify-content-center">
      <div class="col-md-10 order-md-1">
        <h4 class="mb-3">Datos del cliente</h4>
        <div class="mostrar_ocultar">
            {{-- Inicio de la condición --}}
            @if (count($errors) > 0) {{-- ¿Existe un algún error que mostrar? --}}
                <div class="alert alert-danger" role="alert">
                    <button type="button" class="close" data-dismiss="alert">x</button>
                    <p class="lead">Error al crear cliente</p> {{-- Muestra los errores --}}
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
            <form class="border p-3 form" method="POST" action="{{ route('col.client.create') }}">
                @csrf
                <div class="form-group row">
                    <div class="col-md-3 mb-3">
                        <label for="identity">Identidad</label>
                        <input name="identity" id="identity" class="form-control text-uppercase" type="text" v-model="identity" v-mask="'####-####-######'" value="{{ old('identity') }}" placeholder="9999-9999-99999" autofocus required/>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="name">Nombre completo</label>
                        <input name="name" id="name" class="form-control text-uppercase" type="text" v-model="name" maxlength="40" value="{{ old('name') }}" placeholder="JUAN PEREZ PEREIRA" required/>
                    </div>
                    <div class="col-md-3 mb-3">
                        <label class="" for="email">Correo</label>
                        <input name="email" id="email" class="form-control text-lowercase" v-model="email" maxlength="40" value="{{ old('email') }}" placeholder="cliente.nuevo@correo.com" required/>
                    </div>
                </div>
                <div class="form-group row">
                <div class="col-md-2 mb-3">
                    <label for="age">Edad</label>
                    <input name="age" id="age" class="form-control" type="number" v-model="age"  v-mask="'##'" value="{{ old('age') }}" placeholder="99" required/>
                </div>
                <div class="col-md-3 mb-3">
                    <label class="" for="phone1">Teléfono 1</label>
                    <input name="phone1" id="phone1" class="form-control" v-model="phone1" v-mask="'####-####'" value="{{ old('phone1') }}" placeholder="9999-9999" required/>
                </div>
                <div class="col-md-3 mb-3">
                    <label class="" for="phone2">Teléfono 2</label>
                    <input name="phone2" id="phone2" class="form-control" v-model="phone2" v-mask="'####-####'" value="{{ old('phone2') }}" placeholder="9999-9999"/>
                </div>
                <div class="col-md-4 mb-3">
                    <label class="" for="nationality">Nacionalidad</label>
                    <input name="nationality" id="nationality" class="form-control text-uppercase" v-model="nationality" maxlength="20" value="{{ old('nationality') }}" placeholder="HONDUREÑA"/>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-md-5 mb-3">
                <label class="" for="workplace">Lugar de trabajo</label>
                <input name="workplace" id="workplace" class="form-control text-uppercase" v-model="workplace" maxlength="30" value="{{ old('workplace') }}" placeholder="EMPRESA"/>
            </div>
            <div class="col-md-4 mb-3">
                <label class="" for="workstation">Puesto o Cargo</label>
                <input name="workstation" id="workstation" class="form-control text-uppercase" v-model="workstation" maxlength="45" value="{{ old('workstation') }}" placeholder="PUESTO"/>
            </div>
            <div class="col-md-3 mb-3">
                <label class="" for="salary">Salario</label>
                <input name="salary" id="salary" class="form-control" v-model="salary" v-money="money" maxlength="11" value="{{ old('salary') }}" style="text-align: right" required/>
            </div>
            </div>
            <div class="from-group row">
                <div class="col-md-6 mb-3">
                    <label for="activity">Actividad Económica</label>
                    <select name="activity" id="activity" class="custom-select d-block w-100" v-model="activity" value="{{ old('activity') }}"required >
                        @foreach($activities as $activity)
                            <option value="{{ $activity->id }}">{{ $activity->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="funding">Fuente de Financiamiento</label>
                    <select name="funding" id="funding" class="custom-select d-block w-100" v-model="funding" value="{{ old('funding') }}" required>
                        @foreach($fundings as $funding)
                            <option value="{{ $funding->id }}">{{ $funding->name }}</option>
                        @endforeach
                    </select>
                </div>
                </div>
                <div class="row">
                    <div class="col">
                    </div>
                    <div class="col">
                    </div>
                    <div class="col-auto">
                    <button type="submit" class="btn btn-sm btn-success">Registrar</button>
                    </div>
                    <div class="col-auto">
                    <button type="button" class="btn btn-sm btn-primary" @click.prevent='clearProperty'>Limpiar</button>
                    </div>
                    <a class="btn btn-sm btn-danger" role="button" href="{{ route('col.client.table') }}">
                        <p class="">Cancelar</p>
                    </a>
                </div>
            </form>
      </div>
    </div>
</div> {{-- Fin del main --}}
@endsection {{-- Fin de la seccion --}}
