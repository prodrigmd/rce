<div class="row">
    <div class="col-sm-3">
        <label for="patientName">Nombre paciente(*)</label>
        <input class="form-control" value="{!! old('patientName') ?? ($editable[0]->patientName ?? '') !!}" name="patientName" type="text" id="patientName">
        @error('patientName')
        <small class="text-danger">
            {{ $message }}
        </small>
        @enderror
    </div>
    <div class="col-sm-1">
        <label for="patientAge">Edad(*)</label>
        <input class="form-control" value="{!! old('patientAge') ?? ($editable[0]->patientAge ?? '') !!}" name="patientAge" type="text" id="patientAge">
        @error('patientAge')
        <small class="text-danger">
            {{ $message }}
        </small>
        @enderror
    </div>
    <div class="col-sm-2">
        <label for="patientRUT">RUT(*)</label>
        <input class="form-control" value="{!! old('patientRUT') ?? ($editable[0]->patientRUT ?? '') !!}" name="patientRUT" type="text" id="patientRUT">
        @error('patientRUT')
        <small class="text-danger">
            {{ $message }}
        </small>
        @enderror
    </div>
    <div class="col-sm-3">
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
        <x-adminlte-input-date name="date" id="date" label="Fecha Solicitud(*)" igroup-size="sm"
                               :config="$config" placeholder="Escoja una fecha" value="{{ isset($editable[0]->date) ? \Carbon\Carbon::parse($editable[0]->date)->format('d-m-Y H:i') : '' }}">
            <x-slot name="appendSlot">
                <div class="input-group-text bg-dark">
                    <i class="fas fa-calendar-day"></i>
                </div>
            </x-slot>
        </x-adminlte-input-date>
        @error('date')
        <small class="text-danger">
            {{ $message }}
        </small>
        @enderror
    </div>
    <div class="col-sm-3">
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
        <x-adminlte-input-date name="dateSurgery" id="dateSurgery" label="Fecha Cirugía(*)" igroup-size="sm"
                               :config="$config" placeholder="Escoja una fecha" value="{{ isset($editable[0]->dateSurgery) ? \Carbon\Carbon::parse($editable[0]->dateSurgery)->format('d-m-Y H:i') : '' }}">
            <x-slot name="appendSlot">
                <div class="input-group-text bg-dark">
                    <i class="fas fa-calendar-day"></i>
                </div>
            </x-slot>
        </x-adminlte-input-date>
        @error('dateSurgery')
        <small class="text-danger">
            {{ $message }}
        </small>
        @enderror
    </div>
</div>

<div class="row">
    <div class="col-sm-6">
        <label for="surgeonName">Cirujanos</label>
        <input class="form-control" value="{!! old('surgeonName') ?? ($editable[0]->surgeonName ?? '') !!}" name="surgeonName" type="text" id="surgeonName">
        @error('surgeonName')
        <small class="text-danger">
            {{ $message }}
        </small>
        @enderror
    </div>
    <div class="col-sm-3">
        <label for="surgeonRUT">RUT Cirujanos</label>
        <input class="form-control" value="{!! old('surgeonRUT') ?? ($editable[0]->surgeonRUT ?? '') !!}" name="surgeonRUT" type="text" id="surgeonRUT">
        @error('surgeonRUT')
        <small class="text-danger">
            {{ $message }}
        </small>
        @enderror
    </div>
    <div class="col-sm-3">
        <label for="surgeonSpecialty">Especialidad Cirujanos</label>
        <input class="form-control" value="{!! old('surgeonSpecialty') ?? ($editable[0]->surgeonSpecialty ?? '') !!}" name="surgeonSpecialty" type="text" id="surgeonSpecialty">
        @error('surgeonSpecialty')
        <small class="text-danger">
            {{ $message }}
        </small>
        @enderror
    </div>
</div>
<br>
<div class="row">
    <div class="col-sm-3">
        <label for="anesthesiaName">Anestesiólogo(a)</label>
        <input class="form-control" value="{!! old('anesthesiaName') ?? ($editable[0]->anesthesiaName ?? '') !!}" name="anesthesiaName" type="text" id="anesthesiaName">
        @error('anesthesiaName')
        <small class="text-danger">
            {{ $message }}
        </small>
        @enderror
    </div>
    <div class="col-sm-3">
        <label for="anesthesiaRUT">RUT Anestesiólogo(a)</label>
        <input class="form-control" value="{!! old('anesthesiaRUT') ?? ($editable[0]->anesthesiaRUT ?? '') !!}" name="anesthesiaRUT" type="text" id="anesthesiaRUT">
        @error('anesthesiaRUT')
        <small class="text-danger">
            {{ $message }}
        </small>
        @enderror
    </div>
    <div class="col-sm-3">
        <label for="arsenaleraName">Arsenalera(o)</label>
        <input class="form-control" value="{!! old('arsenaleraName') ?? ($editable[0]->arsenaleraName ?? '') !!}" name="arsenaleraName" type="text" id="arsenaleraName">
        @error('arsenaleraName')
        <small class="text-danger">
            {{ $message }}
        </small>
        @enderror
    </div>
    <div class="col-sm-3">
        <label for="arsenaleraRUT">RUT Arsenalera(o)</label>
        <input class="form-control" value="{!! old('arsenaleraRUT') ?? ($editable[0]->arsenaleraRUT ?? '') !!}" name="arsenaleraRUT" type="text" id="arsenaleraRUT">
        @error('arsenaleraRUT')
        <small class="text-danger">
            {{ $message }}
        </small>
        @enderror
    </div>
</div>
<br>
<div class="row">
    <div class="col-sm-4">
        <label for="email">Email</label>
        <input class="form-control" value="{!! old('email') ?? ($editable[0]->email ?? '') !!}" name="email" type="text" id="email">
        @error('email')
        <small class="text-danger">
            {{ $message }}
        </small>
        @enderror
    </div>
</div>
<br>
<div class="row">
    <div class="col-sm-12">
        <label for="description">Detalle</label>
    </div>
    <div class="col-sm-12">
        <textarea name="description" id="description" cols="80" rows="5" placeholder="Write me anything please!">{!! old('description') ?? ($editable[0]->description ?? '') !!}</textarea>
        @error('description')
        <br>
        <small class="text-danger">
            {{ $message }}
        </small>
        @enderror
    </div>
</div>

<input type="hidden" id="pathway" name="pathway" value="receta">

@isset($myType)
    <div class="row">
        <div class="col-sm-3">
            <label for="documents_type_id">Tipo Documentos(*)</label>
            <select name="documents_type_id" id="documents_type_id" style="width: 100%" disabled>
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

        <div class="col-sm-3">
            <label for="documents_type_subtype_id">Subtipo Documento(*)</label>
            <select name="documents_type_subtype_id" id="documents_type_subtype_id" style="width: 100%">
                @foreach($subtypes as $subtype)
                    <option value="{{$subtype->id}}" {{ $subtype->id == $editable[0]->documents_type_subtype_id ? "selected" : "" }}>{{$subtype->name}}</option>
                @endforeach
            </select>
            @error('documents_type_subtype_id')
            <small class="text-danger">
                {{ $message }}
            </small>
            @enderror
        </div>

    </div>
@endisset

{{--<div class="row">--}}
{{--    <div class="col-sm-4">--}}
{{--        <label for="documents_type_id">Tipo de Documento(*)</label>--}}
{{--        <select name="documents_type_id" id="documents_type_id" style="width: 100%">--}}
{{--            <option value="" selected="selected"></option>--}}
{{--            @foreach($types as $type)--}}
{{--                <option value="{{$type->id}}">{{$type->name}}</option>--}}
{{--            @endforeach--}}
{{--        </select>--}}
{{--        @error('documents_type_id')--}}
{{--        <small class="text-danger">--}}
{{--            {{ $message }}--}}
{{--        </small>--}}
{{--        @enderror--}}
{{--    </div>--}}
{{--    <div class="col-sm-4">--}}
{{--        <label for="documents_type_subtype_id">Subtipo de Documento(*)</label>--}}
{{--        <select name="documents_type_subtype_id" id="documents_type_subtype_id" style="width: 100%">--}}
{{--            <option value="" selected="selected"></option>--}}
{{--            @foreach($subtypes as $subtype)--}}
{{--                <option value="{{$subtype->id}}">{{$subtype->name}}</option>--}}
{{--            @endforeach--}}
{{--        </select>--}}
{{--        @error('documents_type_subtype_id')--}}
{{--        <small class="text-danger">--}}
{{--            {{ $message }}--}}
{{--        </small>--}}
{{--        @enderror--}}
{{--    </div>--}}
{{--</div>--}}
