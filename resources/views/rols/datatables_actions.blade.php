{!! Form::open(['route' => ['rols.destroy', $id], 'method' => 'delete']) !!}
<div class='btn-group'>
    <a href="{{ route('rols.show', $id) }}" class='btn btn-default btn-xs'>
        <i class="glyphicon glyphicon-eye-open"></i>
    </a>
    <a href="{{ route('rols.edit', $id) }}" class='btn btn-default btn-xs'>
        <i class="glyphicon glyphicon-edit"></i>
    </a>
    <a href="{{ route('rols.permissions', $id) }}" class='btn btn-default btn-xs'>
        <i class="glyphicon glyphicon-cog"></i>
    </a>
    <!--{!! Form::button('<i class="glyphicon glyphicon-trash"></i>', [
        'type' => 'submit',
        'class' => 'btn btn-danger btn-xs',
        'onclick' => "return confirm('¿Estás seguro(a)?')"
    ]) !!}-->
</div>
{!! Form::close() !!}
