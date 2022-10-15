@extends('adminlte::page')

@section('title', 'Documentos')

@section('plugins.Datatables', true)

@section('plugins.Sweetalert2', true)


@section('content_header')
{{--    <a class="btn btn-secondary btn-sm float-right" href="{{ route('document.create') }}">Nuevo Documento</a>--}}
<form method="GET" action="{{ route('document.create') }}" accept-charset="UTF-8">
    @csrf
    <div class="col-sm-12 d-flex justify-content-end">
{{--    <div>--}}
{{--        <label for="documents_type_subtype_id">Subtipo de Documento(*)</label>--}}
        <div class="p-2 d-flex justify-content-end">
            <select name="documents_type_subtype_id" id="documents_type_subtype_id" style="width: 100%; text-align: right">
                <option value="" selected="selected"></option>
                @foreach($document_type_subtypes as $subtype)
                    <option value="{{$subtype->id}}">{{$subtype->name}}</option>
                @endforeach
            </select>
            @error('documents_type_subtype_id')
            <small class="text-danger">
                {{ $message }}
            </small>
            @enderror
        </div>
        <div class="p-2">
{{--            <input type="hidden" id="documents_type_id" name="documents_type_id" value="{{ $subtype->documents_type_id }}">--}}
            <input class="btn btn-secondary btn-sm float-right" type="submit" value="Nuevo Documento">
        </div>
{{--        <input class="btn btn-secondary btn-sm float-right" type="submit" value="Nuevo Documento">--}}
    </div>
</form>
    <h1>Documentos</h1>
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
                <th>RUT</th>
                <th>Fecha</th>
                <th>Tipo de Documento</th>
                <th>Subtipo de Documento</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            @forelse($documents as $document)
                <tr>
                    <td id="myName">{{ $document -> patientName }}</td>
                    <td>{{ $document -> patientRUT }}</td>
                    <td>{{ $document -> date }}</td>
                    <td>
                        @foreach($document_types as $type)
                            @if($type->id == $document->documents_type_id)
                                {{ $type -> name }}
                            @endif
                        @endforeach
                    </td>
                    <td>
                        @foreach($document_type_subtypes as $subtype)
                            @if($subtype->id == $document->documents_type_subtype_id)
                                {{ $subtype -> name }}
                            @endif
                        @endforeach
                    </td>
                    <td style="width: 100px">
                        <div class="row">
{{--                            <a href="{{ route('paciente.show', $paciente -> id) }}" class="btn btn-xs btn-default text-teal mx-1 shadow" title="Ver"><i class="fa fa-lg fa-fw fa-eye"></i></a>--}}
                            <a href="{{ route('document.edit', $document->id) }}" class="btn btn-xs btn-default text-primary mx-1 shadow" title="Editar"><i class="fa fa-lg fa-fw fa-pen"></i></a>
                            <form action="{{ route('document.destroy', $document->id) }}" method="POST" class="eliminator">
                                @csrf
                                @method('DELETE')
                                    <button onclick="myFunction({{ $document -> id }}, 'Paul')" type="submit" class="btn btn-xs btn-default text-danger mx-1 shadow" title="Eliminar"><i class="fa fa-lg fa-fw fa-trash"></i></button>
                            </form>
                        </div>
                    </td>
                </tr>
            @empty
                <p>No existen documentos</p>
            @endforelse
            </tbody>
        </table>

    </div>

</div>
@stop

@section('js')
    @if(session('info') == 'Documento eliminado con éxito!')
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
                this.api().columns([3,4]).every( function (d) {
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
