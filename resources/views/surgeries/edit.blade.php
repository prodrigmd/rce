@extends('adminlte::page')

@section('title', 'Intervenciones')
@section('plugins.Summernote', true)
@section('plugins.Sweetalert2', true)

@section('content_header')
    <h1>Editar Intervención: {{ $editable[0]->name }} </h1>
@stop

@section('content')

    @if(session('info'))
        <div class="alert alert-success">
            {{ session('info') }}
        </div>
    @endif

    <div class="card">
        <div class="card-body">
            <form method="POST" action="{{ route('surgery.update', $editable[0]->id) }}" accept-charset="UTF-8">
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
                            <label for="codigoFonasa">Código Fonasa</label>
                            <input class="form-control" value="{{ old('codigoFonasa') ?? $editable[0]->codigoFonasa }}" name="codigoFonasa" type="text" id="codigoFonasa">
                            @error('codigoFonasa')
                            <small class="text-danger">
                                {{ $message }}
                            </small>
                            @enderror
                        </div>
                        <div class="col-sm-4">
                            <label for="areas_id">Area(*)</label>
                            <select class="form-control" id="areas_id" name="areas_id">
                                @foreach($areas as $area)
                                    @if($area -> id == $editable[0] -> areas_id)
                                        <option value="{{ $editable[0]->areas_id }}">
                                            {{ $area -> name }}
                                        </option>
                                    @endif
                                @endforeach
                                @foreach($areas as $area)
                                    @if($area -> id != $editable[0] -> areas_id)
                                        <option value='{{ $area -> id }}'>{{ $area -> name }}</option>
                                    @endif
                                @endforeach
                            </select>
                            @error('areas_id')
                            <small class="text-danger">
                                {{ $message }}
                            </small>
                            @enderror
                        </div>
                    </div>
{{--                    <br>--}}
{{--                    <label for="description">Description</label>--}}
                    <br>
{{--                    <textarea name="description" id="description" cols="100" rows="3" placeholder="Write me anything please!">{{ old('description') ?? $editable[0]->description ?? '' }}--}}
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
                    <x-adminlte-text-editor name="description" id="description" label="Description" label-class="text-danger"
                                            igroup-size="sm" placeholder="Write some text..." :config="$config">
                        {{ old('description') ?? $editable[0]->description ?? '' }}
                    </x-adminlte-text-editor>
                    @error('description')
                    <small class="text-danger">
                        {{ $message }}
                    </small>
                    @enderror
                </div>
                <a href="{{ route('surgery.show', $editable[0]->id) }}" class="btn btn-secondary">Volver</a>
                <input class="btn btn-primary" type="submit" value="Guardar Intervención">
            </form>

        </div>
    </div>
    <div class="card" style="width: 100%">
        <div class="card-header">
            <h4>Templates <a href="{{ route('template.create', $editable[0] -> id) }}" class="btn btn-sm btn-default text-danger mx-1 shadow" title="Nuevo">Agregar Template</a></h4>
        </div>
    @forelse($templates->where('surgeries_id', '=', $editable[0] -> id) as $template)
        <div class="card-body">
            <div class="card-title bg-secondary border-3 rounded py-1" style="width: 100%">
                        {{ $template -> name }}
            </div>
            <br>
            <div class="card-text text" id="template_description">
                {!! $template -> description !!}
{{--                <text id="template_description">--}}
{{--                    {!! ($template -> description) !!}--}}
{{--                </text>--}}

                {{-- Minimal with placeholder --}}
{{--                <x-adminlte-textarea name="template_description" id="template_description" disabled>--}}
{{--                    {!! $template -> description !!}--}}
{{--                </x-adminlte-textarea>--}}

{{--                <textarea style="width:100%; max-width:100%; max-height:30%;" id="template_description">--}}
{{--                    {!! nl2br(e($template -> description)) !!}--}}
{{--                    {{ $template -> description }}--}}
{{--                </textarea>--}}
            </div>
            <div class="card-footer">
                <div class="row">
                    <a href="{{ route('template.edit', [$template -> id]) }}" class="card-link"><i class="fas fa-edit"></i></a>
{{--                    <button onclick="copyMyText()">Copy</button>--}}
                    <form action="{{ route('template.destroy', $template -> id) }}" method="POST" class="eliminator">
                        @csrf
                        @method('DELETE')
                        <button onclick="myFunction({{ $editable[0] -> name }}, 'Paul')" type="submit" class="btn btn-xs btn-default text-danger mx-1 shadow" title="Eliminar"><i class="fa fa-lg fa-fw fa-trash"></i></button>
                    </form>
                </div>
            </div>

        </div>
    @empty
        <div class="card" style="width: 100%">
            <div class="card-body">
                Sin templates...
            </div>
        </div>
    @endforelse
        <div class="card-footer">
            <a href="" class="btn btn-sm btn-default text-danger mx-1 shadow" title="Nuevo">Agregar Template</a>
        </div>
    </div>
@stop

@section('js')

    @if(session('info') == 'Template eliminado con éxito!')
        <script>
            Swal.fire(
                'Eliminado!',
                'El template ha sido eliminado.',
                'success'
            )
        </script>
    @endif
    <script>
        $('.eliminator').submit(function(e){
            e.preventDefault();
            Swal.fire({
                title: 'Está seguro que desea eliminar?',
                text: "Esta acción es irreversible!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Si, eliminar!',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.value) {
                    // Swal.fire(
                    //     'Deleted!',
                    //     'Your file has been deleted.',
                    //     'success'
                    // )
                    this.submit();
                }
            });
        });
    </script>

    <script>
        function copyMyText() {
            /* Get the text field */
            var copyText = document.getElementById("template_description");

            /* Select the text field */
            copyText.select();
            copyText.setSelectionRange(0, 99999); /* For mobile devices */

            /* Copy the text inside the text field */
            navigator.clipboard.writeText(copyText.value);

            /* Alert the copied text */
            alert("Copied the text: " + copyText.value);
        }
    </script>

@stop
