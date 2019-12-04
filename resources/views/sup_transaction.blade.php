@extends('layouts.sup') {{-- Extiende de app.blade.php --}}

@section('content.sup') {{-- Contenido agregada --}}

<div id="sup_trans" class="col-md-9 ml-sm-auto col-lg-10 px-4">
  <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3">
    <h1 class="h2">Tablero de Transacciones</h1>
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
        <input v-model="property" type="text" class="form-control" placeholder="Buscar transacción">
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
          <th>ID del Cliente</th>
          <th>Nombre del Cliente</th>
          <th>Mes de Transacción</th>
          <th>¿En Efectivo?</th>
          <th>¿En Dolares?</th>
          <th>Monto en Lempiras</th>
          <th>Monto en Dólares</th>
          <th>Empresa</th>
          <th>Subido Por</th>
        </tr>
      </thead>
      <tbody v-if = "property">
        <tr v-for="(transaction, index) in searchTransactionsAll" :key="index">
          <td>@{{ transaction.client_identity }}</td>
          <td>@{{ transaction.client_name }}</td>
          <td>@{{ transaction.transaction_month }}</td>
          <td>@{{ transaction.transaction_cash }}</td>
          <td>@{{ transaction.transaction_dollars }}</td>
          <td>L @{{ formatPrice(transaction.transaction_amount_lempiras) }}</td>
          <td>$ @{{ formatPrice(transaction.transaction_amount_dollars) }}</td>
          <td>@{{ transaction.company_name }}</td>
          <td>@{{ transaction.user_name }}</td>
        </tr>
      </tbody>
      <tbody v-else>
        <tr v-for="(transaction, index) in transactions" :key="index">
          <td>@{{ transaction.client_identity }}</td>
          <td>@{{ transaction.client_name }}</td>
          <td>@{{ formatDate(transaction.transaction_date) }}</td>
          <td>@{{ formatBool(transaction.transaction_cash) }}</td>
          <td>@{{ formatBool(transaction.transaction_dollars) }}</td>
          <td>L @{{ formatPrice(transaction.transaction_amount_lempiras) }}</td>
          <td>$ @{{ formatPrice(transaction.transaction_amount_dollars) }}</td>
          <td>@{{ transaction.company_name }}</td>
          <td>@{{ transaction.user_name }}</td>
        </tr>
      </tbody>
    </table>
  </div>
  <div class="card-deck flex-center" v-for="(client, index) in chosenTransactions" :key="index" >
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