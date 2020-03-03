@extends('layouts.adm')

@section('content.adm')

<div id="adm_users" class="col-md-9 col-lg-10 px-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3">
        <h1 class="h2">Tabla de Usuarios</h1>
        <div class="btn-group mr-2">
            <a class="btn btn-success" role="button" href="{{ route('adm.create.user') }}">
                <i class="material-icons">person_add</i>
            </a>
        </div>
    </div>
    <div class="row">
        <table class="table table-striped table-hover table-sm text-center">
        <thead class="thead-dark">
            <tr>
            <th>Nombre</th>
            <th>Correo</th>
            <th>Rol</th>
            <th>Empresa</th>
            <th>¿Activo?</th>
            <th>Actualizar</th>
            </tr>
        </thead>
        <tbody>
            <tr v-for="(user, index) in usersAll" :key="index">
            <td>@{{ user.user_name }}</td>
            <td>@{{ user.user_email }}</td>
            <td>@{{ user.user_role }}</td>
            <td>@{{ user.user_company }}</td>
            <td>@{{ formatBool(user.user_active) }}</td>
            <td>
                <button type="button" class="btn btn-primary" v-on:click='showUser(user.user_id)'><i class="material-icons">update</i></button>
            </td>
            </tr>
        </tbody>
        </table>
    </div>
</div>
@endsection
