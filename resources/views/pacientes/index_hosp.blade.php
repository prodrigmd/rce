@extends('adminlte::page')

@section('title', 'Pacientes')

@section('plugins.Datatables', true)

@section('plugins.Sweetalert2', true)


@section('content_header')
    <a class="btn btn-secondary btn-sm float-right" href="{{ route('paciente.create') }}">Nuevo Paciente</a>
    <h1>Pacientes hospitalizados</h1>
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
<div class="card">
    <div class="card-body">
        <table class="table table-striped" id="prcTable">
            <thead>
            <tr>
{{--                <th>ID</th>--}}
                <th>Nombre</th>
                <th>Apellidos</th>
{{--                <th>Sexo</th>--}}
                <th>Edad</th>
                <th>Hospital</th>
                <th>Status</th>
                <th>NextAction</th>
                <th>NextDate</th>
                <th>Scheduled</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
{{--            @forelse($pacientes->where('status', '==', '3') as $paciente)--}}
            @forelse($pacientes as $paciente)
{{--                <tr class="{{ $paciente -> scheduled == 0 ? : 'bg-info' }}">--}}
                <tr class="{{ $paciente -> scheduled == 0 ? : ($paciente -> scheduled == 1 ? 'bg-info' : 'bg-warning') }}">
{{--                    <td>{{ $paciente -> id }}</td>--}}
                    <td id="myName">{{ $paciente -> name }}</td>
                    <td>{{ $paciente -> lastName1 }} {{ $paciente -> lastName2 }}</td>
{{--                    <td>{{ $paciente -> sex }}</td>--}}
{{--                    <td>{{ $paciente -> dob }}</td>--}}
                    <td>{{ \Carbon\Carbon::parse($paciente->dob)->age }}</td>
                    <td style="max-width: 200px;overflow: hidden;white-space: nowrap;text-overflow: ellipsis;">
                        @foreach($hospitals as $hospital)
                            @if($paciente -> hospital == $hospital -> id)
                                {{ $hospital -> shortName }}
                            @endif
                        @endforeach
                    </td>
                    <td style="max-width: 200px;overflow: hidden;white-space: nowrap;text-overflow: ellipsis;">
                       @if($paciente->status == 1) Hosp
                        @elseif($paciente->status == 2) Amb
                        @elseif($paciente->status == 3) Alta
                        @endif
                    </td>
                    <td>
{{--                        @if($paciente -> action_next == '1') Interv--}}
{{--                        @elseif($paciente -> action_next == '2') Hosp--}}
{{--                        @elseif($paciente -> action_next == '3') Amb--}}
{{--                        @elseif($paciente -> action_next == '4') Otra--}}
{{--                        @endif--}}
                        @foreach($action_names as $action_name)
                            @if($action_name->id == $paciente->action_next)
                                {{ $action_name->shortName }}
                            @endif
                        @endforeach
                    </td>
{{--                    <td>{{ $paciente -> action_next_date }}</td>--}}
{{--                    <td>{{ \Carbon\Carbon::parse($paciente -> action_next_date)->format('d-m-Y') }}</td>--}}
                    <td>
                        @if(isset($paciente -> action_next_date))
{{--                            {{ \Carbon\Carbon::parse($paciente -> action_next_date)->format('d-m-Y') }}--}}
                            {{ \Carbon\Carbon::parse($paciente -> action_next_date)->format('Y-m-d') }}
                        @endif
                    </td>
                    <td style="text-align: center">
                        {{--                        <i class="{{ $paciente -> scheduled == 0 ? 'fas fa-times': 'fas fa-check-circle' }}"></i>--}}
                        {{ $paciente -> scheduled == 0 ? 'No': ($paciente -> scheduled == 1 ? 'Si' : '(p)') }}
                    </td>
                    <td style="width: 100px">
                        <div class="row">
                            <a href="{{ route('paciente.show', $paciente -> id) }}" class="btn btn-xs btn-default text-teal mx-1 shadow" title="Ver"><i class="fa fa-lg fa-fw fa-eye"></i></a>
    {{--                        <a href="{{ route('paciente.edit', [$paciente->id, 'origen'=>'index']) }}" class="btn btn-sm btn-primary">Editar</a>--}}
                            <a href="{{ route('paciente.edit', [$paciente->id, 'origen'=>'index_hosp']) }}" class="btn btn-xs btn-default text-primary mx-1 shadow" title="Editar"><i class="fa fa-lg fa-fw fa-pen"></i></a>
    {{--                    </td>--}}
    {{--                    <td>--}}
                            <form action="{{ route('paciente.destroy', $paciente->id) }}" method="POST" class="eliminator">
                                @csrf
                                @method('DELETE')
    {{--                                <button onclick="myFunction({{ $paciente -> name }}, 'Paul')" type="submit" class="btn btn-sm btn-danger">Eliminar</button>--}}
                                    <button onclick="myFunction({{ $paciente -> name }}, 'Paul')" type="submit" class="btn btn-xs btn-default text-danger mx-1 shadow" title="Eliminar"><i class="fa fa-lg fa-fw fa-trash"></i></button>
                            </form>
                        </div>
                    </td>
                </tr>
            @empty
                <p>No existen Pacientes</p>
            @endforelse
            </tbody>
        </table>

    </div>

</div>
@stop

@section('js')
    @if(session('info') == 'Paciente eliminado con éxito!')
        <script>
            Swal.fire(
                'Eliminado!',
                'El paciente ha sido eliminado.',
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
        $('#prcTable').DataTable({
            responsive: true,
            autoWidth: false,
            fixedHeader: true,
            colReorder: false,
            search: {
                return: false
            },
            "deferRender": true,
            "order": [],
            "language": {
                "lengthMenu": 'Mostrar ' +
                    `<select class="custom-select custom-select-sm form-control form-control-sm">
                        <option value='10'>10</option>
                        <option value='25'>25</option>
                        <option value='50'>50</option>
                        <option value='100'>100</option>
                        <option value='-1'>Todo</option>
                    </select>` +
                    ' registros por página',
                "decimal": ",",
                "thousands": ".",
                "zeroRecords": "Nada encontrado - disculpe",
                "info": "Mostrando la página _PAGE_ de _PAGES_",
                "infoEmpty": "No records available",
                "infoFiltered": "(filtrado de _MAX_ registros totales)",
                "search": "Buscar:",
                "loadingRecords": "Cargando...",
                "processing": "Procesando...",
                "paginate": {
                    "next": "Siguiente",
                    "previous": "Anterior"
                }
            },

            //Individual column searching (select inputs)
            initComplete: function () {
                this.api().columns([3,7]).every( function (d) {
                    var theadname = $("#prcTable th").eq([d]).text(); //used this specify table name and head
                    var column = this;
                    var select = $(
                        // '<select><option value=""></option></select>'
                        '<select class="form-control my-1"><option value="">' +
                        theadname +
                        ": All</option></select>"
                    )
                        // .appendTo( $(column.footer()).empty() )
                        .appendTo( $(column.header()).empty() )
                        .on( 'change', function () {
                            var val = $.fn.dataTable.util.escapeRegex(
                                $(this).val()
                            );

                            column
                                .search( val ? '^'+val+'$' : '', true, false )
                                .draw();
                        } );

                    column.data().unique().sort().each( function ( d, j ) {
                        select.append( '<option value="'+d+'">'+d+'</option>' )
                    } );
                } );
            }

        });
    </script>


@stop
