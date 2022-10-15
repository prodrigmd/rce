<!DOCTYPE html>
<html>
<head>
    <title>Document Verifier</title>
    <style>
        @page { margin: 0; }
    </style>
</head>
<body>
<div style="text-align: center;">
    @if(!is_null($content))
        <h2>*** Documento verificado ***</h2>
        <img src="{{ url(asset('storage/documents').'/receta_'.$content ) }}" style="width: 13.5cm; height: auto">
    @else
        <h1>Este documento ya no es válido!</h1>
    @endif
</div>
{{--<p>ut aliquip ex ea commodoconsequat. Duis aute irure dolor in reprehenderit in voluptate velit esse--}}
{{--    cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidata.</p>--}}
</body>
</html>
