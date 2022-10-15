@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Editar rol</h1>
@stop

@section('content')

    @if(session('info'))
        <div class="alert alert-success">
            {{ session('info') }}
        </div>
    @endif

    <div class="card">
        <div class="card-body">
            <form method="POST" action="{{ route('roles.update', $role) }}" accept-charset="UTF-8">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="name">Nombre</label>
                    @if($role -> name == 'SuperAdmin' OR $role -> name == 'Admin')
                        <input class="form-control" value="{{ $role->name }}" name="" type="text" id="" disabled>
                        <input type="hidden" id="name" name="name" value="{{ $role->name }}">
                    @else
                        <input class="form-control" value="{{ $role->name }}" name="name" type="text" id="name">
                    @endif
                    @error('name')
                    <small class="text-danger">
                        {{ $message }}
                    </small>
                    @enderror
                </div>
                <h2 class="h3">Lista de permisos</h2>
                @foreach($permissions as $permission)
                    <div>
                        <label>
                            @if($role->hasPermissionTo($permission->name))
                                @if(($permission->name == 'admin' OR $permission->name == 'edit admin') AND $role->name == 'SuperAdmin')
                                    <input class="mr-1" name="" type="checkbox" value="admin" checked disabled>
                                    <input name="permissions[]" type="hidden" value="{{ $permission->id }}" checked>
                                    {{ $permission -> name}}
                                @else
                                    <input class="mr-1" name="permissions[]" type="checkbox" value="{{ $permission->id }}" checked>
                                    {{ $permission -> name}}
                                @endif
                            @else
                                @if($permission->name == 'admin' OR $permission->name == 'edit admin')
                                    @can('edit admin')
                                        <input class="mr-1" name="permissions[]" type="checkbox" value="{{ $permission->id }}">
                                        {{ $permission -> name}}
                                    @else
                                        <input class="mr-1" name="permissions[]" type="checkbox" value="{{ $permission->id }}" disabled>
                                        {{ $permission -> name}}
                                    @endcan
                                @else
                                <input class="mr-1" name="permissions[]" type="checkbox" value="{{ $permission->id }}">
                                {{ $permission -> name}}
                                @endif
                            @endif
                        </label>
                    </div>
                @endforeach
                <input class="btn btn-primary" type="submit" value="Actualizar Rol">
            </form>

        </div>
    </div>
@stop
