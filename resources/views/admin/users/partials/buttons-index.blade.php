<td style="width: 10px">
    <a href="{{ route('users.edit', $user) }}" class="btn btn-sm btn-primary">Editar</a>
</td>
<td style="width: 10px">
    <form action="{{ route('users.destroy', $user) }}" method="POST" class="eliminator">
        @csrf
        @method('DELETE')
        @if($user -> hasRole('SuperAdmin'))
            <button type="submit" class="btn btn-sm btn-danger" disabled="disabled">Eliminar</button>
        @else
            <button type="submit" class="btn btn-sm btn-danger">Eliminar</button>
        @endif
    </form>
</td>
