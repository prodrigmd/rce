@extends('adminlte::page')

@section('title', 'Template')
@section('plugins.Summernote', true)

@section('content_header')
    <h1>Editar template a: {{ $surgery[0] -> name }}</h1>
@stop

@section('content')

    @if(session('info'))
        <div class="alert alert-success">
            {{ session('info') }}
        </div>
    @endif

    <div class="card">
        <div class="card-body">
            <form method="POST" action="{{ route('template.update', $editable[0] -> id) }}" accept-charset="UTF-8">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <div class="row">
                        <div class="col-sm-6">
                            <label for="name">Nombre(*)</label>
                            <input class="form-control" value="{{ old('name') ?? $editable[0]->name }}" name="name" type="text" id="name">
                            @error('name')
                            <small class="text-danger">
                                {{ $message }}
                            </small>
                            @enderror
                        </div>
                        <div class="col-sm-2">
                            <label for="shortName">Short Name(*)</label>
                            <input class="form-control" value="{{ old('shortName') ?? $editable[0]->shortName }}" name="shortName" type="text" id="shortName">
                            @error('shortName')
                            <small class="text-danger">
                                {{ $message }}
                            </small>
                            @enderror
                        </div>
                    </div>
                    <br>
{{--                    <label for="description">Description</label>--}}
{{--                    <br>--}}
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
                    <x-adminlte-text-editor name="description" id="description" label="Description" label-class="text-danger"
                                            igroup-size="sm" placeholder="Write some text..." :config="$config">
                        {{ old('description') ?? $editable[0]->description ?? '' }}
                    </x-adminlte-text-editor>
                </div>
                <a href="{{ route('surgery.edit', $surgery[0]->id) }}" class="btn btn-secondary">Volver</a>
                <input class="btn btn-primary" type="submit" value="Guardar Template">

            </form>
        </div>
    </div>

@stop
