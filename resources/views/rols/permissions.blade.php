@extends('layouts.app')

@section('content')
<section class="content-header">
    <h1>
        Rol
    </h1>
</section>
<div class="content">
    @include('flash::message')
    <div class="box box-primary">
        <div class="box-body">
            <div class="row" style="padding-left: 20px">
                <div class="form-group">                    
                    <h1>{!! $rol->name !!}</h1>
                </div>

                <div class="form-group">                                        

                    <div class="col-sm-6">
                        <h3> Acceso </h3>
                        <table class="table table-striped table-hover">
                            <tr>
                                <th>ID</th>
                                <th>Página</th>
                            </tr>

                            @foreach($permissions as $p)
                            <tr>
                                <td>{!! $p->id !!}</td>
                                <td>{!! $p->page!!}</td>
                                <td>
                                    {!! Form::open(['route' => ['rols.submitted_delete', $rol->id ,$p->id ], 'method' => 'delete']) !!}
                                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', [
                                        'type' => 'submit',
                                        'class' => 'btn btn-danger btn-xs',
                                        'onclick' => "return confirm('¿Estás seguro(a)?')"
                                        ]) !!}
                                        {!! Form::close() !!}
                                    </td>
                                </tr>
                                @endforeach
                            </table>
                        </div>

                        <div class="col-sm-6">
                            {!! Form::open(['route' => ['rols.submitted', $rol->id], 'method' => 'post']) !!}
                            <h3> Agregar </h3>
                            <?php $routeCollection = Route::getRoutes(); ?>                        
                            <table class="table table-bordered table-striped">
                                <tr>
                                    <th>*.index </th>
                                    <th>*.create </th>
                                    <th>*.show </th>
                                    <th>*.edit </th>                                        
                                </tr>
                                <tr>
                                    <td>Mostrar Listado de Registros</td>
                                    <td>Crear Registro</td>
                                    <td>Mostrar Registro Completo</td>
                                    <td>Actualizar/Editar Registro</td>
                                </tr>
                            </table>
                            <select name="page" id="page" class="form-control">                            
                                @foreach($routeCollection as $value)
                                @if(!empty($value->getName()))
                                @if(substr($value->getName(), 0, 4) != "api.")
                                @if(substr($value->getName(), 0, 11) != "swaggervel.") 
                                @if(substr($value->getName(), 0, 9) != "password.")                            
                                @if($value->getName() != "login")
                                @if($value->getName() != "logout")
                                @if($value->getName() != "register")
                                @if($value->getName() != "home")
                                @if(substr($value->getName(), strlen($value->getName())-8, strlen($value->getName())) != ".destroy")
                                @if(substr($value->getName(), strlen($value->getName())-6, strlen($value->getName())) != ".store")
                                @if(substr($value->getName(), strlen($value->getName())-7, strlen($value->getName())) != ".update")
                                <option>{!! $value->getName() !!}</option>                            
                                @endif
                                @endif
                                @endif                            
                                @endif                            
                                @endif                            
                                @endif                            
                                @endif                            
                                @endif                            
                                @endif                            
                                @endif
                                @endif
                                @endforeach
                            </select>


                            <div class="form-group col-sm-12">    
                                <br>
                                {!! Form::submit('Agregar', ['class' => 'btn btn-primary']) !!}                           
                            </div>

                            {!! Form::close() !!}
                        </div>

                    </div>
                    <div class="col-sm-12">
                        <br>
                        <br>
                        <a href="{!! route('rols.index') !!}" class="btn btn-default">Volver</a>                    
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endsection