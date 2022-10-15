@extends('adminlte::page')

@section('title', 'Dashboard')

{{--@section('plugins.Sweetalert2', true)--}}
@section('plugins.Summernote', true)

@section('content_header')
    <h1>CaseBook</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <h1 class="card-title">Hola Amigos</h1>
        </div>
        <div class="card-body">
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Asperiores ipsam optio quasi soluta? Alias assumenda atque cum deleniti dolorem doloremque, ducimus expedita minus neque quam quasi quibusdam sequi, tenetur. Nulla.</p>
        </div>

    </div>
    <div class="card">
        <div class="card-header">
            <h1 class="card-title">Hola Amigos</h1>
        </div>
        <div class="card-body">
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Asperiores ipsam optio quasi soluta? Alias assumenda atque cum deleniti dolorem doloremque, ducimus expedita minus neque quam quasi quibusdam sequi, tenetur. Nulla.</p>
        </div>

    </div>
    <div class="card">
        <div class="card-header">
            <h1 class="card-title">Hola Amigos</h1>
        </div>
        <div class="card-body">
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Asperiores ipsam optio quasi soluta? Alias assumenda atque cum deleniti dolorem doloremque, ducimus expedita minus neque quam quasi quibusdam sequi, tenetur. Nulla.</p>
        </div>

    </div>
    <div class="card">
        <div class="card-header">
            <h1 class="card-title">Hola Amigos</h1>
        </div>
        <div class="card-body">
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Asperiores ipsam optio quasi soluta? Alias assumenda atque cum deleniti dolorem doloremque, ducimus expedita minus neque quam quasi quibusdam sequi, tenetur. Nulla.</p>
        </div>

    </div>
    <div class="card">
        <div class="card-header">
            <h1 class="card-title">Hola Amigos</h1>
        </div>
        <div class="card-body">
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Asperiores ipsam optio quasi soluta? Alias assumenda atque cum deleniti dolorem doloremque, ducimus expedita minus neque quam quasi quibusdam sequi, tenetur. Nulla.</p>
        </div>

    </div>
    <div class="card">
        <div class="card-header">
            <h1 class="card-title">Hola Amigos</h1>
        </div>
        <div class="card-body">
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Asperiores ipsam optio quasi soluta? Alias assumenda atque cum deleniti dolorem doloremque, ducimus expedita minus neque quam quasi quibusdam sequi, tenetur. Nulla.</p>
        </div>

    </div>
    <div class="card">
        <div class="card-header">
            <h1 class="card-title">Hola Amigos</h1>
        </div>
        <div class="card-body">
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Asperiores ipsam optio quasi soluta? Alias assumenda atque cum deleniti dolorem doloremque, ducimus expedita minus neque quam quasi quibusdam sequi, tenetur. Nulla.</p>
        </div>

    </div>

    </div>
    <div class="card">
        <div class="card-header">
            <h1 class="card-title">Summernote</h1>
        </div>
        <div class="card-body">
            <textarea name="" id="mytext" cols="30" rows="100"></textarea>

        </div>

    </div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
{{--    <script>--}}
{{--        Swal.fire(--}}
{{--            'Good job!',--}}
{{--            'You clicked the button!',--}}
{{--            'success'--}}
{{--        );--}}
{{--    </script>--}}
    <script>
        $('#mytext').summernote({
            placeholder: 'Puede escribir algo...',
            tabsize: 2,
            height: 100,
            lang: 'es-ES'
        });
    </script>
@stop
