@extends('layouts.adm')

@section('content.adm')

<div id="adm_users" class="col-md-9 ml-sm-auto col-lg-10 px-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3">
        <h1 class="h2">Tabla de Fuentes de Financiamiento</h1>
        <div class="btn-group mr-2">
            <button type="button" class="btn btn-success btn-action">AGREGAR USUARIO</button>
        </div>
    </div>
  <div class="table-responsive">
    <table class="table table-striped table-hover table-sm text-center">
      <thead class="thead-dark">
        <tr>
          <th>ID</th>
          <th>Nombre</th>
          <th>Correo</th>
          <th>Rol</th>
          <th>Empresa</th>
          <th>Contraseña</th>
          <th>¿Activo?</th>
          <th>Acciones</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="(user, index) in usersAll" :key="index">
          <td>@{{ user.user_id }}</td>
          <td>@{{ user.user_name }}</td>
          <td>@{{ user.user_email }}</td>
          <td>@{{ user.user_rol }}</td>
          <td>@{{ user.user_company }}</td>
          <td>CAMBIAR CONTRASEÑA</td>
          <td>@{{ formatBool(user.user_active) }}</td>
          <td>
            <button type="button" class="btn btn-primary btn-action" v-on:click.prevent='updateUser(user)'>MODIFICAR</button>
            <button type="button" class="btn btn-danger btn-action" v-on:click.prevent='deleteUser(user)'>ELIMINAR</button>
        </td>
        </tr>
      </tbody>
    </table>
  </div>
</div>
@endsection
