@extends('layouts.app') {{-- Usa la plantilla principal app.blade.php --}}

@section('content') {{-- Inicio de la seccion --}}

<div  id="col" class="container-fluid">
    <div class="row">
      <nav class="col-md-2 d-none d-md-block bg-light sidebar"> {{-- Inicio de la barra de navegación lateral --}}
        <div class="sidebar-sticky">
          <ul class="nav flex-column"> {{-- Inicio de la lista de elementos en la barra de navegación --}}
            <li class="nav-item"> {{-- Item #1 página principal del colaborador --}}
              <a class="nav-link" href="home.col"> {{-- Enlazado a la ruta /home.col --}}
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-home"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg>
                Subir Archivo <span class="sr-only">(current)</span>
              </a>
            </li>
            <li class="nav-item"> {{-- Item #2 perfil del colaborador --}}
                <a class="nav-link" href="#">
                    <svg  width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-users"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle></svg>
                Perfil
                </a>
            </li>
            <li class="nav-item"> {{-- Item #3 página de ayuda del colaborador (pendiente) --}}
              <a class="nav-link" href="#">
                  <svg  width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-plus-circle"><circle cx="12" cy="12" r="10"></circle></svg>
              Ayuda
              </a>
          </li>
          </ul>{{-- Fin de la lista de elementos en la barra de navegación --}}
        </div>
      </nav>{{-- Fin de la barra de navegación lateral --}}

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
            <span class="badge badge-secondary badge-pill">4.5 de 5.0</span>
          </h4>
          <ul class="list-group mb-3">
            <li class="list-group-item d-flex justify-content-between lh-condensed">
              <div>
                <h6 class="my-0 mx-2">Nombre:</h6>
              </div>
              <span class=""><b>ALEXANDER MAXIMILIANO HERNANDEZ GONZALES</b></span>
            </li>
            <li class="list-group-item d-flex justify-content-between lh-condensed">
              <div>
                <h6 class="my-0">Edad:</h6>
              </div>
              <span class="text-muted"><b>51 AÑOS</b></span>
            </li>
            <li class="list-group-item d-flex justify-content-between lh-condensed">
              <div>
                <h6 class="my-0">No. de Viviendas:</h6>
              </div>
              <span class="text-muted"><b>5 VIVIENDAS</b></span>
            </li>
            <li class="list-group-item d-flex justify-content-between lh-condensed">
              <div>
                <h6 class="my-0 mx-2">Actividad Económica:</h6>
              </div>
              <span class="text-muted"><b>SIN FINES DE LUCRO (ONGS)</b></span>
            </li>
            <li class="list-group-item d-flex justify-content-between lh-condensed">
              <div>
                <h6 class="my-0 mx-2">Fuente de Financiamiento:</h6>
              </div>
              <span class="text-muted"><b>DEPÓSITO EN EFECTIVO EN CTAS DE LA EMPRESA</b></span>
            </li>
            <li class="list-group-item d-flex justify-content-between bg-critico">
              <div class="">
                <h6 class="my-0">Riesgo</h6>
              </div>
              <span class="text-danger">SIGNIFICATIVO</span>
            </li>
          </ul>
        </div>
        <div class="col-md-9 order-md-1">
          <h4 class="mb-3">Datos del posible cliente</h4>
          <form class="">
            <div class="row">
              <div class="col-md-6 mb-3">
                  <label for="name">Nombre completo</label>
                  <input type="text" class="form-control" id="name" placeholder="">
                  {{-- <div class="invalid-feedback">
                    Valid first name is required.
                  </div> --}}
                </div>
              <div class="col-md-3 mb-3">
                <label for="age">Edad</label>
                <input type="number" class="form-control" id="age" placeholder="" v-model.number="age">
                {{-- <div class="invalid-feedback">
                  Zip code required.
                </div> --}}
              </div>
              <div class="col-md-3 mb-3">
                  <label class="" for="households">No. de Viviendas</label>
                  <input type="number" class="form-control" id="households" placeholder="">
                  {{-- <div class="invalid-feedback">
                    Zip code required.
                  </div> --}}
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 mb-3">
                  <label for="activity">Actividad Económica</label>
                  <select class="custom-select d-block w-100" id="activity">
                    <option value="">Escoger...</option>
                  </select>
                  {{-- <div class="invalid-feedback">
                    Please select a valid country.
                  </div> --}}
                </div>
                <div class="col-md-6 mb-3">
                  <label for="state">Fuente de Financiamiento</label>
                  <select class="custom-select d-block w-100" id="state">
                    <option value="">Escoger...</option>
                  </select>
                  {{-- <div class="invalid-feedback">
                    Please provide a valid state.
                  </div> --}}
                </div>
              </div>
          </form>
        </div>
      </div>
      </main> {{-- Fin del main --}}
    </div>
  </div>
@endsection {{-- Fin de la seccion --}}
