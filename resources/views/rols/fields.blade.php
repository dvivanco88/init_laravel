<!-- Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('id', 'ID:') !!}
    {!! Form::text('id', null, ['class' => 'form-control', 'disabled'=> true]) !!}
</div>
<div class="clearfix"></div>
<!-- Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('name', 'Nombre:') !!}
    {!! Form::text('name', null, ['class' => 'form-control']) !!}
</div>

<!-- Is Active Field -->
<div class="form-group col-sm-6">
    {!! Form::label('is_active', 'Activo?') !!}
    {!!Form::select('is_active', array('0' => 'BAJA', '1' => 'ACTIVO'), isset($rol) ? $rol->is_active == 1 ? "1" : "0" : "1", ['class' => 'form-control']); !!}     
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">    

     {!! Form::submit('Guardar', ['class' => 'btn btn-primary']) !!}
    @if (Route::current()->getName() == "rols.edit")
    <a href="{!! route('rols.show', $rol) !!}" class="btn btn-default">Cancelar</a>
    @else    
    <a href="{!! route('rols.index') !!}" class="btn btn-default">Cancelar</a>
    @endif
</div>
