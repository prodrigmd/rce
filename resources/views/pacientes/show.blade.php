@extends('adminlte::page')

@section('title', 'Paciente')
@section('plugins.Sweetalert2', true)

@section('content_header')
    <h2>{{ $editable[0]->name }} {{ $editable[0]->lastName1 }} {{ $editable[0]->lastName2 }} -
        {{ $editable[0]->sex }} - {{ $age }} años.</h2>
    {{ $status_actual[0]-> name }} | {{ $hospital_actual[0]->name }} | <span class="text-bold">RUT:</span> {{ $editable[0]->rut }} | {{ $editable[0]->insurance }}
    <br>
    <span class="text-bold">Fono:</span> {{$editable[0]->phone}} | <span class="text-bold">email:</span>{{ $editable[0]->email }}
    <br>
    <span class="text-bold">Diagnóstico:</span> {{$editable[0]->diagnosis}}
    <br>
    <span class="text-bold">Historia:</span> {{$editable[0]->description}}
    <br>
    <a href="{{ route('paciente.edit', [$editable[0]->id, 'origen'=>'show']) }}" title="Editar paciente"><i class="far fa-edit"></i></a>
    |
    <a href="{{ route('paciente_action.create', $editable[0] -> id) }}" title="Nueva atención"><i class="fas fa-plus"></i></a>
@stop

@section('content')
    @if(session('info'))
        <div class="alert alert-success">
            {{ session('info') }}
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    @forelse($actions as $action)
        <div class="card" style="width: 100%">
            <div class="card-body">
                <div class="card-title bg-secondary border-3 rounded py-1" style="width: 100%">
                @foreach($action_names as $action_name)
                    @if($action_name->id == $action->action_name)
                        {{ $action_name -> name }}
                    @endif
                @endforeach
                    - {{Carbon\Carbon::parse($action -> date)->locale('es_ES')->isoFormat('LLLL')}}
                </div>
                <br>
                <div class="card-text">
{{--                    <div class="text" style="display: inline-block; word-wrap: break-word">--}}
{{--                    <textarea class="text" style="width: 100%; word-wrap: break-word; height: auto">--}}
{{--                    <textarea class="text text-gray-dark" style="width: 100%; height: 200px" disabled>--}}
{{--                        {!! $action -> description !!}--}}
{{--                    </textarea>--}}

                    <div class="col-sm-12 text-justify letraclara pl-4 background3" style="position: relative; height: auto; overflow-y: auto">
                        {!! $action->description !!}
                    </div>


                    {{-- Disabled --}}
{{--                    <x-adminlte-textarea name="taDisabled" igroup-size="sm" rows=20 disabled="">--}}
{{--                        {!! $action -> description !!}--}}
{{--                    </x-adminlte-textarea>--}}
                    <div class="row">
                        <a href="{{ route('paciente_action.edit', [$editable[0] -> id, $action -> id]) }}" class="card-link"><i class="fas fa-edit"></i></a>
                        {{--                <a href="{{ route('paciente_action.destroy', [$editable[0] -> id, $action -> id]) }}" class="card-link">Eliminar atención</a>--}}
                        <form action="{{ route('paciente_action.destroy', [$editable[0] -> id, $action -> id]) }}" method="POST" class="eliminator">
                            @csrf
                            @method('DELETE')
                            {{--                                <button onclick="myFunction({{ $paciente -> name }}, 'Paul')" type="submit" class="btn btn-sm btn-danger">Eliminar</button>--}}
                            <button onclick="myFunction({{ $editable[0] -> name }}, 'Paul')" type="submit" class="btn btn-xs btn-default text-danger mx-1 shadow" title="Eliminar"><i class="fa fa-lg fa-fw fa-trash"></i></button>
                        </form>
                    </div>
                </div>

                @foreach($authors as $author)
                    @if($author->id == $action->users_id)
                        <div class="card-footer p-0">{{ $author->title }} {{ $author->name }}</div>
                    @endif
                @endforeach
            </div>
        </div>
    @empty
        <div class="card" style="width: 100%">
            <div class="card-body">
                Sin atenciones...
            </div>
        </div>
    @endforelse

    <a href="{{ route('paciente_action.create', $editable[0] -> id) }}" class="btn btn-sm btn-default text-danger mx-1 shadow" title="Nuevo">Agregar Atención</a>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    @if(session('info') == 'Atención eliminada con éxito!')
        <script>
            Swal.fire(
                'Eliminada!',
                'La atención ha sido eliminada.',
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

@stop
