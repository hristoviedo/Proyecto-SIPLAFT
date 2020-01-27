@extends('layouts.adm')

@section('content.adm')

<div id="adm_users" class="col-md-9 col-lg-10 px-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3">
        <h1 class="h2">Tabla de Usuarios</h1>
        <div class="btn-group mr-2">
            <a class="btn btn-success btn-action" role="button" href="register">
                <i class="material-icons">person_add</i>
            </a>
        </div>
        {{-- <div class="btn-group mr-2">
            <button type="button" class="btn btn-danger btn-action"><i class="material-icons">clear</i></button>
        </div> --}}
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
            <th>Acciones</th>
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
                <button type="button" class="btn btn-primary btn-action" ><i class="material-icons">update</i></button>
                <button id="alert-target" type="button" class="btn btn-danger btn-action" v-on:click.prevent='deleteUser(user.user_id)'><i class="material-icons">delete</i></button>
            </td>
            </tr>
        </tbody>
        </table>

        {{-- <div v-if="mostrar" class="col-md-3 order-md-2">
            <h4 class="mb-3">Datos del usuario</h4>
            <form class="">
                <span v-for="error in errors" class="text-danger">@{{ error }}</span>
                <div class="col-md-12 mb-3">
                    <label for="name">Nombre completo</label>
                    <input type="text" class="form-control text-uppercase" name="name" placeholder="INGRESE EL NOMBRE"  v-model="name">
                </div>
                <div class="col-md-12 mb-3">
                    <label for="email">Correo Electrónico</label>
                    <input type="text" class="form-control" name="email" placeholder="INGRESE EL CORREO"  v-model="email">
                </div>
                <div class="col-md-12 mb-3">
                    <label class="" for="password">Contraseña</label>
                    <input type="password" class="form-control" name="password" placeholder="INGRESE LA CONTRASEÑA"  v-model="password">
                </div>
                <div class="col-md-12 mb-3">
                    <label for="company">Empresa</label>
                    <select class="custom-select d-block w-100" name="company"  v-model="company">
                        <option v-for="(company, index) in companiesAll" :key="index" value="index">
                        @{{ company.name }}
                        </option>
                    </select>
                </div>
                <div class="col-md-12 mb-3">
                    <label for="role">Role</label>
                    <select class="custom-select d-block w-100" name="role"  v-model="role">
                        <option v-for="(role, index) in rolesAll" :key="index">
                        @{{ role.name }}
                        </option>
                    </select>
                </div>
                <div class="col-auto">
                    <button type="button" class="btn btn-sm btn-color" @click.prevent='clearProperty'>Limpiar</button>
                    <button type="button" class="btn btn-sm btn-color" v-on:click.prevent='createUser'>Guardar usuario</button>
                </div>
            </form>
        </div> --}}
    </div>
</div>
@endsection
