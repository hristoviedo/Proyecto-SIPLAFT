@extends('layouts.adm')

@section('content.adm')

<div id="" class="col-md-9 col-lg-10 px-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3">
        <h1 class="h2">Tabla de Eventos</h1>
    </div>
    <div class="row">
        <table class="table table-striped table-hover table-sm text-center">
            <thead class="thead-dark">
                <tr>
                    <th>Nombre del Usuario</th>
                    <th>Accion</th>
                    <th>Fecha</th>
                    <th>Tabla Modificada</th>
                    <th>Registro Modificado</th>
                    <th>Campo Modificado</th>
                    <th>Valor Nuevo</th>
                    <th>Valor Antiguo</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($records as $record)
                    <tr>
                        @if( $record->user_modifier_id == null )
                            <td>INVITADO</td>
                        @else
                            @foreach($users as $user)
                                @if( $record->user_modifier_id == $user->id )
                                    <td>{{ $user->name }}</td>
                                @endif
                            @endforeach
                        @endif
                        <td>{{ $record->record_action }}</td>
                        <td>{{ $record->record_date }}</td>
                        <td>{{ $record->record_modified_table }}</td>
                        <td>{{ $record->record_modified_register }}</td>
                        <td>{{ $record->record_modified_field }}</td>
                        <td>{{ $record->record_new_data }}</td>
                        <td>{{ $record->record_old_data }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
