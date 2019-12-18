@extends('layouts.sup') {{-- Extiende de sup.blade.php --}}

@section('content.sup') {{-- Contenido agregada --}}

<div  id="sup_clients" class="col-md-9 ml-sm-auto col-lg-10 px-4">
  <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3">
    <h1 class="h2">Tablero de Clientes</h1>
    <nav v-if = '!property' aria-label="Page navigation example">
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
    <div class="btn-toolbar mb-2 mb-md-0 flex-center">
      <div class="input-group">
        <input v-model="property" type="text" class="form-control" placeholder="Buscar cliente">
      </div>
      <div v-if = 'property'>
        <button type="reset" @click.prevent="showpagination()"  class="btn btn-sm btn-color">Ver paginación</button>
      </div>
      <div v-else>
        <button type="button" @click.prevent="showEverything()" class="btn btn-sm btn-color">Ver todos</button>
      </div>
    </div>
  </div>
  <div class="table-responsive">
    <table class="table table-striped table-hover table-sm text-center">
      <thead class="thead-dark">
        <tr>
          <th>Número de ID</th>
          <th>Nombre</th>
          <th>Email</th>
          <th>Teléfono</th>
          <th>Lugar de Trabajo</th>
          <th>Nivel de Riesgo</th>
          <th>Detalles</th>
        </tr>
      </thead>
      <tbody v-if = "property">
        <tr v-for="(client, index) in searchClientAll" :key="index">
          <td>@{{ client.client_identity }}</td>
          <td>@{{ client.client_name}}</td>
          <td>@{{ client.client_email}}</td>
          <td>@{{ client.client_phone1}}</td>
          <td>@{{ client.client_workplace}}</td>
          <td>
            <button type="button" class="btn btn-sm" :style="riskColorAll(index)">@{{ client.client_risk }}</button>
          </td>
          <td><a href="#" v-on:click.prevent='addClientAll(index)'>Más información</a></td>
        </tr>
      </tbody>
      <tbody v-else>
        <tr v-for="(client, index) in clients" :key="index">
          <td>@{{ client.client_identity }}</td>
          <td>@{{ client.client_name}}</td>
          <td>@{{ client.client_email}}</td>
          <td>@{{ client.client_phone1}}</td>
          <td>@{{ client.client_workplace}}</td>
          <td>
            <button type="button" class="btn btn-sm" :style="riskColor(index)">@{{ client.client_risk }}</button>
          </td>
          <td><a href="#" v-on:click.prevent='addClient(index)'>Más información</a></td>
        </tr>
      </tbody>
    </table>
  </div>

  {{------------------------------------------------- Card del cliente seleccionado -------------------------------------------------}}

  <div class="card-deck flex-center" v-for="(client, index) in chosenClient" :key="index" >
    <div class="card card-w">
      <div class="card-header" :style="riskColorCard(index)">
        <img :src="riskImageCard(index)" class="card-img-top" alt="...">
        <button type="button" class="close" aria-label="Close" v-on:click.prevent='deleteClient()'>
          <span aria-hidden="true">&times;</span>
        </button>
        <p v-show='client.client_risk' class="text-center text-title-card">Nivel de Riesgo: @{{ client.client_risk }}</p>
      </div>
      <div class="card-body">
        <div class="card-text content">
          <p class="h5"><strong>
            @{{ client.client_name }}
          </strong></p>
          <span class="h6">@{{ client.client_email }}</span>
        </div>
        <div class="row">
          <div class="column1">
            <p class="text-center"><strong>Datos Generales</strong></p>
            <ul>
              <li v-show='client.client_identity'>@{{ client.client_identity }}</li>
              <li v-show='client.client_phone1'>@{{ client.client_phone1 }}</li>
              <li v-show='client.client_phone2'>@{{ client.client_phone2 }}</li>
              <li v-show='client.client_workplace'>@{{ client.client_workplace }}</li>
              <li v-show='client.client_nationality'>@{{ client.client_nationality }}</li>
              <li v-show='client.client_total_amount'>L @{{ formatPrice(client.client_total_amount) }}</li>
            </ul>
            <hr>
            <p class="text-center"><strong>Inmoviliarias</strong></p>
            <ul v-for="(clientxcompany, index) in clientXCompanies">
              <li v-show='clientxcompany.client_id == client.client_id'>@{{ clientxcompany.company_name }}</li>
            </ul>
          </div>
          <div class="column2">
            <ul>
              <p><strong>Datos de Interés</strong></p>
              <li v-show='client.client_age'>@{{ client.client_age }} AÑOS</li>
              <li v-show='client.client_activity'>@{{ client.client_activity }}</li>
              <li v-show='client.client_funding'>@{{ client.client_funding }}</li>
              <li v-show='client.client_households'>@{{ client.client_households }} PROPIEDADES</li>
              <li v-show='client.client_score_risk'>@{{ client.client_score_risk }} de 5.00</li>
            </ul>
          </div>
          </div>
        </div>
        {{-- <div class="card-footer bg-transparent border-warning flex-center"><button type="button" class="btn btn-block btn-color">Reportar</button></div> --}}
      </div>
    </div>
  </div>
  @endsection
