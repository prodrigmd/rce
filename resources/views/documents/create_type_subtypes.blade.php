@extends('adminlte::page')

@section('title', 'Subtipo de Documento')

@section('content_header')
    <h1>Agregar Nuevo Subtipo de Documento</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form method="POST" action="{{ route('document_type_subtypes.store') }}" accept-charset="UTF-8">
                @csrf
                <div class="form-group">
                    <div class="row">
                        <div class="col-sm-4">
                            <label for="name">Nombre(*)</label>
                            <input class="form-control" value="{!! old('name') !!}" name="name" type="text" id="name">
                            @error('name')
                            <small class="text-danger">
                                {{ $message }}
                            </small>
                            @enderror
                        </div>
                        <div class="col-sm-4">
                            <label for="shortName">Nombre Corto(*)</label>
                            <input class="form-control" value="{!! old('shortName') !!}" name="shortName" type="text" id="shortName">
                            @error('shortName')
                            <small class="text-danger">
                                {{ $message }}
                            </small>
                            @enderror
                        </div>
                        <div class="col-sm-4">
                            <label for="documents_type_id">Tipo de Documento(*)</label>
                            <select name="documents_type_id" id="documents_type_id" style="width: 100%">
                                <option value="" selected="selected"></option>
                                @foreach($types as $type)
                                    <option value="{{$type->id}}">{{$type->name}}</option>
                                @endforeach
                            </select>
                            @error('documents_type_id')
                            <small class="text-danger">
                                {{ $message }}
                            </small>
                            @enderror
                        </div>
                    </div>
                </div>
                <a href="{{ route('document_type_subtypes.index') }}" class="btn btn-secondary">Volver</a>
                <input class="btn btn-primary" type="submit" value="Agregar Subtipo de Documento">

            </form>
        </div>
    </div>

@stop
