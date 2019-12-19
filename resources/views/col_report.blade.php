@extends('layouts.sup')

@section('content.sup')

<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4"> {{-- Inicio del main --}}
    <div class="py-5 text-center">
      {{-- <img :src="imageForm"> --}}
      <h2>Reporte de Transacciones</h2>
      <p class="">En esta sección exportará las transacciones según el mes y año en formato .csv</p>
    </div>
    <div class="row">
      <div class="col-md-12 order-md-1">
        <h4 class="mb-3"></h4>
        <form class="">
          <div class="row">
            <div class="col-md-6 mb-3">
                <label for="name">Nombre completo</label>
                <input type="text" class="form-control text-uppercase" id="name" placeholder="" v-model="name">
                {{-- <div class="invalid-feedback">
                  Valid first name is required.
                </div> --}}
              </div>
            <div class="col-md-3 mb-3">
              <label for="age">Edad</label>
              <input type="number" class="form-control" id="age" placeholder="" v-model="age">
              {{-- <div class="invalid-feedback">
                Zip code required.
              </div> --}}
            </div>
            <div class="col-md-3 mb-3">
                <label class="" for="households">No. de Viviendas</label>
                <input type="number" class="form-control" id="households" placeholder=""  v-model="households">
                {{-- <div class="invalid-feedback">
                  Zip code required.
                </div> --}}
              </div>
          </div>
          <div class="row">
              <div class="col-md-6 mb-3">
                <label for="activity">Actividad Económica</label>
                <select class="custom-select d-block w-100" id="activity"  v-model="activity">
                  <option v-for="(activityType, index) in activityArray" :key="index">
                    @{{ activityType }}
                  </option>
                </select>
                {{-- <div class="invalid-feedback">
                  Please select a valid country.
                </div> --}}
              </div>
              <div class="col-md-6 mb-3">
                <label for="funding">Fuente de Financiamiento</label>
                <select class="custom-select d-block w-100" id="funding"  v-model="funding">
                  <option v-for="(fundingType, index) in fundingArray" :key="index">
                    @{{ fundingType }}
                  </option>
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
