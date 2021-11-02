@extends('pages.master')

@section('title', 'Categorias')

@section('breadcrumb')
    <li class="breadcrumb-item">
        <a href="{{ url('/categories') }}" class="nav-link"><i class="fas fa-folder"></i> Categorias</a>
    </li>  
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-4">
                <div class="panel shadow">
                    <div class="header">
                        <h2 class="title"><i class="fas fa-plus"></i> Agregar categoria</h2>
                    </div>
                    <div class="inside">
                        {!! Form::open(['url' => '/category/addcategory']) !!}
                        <!--Nombre de la categoria-->
                        <label for="name" class="descriptionname">Nombre de la categoria</label>
                        <div class="input-group">
                            <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
                            {!! Form::text('name', null, ['class' => 'form-control']) !!}
                        </div>
                        
                        <!--Móudlo de la categoria-->
                        <label for="module" class="mtop16 descriptionname">Módulo</label>
                        <div class="input-group">
                            <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
                            {!! Form::select('module', getModulesArray(), 0, ['class' => 'custom-select']) !!}
                        </div>   
                        
                        <!--Nombre de la categoria-->
                        <label for="icon" class="descriptionname mtop16">Ícono</label>
                        <div class="input-group">
                            <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
                            {!! Form::text('icon', null, ['class' => 'form-control']) !!}
                        </div>

                        {!! Form::submit('Guardar', ['class'=> 'btn btn-success mtop16']) !!}
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection