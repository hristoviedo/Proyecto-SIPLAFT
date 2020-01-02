@extends('layouts.col')

@section('content.col')

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
                <label for="month">Actividad Económica</label>
                <select class="custom-select d-block w-100" id="month"  v-model="month">
                  <option v-for="(month, index) in months" :key="index">
                    @{{ month }}
                  </option>
                </select>
                {{-- <div class="invalid-feedback">
                  Please select a valid country.
                </div> --}}
              </div>
              <div class="col-md-6 mb-3">
                <label for="year">Actividad Económica</label>
                <select class="custom-select d-block w-100" id="year"  v-model="year">
                  <option v-for="(year, index) in years" :key="index">
                    @{{ year }}
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
