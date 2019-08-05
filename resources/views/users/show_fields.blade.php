<!-- Image Field -->
<div class="form-group">
    {!! Form::label('image', 'Imagen:') !!}    
    <div style="display:inline-block; width:100%; height:auto;">
        <img style="max-height: 200px;" class="img-responsive" src='{!! $user->image == "no_photo" ? "../../images/no_photo.jpg" : "../../uploads/users/". $user->id ."/".$user->image !!}'>
    </div>
</div>


<!-- Name Field -->
<div class="form-group">
    {!! Form::label('name', 'Nombre Completo:') !!}
    <p>{!! $user->name !!}</p>
</div>

<!-- Rol Field -->
<div class="form-group">
    {!! Form::label('rol_id', 'Rol:') !!}
    <p>{!! $user->rol_name !!}</p>
</div>

<!-- Email Contact Field -->
<div class="form-group">
    {!! Form::label('email', 'Email:') !!}
    <p>{!! $user->email !!}</p>
</div>


<!-- Ext Tel Field -->
<div class="form-group">
    {!! Form::label('enterprise_id', 'Empresa:') !!}
    @if(is_null($user->enterprise_id))
    <p style="color:Silver">N/A</p>
    @else
    <p> <b><a href="{!!route('enterprises.enterprises.show', $user->enterprise_id)!!}" target="_blank">{!! $user->enterprise_name !!} </a></b>
        <span style="color:Dodgerblue">
            <br><b>Contacto: {!! $user->contact_name !!}</b>
            <br>Email: {!! $user->email_contact !!}
            <br>Tel: {!! $user->tel !!}, Ext: {!! $user->ext_tel !!}
        </span>
    </p>
    @endif
    
</div>

<!-- Is Active Field -->
<div class="form-group">
    {!! Form::label('is_active', 'Estado de Usuario') !!}
    @if(is_null($user->is_active) || $user->is_active == 0)
    <p style="color:Tomato">BAJA</p>
    @else
    <p style="color:Dodgerblue">ACTIVO</p>
    @endif
    
</div>

