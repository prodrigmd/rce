@extends('adminlte::page')

@section('title', 'Paciente')

@section('content_header')
    <h1>Agregar Nuevo Paciente</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form method="POST" action="{{ route('paciente.store') }}" accept-charset="UTF-8">
                @csrf
                <div class="form-group">
                    <div class="row">
                        <div class="col-sm-2">
                            <label for="name">Nombre(*)</label>
                            <input class="form-control" value="{!! old('name') !!}" name="name" type="text" id="name">
                            @error('name')
                            <small class="text-danger">
                                {{ $message }}
                            </small>
                            @enderror
                        </div>
                        <div class="col-sm-2">
                            <label for="lastName1">Paterno(*)</label>
                            <input class="form-control" value="{!! old('lastName1') !!}" name="lastName1" type="text" id="lastName1">
                            @error('lastName1')
                            <small class="text-danger">
                                {{ $message }}
                            </small>
                            @enderror
                        </div>
                        <div class="col-sm-2">
                            <label for="lastName2">Materno</label>
                            <input class="form-control" value="{!! old('lastName2') !!}" name="lastName2" type="text" id="lastName2">
                            @error('lastName2')
                            <small class="text-danger">
                                {{ $message }}
                            </small>
                            @enderror
                        </div>
                        <div class="col-sm-2">
                            <label for="sex">Sex(*)</label>
                            <select name="sex" id="sex" style="width: 100%">
                                <option value="" selected="selected"></option>
                                <option value="Mujer">Mujer</option>
                                <option value="Hombre">Hombre</option>
                                <option value="n/d">n/d</option>
                            </select>
                            @error('sex')
                            <small class="text-danger">
                                {{ $message }}
                            </small>
                            @enderror
                        </div>
                        <div class="col-sm-2">
                            <label for="dob">DOB</label>
                            <input class="form-control" value="{!! old('dob') !!}" name="dob" type="date" id="dob">
                            @error('dob')
                            <small class="text-danger">
                                {{ $message }}
                            </small>
                            @enderror
                        </div>
                        <div class="col-sm-2">
                            <label for="rut">RUT</label>
                            <input class="form-control" value="{!! old('rut') !!}" name="rut" type="text" id="rut">
                            @error('rut')
                            <small class="text-danger">
                                {{ $message }}
                            </small>
                            @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-2">
                            <label for="status">Status(*)</label>
                            <select name="status" id="status" style="width: 100%">
                                <option value="" selected="selected"></option>
                                <option value="1">1-Hosp</option>
                                <option value="2">2-Amb</option>
                                <option value="3">3-Alta</option>
                            </select>
                            @error('status')
                            <small class="text-danger">
                                {{ $message }}
                            </small>
                            @enderror
                        </div>
                        <div class="col-sm-2">
                            <label for="email">Email</label>
                            <input class="form-control" value="{!! old('email') !!}" name="email" type="text" id="email">
                            @error('email')
                            <small class="text-danger">
                                {{ $message }}
                            </small>
                            @enderror
                        </div>
                        <div class="col-sm-2">
                            <label for="phone">Fono</label>
                            <input class="form-control" value="{!! old('phone') !!}" name="phone" type="text" id="phone">
                            @error('phone')
                            <small class="text-danger">
                                {{ $message }}
                            </small>
                            @enderror
                        </div>
                        <div class="col-sm-2">
                            <label for="address">Dirección</label>
                            <input class="form-control" value="{!! old('address') !!}" name="address" type="text" id="address">
                            @error('address')
                            <small class="text-danger">
                                {{ $message }}
                            </small>
                            @enderror
                        </div>
                        <div class="col-sm-2">
                            <label for="insurance">Previsión</label>
                            <input class="form-control" value="{!! old('insurance') !!}" name="insurance" type="text" id="insurance">
                            @error('insurance')
                            <small class="text-danger">
                                {{ $message }}
                            </small>
                            @enderror
                        </div>
                        <div class="col-sm-2">
                            <label for="hospital">Institución</label>
                            <select name="hospital" id="hospital" style="width: 100%">
                                <option value="" selected="selected"></option>
                                @foreach($hospitals as $hospital)
                                    <option value="{{$hospital->id}}">{{$hospital->shortName}}</option>
                                @endforeach
                            </select>
                            @error('hospital')
                            <small class="text-danger">
                                {{ $message }}
                            </small>
                            @enderror
                        </div>
                    </div>
                    <br>
                    <label for="diagnosis">Diagnóstico</label>
                    <br>
                    <textarea name="diagnosis" id="diagnosis" cols="90" rows="5" placeholder="Write me anything please!">{!! old('diagnosis') !!}</textarea>
                    <br>
                    <label for="description">Historia</label>
                    <br>
                    <textarea name="description" id="description" cols="90" rows="5" placeholder="Write me anything please!">{!! old('description') !!}</textarea>
                </div>
                <a href="{{ route('paciente.index') }}" class="btn btn-secondary">Volver</a>
                <input class="btn btn-primary" type="submit" value="Agregar Paciente">

            </form>
        </div>
    </div>

@stop
