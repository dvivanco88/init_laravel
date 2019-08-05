<!-- Id Field -->
<div class="form-group">
    {!! Form::label('id', 'ID:') !!}
     {!! $rol->id !!}
</div>
<div class="clearfix"></div>
<!-- Name Field -->
<div class="form-group">
    {!! Form::label('name', 'Nombre:') !!}
    <p>{!! $rol->name !!}</p>
</div>

<!-- Is Active Field -->
<div class="form-group">
    {!! Form::label('is_active', 'Activo?') !!}
    @if(is_null($rol->is_active) || $rol->is_active == 0)
    <p style="color:Tomato">BAJA</p>
    @else
    <p style="color:Dodgerblue">ACTIVO</p>
    @endif    
</div>


