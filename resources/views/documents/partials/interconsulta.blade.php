<div class="row">
    <div class="col-sm-6">
        <label for="patientName">Nombre de IC(*)</label>
        <input class="form-control" value="{!! old('patientName') !!}" name="patientName" type="text" id="patientName">
        @error('patientName')
        <small class="text-danger">
            {{ $message }}
        </small>
        @enderror
    </div>
    <div class="col-sm-2">
        <label for="patientAge">Edad(*)</label>
        <input class="form-control" value="{!! old('patientAge') !!}" name="patientAge" type="text" id="patientAge">
        @error('patientAge')
        <small class="text-danger">
            {{ $message }}
        </small>
        @enderror
    </div>
    <div class="col-sm-4">
        <label for="patientRUT">RUT(*)</label>
        <input class="form-control" value="{!! old('patientRUT') !!}" name="patientRUT" type="text" id="patientRUT">
        @error('patientRUT')
        <small class="text-danger">
            {{ $message }}
        </small>
        @enderror
    </div>
</div>

<div class="row">
    <div class="col-sm-6">
        <label for="patientAddress">Dirección</label>
        <input class="form-control" value="{!! old('patientAddress') !!}" name="patientAddress" type="text" id="patientAddress">
        @error('patientAddress')
        <small class="text-danger">
            {{ $message }}
        </small>
        @enderror
    </div>
    <div class="col-sm-2">
        <label for="patientCity">Ciudad</label>
        <input class="form-control" value="{!! old('patientCity') !!}" name="patientCity" type="text" id="patientCity">
        @error('patientCity')
        <small class="text-danger">
            {{ $message }}
        </small>
        @enderror
    </div>
    <div class="col-sm-4">
        <label for="date">Fecha(*)</label>
        <input class="form-control" value="{!! old('date') !!}" name="date" type="d" id="date">
        @error('date')
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
        <textarea name="description" id="description" cols="80" rows="5" placeholder="Write me anything please!">{!! old('description') !!}</textarea>
    </div>
</div>
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
