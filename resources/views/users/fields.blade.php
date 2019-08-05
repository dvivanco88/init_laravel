<!-- Image Field -->
<div class="form-group col-sm-6">
    @if (Route::current()->getName() == "users.edit")
    <div style="display:inline-block; width:100%; height:auto;">
        <img style="max-height: 200px;" class="img-responsive" src='{!! $user->image == "no_photo" ? "../../images/no_photo.jpg" : "../../uploads/users/". $user->id ."/".$user->image !!}'>
        {!! Form::label('image', 'Cambiar Imagen:') !!}
        {!! Form::file('image') !!}
    </div>
    @else    
    {!! Form::label('image', 'Imagen:') !!}
    {!! Form::file('image') !!}
    @endif
    
</div>
<div class="clearfix"></div>

<!-- Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('name', 'Nombre Completo:') !!}
    {!! Form::text('name', null, ['class' => 'form-control']) !!}
</div>

@if (Route::current()->getName() == "users.edit" && Auth::user()->rol->name != "Admin" && $user->rol->name == "Admin" )
<!-- Email Contact Field -->
<div class="form-group col-sm-6">
    {!! Form::label('email', 'Email:') !!}
    {!! Form::email('email', null, ['class' => 'form-control', 'disabled'=> 'true']) !!}
</div>


<!-- Email Contact Field -->
<div class="form-group col-sm-4">
    {!! Form::label('password', 'Contraseña:') !!}
    {!! Form::password('password', ['class' => 'form-control', 'disabled'=> 'true']); !!}
</div>
@else
<!-- Email Contact Field -->
<div class="form-group col-sm-6">
    {!! Form::label('email', 'Email:') !!}
    {!! Form::email('email', null, ['class' => 'form-control']) !!}
</div>


<!-- Email Contact Field -->
<div class="form-group col-sm-4">
    {!! Form::label('password', 'Contraseña:') !!}
    {!! Form::password('password', ['class' => 'form-control']); !!}
</div>
@endif

<!-- Is Active Field -->
<div class="form-group col-sm-3">
    {!! Form::label('enterprise_id', 'Empresa:') !!}
    {!!Form::select('enterprise_id', array($enterprises->pluck('name', 'id')->prepend('N/A','')), isset($user) ? is_null($user->enterprise_id) ? '' : $user->enterprise_id  : '', ['class' => 'form-control']); !!}    
</div>
@if(Auth::user()->rol->name == "Admin")
<div class="form-group col-sm-3">
    {!! Form::label('rol_id', 'Rol:') !!}
    {!!Form::select('rol_id', array($rols->pluck('name', 'id')->prepend('-- Seleccionar Rol --','')), isset($user) ? is_null($user->rol_id) ? '' : $user->rol_id  : '', ['class' => 'form-control']); !!}    
</div>

<!-- Is Active Field -->
<div class="form-group col-sm-2">
    {!! Form::label('is_active', 'Estado de Usuario:') !!}
    {!!Form::select('is_active', array('0' => 'BAJA', '1' => 'ACTIVO'), isset($user) ? $user->is_active == 1 ? "1" : "0" : "1", ['class' => 'form-control']); !!}    
</div>
@elseif(isset($user) && $user->rol->name != "Admin")
<div class="form-group col-sm-3">
    {!! Form::label('rol_id', 'Rol:') !!}
    {!!Form::select('rol_id', array($rols->pluck('name', 'id')->prepend('-- Seleccionar Rol --','')), isset($user) ? is_null($user->rol_id) ? '' : $user->rol_id  : '', ['class' => 'form-control']); !!}    
</div>

<!-- Is Active Field -->
<div class="form-group col-sm-2">
    {!! Form::label('is_active', 'Estado de Usuario:') !!}
    {!!Form::select('is_active', array('0' => 'BAJA', '1' => 'ACTIVO'), isset($user) ? $user->is_active == 1 ? "1" : "0" : "1", ['class' => 'form-control']); !!}    
</div>
@elseif(!isset($user))
<div class="form-group col-sm-3">
    {!! Form::label('rol_id', 'Rol:') !!}
    {!!Form::select('rol_id', array($rols->pluck('name', 'id')->prepend('-- Seleccionar Rol --','')), isset($user) ? is_null($user->rol_id) ? '' : $user->rol_id  : '', ['class' => 'form-control']); !!}    
</div>

<!-- Is Active Field -->
<div class="form-group col-sm-2">
    {!! Form::label('is_active', 'Estado de Usuario:') !!}
    {!!Form::select('is_active', array('0' => 'BAJA', '1' => 'ACTIVO'), isset($user) ? $user->is_active == 1 ? "1" : "0" : "1", ['class' => 'form-control']); !!}    
</div>
@endif

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Guardar', ['class' => 'btn btn-primary']) !!}
    @if (Route::current()->getName() == "users.edit")
    <a href="{!! route('users.show', $user) !!}" class="btn btn-default">Cancelar</a>
    @else    
    <a href="{!! route('users.index') !!}" class="btn btn-default">Cancelar</a>
    @endif
</div>
