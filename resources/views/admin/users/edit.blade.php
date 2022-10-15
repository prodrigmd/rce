@extends('adminlte::page')

@section('title', 'Users')

@section('content_header')
    <h1>Editar Usuario</h1>
@stop

@section('content')

    @if(session('info'))
        <div class="alert alert-success">
            {{ session('info') }}
        </div>
    @endif

    <div class="card">
        <div class="card-body">
            <form method="POST" action="{{ route('users.update', $user) }}" accept-charset="UTF-8">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="name">Nombre</label>
                    <input class="form-control" value="{{ $user->name }}" name="name" type="text" id="name">
{{--                        <input type="hidden" id="name" name="name" value="{{ $user->name }}">--}}

                    @error('name')
                    <small class="text-danger">
                        {{ $message }}
                    </small> <br>
                    @enderror

                    <label for="name">Email</label>
{{--                    @if($user->hasRole(['Admin','SuperAdmin']))--}}
{{--                        @can('edit admin')--}}
                    <input class="form-control" value="{{ $user->email }}" name="email" type="text" id="email">

                    @error('email')
                    <small class="text-danger">
                        {{ $message }}
                    </small> <br>
                    @enderror

                    <label for="name">Password</label>
                    <input class="form-control" placeholder="Opcional: Ingrese nuevo password" name="password" type="text" id="password">
                    @error('password')
                    <small class="text-danger">
                        {{ $message }} <br>
                    </small>
                    @enderror

                    <label for="name">Password confirmation</label>
                    <input class="form-control" placeholder="Opcional: Ingrese nuevamente el password" name="password_confirmation" type="text" id="password_confirmation">
                    @error('password')
                    <small class="text-danger">
                        {{ $message }} <br>
                    </small>
                    @enderror

                </div>
                <input class="btn btn-primary" type="submit" value="Actualizar Usuario">
            </form>

        </div>
    </div>
@stop
