@extends('adminlte::page')

@section('title', 'Intervenciones')

@section('plugins.Datatables', true)

@section('plugins.Sweetalert2', true)


@section('content_header')
    <a class="btn btn-secondary btn-sm float-right" href="{{ route('surgery.create') }}">Nueva Intervención</a>
    <h1>Lista de Intervenciones</h1>
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
                <th>Nombre</th>
                <th>Área</th>
                <th style="text-align: center">Templates</th>
{{--                <th></th>--}}
                <th></th>
            </tr>
            </thead>
            <tbody>
            @forelse($surgeries as $surgery)
                <tr>
                    <td id="myName" style="min-width: 200px;overflow: hidden;white-space: nowrap;text-overflow: ellipsis;">{{ $surgery -> name }}</td>
                    <td>
                        @foreach($areas as $area)
                            @if($area -> id == $surgery -> areas_id)
                                {{ $area -> shortName }}
                            @endif
                        @endforeach
                    </td>
                    <td style="text-align: center">
                        @php $i = 0;  @endphp
                        @foreach($templates as $template)
                            @if($template -> surgeries_id == $surgery -> id)
                                @php $i++; @endphp
                            @endif
                        @endforeach
                        @php echo $i; @endphp
                    </td>
                    <td>
                        <div class="row">
                            <a href="{{ route('surgery.show', $surgery -> id) }}" class="btn btn-xs btn-default text-teal mx-1 shadow" title="Ver"><i class="fa fa-lg fa-fw fa-eye"></i></a>
{{--                        <a href="{{ route('surgery.edit', $surgery->id) }}" class="btn btn-xs btn-default text-primary mx-1 shadow" title="Editar"><i class="fa fa-lg fa-fw fa-pen"></i></a>--}}
{{--                    </td>--}}
{{--                    <td style="width: 10px">--}}
                        <form action="{{ route('surgery.destroy', $surgery->id) }}" method="POST" class="eliminator">
                            @csrf
                            @method('DELETE')
                                <button onclick="myFunction({{ $surgery -> name }}, 'Paul')" type="submit" class="btn btn-xs btn-default text-danger mx-1 shadow" title="Eliminar"><i class="fa fa-lg fa-fw fa-trash"></i></button>
                        </form>
                        </div>
                    </td>
                </tr>
            @empty
                <p>No existen intervenciones</p>
            @endforelse
            </tbody>
        </table>

    </div>

</div>
@stop

@section('js')
    @if(session('info') == 'Intervención eliminada con éxito!')
        <script>
            Swal.fire(
                'Eliminada!',
                'La intervención ha sido eliminada.',
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
                this.api().columns([1]).every( function (d) {
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
