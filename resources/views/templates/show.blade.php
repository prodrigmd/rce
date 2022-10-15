@extends('adminlte::page')

@section('title', 'Template')

@section('content_header')
    <h1>{{ $surgery[0] -> name }}</h1>
@stop

@section('content')
<div class="card">
    <div class="card-body">
        <textarea name="description" id="description" cols="90" rows="5" placeholder="Sin contenido">{{ $editable[0]->description }}</textarea>
    </div>
</div>
@stop

@section('js')
    <script>
        function copyText() {
            /* Get the text field */
            var copyText = document.getElementById("description");

            /* Select the text field */
            copyText.select();
            copyText.setSelectionRange(0, 99999); /* For mobile devices */

            /* Copy the text inside the text field */
            navigator.clipboard.writeText(copyText.value);

            /* Alert the copied text */
            alert("Copied the text: " + copyText.value);
        }
    </script>

@stop
