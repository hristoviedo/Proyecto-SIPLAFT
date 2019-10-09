@extends('layouts.app')

@section('content')

<div class="container-fluid">
    <div class="row">
      <nav class="col-md-2 d-none d-md-block bg-light sidebar">
        <div class="sidebar-sticky">
          <ul class="nav flex-column">
            <li class="nav-item">
              <a class="nav-link" href="#">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-home"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg>
                Historial <span class="sr-only">(current)</span>
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
        </div>
      </nav>

      <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4"><div class="chartjs-size-monitor" style="position: absolute; left: 0px; top: 0px; right: 0px; bottom: 0px; overflow: hidden; pointer-events: none; visibility: hidden; z-index: -1;"><div class="chartjs-size-monitor-expand" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;"><div style="position:absolute;width:1000000px;height:1000000px;left:0;top:0"></div></div><div class="chartjs-size-monitor-shrink" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;"><div style="position:absolute;width:200%;height:200%;left:0; top:0"></div></div></div>
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3">
          <h1 class="h2">Historial de Actividades</h1>
          <div class="btn-toolbar mb-2 mb-md-0">
            <div class="input-group">
              <input type="text" class="form-control" placeholder="Buscar actividad">
              <span class="input-group-btn">
                <button class="btn btn-color" type="button">Buscar</button>
              </span>
            </div>
          </div>
          <div class="btn-group mr-2">
            <button type="button" class="btn btn-sm btn-primary">Exportar</button>
          </div>
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
    </div>
  </div>

{{-- <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    You are logged in!
                </div>
            </div>
        </div>
    </div>
</div> --}}
@endsection