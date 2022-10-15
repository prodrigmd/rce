@extends('adminlte::page')

@section('title', 'Hospital')

@section('content_header')
    <h1>Agregar Nuevo Hospital</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form method="POST" action="{{ route('hospital.store') }}" accept-charset="UTF-8">
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
                            <label for="shortName">Nombre corto(*)</label>
                            <input class="form-control" value="{!! old('shortName') !!}" name="shortName" type="text" id="shortName">
                            @error('shortName')
                            <small class="text-danger">
                                {{ $message }}
                            </small>
                            @enderror
                        </div>
                        <div class="col-sm-2">
{{--                            <label for="is_main">is_main</label>--}}
{{--                            <input class="form-control" value="{!! old('is_main') !!}" name="is_main" type="text" id="is_main">--}}
                            <p>Is Main:</p>
                            <input type="radio" id="no" name="is_main" value=0 checked>
                            <label for="no">NO</label>
                            <input type="radio" id="si" name="is_main" value=1>
                            <label for="si">SI</label>
                        </div>
                        <div class="col-sm-2">
{{--                            <label for="is_main">is_main</label>--}}
{{--                            <input class="form-control" value="{!! old('is_main') !!}" name="is_main" type="text" id="is_main">--}}
                            <p>Is Public:</p>
                            <input type="radio" id="no" name="is_public" value=0>
                            <label for="no">NO</label>
                            <input type="radio" id="si" name="is_public" value=1 checked>
                            <label for="si">SI</label>
                        </div>

                    </div>
                    <br>
                    <label for="description">Description</label>
                    <br>
                    <textarea name="description" id="description" cols="90" rows="5" placeholder="Write me anything please!">{!! old('description') !!}</textarea>
                </div>
                <a href="{{ route('hospital.index') }}" class="btn btn-secondary">Volver</a>
                <input class="btn btn-primary" type="submit" value="Agregar Hospital">

            </form>
        </div>
    </div>

@stop
