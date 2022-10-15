@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Crear nuevo rol</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form method="POST" action="{{ route('roles.store') }}" accept-charset="UTF-8">
                @csrf
                <div class="form-group">
                    <label for="name">Nombre</label>
                    <input class="form-control" placeholder="Ingrese el nombre del rol" name="name" type="text" id="name">
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
                            <input class="mr-1" name="permissions[]" type="checkbox" value="{{ $permission->id }}">
                            {{ $permission -> name}}
                        </label>
                    </div>
                @endforeach
                <input class="btn btn-primary" type="submit" value="Crear Rol">
            </form>
        </div>
    </div>

@stop
