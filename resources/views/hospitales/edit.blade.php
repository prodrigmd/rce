@extends('adminlte::page')

@section('title', 'Hospitales')

@section('content_header')
    <h1>Editar Institución: {{ $editable[0]->name }} </h1>
@stop

@section('content')

    @if(session('info'))
        <div class="alert alert-success">
            {{ session('info') }}
        </div>
    @endif

    <div class="card">
        <div class="card-body">
            <form method="POST" action="{{ route('hospital.update', $editable[0]->id) }}" accept-charset="UTF-8">
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
                        <div class="col-sm-5">
                            <label for="name">Name(*)</label>
                            <input class="form-control" value="{{ old('name') ?? $editable[0]->name }}" name="name" type="text" id="name">
                            @error('name')
                            <small class="text-danger">
                                {{ $message }}
                            </small>
                            @enderror
                        </div>
                        <div class="col-sm-2">
                            <label for="shortName">Nombre corto(*)</label>
                            <input class="form-control" value="{{ old('shortName') ?? $editable[0]->shortName }}" name="shortName" type="text" id="shortName">
                            @error('shortName')
                            <small class="text-danger">
                                {{ $message }}
                            </small>
                            @enderror
                        </div>
                        <div class="col-sm-2">
                            <p>Is Main:</p>
                            @if($editable[0]->is_main == 0)
                                <input type="radio" id="no" name="is_main" value=0 checked>
                                <label for="no">NO</label>
                                <input type="radio" id="si" name="is_main" value=1>
                                <label for="si">SI</label>
                            @elseif($editable[0]->is_main == 1)
                                <input type="radio" id="no" name="is_main" value=0>
                                <label for="no">NO</label>
                                <input type="radio" id="si" name="is_main" value=1 checked>
                                <label for="si">SI</label>
                            @endif
                            @error('is_main')
                            <small class="text-danger">
                                {{ $message }}
                            </small>
                            @enderror
                        </div>
                        <div class="col-sm-2">
                            <p>Is Public:</p>
                            @if($editable[0]->is_public == 0)
                                <input type="radio" id="no" name="is_public" value=0 checked>
                                <label for="no">NO</label>
                                <input type="radio" id="si" name="is_public" value=1>
                                <label for="si">SI</label>
                            @elseif($editable[0]->is_public == 1)
                                <input type="radio" id="no" name="is_public" value=0>
                                <label for="no">NO</label>
                                <input type="radio" id="si" name="is_public" value=1 checked>
                                <label for="si">SI</label>
                            @endif
                            @error('is_public')
                            <small class="text-danger">
                                {{ $message }}
                            </small>
                            @enderror
                        </div>
                    </div>
                    <br>
                    <label for="description">Description</label>
                    <br>
                    <textarea name="description" id="description" cols="90" rows="5" placeholder="Write me anything please!">{{ old('description') ?? $editable[0]->description ?? '' }}
</textarea>
                    @error('description')
                    <small class="text-danger">
                        {{ $message }}
                    </small>
                    @enderror
                </div>
                <a href="{{ route('hospital.index') }}" class="btn btn-secondary">Volver</a>
                <input class="btn btn-primary" type="submit" value="Actualizar Hospital">
            </form>

        </div>
    </div>
@stop
