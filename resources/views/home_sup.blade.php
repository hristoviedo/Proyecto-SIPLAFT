@extends('layouts.app')

@section('content')

  <div id="sup" class="container-fluid"> {{-- id usado por la app de Vuejs --}}
    <div class="row">
      <nav class="col-md-2 d-none d-md-block bg-light">
        <div class="">
          <ul class="nav flex-column">
            <li class="nav-item">
              <a class="nav-link" href="#">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-home"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg>
                Tablero <span class="sr-only">(current)</span>
              </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">
                    <svg  width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-users"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle></svg>
                Perfil
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">
                    <svg  width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file-text"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg>
                Reportes
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">
                    <svg  width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-plus-circle"><circle cx="12" cy="12" r="10"></circle></svg>
                Ayuda
                </a>
            </li>
          </ul>

          <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
            <span>Reportes Recientes</span>
          </h6>
          <ul class="nav flex-column mb-2">
            <li class="nav-item">
              <a class="nav-link" href="#">
                <svg  width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file-text"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg>
                Último Guardado
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">
                <svg  width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file-text"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg>
                Críticos
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">
                <svg  width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file-text"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg>
                Alto
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">
                <svg  width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file-text"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg>
                Significativo
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">
                <svg  width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file-text"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg>
                Moderado
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">
                <svg  width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file-text"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg>
                Bajo
              </a>
            </li>
          </ul>
        </div>
      </nav>
      <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3">
          <h1 class="h2">Tablero</h1>
          <div class="btn-toolbar mb-2 mb-md-0 flex-center">
            <div class="input-group">
              <input v-model="property" type="text" class="form-control" placeholder="Buscar cliente">
              <span class="input-group-btn">
                <button class="btn btn-color" type="button">Buscar</button>
              </span>
            </div>
          </div>
          <nav aria-label="Page navigation example">
            <ul class="pagination">
                <li class="page-item" v-if="pagination.current_page > 1">
                    <a class="page-link" href="#" @click.prevent="changePage(pagination.current_page - 1)">
                        <span>Atrás</span>
                    </a>
                </li>
                <li class="page-item" v-for="page in pagesNumber" v-bind:class="[ page == isActived ? 'active' : '']">
                    <a class="page-link" href="#" @click.prevent="changePage(page)">
                        @{{ page }}
                    </a>
                </li>
                <li class="page-item" v-if="pagination.current_page < pagination.last_page">
                    <a class="page-link" href="#" @click.prevent="changePage(pagination.current_page + 1)">
                        <span>Siguiente</span>
                    </a>
                </li>
            </ul>
          </nav>
        </div>
        <div class="table-responsive">
          <table class="table table-striped table-hover table-sm text-center">
            <thead class="thead-dark">
              <tr>
                <th>Número de ID</th>
                <th>Nombre</th>
                <th>Teléfono</th>
                <th>Actividad Económica</th>
                <th>Nivel de Riesgo</th>
                <th>Detalles del Cliente</th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="(client, index) in searchClient" :key="index">
                <td>@{{ client.identity }}</td>
                <td>@{{ client.name }}</td>
                <td>@{{ client.phone1 }}</td>
                <td>@{{ client.activity }}</td>
                <td><button type="button" class="btn btn-sm btn-critico">@{{ client.risk }}</button></td>
                <td><a href="#" v-on:click.prevent='addClient(index)'>Más información</a></td>
              </tr>
            </tbody>
          </table>
        </div>
        <div class="card-deck flex-center" v-for="(client, index) in chosenClient" :key="index" >
          <div class="card card-w">
            <div class="card-header bg-alto">
              <img src="{{ asset('img/alto.png') }}" class="card-img-top" alt="...">
              <button type="button" class="close" aria-label="Close" v-on:click.prevent='deleteClient()'>
                <span aria-hidden="true">&times;</span>
              </button>
            <p v-show='client.risk' class="text-center text-title-card">Nivel de Riesgo: @{{ client.risk }}</p>
            </div>
            <div class="card-body">
              <div class="card-text content">
                  <p class="h5"><strong>
                    @{{ client.name }}
                  </strong></p>
                  <span class="h6">@{{ client.email }}</span>
              </div>
              <div class="row">
                  <div class="column1">
                      <ul>
                        <li v-show='client.identity'>@{{ client.identity }}</li>
                        <li v-show='client.phone1'>@{{ client.phone1 }}</li>
                        <li v-show='client.phone2'>@{{ client.phone2 }}</li>
                        <li v-show='client.nationality'>@{{ client.nationality }}</li>
                      </ul>
                  </div>
                  <div class="column2">
                    <ul>
                      <li v-show='client.activity'>@{{ client.activity }}</li>
                      <li v-show='client.funding'>@{{ client.funding }}</li>
                      <li v-show='client.age'>@{{ client.age }} AÑOS</li>
                      <li v-show='client.households'>@{{ client.households }} PROPIEDADES</li>
                    </ul>
                  </div>
              </div>
            </div>
            <div class="card-footer bg-transparent border-warning flex-center"><button type="button" class="btn btn-block btn-color">Reportar</button></div>
          </div>
        </div>
      </main>
    </div>
  </div>
@endsection