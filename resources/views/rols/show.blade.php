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
                    @include('rols.show_fields')
                    <a href="{!! route('rols.index') !!}" class="btn btn-default">Volver</a>
                    <a href="{!! route('rols.edit', $rol) !!}" class="btn btn-default" style:"padding-left: 5px;">Editar</a>
                </div>
            </div>
        </div>
    </div>
@endsection
