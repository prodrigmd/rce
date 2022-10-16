@extends('adminlte::page')

@section('title', 'Documento')

@section('plugins.TempusDominusBs4', true)

@section('content_header')
    <h1>Crear Nuevo Documento: {{ $subtype[0] -> name }}</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form method="POST" action="{{ route('document.store') }}" accept-charset="UTF-8">
                @csrf
                <div class="form-group">
                    @if($type[0] -> name == 'Receta')
                        @include('documents.partials.receta')
                    @elseif($type[0] -> name == 'Interconsulta')
                        @include('documents.partials.interconsulta')
                    @elseif($type[0] -> shortName == 'SolicitudPab')
                        @include('documents.partials.solicitudPab')
                    @endif
                </div>
                <a href="{{ route('document.index') }}" class="btn btn-secondary">Volver</a>
                <input type="hidden" id="documents_type_id" name="documents_type_id" value="{{ $type[0] -> id }}">
                <input type="hidden" id="documents_type_subtype_id" name="documents_type_subtype_id" value="{{ $subtype[0] -> id }}">
                <input class="btn btn-primary" type="submit" value="Agregar {{ $subtype[0] -> name }}">

            </form>
        </div>
    </div>

@stop
