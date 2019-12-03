@extends('layouts.adm')

@section('content.adm')

<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4"><div class="chartjs-size-monitor" style="position: absolute; left: 0px; top: 0px; right: 0px; bottom: 0px; overflow: hidden; pointer-events: none; visibility: hidden; z-index: -1;"><div class="chartjs-size-monitor-expand" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;"><div style="position:absolute;width:1000000px;height:1000000px;left:0;top:0"></div></div><div class="chartjs-size-monitor-shrink" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;"><div style="position:absolute;width:200%;height:200%;left:0; top:0"></div></div></div>
  <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3">
    <h1 class="h2">Historial de Actividades</h1>
    <div class="btn-toolbar mb-2 mb-md-0">
      <div class="btn-toolbar mb-2 mb-md-0 flex-center">
        <div class="input-group">
          <input v-model="property" type="text" class="form-control" placeholder="Buscar cliente">
        </div>
        <div v-if = "">
            <button type="button" @click.prevent="showEverything()" class="btn btn-sm btn-color">Ver todos</button>
        </div>
      </div>
    </div>
    {{-- <div class="btn-group mr-2">
      <button type="button" class="btn btn-sm btn-primary">Exportar</button>
    </div> --}}
  </div>

  <div class="table-responsive">
    <table class="table table-striped table-hover table-sm text-center">
      <thead class="thead-dark">
        <tr>
          <th>Actividad</th>
          <th>Usuario</th>
          <th>Tipo de Usuario</th>
          <th>Fecha</th>
          <th>Hora</th>
          <th>Tabla Modificada</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>Subir archivo de Excel</td>
          <td>Juan Perez</td>
          <td>Colaborador</td>
          <td>2018-10-09</td>
          <td>14:32:20</td>
          <td>Clientes</td>
        </tr>
        <tr>
          <td>Crear reporte clientes</td>
          <td>Juana Rios</td>
          <td>Supervisor</td>
          <td>2018-11-20</td>
          <td>14:32:20</td>
          <td>Reportes</td>
        </tr>
        <tr>
          <td>Subir archivo de excel</td>
          <td>Juan Perez</td>
          <td>Colaborador</td>
          <td>2019-10-09</td>
          <td>14:32:20</td>
          <td>Clientes</td>
        </tr>
        <tr>
            <td>Crear reporte clientes</td>
            <td>Juana Rios</td>
            <td>Supervisor</td>
            <td>2018-11-20</td>
            <td>14:32:20</td>
            <td>Reportes</td>
          </tr>
        <tr>
          <td>Crear reporte historial</td>
          <td>Juan Perez</td>
          <td>Adminstrador</td>
          <td>2019-10-09</td>
          <td>14:32:20</td>
          <td>Clientes</td>
        </tr>
      </tbody>
    </table>
  </div>
</main>
@endsection