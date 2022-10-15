@extends('adminlte::page')

@section('title', 'Action')

@section('plugins.Summernote', true)
@section('plugins.TempusDominusBs4', true)

@section('content_header')
    <h1>{{ $editable[0]->name }} {{ $editable[0]->lastName1 }} {{ $editable[0]->lastName2 }} -
        {{ $editable[0]->sex }} - {{ $age }} años.</h1>
@stop

@section('content')
    @if(session('info'))
        <div class="alert alert-success">
            {{ session('info') }}
        </div>
    @endif

    <div class="card">
        <div class="card-body">
            RUT:{{ $editable[0]->rut }}. Fono: {{$editable[0]->phone}}. email:{{ $editable[0]->email }}.
            Previsión:{{ $editable[0]->insurance }} <br>
            {{ $status_actual[0]-> name }}. Institución actual:{{ $hospital_actual[0]->name }}
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            @if(isset($action_actual))
                <form method="POST" action="{{ route('paciente_action.update', $action_actual[0]->id) }}" accept-charset="UTF-8">
                    @csrf
                    @method('PUT')
            @else
                <form method="POST" action="{{ route('paciente_action.store') }}" accept-charset="UTF-8">
                    @csrf
            @endif
                <div class="form-group">
                    <div class="row">
                        <div class="col-sm-6">
                            <label for="action_name">Action Name(*)</label>
                            <select name="action_name" id="action_name" style="width: 100%">
                                @if(isset($action_actual))
                                    @foreach($action_names as $action_name)
                                        @if($action_name -> id == $action_actual[0] -> action_name )
                                            <option value="{{ $action_name -> id }}" selected="selected">{{ $action_name -> name }}</option>
                                        @endif
                                    @endforeach
                                @else
                                    <option value="" selected="selected"></option>
                                @endif
                                @foreach($action_names as $action_name)
                                    <option value="{{ $action_name->id }}">{{ $action_name->name }}</option>
                                @endforeach
                            </select>
                            @error('action_name')
                            <small class="text-danger">
                                {{ $message }}
                            </small>
                            @enderror
                        </div>
                        <div class="col-sm-4">
                            <label for="action_type">Action Type(*)</label>
                            <select name="action_type" id="action_type" style="width: 100%">
                                @if(isset($action_actual))
                                    @foreach($action_types as $action_type)
                                        @if($action_type -> id == $action_actual[0] -> action_type )
                                            <option value="{{ $action_type -> id }}" selected="selected">{{ $action_type -> name }}</option>
                                        @endif
                                    @endforeach
                                @else
                                    <option value="" selected="selected"></option>
                                @endif
                                @foreach($action_types as $action_type)
                                    <option value="{{ $action_type->id }}">{{ $action_type->name }}</option>
                                @endforeach
                            </select>
                            @error('action_type')
                            <small class="text-danger">
                                {{ $message }}
                            </small>
                            @enderror
                        </div>
                        <div class="col-sm-2">
{{--                            <label for="date">Date</label>--}}
{{--                            <input class="form-control" value="{!! old('date') !!}" name="date" type="datetime-local" id="date">--}}
                            {{-- SM size, restricted to current month and week days --}}
{{--                            'format' => 'YYYY-MM-DD HH.mm',--}}
                            @php
                                $config = [
                                    'format' => 'DD-MM-YYYY HH:mm',
                                    'dayViewHeaderFormat' => 'MMM YYYY'
                                ];
                            @endphp
                            <x-adminlte-input-date name="date" id="date" label="Date" igroup-size="sm"
                                                   :config="$config" placeholder="Escoja una fecha" value="{{ isset($action_actual[0]->date) ? $action_actual[0]->date : Carbon\Carbon::now('America/Santiago')->format('Y-m-d H:i') }}">
                                <x-slot name="appendSlot">
                                    <div class="input-group-text bg-dark">
                                        <i class="fas fa-calendar-day"></i>
                                    </div>
                                </x-slot>
                            </x-adminlte-input-date>
{{--                            @error('date')--}}
{{--                            <small class="text-danger">--}}
{{--                                {{ $message }}--}}
{{--                            </small>--}}
{{--                            @enderror--}}
                        </div>
                    </div>
{{--                    <br>--}}
{{--                    <label for="description">Description</label>--}}

{{--                    <textarea name="description" id="description" cols="90" rows="5" placeholder="Write me anything please!">{!! old('description') !!}</textarea>--}}
                    {{-- With placeholder, sm size, label and some configuration --}}
{{--                    @php--}}
{{--                        $config = [--}}
{{--                            "height" => "200",--}}
{{--                            "toolbar" => [--}}
{{--                                // [groupName, [list of button]]--}}
{{--                                ['style', ['bold', 'italic', 'underline', 'clear']],--}}
{{--                                ['font', ['strikethrough', 'superscript', 'subscript']],--}}
{{--                                ['fontname', ['fontname']],--}}
{{--                                ['fontsize', ['fontsize']],--}}
{{--                                ['fontsizeunit', ['fontsizeunit']],--}}
{{--                                ['color', ['color']],--}}
{{--                                ['para', ['ul', 'ol', 'paragraph']],--}}
{{--                                ['height', ['height']],--}}
{{--                                ['table', ['table']],--}}
{{--                                //['insert', ['link', 'picture', 'video']],--}}
{{--                                ['view', ['fullscreen', 'codeview', 'help']],--}}
{{--                            ],--}}
{{--                        ]--}}
{{--                    @endphp--}}
{{--                    <x-adminlte-text-editor name="description" id="description" label="Description" label-class="text-danger"--}}
{{--                                            igroup-size="sm" placeholder="Write some text..." :config="$config">--}}
{{--                        @if(isset($action_actual))--}}
{{--                            {!! old('description') ? old('description') : $action_actual[0]->description !!}--}}
{{--                        @else--}}
{{--                            {!! old('description') !!}--}}
{{--                        @endif--}}
{{--                    </x-adminlte-text-editor>--}}



{{--                            <div class="card-text">--}}
{{--                                <texarea class="text col-sm-12" style="height: 200px" name="description" id="description" placeholder="Write some text...">--}}
{{--                                    @if(isset($action_actual))--}}
{{--                                        {!! old('description') ? old('description') : $action_actual[0]->description !!}--}}
{{--                                    @else--}}
{{--                                        {!! old('description') !!}--}}
{{--                                    @endif--}}
{{--                                </texarea>--}}
{{--                            </div>--}}
                    <br>
                    <label for="description">Description</label>
                    <br>
{{--                    <textarea name="description" id="description" style="width:100%; height: 200px" placeholder="Write me anything please!">{!! old('description') ?? $action_actual[0]->description ?? '' !!}--}}
{{--</textarea>--}}
                    <textarea name="description" id="summernote" cols="90" rows="10" placeholder="Write me anything please!">{{ old('description') ?? $action_actual[0]->description ?? '' }}
</textarea>
                    @error('description')
                    <small class="text-danger">
                        {{ $message }}
                    </small>
                    @enderror


                </div>

                <input type="hidden" id="users_id" name="users_id" value="3487">
                <input type="hidden" id="pacientes_id" name="pacientes_id" value={{ $editable[0]->id }}>

                <a href="{{ route('paciente.show', $editable[0]->id) }}" class="btn btn-secondary">Volver</a>
                @if(isset($action_actual))
                    <input class="btn btn-primary" type="submit" value="Guardar Atención">
                @else
                    <input class="btn btn-primary" type="submit" value="Agregar Atención">
                @endif

            </form>
        </div>
    </div>

@stop

@section('js')

    <script>
        $(document).ready(function() {
            $('#summernote').summernote();
        });
    </script>

@stop
