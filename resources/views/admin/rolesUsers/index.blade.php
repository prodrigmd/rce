@extends('adminlte::page')

@section('title', 'RolesUsers')

@section('plugins.Datatables', true)

@section('content_header')
    <h1>Lista de Usuarios con Roles</h1>
@stop

@section('content')

    @if(session('info'))
        <div class="alert alert-success">
            {{ session('info') }}
        </div>
    @endif
<div class="card">
    <div class="card-body">
        <table class="table table-striped" id="rolesUsersTable">
            <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Roles</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            @forelse($users as $rolesUser)
                <tr>
                    <td>{{ $rolesUser -> id }}</td>
                    <td>{{ $rolesUser -> name }}</td>

                    <td>
                        @if($rolesUser -> getRoleNames() -> isNotEmpty())
                        {{ $rolesUser -> getRoleNames() }}
                        @else
                        <p>Sin roles</p>
                        @endif
                    </td>
                    <td style="width: 10px">
                        @if($rolesUser->hasRole('SuperAdmin') OR $rolesUser->hasRole('Admin'))
                        @can('edit admin')
                            <a href="{{ route('rolesUsers.edit', $rolesUser) }}" class="btn btn-sm btn-primary">Editar</a>
                        @else
                            @if(\Illuminate\Support\Facades\Auth::user()->id == $rolesUser->id)
                                <a href="{{ route('rolesUsers.edit', $rolesUser) }}" class="btn btn-sm btn-primary">Editar</a>
                            @else
                                <button class="btn btn-sm btn-primary" disabled>Editar</button>
                            @endif
                        @endcan
                        @else
                            <a href="{{ route('rolesUsers.edit', $rolesUser) }}" class="btn btn-sm btn-primary">Editar</a>
                        @endif
                    </td>
                </tr>
            @empty
                <p>No existen Roles</p>
            @endforelse
            </tbody>
        </table>

    </div>

</div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script>
        $('#rolesUsersTable').DataTable({
            responsive: true,
            autoWidth: false,
            fixedHeader: true,
            colReorder: true,
            search: {
                return: false
            },
            "deferRender": true,
            "language": {
                "lengthMenu": 'Mostrar ' +
                    `<select class="custom-select custom-select-sm form-control form-control-sm">
                        <option value='10'>10</option>
                        <option value='25'>25</option>
                        <option value='50'>50</option>
                        <option value='100'>100</option>
                        <option value='-1'>Todo</option>
                    </select>` +
                    ' registros por página',
                "decimal": ",",
                "thousands": ".",
                "zeroRecords": "Nada encontrado - disculpe",
                "info": "Mostrando la página _PAGE_ de _PAGES_",
                "infoEmpty": "No records available",
                "infoFiltered": "(filtrado de _MAX_ registros totales)",
                "search": "Buscar:",
                "loadingRecords": "Cargando...",
                "processing": "Procesando...",
                "paginate": {
                    "next": "Siguiente",
                    "previous": "Anterior"
                }
            }
        });
    </script>
    </script>
@stop
