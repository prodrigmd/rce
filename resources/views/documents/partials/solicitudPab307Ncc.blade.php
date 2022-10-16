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
        <label for="surgeryTime">Tiempo Quirúrgico</label>
        <input class="form-control" value="{!! old('surgeryTime') ?? ($editable[0]->surgeryTime ?? '') !!}" name="surgeryTime" type="text" id="surgeryTime">
        @error('surgeryTime')
        <small class="text-danger">
            {{ $message }}
        </small>
        @enderror
    </div>
</div>
<br>
<div class="row">
    <div class="col-sm-6">
        <label for="diagnosis">Diagnóstico Quirúrgico</label>
        <input class="form-control" value="{!! old('diagnosis') ?? ($editable[0]->diagnosis ?? '') !!}" name="diagnosis" type="text" id="diagnosis">
        @error('diagnosis')
        <small class="text-danger">
            {{ $message }}
        </small>
        @enderror
    </div>
    <div class="col-sm-6">
        <label for="history">Antecedentes</label>
        <input class="form-control" value="{!! old('history') ?? ($editable[0]->history ?? '') !!}" name="history" type="text" id="history">
        @error('history')
        <small class="text-danger">
            {{ $message }}
        </small>
        @enderror
    </div>
</div>
<br>
<div class="row">
    <div class="col-sm-6">
        <label for="surgeriesList">Procedimientos Quirúrgicos</label>
{{--        <input class="form-control" value="{!! old('surgeriesList') ?? ($editable[0]->surgeriesList ?? '') !!}" name="surgeriesList" type="text" id="surgeriesList">--}}
        <textarea name="surgeriesList" id="surgeriesList" cols="80" rows="5" placeholder="Write me anything please!">{!! old('surgeriesList') ?? ($editable[0]->surgeriesList ?? '') !!}</textarea>
        @error('surgeriesList')
        <small class="text-danger">
            {{ $message }}
        </small>
        @enderror
    </div>
</div>
<div class="row">
    <div class="col-sm-6">
        <label for="surgeriesDetail">Detalle del Procedimiento</label>
        <input class="form-control" value="{!! old('surgeriesDetail') ?? ($editable[0]->surgeriesDetail ?? '') !!}" name="surgeriesDetail" type="text" id="surgeriesDetail">
        @error('surgeriesDetail')
        <small class="text-danger">
            {{ $message }}
        </small>
        @enderror
    </div>
    <div class="col-sm-6">
        <label for="surgeriesPosition">Posición Quirúrgica</label>
        <input class="form-control" value="{!! old('surgeriesPosition') ?? ($editable[0]->surgeriesPosition ?? '') !!}" name="surgeriesPosition" type="text" id="surgeriesPosition">
        @error('surgeriesPosition')
        <small class="text-danger">
            {{ $message }}
        </small>
        @enderror
    </div>
</div>
<br>
<div class="row">
    <div class="col-sm-4">
        <label for="Interconsulta">Interconsulta</label>
        <input class="form-control" value="{!! old('Interconsulta') ?? ($editable[0]->Interconsulta ?? '') !!}" name="Interconsulta" type="text" id="Interconsulta">
        @error('surgeriesPosition')
        <small class="text-danger">
            {{ Interconsulta }}
        </small>
        @enderror
    </div>
    <div class="col-sm-4">
        <label for="paseMatronaYN">Pase Matrona</label>
        <select name="paseMatronaYN" id="paseMatronaYN" style="width: 100%">
            <option value="{{ $editable[0]->paseMatronaYN }}" selected="selected">
                @if($editable[0]->paseMatronaYN == 'Y') Si
                @elseif($editable[0]->paseMatronaYN == 'N') No
                @elseif($editable[0]->paseMatronaYN == NULL)
                @endif
            </option>
            @if($editable[0]->paseMatronaYN == 'Y')
                <option value='N'>No</option>
                <option value=NULL></option>
            @elseif($editable[0]->paseMatronaYN == 'N')
                <option value='Y'>Si</option>
                <option value=NULL></option>
            @else
                <option value='Y'>Si</option>
                <option value='N'>No</option>
{{--                <option value="N" @if(old('paseMatronaYN')=='N') selected="selected" @endif>No</option>--}}
            @endif
        </select>
        @error('paseMatronaYN')
        <small class="text-danger">
            {{ $message }}
        </small>
        @enderror
    </div>
    <div class="col-sm-4">
        <label for="thromboticRiskBMA">Riesgo Tromboembólico</label>
        <select name="thromboticRiskBMA" id="thromboticRiskBMA" style="width: 100%">
            <option value="{{ $editable[0]->thromboticRiskBMA }}" selected="selected">
                @if($editable[0]->thromboticRiskBMA == 'B') Bajo
                @elseif($editable[0]->thromboticRiskBMA == 'M') Medio
                @elseif($editable[0]->thromboticRiskBMA == 'A') Alto
                @elseif($editable[0]->thromboticRiskBMA == NULL)
                @endif
            </option>
            @if($editable[0]->thromboticRiskBMA == 'B')
                <option value='M'>Medio</option>
                <option value='A'>Alto</option>
                <option value=NULL></option>
            @elseif($editable[0]->thromboticRiskBMA == 'M')
                <option value='B'>Bajo</option>
                <option value='A'>Alto</option>
                <option value=NULL></option>
            @elseif($editable[0]->thromboticRiskBMA == 'A')
                <option value='B'>Bajo</option>
                <option value='M'>Medio</option>
                <option value=NULL></option>
            @else
                <option value='B'>Bajo</option>
                <option value='M'>Medio</option>
                <option value='A'>Alto</option>
            @endif
        </select>
        @error('thromboticRiskBMA')
        <small class="text-danger">
            {{ $message }}
        </small>
        @enderror
    </div>
</div>
<br>
<div class="row">
    <div class="col-sm-12">
        <label for="description">Justificación</label>
        <input class="form-control" value="{!! old('description') ?? ($editable[0]->description ?? '') !!}" name="description" type="text" id="description">
        @error('description')
        <small class="text-danger">
            {{ $message }}
        </small>
        @enderror
    </div>
</div>
<br>
<div class="row">
    <div class="col-sm-6">
        <label for="supplies">Insumos</label>
        <textarea name="supplies" id="supplies" cols="80" rows="5" placeholder="Write me anything please!">{!! old('supplies') ?? ($editable[0]->supplies ?? '') !!}</textarea>
        @error('supplies')
        <small class="text-danger">
            {{ $message }}
        </small>
        @enderror
    </div>
</div>
<br>
<div class="row">
    <div class="col-sm-12">
        <label for="equipment">Equipamiento</label>
        <input class="form-control" value="{!! old('equipment') ?? ($editable[0]->equipment ?? '') !!}" name="equipment" type="text" id="equipment">
        @error('equipment')
        <small class="text-danger">
            {{ $message }}
        </small>
        @enderror
    </div>
</div>
<br>
<div class="row">
    <div class="col-sm-12">
        <label for="consignaciones">Consignaciones</label>
        <input class="form-control" value="{!! old('consignaciones') ?? ($editable[0]->consignaciones ?? '') !!}" name="consignaciones" type="text" id="consignaciones">
        @error('consignaciones')
        <small class="text-danger">
            {{ $message }}
        </small>
        @enderror
    </div>
</div>
<br>
<div class="row">
    <div class="col-sm-4">
        <label for="bloodProducts">Hemoderivados (Tipo-Cantidad)</label>
        <input class="form-control" value="{!! old('bloodProducts') ?? ($editable[0]->bloodProducts ?? '') !!}" name="bloodProducts" type="text" id="bloodProducts">
        @error('bloodProducts')
        <small class="text-danger">
            {{ $message }}
        </small>
        @enderror
    </div>
    <div class="col-sm-4">
        <label for="ambulatorioYN">Ambulatorio</label>
        <select name="ambulatorioYN" id="ambulatorioYN" style="width: 100%">
            <option value="{{ $editable[0]->ambulatorioYN }}" selected="selected">
                @if($editable[0]->ambulatorioYN == 'Y') Si
                @elseif($editable[0]->ambulatorioYN == 'N') No
                @elseif($editable[0]->ambulatorioYN == NULL)
                @endif
            </option>
            @if($editable[0]->ambulatorioYN == 'Y')
                <option value='N'>No</option>
                <option value=NULL></option>
            @elseif($editable[0]->ambulatorioYN == 'N')
                <option value='Y'>Si</option>
                <option value=NULL></option>
            @else
                <option value='Y'>Si</option>
                <option value='N'>No</option>
            @endif
        </select>
        @error('ambulatorioYN')
        <small class="text-danger">
            {{ $message }}
        </small>
        @enderror
    </div>
    <div class="col-sm-4">
        <label for="diasHosp">Dias de Hosp (MQ-UTI-UCI-TOTAL)</label>
        <input class="form-control" value="{!! old('diasHosp') ?? ($editable[0]->diasHosp ?? '') !!}" name="diasHosp" type="text" id="diasHosp">
        @error('diasHosp')
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
