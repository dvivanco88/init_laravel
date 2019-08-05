@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Enterprise
        </h1>
    </section>
    <div class="content">
        <div class="box box-primary">
            <div class="box-body">
                <div class="row" style="padding-left: 20px">
                    @include('enterprises.enterprises.show_fields')
                    <a href="{!! route('enterprises.enterprises.index') !!}" class="btn btn-default">Volver</a>
                    <a href="{!! route('enterprises.enterprises.edit', $enterprise->id) !!}" class="btn btn-default">Editar</a>
                </div>
            </div>
        </div>
    </div>
@endsection
