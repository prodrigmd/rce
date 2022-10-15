@extends('adminlte::page')

@section('title', 'RolesUsers')

@section('content_header')
    <h1>Editar Roles del Usuario</h1>
@stop

@section('content')

    @if(session('info'))
        <div class="alert alert-success">
            {{ session('info') }}
        </div>
    @endif

    <div class="card">
        <div class="card-body">
            <form method="POST" action="{{ route('rolesUsers.update', $rolesUser) }}" accept-charset="UTF-8">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="name">Nombre</label>
                    <h2>{{ $rolesUser -> name}}</h2>
                </div>
                <h2 class="h3">Lista de roles</h2>
                @foreach($roles as $rol)
                    <div>

                            @if($rolesUser->hasRole($rol->name))
                                @if($rol->name == 'SuperAdmin')
                                <label>
                                    <input class="mr-1" name="" type="checkbox" value="SuperAdmin" checked disabled>
                                    <input name="roles[]" type="hidden" value="{{ $rol->id }}" checked>
                                    {{ $rol -> name}}
                                </label>
                                @elseif($rol->name == 'Admin')
                                    @can('edit admin')
                                    <label>
                                        <input class="mr-1" name="roles[]" type="checkbox" value="{{ $rol->id }}" checked>
                                        {{ $rol -> name}}
                                    </label>
                                    @else
                                    <label>
                                        <input class="mr-1" name="" type="checkbox" value="Admin" checked disabled>
                                        <input name="roles[]" type="hidden" value="{{ $rol->id }}" checked>
                                        {{ $rol -> name}}
                                    </label>
                                    @endcan
                                @else
                                <label>
                                    <input class="mr-1" name="roles[]" type="checkbox" value="{{ $rol->id }}" checked>
                                    {{ $rol -> name}}
                                </label>
                                @endif
                            @else
                                @if($rol->name == 'SuperAdmin')
                                @elseif($rol->name == 'Admin')
                                    @can('edit admin')
                                    <label>
                                        <input class="mr-1" name="roles[]" type="checkbox" value="{{ $rol->id }}">
                                        {{ $rol -> name}}
                                    </label>
                                    @endcan
                                @else
                                <label>
                                    <input class="mr-1" name="roles[]" type="checkbox" value="{{ $rol->id }}">
                                    {{ $rol -> name}}
                                </label>
                                @endif
                            @endif
                    </div>
                @endforeach
                <input class="btn btn-primary" type="submit" value="Actualizar Roles de Usuario">
            </form>

        </div>
    </div>
@stop
