@extends('adminlte::page')

@section('title', 'Subtipo de Documento')

@section('plugins.TempusDominusBs4', true)

@section('plugins.Sweetalert2', true)

@section('content_header')
    <h1>Editar Subtipo de Documento: {{ $editable[0]->name }} </h1>
@stop

@section('content')

    @if(session('info'))
        <div class="alert alert-success">
            {{ session('info') }}
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <div class="card">
        <div class="card-body">
            <form method="POST" action="{{ route('document_type_subtypes.update', $editable[0]->id) }}" accept-charset="UTF-8">
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
                        <div class="col-sm-4">
                            <label for="name">Name(*)</label>
                            <input class="form-control" value="{{ old('name') ?? $editable[0]->name }}" name="name" type="text" id="name">
                            @error('name')
                            <small class="text-danger">
                                {{ $message }}
                            </small>
                            @enderror
                        </div>
                        <div class="col-sm-2">
                            <label for="shortName">Nombre Corto(*)</label>
                            <input class="form-control" value="{{ old('shortName') ?? $editable[0]->shortName }}" name="shortName" type="text" id="shortName">
                            @error('shortName')
                            <small class="text-danger">
                                {{ $message }}
                            </small>
                            @enderror
                        </div>
                        <div class="col-sm-2">
                            <label for="documents_type_id">Tipo Documento(*)</label>
                            <select name="documents_type_id" id="documents_type_id" style="width: 100%">
                                @foreach($types as $type)
                                    <option value="{{$type->id}}" {{ $type->id == $editable[0]->documents_type_id ? "selected" : "" }}>{{$type->name}}</option>
                                @endforeach
                            </select>
                            @error('documents_type_id')
                            <small class="text-danger">
                                {{ $message }}
                            </small>
                            @enderror
                        </div>
                    </div>
                </div>
                <a href="{{ route('document_type_subtypes.index') }}" class="btn btn-secondary">Volver</a>
                <input class="btn btn-primary" type="submit" value="Actualizar tipo de documento">
            </form>
            <br>
            @if(isset($editable[0]->image))
                <div class="row">
                    <div class="col-sm-8">
                        <img class="img-fluid" src="{{ url(asset('storage/documents').'/'.$editable[0]->image) }}" alt="Receta">
                    </div>
                </div>
{{--                <form action="{{ route('document_type_subtypes.destroy_document', $editable[0]->id) }}" method="POST" class="eliminator">--}}
                <form action="{{ route('receta.destroy', $editable[0]->id) }}" method="POST" class="eliminator">
                    @csrf
                    @method('DELETE')
                    <a href="{{ route('document_type_subtypes.index') }}" class="btn btn-secondary">Volver</a>
                    <a href="{{ route('document_image.edit', $editable[0]->id) }}" class="btn btn-primary">Coordenadas</a>
                    <button onclick="myFunction({{ $editable[0] -> id }}, 'Paul')" type="submit" class="btn btn-default text-danger mx-1 shadow" title="Eliminar">Eliminar</button>
                </form>

            @else
{{--            <form method="POST" action="{{ route('document_type_subtypes.store_document', $editable[0]->id) }}" enctype="multipart/form-data">--}}
            <form method="POST" action="{{ route('receta.store', ['subtype'=>$editable[0]->id ]) }}" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <div class="row">
                        <div class="col-sm-8">
                            <div class="file">
                                <label>Add image</label>
                                <input type="file" class="form-control" required name="file">
                                @error('file')
                                <small class="text-danger">
                                    {{ $message }}
                                </small>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
                <a href="{{ route('document_type_subtypes.index') }}" class="btn btn-secondary">Volver</a>
                <input class="btn btn-primary" type="submit" value="Subir imagen">
            </form>

            @endif

        </div>
    </div>
@stop

@section('js')

    @if(session('info') == 'Imagen eliminada con éxito!')
        <script>
            Swal.fire(
                'Eliminada!',
                'La imagen ha sido eliminada.',
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
                    this.submit();
                }
            });
        });
    </script>

@stop
