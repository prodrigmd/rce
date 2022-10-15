@extends('adminlte::page')

@section('title', 'Intervenciones')
@section('plugins.Sweetalert2', true)

@section('content_header')
    <h2>{{ $editable[0]->name }}</h2>
    <span class="text-bold">Area:</span>
    {{$area[0]->name}}
    <br>

{{--    <span class="text-bold">Descripción:</span>--}}
{{--    <br>--}}
{{--    {!! $editable[0]->description !!}--}}
{{--    <br>--}}
{{--    <a href="{{ route('surgery.edit', $editable[0]->id) }}" title="Editar"><i class="far fa-edit"></i></a>--}}
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

    <div class="card" style="width: 100%">
        <div class="card-body">
            <div class="card-title bg-secondary border-3 rounded py-1" style="width: 100%">
                Descripcion
            </div>
            <br>
            <div class="card-text">
                <div class="col-sm-12 text-justify text-dark pl-4 background3" style="position: relative; height: auto; overflow-y: auto">
                    {!! $editable[0]->description !!}
                </div>
                <br>
                <a href="{{ route('surgery.edit', $editable[0]->id) }}" title="Editar"><i class="far fa-edit"></i></a>
            </div>
        </div>
    </div>
<h4 class="text-light">Templates</h4>
    @forelse($templates as $template)
        <div class="card" style="width: 100%">
            <div class="card-body">
                <div class="card-title bg-secondary border-3 rounded py-1" style="width: 100%">
                        {{ $template -> name }}
                </div>
                <br>
                <div class="card-text">
                    <div id="copy_{{ $template->id }}" class="col-sm-12 text-justify letraclara pl-4 background3" style="position: relative; height: auto; overflow-y: auto">
                        {!! $template->description !!}
                    </div>
{{--                    <input type="hidden" id="copy_{{ $template->id }}" value="{!! $template->description !!}">--}}
                    <button value="copy" onclick="copyToClipboard('copy_{{ $template->id }}')">Copy!</button>
                </div>
            </div>
        </div>
    @empty
        <div class="card" style="width: 100%">
            <div class="card-body">
                Sin Templates...
            </div>
        </div>
    @endforelse
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

{{--    <script>--}}
{{--        function copyToClipboard(id) {--}}
{{--            document.getElementById(id).select();--}}
{{--            document.execCommand('copy');--}}
{{--        }--}}
{{--    </script>--}}

    <script>
        function copyToClipboard(id)
        {
            var r = document.createRange();
            r.selectNode(document.getElementById(id));
            window.getSelection().removeAllRanges();
            window.getSelection().addRange(r);
            document.execCommand('copy');
            window.getSelection().removeAllRanges();
        }
    </script>

@stop
