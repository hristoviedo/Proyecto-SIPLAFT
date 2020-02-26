@extends('layouts.col') {{-- Usa la plantilla col.blade.php --}}

@section('content.col') {{-- Inicio de la seccion --}}

<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4"> {{-- Inicio del main --}}
    <div class="py-5 text-center">
      {{-- <img :src="imageForm"> --}}
      <h2>Evaluación Preliminar de Riesgo</h2>
      <p class=""><strong>Con este formulario calculará el riesgo que representa un posible cliente y tomar las medidas necesarias</strong></p>
    </div>
    <div class="row">
      <div class="col-md-3 order-md-2 mb-4">
        <h4 class="d-flex justify-content-between align-items-center mb-3">
          <span class="text-muted">Resultados</span>
          <span class="badge badge-secondary badge-pill" v-show='scoreRisk'>@{{ formatPrice(scoreRisk) }} de 5.00</span>
        </h4>
        <ul class="list-group mb-3">
          <li class="list-group-item d-flex justify-content-between lh-condensed" v-show='name'>
            <div>
              <h6 class="my-0 mx-2">Nombre:</h6>
            </div>
          <span class="text-uppercase"><b>@{{ name }}</b></span>
          </li>
          <li class="list-group-item d-flex justify-content-between lh-condensed" v-show='age'>
            <div>
              <h6 class="my-0 mx-2">Edad:</h6>
            </div>
          <span class="text-uppercase"><b>@{{age}} AÑOS</b></span>
          </li>
          <li class="list-group-item d-flex justify-content-between lh-condensed" v-show='households'>
            <div>
              <h6 class="my-0 mx-2">No. de Viviendas:</h6>
            </div>
            <span class="text-uppercase"><b>@{{households}} VIVIENDAS</b></span>
          </li>
          <li class="list-group-item d-flex justify-content-between lh-condensed" v-show='activity'>
            <div>
              <h6 class="my-0 mx-2">Actividad Económica:</h6>
            </div>
          <span class="text-uppercase"><b>@{{ activity }}</b></span>
          </li>
          <li class="list-group-item d-flex justify-content-between lh-condensed" v-show='funding'>
            <div>
              <h6 class="my-0 mx-2">Fuente de Financiamiento:</h6>
            </div>
          <span class="text-uppercase"><b>@{{ funding }}</b></span>
          </li>
          <li class="list-group-item d-flex justify-content-between" :style="riskColor()" v-show='risk'>
            <div class="">
              <h6 class="my-0 mx-2"><b>Riesgo</b></h6>
            </div>
          <span class="">@{{ risk }}</span>
          </li>
        </ul>
      </div>
      <div class="col-md-9 order-md-1">
        <h4 class="mb-3">Datos del posible cliente</h4>
        <form class="">
          <div class="row">
            <div class="col-md-6 mb-3">
                <label for="name">Nombre completo</label>
                <input type="text" class="form-control text-uppercase" id="name" placeholder="" v-model="name" maxlength="40" oninput="if(this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" /><i>(Máximo 40 caracteres)</i>
                {{-- <div class="invalid-feedback">
                  Valid first name is required.
                </div> --}}
              </div>
            <div class="col-md-3 mb-3">
              <label for="age">Edad</label>
              <input type="number" class="form-control" min="0" maxlength="3" id="age" placeholder="" v-model="age" oninput="if(this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" /><i>(Máximo 3 dígitos)</i>
              {{-- <div class="invalid-feedback">
                Zip code required.
              </div> --}}
            </div>
            <div class="col-md-3 mb-3">
                <label class="" for="households">No. de Viviendas</label>
                <input type="number" class="form-control" id="households" maxlength="2" placeholder=""  v-model="households" oninput="if(this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" /><i>(Máximo 2 dígitos)</i>
                {{-- <div class="invalid-feedback">
                  Zip code required.
                </div> --}}
              </div>
          </div>
          <div class="row">
              <div class="col-md-6 mb-3">
                <label for="activity">Actividad Económica</label>
                <select name="activity" class="custom-select d-block w-100" id="activity"  v-model="activity">
                    @foreach($activities as $activity)
                        <option>{{ $activity->name }}</option>
                    @endforeach
                </select>
                {{-- <div class="invalid-feedback">
                  Please select a valid country.
                </div> --}}
              </div>
              <div class="col-md-6 mb-3">
                <label for="funding">Fuente de Financiamiento</label>
                <select name="funding" class="custom-select d-block w-100" v-model="funding">
                    @foreach($fundings as $funding)
                        <option>{{ $funding->name }}</option>
                    @endforeach
                </select>
                {{-- <div class="invalid-feedback">
                  Please provide a valid state.
                </div> --}}
              </div>
            </div>
            <div class="row">
                <div class="col">
                </div>
                <div class="col">
                </div>
                <div class="col-auto">
                  <button type="button" class="btn btn-sm btn-color" @click.prevent='clearProperty'>Limpiar</button>
                </div>
                <div class="col-auto">
                  <button type="button" class="btn btn-sm btn-color" @click.prevent='calculateRisk'>Calcular</button>
                </div>
            </div>
        </form>
      </div>
    </div>
  </main> {{-- Fin del main --}}
@endsection {{-- Fin de la seccion --}}
