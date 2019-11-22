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
          <th>Actividad Económica</th>
          <th>Lugar de Trabajo</th>
          <th>Inmobiliaria</th>
          <th>Nivel de Riesgo</th>
          <th>Detalles</th>
        </tr>
      </thead>
      <tbody v-if = "property">
        <tr>
          <td>0321-1995-33655</td>
          <td>José Manuel García</td>
          <td>jose.garcia@test.com</td>
          <td>PEP</td>
          <td>Postensa</td>
          <td>Inmobiliaria Distrito Verde</td>
          <td>Alto</td>
          {{-- <td>
            <button type="button" class="btn btn-sm" :style="riskColorAll(index)">@{{ client.risk }}</button>
          </td> --}}
          <td><a href="#" >Más información</a></td>
        </tr>
      </tbody>
      <tbody v-else>
        <tr>
          <td>0321-1995-33655</td>
          <td>José Manuel García</td>
          <td>jose.garcia@test.com</td>
          <td>PEP</td>
          <td>Concremix</td>
          <td>Inmobiliaria Distrito Verde</td>
          <td>Alto</td>
          {{-- <td>
            <button type="button" class="btn btn-sm" :style="riskColor(index)">@{{ client.risk }}</button>
          </td> --}}
          <td><a href="#" >Más información</a></td>
        </tr>
      </tbody>
    </table>
  </div>
  <div class="card-deck flex-center" v-for="(client, index) in chosenClient" :key="index" >
    <div class="card card-w">
      <div class="card-header" :style="riskColorCard(index)">
        <img :src="riskImageCard(index)" class="card-img-top" alt="...">
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
                  <li v-show='client.score_risk'>@{{ client.score_risk }} de 5.00</li>
                </ul>
            </div>
            <div class="column2">
              <ul>
                <li v-show='client.age'>@{{ client.age }} AÑOS</li>
                <li v-show='client.activity'>@{{ client.activity }}</li>
                <li v-show='client.funding'>@{{ client.funding }}</li>
                <li v-show='client.households'>@{{ client.households }} PROPIEDADES</li>
                <li v-show='client.total_amount'>L @{{ formatPrice(client.total_amount) }}</li>
              </ul>
            </div>
        </div>
      </div>
      <div class="card-footer bg-transparent border-warning flex-center"><button type="button" class="btn btn-block btn-color">Reportar</button></div>
    </div>
  </div>
</div>
@endsection