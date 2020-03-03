@extends('layouts.col') {{-- Usa la plantilla col.blade.php --}}

@section('content.col') {{-- Inicio de la seccion --}}

<div id="col_client" role="main" class="col-md-9 ml-sm-auto col-lg-10 px-5"> {{-- Inicio del main --}}
    <div class="py-3 text-center">
      {{-- <img :src="imageForm"> --}}
      <h2>Actualizar Cliente</h2>
      <p class=""><strong>Con este formulario actualizará un cliente registrado</strong></p>
    </div>
    <div class="row justify-content-center">
      <div class="col-md-10 order-md-1">
        <h4 class="mb-3">Datos del cliente</h4>
        <div class="mostrar_ocultar">
            {{-- Inicio de la condición --}}
            @if (count($errors) > 0) {{-- ¿Existe un algún error que mostrar? --}}
                <div class="alert alert-danger" role="alert">
                    <button type="button" class="close" data-dismiss="alert">x</button>
                    <p class="lead">Error al actualizar cliente</p> {{-- Muestra los errores --}}
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
            @foreach($client as $clientUpdate)
                <form class="border p-3 form" method="POST" action="/clients/{{ $clientUpdate->id }}">
                    @csrf
                    @method('PUT')
                    <div class="form-group row">
                        <div class="col-md-3 mb-3">
                            <label for="identity">Identidad</label>
                            <input name="identity" id="identity" class="form-control text-uppercase" type="text" v-mask="'####-####-######'" value="{{ $clientUpdate->identity }}" placeholder="9999-9999-99999" autofocus required/>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="name">Nombre completo</label>
                            <input name="name" id="name" class="form-control text-uppercase" value="{{ $clientUpdate->name }}" type="text" maxlength="40" placeholder="JUAN PEREZ PEREIRA" onKeyUp="this.value=this.value.toUpperCase();" required/>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label class="" for="email">Correo</label>
                            <input name="email" id="email" class="form-control text-lowercase" value="{{ $clientUpdate->email }}" maxlength="40" placeholder="cliente.nuevo@correo.com" required/>
                        </div>
                    </div>
                    <div class="form-group row">
                    <div class="col-md-2 mb-3">
                        <label for="age">Edad</label>
                        <input name="age" id="age" class="form-control" value="{{ $clientUpdate->age }}" type="number" v-mask="'##'" placeholder="99" required/>
                    </div>
                    <div class="col-md-3 mb-3">
                        <label class="" for="phone1">Teléfono 1</label>
                        <input name="phone1" id="phone1" class="form-control" value="{{ $clientUpdate->phone1 }}" placeholder="9999-9999" required/>
                    </div>
                    <div class="col-md-3 mb-3">
                        <label class="" for="phone2">Teléfono 2</label>
                        <input name="phone2" id="phone2" class="form-control" value="{{ $clientUpdate->phone2 }}" placeholder="9999-9999"/>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="" for="nationality">Nacionalidad</label>
                        <input name="nationality" id="nationality" class="form-control text-uppercase" value="{{ $clientUpdate->nationality }}"maxlength="20" placeholder="HONDUREÑA" onKeyUp="this.value=this.value.toUpperCase();"/>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-5 mb-3">
                    <label class="" for="workplace">Lugar de trabajo</label>
                    <input name="workplace" id="workplace" class="form-control text-uppercase" value="{{ $clientUpdate->workplace }}" maxlength="30" placeholder="EMPRESA" onKeyUp="this.value=this.value.toUpperCase();"/>
                </div>
                <div class="col-md-4 mb-3">
                    <label class="" for="workstation">Puesto o Cargo</label>
                    <input name="workstation" id="workstation" class="form-control text-uppercase" value="{{ $clientUpdate->workstation }}" maxlength="45" placeholder="PUESTO" onKeyUp="this.value=this.value.toUpperCase();"/>
                </div>
                <div class="col-md-3 mb-3">
                    <label class="" for="salary">Salario</label>
                    <input name="salary" id="salary" class="form-control" value="{{ $clientUpdate->salary }}" v-money="money" maxlength="10" style="text-align: right" required/>
                </div>
                </div>
                <div class="from-group row">
                    <div class="col-md-6 mb-3">
                        <label for="activity">Actividad Económica</label>
                        <select name="activity_id" class="form-control">
                            @foreach($activities as $activity)
                                @if( $activity->id  == $clientUpdate->activity_id)
                                    <option value="{{ $activity->id }}" default selected>{{ $activity->name }}</option>
                                @else
                                    <option value="{{ $activity->id }}">{{ $activity->name }}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="funding">Fuente de Financiamiento</label>
                        <select name="funding_id" class="form-control">
                            @foreach($fundings as $funding)
                                @if( $funding->id  == $clientUpdate->funding_id)
                                    <option value="{{ $funding->id }}" default selected>{{ $funding->name }}</option>
                                @else
                                    <option value="{{ $funding->id }}">{{ $funding->name }}</option>
                                @endif
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
                        <button type="submit" class="btn btn-sm btn-success">Actualizar</button>
                        </div>
                        <div class="col">
                            <a class="btn btn-sm btn-danger" role="button" href="{{ route('col.client.table') }}">
                                <p class="">Cancelar</p>
                            </a>
                        </div>
                    </div>
                </form>
            @endforeach
      </div>
    </div>
</div> {{-- Fin del main --}}
@endsection {{-- Fin de la seccion --}}
