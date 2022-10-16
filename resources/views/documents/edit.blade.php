@extends('adminlte::page')

@section('title', 'Documento')

@section('plugins.TempusDominusBs4', true)

@section('content_header')
    <h1>Editar Documento: {{ $mySubtype[0]->name }} de {{ $editable[0] -> patientName }}</h1>
@stop

@section('content')

    @if(session('info'))
        <div class="alert alert-success">
            {{ session('info') }}
        </div>
    @endif

    <div class="card">
        <div class="card-body">
            <form method="POST" action="{{ route('document.update', $editable[0]->id) }}" accept-charset="UTF-8">
                @csrf
                @method('PUT')
                <div class="form-group">
                    @if($myType[0] -> name == 'Receta')
                        @include('documents.partials.receta')
                    @elseif($myType[0] -> name == 'Interconsulta')
                        @include('documents.partials.interconsulta')
                    @elseif($myType[0] -> shortName == 'SolicitudPab')
                        @include('documents.partials.solicitudPab')
                    @endif
                </div>
                <a href="{{ route('document.index') }}" class="btn btn-secondary">Volver</a>
                <input class="btn btn-primary" type="submit" value="Actualizar documento">
                <a href="{{ route('receta.edit', $editable[0]->id) }}" class="btn btn-info">Generar Imagen</a>
                @if(isset($editable[0]->document_file))
                <a href="{{ route('receta_pdf.edit', $editable[0]->id) }}" class="btn btn-info">Crear Pdf</a>
                @endif
                @if(isset($editable[0]->pdf_file) AND isset($editable[0]->email))
                    <a href="{{ route('receta_send_email.edit', $editable[0]->id) }}" class="btn btn-info" target="_blank">Pdf al email</a>
                @endif
            </form>
            <br>
            @if(isset($editable[0]->document_file))
                <div class="row">
                    <div class="col-sm-8">
{{--                        <img class="img-fluid" src="{{ url(asset('storage/documents').'/receta_'.$editable[0]->document_file) }}" alt="Receta">--}}
                        <img class="img-fluid" src="{{ url(asset('storage/documents').'/'.$myType[0]->shortName.'_'.$editable[0]->document_file) }}" alt="Receta">
                    </div>
                </div>
            @endif

        </div>
    </div>
@stop
