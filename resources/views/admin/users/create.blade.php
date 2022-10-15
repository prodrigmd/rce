@extends('adminlte::page')

@section('title', 'Users')

@section('content_header')
    <h1>Crear nuevo usuario</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form method="POST" action="{{ route('users.store') }}" accept-charset="UTF-8">
                @csrf
                <div class="form-group">
                    <label for="name">Nombre</label>
                    <input class="form-control" value="{{old('name')}}" placeholder="Ingrese el nombre del usuario" name="name" type="text" id="name">
                    @error('name')
                    <small class="text-danger">
                        {{ $message }} <br>
                    </small>
                    @enderror

                    <label for="name">Email</label>
                    <input class="form-control" value="{{old('email')}}" placeholder="Ingrese el email" name="email" type="text" id="email">
                    @error('email')
                    <small class="text-danger">
                        {{ $message }} <br>
                    </small>
                    @enderror

                    <label for="name">Password</label>
                    <input class="form-control" placeholder="Ingrese el password" name="password" type="text" id="password">
                    @error('password')
                    <small class="text-danger">
                        {{ $message }} <br>
                    </small>
                    @enderror

                    <label for="name">Password confirmation</label>
                    <input class="form-control" placeholder="Ingrese nuevamente el password" name="password_confirmation" type="text" id="password_confirmation">
                    @error('password')
                    <small class="text-danger">
                        {{ $message }} <br>
                    </small>
                    @enderror


                </div>
                <input class="btn btn-primary" type="submit" value="Crear Usuario">
            </form>
        </div>
    </div>

@stop
