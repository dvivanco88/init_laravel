@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Usuarios
        </h1>
    </section>    
    <div class="content">
        @include('flash::message')
        <div class="box box-primary">
            <div class="box-body">
                <div class="row" style="padding-left: 20px">
                    @include('users.show_fields')
                    <a href="{!! route('users.index') !!}" class="btn btn-default">Volver</a>
                    <a href="{{ route('users.edit', $user->id) }}" class="btn btn-default" style="padding-left: 5px;">Editar</a>
                </div>
            </div>
        </div>
    </div>
@endsection
