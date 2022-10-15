@extends('adminlte::page')

@section('title', 'Permissions')

@section('plugins.Sweetalert2', true)

@section('content_header')
    <a class="btn btn-secondary btn-sm float-right" href="{{ route('permissions.create') }}">Nuevo Permiso</a>
    <h1>Lista de permisos</h1>
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
                <th>Permiso</th>
                <th colspan="2"></th>
            </tr>
            </thead>
            <tbody>
            @forelse($permissions as $permission)
                <tr>
                    <td>{{ $permission -> id }}</td>
                    <td>{{ $permission -> name }}</td>
                    <td style="width: 10px">
                        @if($permission -> name == 'admin' OR $permission -> name == 'edit admin')
                            <a href="{{ route('permissions.edit', $permission) }}" class="btn btn-sm btn-primary" style="pointer-events: none">(Editar)</a>
                        @else
                            <a href="{{ route('permissions.edit', $permission) }}" class="btn btn-sm btn-primary">Editar</a>
                        @endif
                    </td>
                    <td style="width: 10px">
                        <form action="{{ route('permissions.destroy', $permission) }}" method="POST" class="eliminator">
                            @csrf
                            @method('DELETE')
                                @if($permission -> name == 'admin' OR $permission -> name == 'edit admin')
                                <button type="submit" class="btn btn-sm btn-danger" disabled="disabled">(Eliminar)</button>
                                @else
                                <button type="submit" class="btn btn-sm btn-danger">Eliminar</button>
                            @endif
                        </form>
                    </td>

                </tr>
            @empty
                <p>No existen Permisos</p>
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
    @if(session('info') == 'Permiso eliminado con éxito!')
        <script>
            Swal.fire(
                'Eliminado!',
                'El permiso ha sido eliminado.',
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
