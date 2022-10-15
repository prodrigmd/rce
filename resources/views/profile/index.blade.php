@extends('adminlte::page')

@section('title', 'Profile')

@section('content_header')
    <h1>Perfil de Usuario</h1>
@stop

@section('content')

    @if(session('info'))
        <div class="alert alert-success">
            {{ session('info') }}
        </div>
    @endif
    <div class="card">
        <div class="card-header">
            <h1 class="card-title">Nombre</h1>
        </div>
        <div class="card-body">
            <p>{{ $user->name }}</p>
        </div>

    </div>

    <div class="card">
        <div class="card-header">
            <h1 class="card-title">Email</h1>
        </div>
        <div class="card-body">
            <p>{{ $user->email }}</p>
        </div>

    </div>

    <div class="card">
        <div class="card-body">
            <a href="{{ route('profile.edit', $user) }}" class="btn btn-sm btn-primary">Editar</a>

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

