<?php 
$paginas = Auth::user()->join('permissions', 'users.rol_id', '=', 'permissions.rol_id')->pluck('permissions.page')->toArray();
?>

<li class="{{ Request::is('home') ? 'active' : '' }}">	
	<a href="{!! route('home') !!}"><i class="fas fa-home"></i><span> Home</span></a>    
</li>

@if(in_array("enterprises.enterprises.index", $paginas) == true || Auth::user()->rol->name == 'Admin')
<li class="{{ Request::is('enterprises*') ? 'active' : '' }}">	
	<a href="{!! route('enterprises.enterprises.index') !!}"><i class="fas fa-city"></i><span> Empresas</span></a>    
</li>
@endif

@if(in_array("users.index", $paginas) == true || Auth::user()->rol->name == 'Admin')
<li class="{{ Request::is('users*') ? 'active' : '' }}">	
	<a href="{!! route('users.index') !!}"><i class="fas fa-users"></i><span> Usuarios</span></a>
</li>
@endif

@if(in_array("rols.index", $paginas) == true || Auth::user()->rol->name == 'Admin')

<li class="{{ Request::is('rols*') ? 'active' : '' }}">
    <a href="{!! route('rols.index') !!}"><i class="fab fa-superpowers"></i><span> Roles de Usuario</span></a>
</li>
@endif

@if(Auth::user()->rol->name == 'Admin')
<li class="{{ Request::is('rols*') ? 'active' : '' }}">
    <a href="{!! route('scaffolding') !!}" target="_blank"><i class="fas fa-file-code"></i><span> Scaffolding</span></a>
</li>
@endif


