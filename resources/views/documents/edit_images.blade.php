@extends('adminlte::page')

@section('title', 'Imagenes')

@section('plugins.TempusDominusBs4', true)

@section('plugins.Sweetalert2', true)

@section('content_header')
    <h1>Editar Imagen: {{ $editable[0]->name }} </h1>
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
            <form method="POST" action="{{ route('document_subtypes_xy.update', $editable[0]->id) }}" accept-charset="UTF-8">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <div class="row">
                        <div class="col-sm-12">
                            <label for="imagexy_description">Coordinates Description(*)</label>
                            <p>Las coordenadas tienen 4 partes separadas por comas con un ; al final del grupo (excepto la última línea). <br>
                                Primero el nombre del grupo entre corchetes [], luego el texto a colocar en el template,
                                luego las coordenada x (horizontal) e y(vertical).<br>
                                El nombre del grupo coincide con el nombre de columna de la tabla 'documents'. <br>
                                ejemplo: [patientName],Pedro Torres Valencia,1250,600; <br>

                                Si el texto corresponde a varias líneas o a tabulaciones, estas se separan con el uso de /t/ y se usa /XY:
                                la diferencia de coordenadas entre textos. <br>
                                Ej: [surgeriesPosition],Posicion Linea 1/t/Posicion Linea 2/XY:0|90,3400,2480;<br>

                                <b>Nombre de grupos disponibles: </b>[patientName], [patientAge], [patientRUT],
                                [patientAddress], [patientCity], [date], [description], [email],
                                [surgeonName], [surgeonRUT], [surgeonSpecialty], [anesthesiaName], [arsenaleraName],
                                [surgeryTime], [diagnosis], [history], [surgeriesList], [surgeriesDetail],
                                [surgeriesPosition], [thromboticRisk], [paseMatronaYN], [justification], [supplies],
                                [equipment], [consignaciones], [ambulatorioYN], [diasHosp], [delayRiskYN]. <br>
                                <b>Grupos derivados: </b> [date-d], [date-m], [date-Y], [date-d-m-Y], [date-H:i],
                                [dateSurgery-d-m-Y], [dateSurgery-H:i], [surgeonName-1], [anesthesist-YN],
                                [arsenalera-YN]<br>
                                <b>Grupos de configuración: </b> [qrcode], [sizeAngleColor] (color habitual: #132683).
                            </p>
{{--                            <textarea name="imagexy_description" id="imagexy_description" cols="100" rows="5">{{ old('imagexy_description') ?? $editable[0]->imagexy_description }}</textarea>--}}
{{--                            @error('imagexy_description')--}}
{{--                            <small class="text-danger">--}}
{{--                                {{ $message }}--}}
{{--                            </small>--}}
{{--                            @enderror--}}
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <label for="imagexy">Coordinates(*)</label>
{{--                            <input class="form-control" value="{{ old('imagexy') ?? $editable[0]->imagexy }}" name="imagexy" type="text" id="imagexy">--}}
                            <textarea name="imagexy" id="imagexy" cols="100" rows="10">{{ old('imagexy') ?? $editable[0]->imagexy }}</textarea>
                            @error('imagexy')
                            <small class="text-danger">
                                {{ $message }}
                            </small>
                            @enderror
                        </div>
                    </div>
                </div>
                <a href="{{ route('document_type_subtypes.edit', $editable[0]->id) }}" class="btn btn-secondary">Volver</a>
                <input class="btn btn-primary" type="submit" value="Actualizar coordenadas">
                <a href="{{ route('receta_template.edit', $editable[0]->id) }}" class="btn btn-success">Generar Template</a>
            </form>
            <br>
            @if(isset($editable[0]->image))
                <div class="row">
                    <div class="col-sm-8">
{{--                        <img class="img-fluid" src="{{ url(asset('storage/documents').'/'.$editable[0]->image) }}" alt="Receta">--}}
                        <img class="img-fluid" src="{{ url(asset('storage/documents').'/test_receta_'.$editable[0]->imagexy_file) }}" alt="Receta">
                    </div>
                </div>
            @endif

        </div>
    </div>
@stop
