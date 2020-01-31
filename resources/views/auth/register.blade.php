@extends('layouts.adm')

@section('content.adm')
<div class="container">
    <h1 class="h2">Registrar Nuevo Usuario</h1>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="mostrar_ocultar">
                {{-- Inicio de la condición --}}
                @if (Session::has('message')) {{-- ¿Existe un mensaje que mostrar? --}}
                    <div class="alert alert-success" role="alert">
                      <p class="lead importacion__message">{{ Session::get('message') }}</p> {{-- Muestra el mensaje --}}
                    </div>
                @endif {{-- Fin de la condición --}}
            </div>
            <div class="card">
                <div class="card-header bg-color"><b>{{ __('Registro de Usuario') }}</b></div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="text-uppercase form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="role_id" class="col-md-4 col-form-label text-md-right">{{ __('Role del usuario') }}</label>
                            <div class="col-md-6">
                                <select name="role_id" class="form-control">
                                    @foreach($roles as $role)
                                    <option value="{{ $role->id }}">{{ $role->name }}</option>
                                    @endforeach
                                </select>
                                @error('role')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="company_id" class="col-md-4 col-form-label text-md-right">{{ __('Empresa a la que pertenece') }}</label>
                            <div class="col-md-6">
                                <select name="company_id" class="form-control">
                                    @foreach($companies as $company)
                                        <option value="{{ $company->id }}">{{ $company->name }}</option>
                                    @endforeach
                                </select>
                                @error('company_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="active" class="col-md-4 col-form-label text-md-right">{{ __('¿Activo?') }}</label>
                            <div class="col-md-6">
                                <select name="active" class="form-control">
                                    <option value="1">SÍ</option>
                                    <option value="0">NO</option>
                                </select>
                                @error('active')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-success">
                                    {{ __('Registrar') }}
                                </button>
                                <a class="btn btn-danger" role="button" href="{{ route('adm.user') }}">
                                    <p class="">Cancelar</p>
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
