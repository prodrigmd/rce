@extends('adminlte::page')

@section('title', 'Intervención')

@section('content_header')
    <h1>Agregar Nueva Intervención</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form method="POST" action="{{ route('surgery.store') }}" accept-charset="UTF-8">
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
                        <div class="col-sm-2">
                            <label for="codigoFonasa">Código Fonasa</label>
                            <input class="form-control" value="{!! old('codigoFonasa') !!}" name="codigoFonasa" type="text" id="codigoFonasa">
                            @error('codigoFonasa')
                            <small class="text-danger">
                                {{ $message }}
                            </small>
                            @enderror
                        </div>
                        <div class="col-sm-4">
{{--                            1=endovascular cerebro, 2=endovascular columna, 3=percutaneo columna, 4=percutaneo H&N, 5=otro--}}
                            <label for="areas_id">Area(*)</label>
                            <select class="form-control" id="areas_id" name="areas_id">
                                <option value=''></option>
                                @foreach($areas as $area)
                                    <option value='{{ $area -> id }}'>{{ $area -> name }}</option>
                                @endforeach
                            </select>
                            <br>
                            @error('areas_id')
                            <small class="text-danger">
                                {{ $message }}
                            </small>
                            @enderror
                        </div>
                    </div>
                    <br>
                    <label for="description">Description</label>
                    <br>
                    <textarea name="description" id="description" cols="90" rows="5" placeholder="Write me anything please!">{!! old('description') !!}</textarea>
                </div>
                <a href="{{ route('surgery.index') }}" class="btn btn-secondary">Volver</a>
                <input class="btn btn-primary" type="submit" value="Agregar Intervención">

            </form>
        </div>
    </div>

@stop
