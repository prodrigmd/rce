@extends('adminlte::page')

@section('title', 'Pacientes')

@section('plugins.TempusDominusBs4', true)

@section('content_header')
    <h1>Editar Paciente: {{ $editable[0]->name }} {{ $editable[0]->lastName1 }} {{ $editable[0]->lastName2 }}
        {{ $age }} años</h1>
@stop

@section('content')

    @if(session('info'))
        <div class="alert alert-success">
            {{ session('info') }}
        </div>
    @endif

    <div class="card">
        <div class="card-body">
            <form method="POST" action="{{ route('paciente.update', [$editable[0]->id, 'origen'=>$origen]) }}" accept-charset="UTF-8">
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
                            <label for="lastName1">Paterno(*)</label>
                            <input class="form-control" value="{{ old('lastName1') ?? $editable[0]->lastName1 }}" name="lastName1" type="text" id="lastName1">
                            @error('lastName1')
                            <small class="text-danger">
                                {{ $message }}
                            </small>
                            @enderror
                        </div>
                        <div class="col-sm-2">
                            <label for="lastName2">Materno</label>
                            <input class="form-control" value="{{ old('lastName2') ?? $editable[0]->lastName2 }}" name="lastName2" type="text" id="lastName2">
                            @error('lastName2')
                            <small class="text-danger">
                                {{ $message }}
                            </small>
                            @enderror
                        </div>
                        <div class="col-sm-1">
                            <label for="sex">Sexo</label>
                            <select name="sex" id="sex" style="width: 100%">
                                <option value="{{ $editable[0]->sex }}">{{ $editable[0]->sex }}</option>
                                @if($editable[0]->sex == 'Mujer')
                                    <option value="Hombre" @if(old('sex')=="Hombre") selected="selected" @endif>Hombre</option>
                                    <option value="n/d" @if(old('sex')=="n/d") selected="selected" @endif>n/d</option>
                                @elseif($editable[0]->sex == "Hombre")
                                    <option value="Mujer" @if(old('sex')=="Mujer") selected="selected" @endif>Mujer</option>
                                    <option value="n/d" @if(old('sex')=="n/d") selected="selected" @endif>n/d</option>
                                @elseif($editable[0]->sex == "n/d")
                                    <option value="Mujer" @if(old('sex')=="Mujer") selected="selected" @endif>Mujer</option>
                                    <option value="Hombre" @if(old('sex')=="Hombre") selected="selected" @endif>Hombre</option>
                                @else
                                    <option value="Mujer" @if(old('sex')=="Mujer") selected="selected" @endif>Mujer</option>
                                    <option value="Hombre" @if(old('sex')=="Hombre") selected="selected" @endif>Hombre</option>
                                    <option value="n/d" @if(old('sex')=="n/d") selected="selected" @endif>n/d</option>
                                @endif
                            </select>
                            @error('sex')
                            <small class="text-danger">
                                {{ $message }}
                            </small>
                            @enderror
                        </div>
                        <div class="col-sm-2">
                            <label for="dob">DOB(mm/dd/yyyy)</label>
                            <input class="form-control" value="{{ old('dob') ?? $editable[0]->dob }}" name="dob" type="date" id="dob" >
                            @error('dob')
                            <small class="text-danger">
                                {{ $message }}
                            </small>
                            @enderror
                        </div>
                        <div class="col-sm-2">
                            <label for="rut">RUT</label>
                            <input class="form-control" value="{{ old('rut') ?? $editable[0]->rut }}" name="rut" type="text" id="rut" >
                            @error('rut')
                            <small class="text-danger">
                                {{ $message }}
                            </small>
                            @enderror
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-sm-2">
                            <label for="status">Status(*)</label>
                            {{--                            <input class="form-control" value="{{ old('status') ?? $editable[0]->status }}" name="status" type="text" id="status">--}}
                            <select name="status" id="status" style="width: 100%">
                                <option value="{{ $editable[0]->status }}">
                                    @if($editable[0]->status == 1) 1-hosp
                                    @elseif($editable[0]->status == 2) 2-amb
                                    @elseif($editable[0]->status == 3) 3-alta
                                    {{--                                    {{ $editable[0]->status }}--}}
                                    @endif
                                </option>
                                @if($editable[0]->status == 1)
                                    <option value="2" @if(old('status')==2) selected="selected" @endif>2-amb</option>
                                    <option value="3" @if(old('status')==3) selected="selected" @endif>3-alta</option>
                                @elseif($editable[0]->status == 2)
                                    <option value=1 @if(old('status')==1) selected="selected" @endif>1-hosp</option>
                                    <option value=3 @if(old('status')==3) selected="selected" @endif>3-alta</option>
                                @elseif($editable[0]->status == 3)
                                    <option value=1 @if(old('status')==1) selected="selected" @endif>1-hosp</option>
                                    <option value=2 @if(old('status')==2) selected="selected" @endif>2-amb</option>
                                @endif
                            </select>
                            {{--                            <label for="status">1=hosp|2=amb|3=alta</label>--}}
                            @error('status')
                            <small class="text-danger">
                                {{ $message }}
                            </small>
                            @enderror
                        </div>
                        <div class="col-sm-2">
                            <label for="email">email</label>
                            <input class="form-control" value="{{ old('email') ?? $editable[0]->email }}" name="email" type="text" id="email">
                            @error('email')
                            <small class="text-danger">
                                {{ $message }}
                            </small>
                            @enderror
                        </div>
                        <div class="col-sm-2">
                            <label for="phone">Fono</label>
                            <input class="form-control" value="{{ old('phone') ?? $editable[0]->phone }}" name="phone" type="text" id="phone">
                            @error('phone')
                            <small class="text-danger">
                                {{ $message }}
                            </small>
                            @enderror
                        </div>
                        <div class="col-sm-2">
                            <label for="address">Dirección</label>
                            <input class="form-control" value="{{ old('address') ?? $editable[0]->address }}" name="address" type="text" id="address">
                            @error('address')
                            <small class="text-danger">
                                {{ $message }}
                            </small>
                            @enderror
                        </div>
                        <div class="col-sm-2">
                            <label for="insurance">Previsión</label>
                            <input class="form-control" value="{{ old('insurance') ?? $editable[0]->insurance }}" name="insurance" type="text" id="insurance">
                            @error('insurance')
                            <small class="text-danger">
                                {{ $message }}
                            </small>
                            @enderror
                        </div>
                        <div class="col-sm-2">
                            <label for="hospital">Institución</label>
                            <select name="hospital" id="hospital" style="width: 100%">
{{--                                <option value="{{ $editable[0]->hospital }}">{{ $editable[0]->hospital }}</option>--}}
                                @foreach($hospitals as $hospital)
                                    @if($editable[0]->hospital == $hospital->id)
                                        <option value="{{ $hospital->id }}">{{ $hospital->shortName }}</option>
                                    @endif
                                @endforeach
                                @foreach($hospitals as $hospital)
                                    @if($editable[0]->hospital != $hospital->id)
                                        <option value="{{ $hospital->id }}">{{ $hospital->shortName }}</option>
                                    @endif
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
                    <div class="row">
                        <div class="col-sm-2">
                            <label for="action_last">Last Action</label>
{{--                            action: 1=intervención, 2=hospitalizada, 3=ambulatoria, 4=otra--}}
                            <select name="action_last" id="action_last" style="width: 100%">
                                @if(isset($editable[0]->action_last))
                                    @foreach($action_names as $action_name)
                                        @if($action_name->id == $editable[0]->action_last)
                                            <option value="{{ $editable[0]->action_last }}" selected="selected">{{ $action_name -> shortName }}</option>
                                        @endif
                                    @endforeach
                                @else
                                    <option value="" selected="selected"></option>
                                @endif
                                    @foreach($action_names as $action_name)
                                        @if($action_name->id != $editable[0]->action_last)
                                            <option value="{{ $action_name->id }}">{{ $action_name -> shortName }}</option>
                                        @endif
                                    @endforeach
                            </select>
                            @error('action_last')
                            <small class="text-danger">
                                {{ $message }}
                            </small>
                            @enderror
                        </div>
                        <div class="col-sm-2">
                            @php
                                $config = [
                                    'format' => 'DD-MM-YYYY HH:mm',
                                    'dayViewHeaderFormat' => 'MMM YYYY',
                                    'buttons' => [
                                        'showToday' => true,
                                        'showClose' => true,
                                        'showClear' => true,
                                    ],
                                ];
                            @endphp
                            <x-adminlte-input-date name="action_last_date" id="action_last_date" label="Last Date Action" igroup-size="sm"
                                                   :config="$config" placeholder="Escoja una fecha" value="{{ isset($editable[0]->action_last_date) ? \Carbon\Carbon::parse($editable[0]->action_last_date)->format('d-m-Y H:i') : '' }}">
                                <x-slot name="appendSlot">
                                    <div class="input-group-text bg-dark">
                                        <i class="fas fa-calendar-day"></i>
                                    </div>
                                </x-slot>
                            </x-adminlte-input-date>
                            @error('action_last_date')
                            <small class="text-danger">
                                {{ $message }}
                            </small>
                            @enderror
                        </div>
                        <div class="col-sm-2">
                            <label for="action_next">Next Action</label>
                            {{--                            action: 1=intervención, 2=hospitalizada, 3=ambulatoria, 4=otra--}}
                            <select name="action_next" id="action_next" style="width: 100%">
                                @if(isset($editable[0]->action_next))
                                    @foreach($action_names as $action_name)
                                        @if($action_name->id == $editable[0]->action_next)
                                            <option value="{{ $editable[0]->action_next }}" selected="selected">{{ $action_name -> shortName }}</option>
                                        @endif
                                    @endforeach
                                @else
                                    <option value="" selected="selected"></option>
                                @endif
                                @foreach($action_names as $action_name)
                                    @if($action_name->id != $editable[0]->action_next)
                                        <option value="{{ $action_name->id }}">{{ $action_name -> shortName }}</option>
                                    @endif
                                @endforeach
                                    <option value=""></option>
                            </select>
                            {{--                            <label for="status">1=hosp|2=amb|3=alta</label>--}}
                            @error('action_next')
                            <small class="text-danger">
                                {{ $message }}
                            </small>
                            @enderror
                        </div>
                        <div class="col-sm-2">
{{--                            <label for="action_next_date">Next Date Action</label>--}}
{{--                            <input class="form-control" value="{{ old('action_next_date') ?? $editable[0]->action_next_date }}" name="action_next_date" type="date" id="action_next_date">--}}
                            @php
                                $config = [
                                    'format' => 'DD-MM-YYYY HH:mm',
                                    'dayViewHeaderFormat' => 'MMM YYYY',
                                    'firstDayWeek' => 1,
                                    'buttons' => [
                                        'showToday' => true,
                                        'showClose' => true,
                                        'showClear' => true,
                                    ],
                                ];
                            @endphp
                            <x-adminlte-input-date name="action_next_date" id="action_next_date" label="Next Date Action" igroup-size="sm"
{{--                                                   :config="$config" placeholder="Escoja una fecha" value="{{ isset($editable[0]->action_next_date) ? \Carbon\Carbon::parse($editable[0]->action_next_date)->format('d-m-Y H:i') : Carbon\Carbon::now('America/Santiago')->format('d-m-Y H:i') }}">--}}
                                                   :config="$config" placeholder="Escoja una fecha" value="{{ isset($editable[0]->action_next_date) ? \Carbon\Carbon::parse($editable[0]->action_next_date)->format('d-m-Y H:i') : '' }}">
                                <x-slot name="appendSlot">
                                    <div class="input-group-text bg-dark">
                                        <i class="fas fa-calendar-day"></i>
                                    </div>
                                </x-slot>
                            </x-adminlte-input-date>
                            @error('action_next_date')
                            <small class="text-danger">
                                {{ $message }}
                            </small>
                            @enderror
                        </div>
                        <div class="col-sm-2 {{ $editable[0]->scheduled == 1 ? "bg-info" : "border border-info"}}">
                            <label for="scheduled_0">No programado</label>
                            <input value=0 name="scheduled" type="radio" id="scheduled_0" {{ $editable[0]->scheduled == 0 ? "checked" : ""}}>
                            <br>
                            <label for="scheduled_0">(p) programar</label>
                            <input value=2 name="scheduled" type="radio" id="scheduled_2" {{ $editable[0]->scheduled == 2 ? "checked" : ""}}>
                            <br>
                            <label for="scheduled_1">Programado</label>
                            <input value=1 name="scheduled" type="radio" id="scheduled_1" {{ $editable[0]->scheduled == 1 ? "checked" : ""}}>
                            @error('scheduled')
                            <small class="text-danger">
                                {{ $message }}
                            </small>
                            @enderror
                        </div>
                    </div>
                    <br>
                    <label for="diagnosis">Diagnóstico</label>
                    <br>
                    <textarea name="diagnosis" id="diagnosis" cols="90" rows="5" placeholder="Write me anything please!">{{ old('diagnosis') ?? $editable[0]->diagnosis ?? '' }}
</textarea>
                    @error('diagnosis')
                    <small class="text-danger">
                        {{ $message }}
                    </small>
                    @enderror
                    <br>
                    <label for="description">Historia</label>
                    <br>
                    <textarea name="description" id="description" cols="90" rows="5" placeholder="Write me anything please!">{{ old('description') ?? $editable[0]->description ?? '' }}
</textarea>
                    @error('description')
                    <small class="text-danger">
                        {{ $message }}
                    </small>
                    @enderror
                </div>
{{--                <a href="{{ route('paciente.index') }}" class="btn btn-secondary">Volver</a>--}}
                @if($origen == 'show')
                    <a href="{{ route('paciente.show', $editable[0] -> id) }}" class="btn btn-secondary">Volver</a>
                @elseif($origen == 'index_hosp')
                    <a href="{{ route('paciente_hosp.index') }}" class="btn btn-secondary">Volver</a>
                @elseif($origen == 'index_amb')
                    <a href="{{ route('paciente_amb.index') }}" class="btn btn-secondary">Volver</a>
                @elseif($origen == 'index_alta')
                    <a href="{{ route('paciente_alta.index') }}" class="btn btn-secondary">Volver</a>
                @elseif($origen == 'index')
                    <a href="{{ route('paciente.index') }}" class="btn btn-secondary">Volver</a>
{{--                @elseif($origen ?? '' == 'home')--}}
                @else
                    <a href="{{ route('home') }}" class="btn btn-secondary">Volver</a>
                @endif
                <input class="btn btn-primary" type="submit" value="Actualizar Paciente">
            </form>

        </div>
    </div>
@stop
