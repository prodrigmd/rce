@extends('adminlte::page')

@section('title', 'Profile')

@section('content_header')
    <h1>Editar Perfil de Usuario</h1>
@stop

@section('content')

    @if(session('info'))
        <div class="alert alert-success">
            {{ session('info') }}
        </div>
    @endif

    <div class="card">
        <div class="card-body">
            <form method="POST" action="{{ route('profile.update', $user) }}" accept-charset="UTF-8">
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
                    <input class="form-control" value="{{ $user->email }}" name="email" type="text" id="email">

                    @error('email')
                    <small class="text-danger">
                        {{ $message }}
                    </small> <br>
                    @enderror
                    <br>
                    <hr>
                    <label for="name">Password Actual</label>
                    <input class="form-control showme" autocomplete="new-password" placeholder="Opcional: Ingrese password actual (dejar en blanco si no requiere cambios de password)" name="old_password" type="password" id="old_password">
                    @if(session('badOld'))
                        <small class="text-danger">
                            {{ session('badOld') }}
                        </small>
                    @endif
                    <br>
{{--                    @error('old_password')--}}
{{--                    <small class="text-danger">--}}
{{--                        {{ $message }}<br>--}}
{{--                    </small>--}}
{{--                    @enderror--}}
                    <label for="name">Password</label>
                    <input class="form-control showme" autocomplete="new-password" placeholder="Opcional: Ingrese nuevo password (dejar en blanco si no requiere cambios de password)" name="password" type="password" id="password">
                    @error('password')
                    <small class="text-danger">
                        {{ $message }}<br>
                    </small>
                    @enderror
                    <br>
                    <label for="name">Password confirmation</label>
                    <input class="form-control showme" autocomplete="new-password" placeholder="Opcional: Ingrese nuevamente el password (dejar en blanco si no requiere cambios depassword)" name="password_confirmation" type="password" id="password_confirmation">
                    @error('password')
                    <small class="text-danger">
                        {{ $message }} <br>
                    </small>
                    @enderror
                    <input type="checkbox" onclick="myFunction()">Show Password

                </div>
                <input class="btn btn-primary" type="submit" value="Actualizar Usuario">
            </form>

        </div>
    </div>
@stop

@section('js')
{{--    <script>--}}
{{--        function myFunction1() {--}}
{{--            var x = document.getElementById("old_password");--}}
{{--            if (x.type === "password") {--}}
{{--                x.type = "text";--}}
{{--            } else {--}}
{{--                x.type = "password";--}}
{{--            }--}}
{{--        }--}}
{{--    </script>--}}

    <script>

        function myFunction() {
            document.querySelectorAll('.showme').forEach(function(element) {
                if (element.type === "password") {
                    element.type = "text";
                } else {
                    element.type = "password";
                }
            })
        }
    </script>
@stop

