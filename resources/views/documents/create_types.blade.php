@extends('adminlte::page')

@section('title', 'Tipo de Documento')

@section('content_header')
    <h1>Agregar Nuevo Tipo de Documento</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form method="POST" action="{{ route('document_types.store') }}" accept-charset="UTF-8">
                @csrf
                <div class="form-group">
                    <div class="row">
                        <div class="col-sm-6">
                            <label for="name">Nombre(*)</label>
                            <input class="form-control" value="{!! old('name') !!}" name="name" type="text" id="name">
                            @error('name')
                            <small class="text-danger">
                                {{ $message }}
                            </small>
                            @enderror
                        </div>
                        <div class="col-sm-6">
                            <label for="shortName">Nombre Corto(*)</label>
                            <input class="form-control" value="{!! old('shortName') !!}" name="shortName" type="text" id="shortName">
                            @error('shortName')
                            <small class="text-danger">
                                {{ $message }}
                            </small>
                            @enderror
                        </div>
                    </div>
                </div>
                <a href="{{ route('document_types.index') }}" class="btn btn-secondary">Volver</a>
                <input class="btn btn-primary" type="submit" value="Agregar Tipo de Documento">

            </form>
        </div>
    </div>

@stop
