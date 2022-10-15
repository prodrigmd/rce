@extends('adminlte::page')

@section('title', 'Protocolos')
@section('plugins.Summernote', true)

@section('content_header')
    <h1>Editar Protocolo: {{ $editable[0]->name }} </h1>
@stop

@section('content')

    @if(session('info'))
        <div class="alert alert-success">
            {{ session('info') }}
        </div>
    @endif

    <div class="card">
        <div class="card-body">
            <form method="POST" action="{{ route('protocol.update', $editable[0]->id) }}" accept-charset="UTF-8">
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
                    </div>
                    <br>
                    <label for="description">Description</label>
                    <br>
{{--                    <textarea name="description" id="description" cols="90" rows="5" placeholder="Write me anything please!">{{ old('description') ?? $editable[0]->description ?? '' }}--}}
{{--</textarea>--}}
                    @php
                        $config = [
                            "height" => "400",
                            "toolbar" => [
                                // [groupName, [list of button]]
                                ['style', ['bold', 'italic', 'underline', 'clear']],
                                ['font', ['strikethrough', 'superscript', 'subscript']],
                                ['fontname', ['fontname']],
                                ['fontsize', ['fontsize']],
                                ['fontsizeunit', ['fontsizeunit']],
                                ['color', ['color']],
                                ['para', ['ul', 'ol', 'paragraph']],
                                ['height', ['height']],
                                ['table', ['table']],
                                //['insert', ['link', 'picture', 'video']],
                                ['view', ['fullscreen', 'codeview', 'help']],
                            ],
                        ]
                    @endphp
                    {{--                    <textarea name="description" id="description" cols="90" rows="5" placeholder="Write me anything please!">{{ old('description') ?? $editable[0]->description ?? '' }}</textarea>--}}
                    <x-adminlte-text-editor name="description" id="description" label-class="text-danger"
                                            igroup-size="sm" placeholder="Write some text..." :config="$config">
                        {{ old('description') ?? $editable[0]->description ?? '' }}
                    </x-adminlte-text-editor>
                    @error('description')
                    <small class="text-danger">
                        {{ $message }}
                    </small>
                    @enderror
                </div>
                <a href="{{ route('protocol.index') }}" class="btn btn-secondary">Volver</a>
                <input class="btn btn-primary" type="submit" value="Actualizar Protocolo">
                <a href="{{ route('protocol.show', $editable[0] -> id) }}" class="btn btn-xs btn-default text-teal mx-1 shadow" title="Ver"><i class="fa fa-lg fa-fw fa-eye"></i></a>
            </form>

        </div>
    </div>
@stop
