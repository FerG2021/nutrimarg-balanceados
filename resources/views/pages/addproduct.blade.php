@extends('pages.master')

@section('title', 'Nuevo producto')

@section('breadcrumb')
    <li class="breadcrumb-item">
        <a href="{{ url('/addproduct') }}" class="nav-link"><i class="fas fa-box"></i> Nuevo producto</a>
    </li>  
@endsection

@section('content')
    <div class="container-fluid">
        <div class="panel shadow">
            <div class="header">
                <h2 class="title"><i class="fas fa-box"></i> Nuevo producto</h2>
            </div>

            <div class="inside">
                <!--Creacion de formulario para agregar productos-->               
                {!! Form::open(['url' => '/addproduct', 'files' => true]) !!}
                <div class="row">
                    <!--Codigo de producto-->  
                    <div class="col-md-6">
                        <label for="code" class="descriptionname">Codigo del producto</label>
                        <div class="input-group">
                            <span class="input-group-text" id="basic-addon1"><i class="fas fa-barcode"></i></span>
                            {!! Form::number('code', null, ['class' => 'form-control']) !!}
                        </div>                       
                    </div>
                    <!--Nombre del producto-->  
                    <div class="col-md-6">
                        <label for="name" class="descriptionname">Nombre del producto</label>
                        <div class="input-group">
                            <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
                            {!! Form::text('name', null, ['class' => 'form-control']) !!}
                        </div>                       
                    </div>                    
                    <!--Imagen destacada-->  
                    <!--<div class="col-md-2">
                        <label for="image" class="descriptionname">Imagen destacada</label>
                        <div class="input-group mb-3">
                            !! Form::file('img', ['class' => 'form-control', 'id' => 'inputGroupFile02', 'accept' => 'image/*']) !!}
                            <label class="input-group-text" for="inputGroupFile02">Buscar</label>
                        </div>                                         
                    </div>-->
                </div>

                <div class="mtop16">
                    <div class="row">  
                        <!--Tipo de venta-->  
                        <div class="col-md-2 mtop16">
                            <label for="tipesale" class="descriptionname">Tipo de venta</label> 
                            <div class="input-group">
                                <span class="input-group-text" id="basic-addon1"><i class="fas fa-shopping-bag"></i></span>  
                                {!! Form::select('tipesale',['0' => 'Por unidad', '1' => 'Por bolsa'], 0, ['class' => 'form-select']) !!}                        
                            </div>                               
                        </div>   
                        <!--Precio de compra-->  
                        <div class="col-md-2 mtop16">
                            <label for="pricebuy" class="descriptionname">Precio de compra</label>
                            <div class="input-group">
                                <span class="input-group-text" id="basic-addon1"><i class="fas fa-tag"></i></span>
                                {!! Form::number('pricebuy', null, ['class' => 'form-control', 'min' => '0.00', 'step' => 'any']) !!}
                            </div>                       
                        </div>   
                        <!--Precio de venta-->  
                        {{-- <div class="col-md-2 mtop16">
                            <label for="pricesale" class="descriptionname">Precio de venta</label>
                            <div class="input-group">
                                <span class="input-group-text" id="basic-addon1"><i class="fas fa-tag"></i></span>
                                {!! Form::number('pricesale', 0.00, ['class' => 'form-control', 'min' => '0.00', 'step' => 'any']) !!}
                            </div>                       
                        </div>   --}}
    
                        {{-- Porcentaje de precio de venta --}}
                        <div class="col-md-2 mtop16">
                            <label for="porcpricesale" class="descriptionname">Porcentaje para venta</label>
                            <div class="input-group">
                                <span class="input-group-text" id="basic-addon1"><i class="fas fa-percentage"></i></span>
                                {!! Form::number('porcpricesale', null, ['class' => 'form-control', 'min' => '0.00', 'step' => 'any']) !!}
                            </div>                       
                        </div>
    
    
                         <!--Precio por kilo-->  
                         <div class="col-md-3 mtop16">
                            <label for="pricekg" class="descriptionname">Precio por kilo</label>
                            <div class="input-group">
                                <span class="input-group-text" id="basic-addon1"><i class="fas fa-tag"></i></span>
                                {!! Form::number('pricekg', null, ['class' => 'form-control', 'min' => '0.00', 'step' => 'any']) !!}
                            </div>                       
                        </div>       
                        <!--Cantidad de kilos por bolsa-->  
                        <div class="col-md-3 mtop16">
                            <label for="kgbag" class="descriptionname">Cantidad de kilos por bolsa</label>
                            <div class="input-group">
                                <span class="input-group-text" id="basic-addon1"><i class="fas fa-tag"></i></span>
                                {!! Form::number('kgbag', null, ['class' => 'form-control', 'min' => '0.00', 'step' => 'any']) !!}
                            </div>                       
                        </div>                    
                    </div>
                </div>
 
                <div class="mtop16">
                    <div class="row">
                        <!--Cantidad de stock-->  
                        <div class="col-md-3 mtop16">
                            <label for="stock" class="descriptionname">Cantidad de stock</label>
                            <div class="input-group">
                                <span class="input-group-text" id="basic-addon1"><i class="fas fa-boxes"></i></i></span>
                                {!! Form::number('stock', null, ['class' => 'form-control']) !!}
                            </div>                       
                        </div>  
                        <!--Stock minimo-->  
                        <div class="col-md-3 mtop16">
                            <label for="stockmin" class="descriptionname">Cantidad de stock mínimo</label>
                            <div class="input-group">
                                <span class="input-group-text" id="basic-addon1"><i class="fas fa-exclamation-triangle"></i></span>
                                {!! Form::number('stockmin', null, ['class' => 'form-control']) !!}
                            </div>                       
                        </div>  
                        <!--Vencimiento del producto-->  
                        <div class="col-md-3 mtop16">
                            <label for="expiration" class="descriptionname">Vencimiento del producto</label>
                            <div class="input-group">
                                <span class="input-group-text" id="basic-addon1"><i class="fas fa-calendar-alt"></i></span>  
                                {!! Form::select('expiration',['0' => 'No', '1' => 'Si'], 0, ['class' => 'form-select']) !!} 
                            </div>
                        </div>  
                        <!--Fecha de vencimiento-->  
                        <div class="col-md-3 mtop16">
                            <label for="date" class="descriptionname">Fecha de vencimiento</label>
                            <div class="input-group">
                                <span class="input-group-text" id="basic-addon1"><i class="fas fa-calendar-alt"></i></span>
                                {!! Form::date('date', null, ['class' => 'form-control', 'step' => 'any']) !!}
                            </div>                       
                        </div>                             
                    </div>
                </div>

                <div class="row mtop16">
                    <div class="col-md-12">
                        {!! Form::submit('Guardar', ['class'=> 'btn btn-success mtop16']) !!}
                    </div>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
    
@endsection
    
