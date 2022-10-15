@extends('adminlte::page')

@section('title', 'Protocolos')

@section('content_header')
    <h1>Protocolo: {{ $editable[0]->name }} </h1>
@stop

@section('content')

    <div class="card">
        <div class="card-body">
            {!! $editable[0]->description !!}
        </div>
    </div>
    <a href="{{ route('protocol.index') }}" class="btn btn-secondary">Volver</a>
    <a href="{{ route('protocol.edit', $editable[0]->id) }}" class="btn btn-xs btn-default text-primary mx-1 shadow" title="Editar"><i class="fa fa-lg fa-fw fa-pen"></i></a>
@stop
