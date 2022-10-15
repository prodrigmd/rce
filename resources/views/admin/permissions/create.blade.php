@extends('adminlte::page')

@section('title', 'Permissions')

@section('content_header')
    <h1>Crear nuevo permiso</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form method="POST" action="{{ route('permissions.store') }}" accept-charset="UTF-8">
                @csrf
                <div class="form-group">
                    <label for="name">Nombre</label>
                    <input class="form-control" placeholder="Ingrese el nombre del permiso" name="name" type="text" id="name">
                    @error('name')
                    <small class="text-danger">
                        {{ $message }}
                    </small>
                    @enderror
                </div>
                <h2 class="h3">Lista de permisos</h2>
                @foreach($permissions as $permission)
                    <div>
                        <span>&#8226;</span>
                        <label>{{$permission -> name}}</label>
                    </div>
                @endforeach
                <input class="btn btn-primary" type="submit" value="Crear Permiso">
            </form>
        </div>
    </div>

@stop
