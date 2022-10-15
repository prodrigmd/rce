@extends('adminlte::page')

@section('title', 'Tipo de Documento')

@section('plugins.TempusDominusBs4', true)

@section('content_header')
    <h1>Editar Tipo de Documento: {{ $editable[0]->name }} </h1>
@stop

@section('content')

    @if(session('info'))
        <div class="alert alert-success">
            {{ session('info') }}
        </div>
    @endif

    <div class="card">
        <div class="card-body">
            <form method="POST" action="{{ route('document_types.update', $editable[0]->id) }}" accept-charset="UTF-8">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <div class="row">
                        <div class="col-sm-1">
                            <label for="id">ID</label>
                            <input class="form-control" value="{{ old('id') ?? $editable[0]->id }}" name="id" type="text" id="id" disabled>
                            @error('id')
                            <small class="text-danger">
                                {{ $message }}
                            </small>
                            @enderror
                        </div>
                        <div class="col-sm-2">
                            <label for="name">Name(*)</label>
                            <input class="form-control" value="{{ old('name') ?? $editable[0]->name }}" name="name" type="text" id="name">
                            @error('name')
                            <small class="text-danger">
                                {{ $message }}
                            </small>
                            @enderror
                        </div>
                        <div class="col-sm-2">
                            <label for="shortName">Nombre Corto(*)</label>
                            <input class="form-control" value="{{ old('shortName') ?? $editable[0]->shortName }}" name="shortName" type="text" id="shortName">
                            @error('shortName')
                            <small class="text-danger">
                                {{ $message }}
                            </small>
                            @enderror
                        </div>
                    </div>
                </div>
                <a href="{{ route('document_types.index') }}" class="btn btn-secondary">Volver</a>
                <input class="btn btn-primary" type="submit" value="Actualizar tipo de documento">
            </form>

        </div>
    </div>
@stop
