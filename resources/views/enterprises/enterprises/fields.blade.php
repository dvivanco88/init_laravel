<!-- Name Field -->
<div class="form-group col-sm-4">
    {!! Form::label('name', 'Nombre de Empresa:') !!}
    {!! Form::text('name', null, ['class' => 'form-control']) !!}
</div>

<!-- Tel Field -->
<div class="form-group col-sm-4">
    {!! Form::label('tel', 'Tel.:') !!}
    {!! Form::number('tel', null, ['class' => 'form-control']) !!}
</div>

<!-- Ext Tel Field -->
<div class="form-group col-sm-4">
    {!! Form::label('ext_tel', 'Ext. Tel.:') !!}
    {!! Form::number('ext_tel', null, ['class' => 'form-control']) !!}
</div>



<!-- Adress Field -->
<div class="form-group col-sm-8">
    {!! Form::label('adress', 'Dirección:') !!}
    {!! Form::text('adress', null, ['class' => 'form-control']) !!}
</div>

<!-- Rfc Field -->
<div class="form-group col-sm-4">
    {!! Form::label('rfc', 'RFC:') !!}
    {!! Form::text('rfc', null, ['class' => 'form-control']) !!}
</div>

<!-- Contact Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('contact_name', 'Nombre de Contacto:') !!}
    {!! Form::text('contact_name', null, ['class' => 'form-control']) !!}
</div>

<!-- Email Contact Field -->
<div class="form-group col-sm-6">
    {!! Form::label('email_contact', 'Email de Contacto:') !!}
    {!! Form::email('email_contact', null, ['class' => 'form-control']) !!}
</div>

<!-- Image Field 
<div class="form-group col-sm-6">
    {!! Form::label('image', 'Image:') !!}
    {!! Form::file('image') !!}
</div>
<div class="clearfix"></div>-->



<!-- Is Active Field -->
<div class="form-group col-sm-6">
    {!! Form::label('is_active', 'Estado de Empresa:') !!}
    {!!Form::select('is_active', array('0' => 'BAJA', '1' => 'ACTIVO'), isset($enterprise) ? $enterprise->is_active == 1 ? "1" : "0" : "1", ['class' => 'form-control']); !!}    
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Guardar', ['class' => 'btn btn-primary']) !!}
     @if (Route::current()->getName() == "enterprises.enterprises.edit")
    <a href="{!! route('enterprises.enterprises.show', $enterprise) !!}" class="btn btn-default">Cancelar</a>
    @else    
    <a href="{!! route('enterprises.enterprises.index') !!}" class="btn btn-default">Cancelar</a>
    @endif
    
</div>
