<div class="form-group">
{{--    {!! Form::label('name', 'Nombre') !!}--}}
{{--    {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Ingrese el nombre del rol']) !!}--}}

    <label for="name">Nombre</label>
    <input class="form-control" placeholder="Ingrese el nombre del rol" name="name" type="text" id="name">



    @error('name')
    <small class="text-danger">
        {{ $message }}
    </small>
    @enderror

</div>

<h2 class="h3">Lista de permisos</h2>

@foreach($permissions as $permission)
    <div>
        <label>
{{--            {!! Form::checkbox('patologiaCategory[]', $permission->id, null, ['class' => 'mr-1']) !!}--}}
{{--            {{ $permission -> description }}--}}
                <input class="mr-1" name="permissions[]" type="checkbox" value="{{ $permission->id }}">
                {{ $permission -> name}}
        </label>
    </div>
@endforeach
