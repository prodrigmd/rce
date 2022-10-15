@extends('adminlte::page')

@section('title', 'Permissions')

@section('content_header')
    <h1>Editar permiso</h1>
@stop

@section('content')

    @if(session('info'))
        <div class="alert alert-success">
            {{ session('info') }}
        </div>
    @endif

    <div class="card">
        <div class="card-body">
            <form method="POST" action="{{ route('permissions.update', $permission) }}" accept-charset="UTF-8">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="name">Nombre</label>
                    @if($permission -> name == 'admin')
                        <input class="form-control" value="admin" name="" type="text" id="" disabled>
                        <input type="hidden" id="name" name="name" value="admin">
                    @else
                        <input class="form-control" value="{{ $permission->name }}" name="name" type="text" id="name">
                    @endif
                    @error('name')
                    <small class="text-danger">
                        {{ $message }}
                    </small>
                    @enderror
                </div>
                <h2 class="h3">Lista de permisos</h2>
                @foreach($permissions as $permiso)
                    @if($permiso->id != $permission->id)
                    <div>
                        <span>&#8226;</span>
                        <label>{{$permiso -> name}}</label>
                    </div>
                    @endif
                @endforeach
                <input class="btn btn-primary" type="submit" value="Actualizar Permiso">
            </form>

        </div>
    </div>
@stop
