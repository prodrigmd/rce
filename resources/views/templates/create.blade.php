@extends('adminlte::page')

@section('title', 'Template')
@section('plugins.Summernote', true)

@section('content_header')
    <h1>Agregar nuevo template a: {{ $surgery -> name }}</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form method="POST" action="{{ route('template.store') }}" accept-charset="UTF-8">
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
                            <label for="shortName">Short Name(*)</label>
                            <input class="form-control" value="{!! old('shortName') !!}" name="shortName" type="text" id="shortName">
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
{{--                    <textarea name="description" id="description" cols="90" rows="5" placeholder="Write me anything please!">{!! old('description') !!}</textarea>--}}
                    @php
                        $config = [
                            "height" => "200",
                            "toolbar" => [
                                // [groupName, [list of button]]
                                ['style', ['bold', 'italic', 'underline', 'clear']],
                                ['font', ['strikethrough', 'superscript', 'subscript']],
                                ['fontsize', ['fontsize']],
                                ['color', ['color']],
                                ['para', ['ul', 'ol', 'paragraph']],
                                ['height', ['height']],
                                ['table', ['table']],
                                ['insert', ['link', 'picture', 'video']],
                                ['view', ['fullscreen', 'codeview', 'help']],
                            ],
                        ]
                    @endphp
                    {{--                    <textarea name="description" id="description" cols="90" rows="5" placeholder="Write me anything please!">{{ old('description') ?? $editable[0]->description ?? '' }}</textarea>--}}
                    <x-adminlte-text-editor name="description" id="description" label="Description" label-class="text-danger"
                                            igroup-size="sm" placeholder="Write some text..." :config="$config">
                        {{ old('description') ?? $editable[0]->description ?? '' }}
                    </x-adminlte-text-editor>
                    <br>
{{--                    @error('description')--}}
{{--                    <small class="text-danger">--}}
{{--                        {{ $message }}--}}
{{--                    </small>--}}
{{--                    @enderror--}}
                </div>
                <a href="{{ route('surgery.edit', $surgery->id) }}" class="btn btn-secondary">Volver</a>
                <input type="hidden" id="surgeries_id" name="surgeries_id" value="{{ $surgery -> id }}">
                <input class="btn btn-primary" type="submit" value="Agregar Template">

            </form>
        </div>
    </div>

@stop
