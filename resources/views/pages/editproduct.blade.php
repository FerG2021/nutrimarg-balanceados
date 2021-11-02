@extends('pages.master')

@section('title', 'Editar producto')

@section('breadcrumb')
    <li class="breadcrumb-item">
        <a href="" class="nav-link"><i class="fas fa-edit"></i> Editar producto</a>
    </li>  
@endsection

@section('content')
    <div class="container-fluid">
        <div class="panel shadow">
            <div class="header">
                <h2 class="title"><i class="fas fa-edit"></i> Editar producto</h2>
            </div>

            <div class="inside">
                <!--Creacion de formulario para editar productos-->               
                {!! Form::open(['url' => 'product/'.$p->id.'/edit', 'files' => true]) !!}
                <div class="row">
                    <!--Codigo de producto-->  
                    <!--<div class="col-md-6">
                        <label for="code" class="descriptionname">Codigo del producto</label>
                        <div class="input-group">
                            <span class="input-group-text" id="basic-addon1"><i class="fas fa-barcode"></i></span>
                            !! Form::number('code', $p->code, ['class' => 'form-control']) !!}
                        </div>                       
                    </div>-->
                    <!--Nombre del producto-->  
                    <div class="col-md-6">
                        <label for="name" class="descriptionname">Nombre del producto</label>
                        <div class="input-group">
                            <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
                            {!! Form::text('name', $p->name, ['class' => 'form-control']) !!}
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
                                <span class="input-group-text" id="basic-addon1"><i class="fas fa-calendar"></i></span>  
                                {{-- {!! Form::select('tipesale',['0' => 'Por unidad', '1' => 'Por bolsa'], $p->tipesale, ['class' => 'form-select', 'form-select', 'onchange' => 'selectTipeSale(this)']) !!}                                  --}}
                                {!! Form::select('tipesale',['0' => 'Por unidad', '1' => 'Por bolsa'], $p->tipesale, ['class' => 'form-select', 'form-select']) !!}  
                            </div>                               
                        </div>                    
                        <!--Precio de compra-->  
                        <div class="col-md-2 mtop16">
                            <label for="pricebuy" class="descriptionname">Precio de compra</label>
                            <div class="input-group">
                                <span class="input-group-text" id="basic-addon1"><i class="fas fa-tag"></i></span>
                                {!! Form::number('pricebuy', $p->pricebuy, ['class' => 'form-control', 'min' => '0.00', 'step' => 'any']) !!}
                            </div>                       
                        </div> 
                        {{-- Porcentaje para compra    --}}
                        <div class="col-md-2 mtop16">
                            <label for="pricebuy" class="descriptionname">Porcentaje para venta</label>
                            <div class="input-group">
                                <span class="input-group-text" id="basic-addon1"><i class="fas fa-tag"></i></span>
                                {!! Form::number('porcpricesale', $p->porcpricesale , ['class' => 'form-control', 'min' => '0.00', 'step' => 'any']) !!}
                            </div>                       
                        </div>     
                        <!--Precio de venta-->  
                        {{-- <div class="col-md-2 mtop16">
                            <label for="pricesale" class="descriptionname">Precio de venta</label>
                            <div class="input-group">
                                <span class="input-group-text" id="basic-addon1"><i class="fas fa-tag" disabled readonly></i></span>
                                {!! Form::number('pricesale', $p->pricesale, ['class' => 'form-control', 'min' => '0.00', 'step' => 'any']) !!}
                            </div>                       
                        </div>                     --}}
                        <div class="col-md-2 mtop16">
                            <label for="pricesale" class="descriptionname">Precio de venta</label>
                            <div class="input-group">
                                <input type="text" name="" id="" class="form-control" value="{{$p->pricesale}}" aria-label="Disabled input example" disabled readonly>
                            </div>                       
                        </div>            
                        <!--Precio por kilo-->  
                         <div class="col-md-2 mtop16">
                            <label for="pricekg" class="descriptionname">Precio por kilo</label>
                            <div class="input-group">
                                <span class="input-group-text" id="basic-addon1"><i class="fas fa-tag"></i></span>
                                {!! Form::number('pricekg', $p->pricekg, ['class' => 'form-control', 'min' => '0.00', 'step' => 'any']) !!}
                            </div>                       
                        </div>       
                        <!--Cantidad de kilos por bolsa-->  
                        <div class="col-md-2 mtop16">
                            <label for="kgbag" class="descriptionname">Cantidad kg / bolsa</label>
                            <div class="input-group">
                                <span class="input-group-text" id="basic-addon1"><i class="fas fa-tag"></i></span>
                                {!! Form::number('kgbag', $p->kgbag, ['class' => 'form-control', 'min' => '0.00', 'step' => 'any']) !!}
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
                                {!! Form::number('stock', $p->stock, ['class' => 'form-control']) !!}
                            </div>                       
                        </div>  
                        <!--Stock minimo-->  
                        <div class="col-md-3 mtop16">
                            <label for="stockmin" class="descriptionname">Cantidad de stock mínimo</label>
                            <div class="input-group">
                                <span class="input-group-text" id="basic-addon1"><i class="fas fa-exclamation-triangle"></i></span>
                                {!! Form::number('stockmin', $p->stockmin, ['class' => 'form-control']) !!}
                            </div>                       
                        </div>  
                        <!--Vencimiento del producto-->  
                        <div class="col-md-3 mtop16">
                            <label for="expiration" class="descriptionname">Vencimiento del producto</label>
                            <div class="input-group">
                                <span class="input-group-text" id="basic-addon1"><i class="fas fa-calendar"></i></span>  
                                {!! Form::select('expiration',['0' => 'No', '1' => 'Si'], $p->expiration, ['class' => 'form-select']) !!} 
                            </div>
                        </div>  
                        <!--Fecha de vencimiento-->  
                        <div class="col-md-3 mtop16">
                            <label for="date" class="descriptionname">Fecha de vencimiento</label>
                            @if ($p->date == '2001-01-01')
                                <div class="input-group">
                                    <span class="input-group-text" id="basic-addon1"><i class="fas fa-calendar"></i></span>
                                    {!! Form::date('date', null, ['class' => 'form-control', 'step' => 'any']) !!}
                                </div>     
                            @else
                            <div class="input-group">
                                <span class="input-group-text" id="basic-addon1"><i class="fas fa-calendar"></i></span>
                                {!! Form::date('date', $p->date, ['class' => 'form-control', 'step' => 'any']) !!}
                            </div>     
                            @endif
                        </div>

                        {{-- <div class="col-md-3 mtop16">
                            <label for="date" class="descriptionname">Fecha de vencimiento</label>
                            <div class="input-group">
                                <span class="input-group-text" id="basic-addon1"><i class="fas fa-calendar"></i></span>
                                {!! Form::date('date', $p->date, ['class' => 'form-control', 'step' => 'any']) !!}
                            </div>                       
                        </div>      --}}

                    </div>
                </div>

                <div class="mtop16">
                    <div class="row">
                        <div class="col-md-12 mtop16">
                            {!! Form::submit('Guardar', ['class'=> 'btn btn-success']) !!}
                        </div>
                    </div>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
    
@endsection
    
