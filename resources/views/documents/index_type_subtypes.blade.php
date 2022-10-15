@extends('adminlte::page')

@section('title', 'Subtipos de Documentos')

@section('plugins.Datatables', true)

@section('plugins.Sweetalert2', true)


@section('content_header')
    <a class="btn btn-secondary btn-sm float-right" href="{{ route('document_type_subtypes.create') }}">Nuevo Subtipo de Documento</a>
    <h1>Subtipos de documentos</h1>
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
                <th>Nombre corto</th>
                <th>Tipo de Documento</th>
                <th>Imagen</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            @forelse($document_type_subtypes as $subtype)
                <tr>
                    <td id="myName">{{ $subtype -> name }}</td>
                    <td>{{ $subtype -> shortName }}</td>
                    <td>
                        @foreach($document_types as $type)
                            @if($type->id == $subtype->documents_type_id)
                                {{ $type -> name }}
                            @endif
                        @endforeach
                    </td>
                    <td>
                        @if(isset($subtype -> image))
                            <i class="fas fa-check"></i>
                        @endif
                    </td>
                    <td style="width: 100px">
                        <div class="row">
{{--                            <a href="{{ route('paciente.show', $paciente -> id) }}" class="btn btn-xs btn-default text-teal mx-1 shadow" title="Ver"><i class="fa fa-lg fa-fw fa-eye"></i></a>--}}
                            <a href="{{ route('document_type_subtypes.edit', $subtype->id) }}" class="btn btn-xs btn-default text-primary mx-1 shadow" title="Editar"><i class="fa fa-lg fa-fw fa-pen"></i></a>
                            <form action="{{ route('document_type_subtypes.destroy', $subtype->id) }}" method="POST" class="eliminator">
                                @csrf
                                @method('DELETE')
                                    <button onclick="myFunction({{ $subtype -> name }}, 'Paul')" type="submit" class="btn btn-xs btn-default text-danger mx-1 shadow" title="Eliminar"><i class="fa fa-lg fa-fw fa-trash"></i></button>
                            </form>
                        </div>
                    </td>
                </tr>
            @empty
                <p>No existen Tipos</p>
            @endforelse
            </tbody>
        </table>

    </div>

</div>
@stop

@section('js')
    @if(session('info') == 'Tipo de documento eliminado con éxito!')
        <script>
            Swal.fire(
                'Eliminado!',
                'El tipo de documento ha sido eliminado.',
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
                this.api().columns([3]).every( function (d) {
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
