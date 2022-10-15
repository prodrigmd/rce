@extends('adminlte::page')

@section('title', 'Roles')

@section('plugins.Sweetalert2', true)

@section('content_header')
    <a class="btn btn-secondary btn-sm float-right" href="{{ route('roles.create') }}">Nuevo Rol</a>
    <h1>Lista de roles</h1>
@stop

@section('content')

    @if(session('info'))
        <div class="alert alert-success">
            {{ session('info') }}
        </div>
    @endif
<div class="card">
    <div class="card-body">
        <table class="table table-striped">
            <thead>
            <tr>
                <th>ID</th>
                <th>Role</th>
                <th>Permissions</th>
                <th colspan="2"></th>
            </tr>
            </thead>
            <tbody>
            @forelse($roles as $role)
                <tr>
                    <td>{{ $role -> id }}</td>
                    <td>{{ $role -> name }}</td>
                    <td>
                        @if($role -> getPermissionNames() -> isNotEmpty())
                            {{ $role -> getPermissionNames() }}
                        @else
                            <p>Sin roles</p>
                        @endif
                    </td>
                    <td style="width: 10px">
                    @if($role -> name == 'SuperAdmin' OR $role -> name == 'Admin')
                        @can('edit admin')
                         <a href="{{ route('roles.edit', $role) }}" class="btn btn-sm btn-primary">Editar</a>
                        @else
                            <button type="submit" class="btn btn-sm btn-primary" disabled="disabled">(Editar)</button>
                        @endcan
                    @else
                        <a href="{{ route('roles.edit', $role) }}" class="btn btn-sm btn-primary">Editar</a>
                    @endif

                    </td>
                    <td style="width: 10px">
                        <form action="{{ route('roles.destroy', $role) }}" method="POST" class="eliminator">
                            @csrf
                            @method('DELETE')
                                @if($role -> name == 'SuperAdmin')
                                <button type="submit" class="btn btn-sm btn-danger" disabled="disabled">Eliminar</button>
                                @else
                                @if($role -> name == 'Admin')
                                    @can('edit admin')
                                        <button type="submit" class="btn btn-sm btn-danger">Eliminar</button>
                                    @else
                                        <button type="submit" class="btn btn-sm btn-danger" disabled="disabled">Eliminar</button>
                                    @endcan
                                @else
                                    <button type="submit" class="btn btn-sm btn-danger">Eliminar</button>
                                @endif
                            @endif
                        </form>
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
    @if(session('info') == 'Rol eliminado con éxito!')
        <script>
            Swal.fire(
                'Eliminado!',
                'EL rol ha sido eliminado.',
                'success'
            )
        </script>
    @endif
    <script>
        $('.eliminator').submit(function(e){
            e.preventDefault();
        Swal.fire({
            title: 'Está seguro?',
            text: "Esta acción es irreversible!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Si, eliminar!'
        }).then((result) => {
            if (result.value) {
                // Swal.fire(
                //     'Deleted!',
                //     'Your file has been deleted.',
                //     'success'
                // )
                this.submit();
            }
        });
    });
    </script>
@stop
