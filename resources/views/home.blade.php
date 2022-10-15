@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Dashboard</h1>
@stop
@section('content')
    <div class="card" style="width: 100%">
        <div class="card-body bg-dark">
            <div class="card-title"><h4>Hospitalizados({{ $hospCount }})</h4></div>
            <ul>
        @forelse($pacientes_hospitalizados as $paciente_hosp)

            <div class="card-text bg-secondary border-3 rounded py-1" style="width: 100%">
                <li>
                <strong><a href="{{ route('paciente.edit', [$paciente_hosp->id, 'origen'=>'home']) }}" style="color: white">{{ $paciente_hosp->name }} {{ $paciente_hosp->lastName1 }} {{ $paciente_hosp->lastName2 }}</a></strong>

                @foreach($hospitals as $hospital)
                    @if($hospital->id == $paciente_hosp->hospital)
                        en {{ $hospital->name }}
                    @endif
                @endforeach
                </li>

            </div>
        @empty
            <div class="card-text bg-secondary border-3 rounded py-1" style="width: 100%">
                No hay pacientes hospitalizados...
            </div>

        @endforelse
            </ul>
        <br>
            <div class="card-title"><h4>Agenda({{ $agendaCount }})</h4></div>
            <ul>
    @forelse($pacientes_agenda as $paciente_ag)

                <div class="card-text bg-secondary border-3 rounded py-1" style="width: 100%">
                   <li> {{ucfirst(Carbon\Carbon::parse($paciente_ag -> action_next_date)->locale('es_ES')->isoFormat('LLLL'))}} :
                    @foreach($action_names as $action_name)
                        @if($action_name->id == $paciente_ag->action_next)
                            {{ $action_name->name }} de <strong><a href="{{ route('paciente.edit', [$paciente_ag->id, 'origen'=>'home']) }}" style="color: white">{{ $paciente_ag->name }} {{ $paciente_ag->lastName1 }} {{ $paciente_ag->lastName2 }}</a></strong>
                        @endif
                    @endforeach

                    @foreach($hospitals as $hospital)
                        @if($hospital->id == $paciente_ag->hospital)
                            en {{ $hospital->name }}
                        @endif
                    @endforeach
                   </li>

                </div>
    @empty
                <div class="card-text bg-secondary border-3 rounded py-1" style="width: 100%">
                    Sin agendamiento...
                </div>

    @endforelse
            </ul>
            <br>
            <div class="card-title"><h4>A programar({{ $porProgCount }})</h4></div>
            <ol>
            @forelse($pacientes_porprogramar as $paciente_porprogramar)

                <div class="card-text bg-secondary border-3 rounded py-1" style="width: 100%">
                    <li>
                        @if(isset($paciente_porprogramar -> action_next_date))
                            {{ucfirst(Carbon\Carbon::parse($paciente_porprogramar -> action_next_date)->locale('es_ES')->isoFormat('LLLL'))}} :
                        @endif
                    @foreach($action_names as $action_name)
                        @if($action_name->id == $paciente_porprogramar->action_next)
                            {{ $action_name->name }} de
                        @endif
                    @endforeach
                            <strong><a href="{{ route('paciente.edit', [$paciente_porprogramar->id, 'origen'=>'home']) }}" style="color: white">{{ $paciente_porprogramar->name }} {{ $paciente_porprogramar->lastName1 }} {{ $paciente_porprogramar->lastName2 }}</a></strong>

                    @foreach($hospitals as $hospital)
                        @if($hospital->id == $paciente_porprogramar->hospital)
                            en {{ $hospital->name }}
                        @endif
                    @endforeach
                    </li>

                </div>
            @empty
                <div class="card-text bg-secondary border-3 rounded py-1" style="width: 100%">
                    Sin pacientes para programar...
                </div>

            @endforelse
            </ol>
    </div>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop
