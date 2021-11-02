@extends('pages.master')

@section('title', 'Nueva salida de productos')

@section('breadcrumb')
    <li class="breadcrumb-item">
        <a href="{{ url('/movsproductsrest'.'/'.$p->id.'/rest') }}" class="nav-link"><i class="fas fa-arrow-left"></i> Nueva salida de producto</a>
    </li>  
@endsection

@section('content')
    <div class="row">
        <div class="col-md-7">
            <div class="container-fluid">
                <div class="panel shadow">
                    <div class="header">
                        <h2 class="title"><i class="fas fa-arrow-left"></i> Nueva salida de producto</h2>
                    </div>

                    <div class="inside">  
                        
                        <div class="btn-back">
                            <a href="/movsproductsrest" type="button" class="btn btn-primary"><i class="fas fa-arrow-left"></i> Atrás</a>
                        </div>
                
                        {{-- Creacion del formulario para el nuevo ingreso --}}
                        {!! Form::open(['url' => 'movsproductsrest/'.$p->id.'/rest', 'files' => true]) !!}
        
                        @if ($p->tipesale == 0)
                            {{-- PARA TIPO DE VENTA POR UNIDAD --}}
                            {{-- Nombre del producto --}}
                            <div class="mtop16">
                                <div class="row">
                                    <label for="name" class="descriptionname">Nombre del producto</label>
                                    <div class="input-group">
                                        <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard" aria-disabled="true" aria-readonly="true" disabled readonly></i></span>                                
                                        {!! Form::text('name', $p->name, ['class' => 'form-control', 'readonly']) !!}
                                    </div>         
                                </div>
                            </div>
            
                            {{-- Cantidad a vender --}}
                            <div class="mtop16">
                                <div class="row">
                                    <label for="stock" class="descriptionname">Cantidad a vender</label>
                                    <div class="input-group">
                                        <span class="input-group-text" id="basic-addon1"><i class="fas fa-sort-numeric-up"></i></span>
                                        {!! Form::number('stock', null, ['class' => 'form-control']) !!}
                                    </div>    
                                </div>
                            </div>
            
                            {!! Form::number('tipesale', $p->tipesale, ['class' => 'form-control, hidden']) !!}
                        @else
                            {{-- PARA TIPO DE VENTA POR BOLSA --}}
                            {{-- Nombre del producto --}}
                            <div class="mtop16">
                                <div class="row">
                                    <label for="name" class="descriptionname">Nombre del producto</label>
                                    <div class="input-group">
                                        <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard" aria-disabled="true" aria-readonly="true" disabled readonly></i></span>                                
                                        {!! Form::text('name', $p->name, ['class' => 'form-control', 'readonly']) !!}
                                    </div>         
                                </div>
                            </div>
                            
                            <div class="mtop16">
                                <div class="row mtop16">

                                    <div class="col-md-6">
                                        <label for="expiration" class="descriptionname">Forma de venta</label>
                                        <div class="input-group">
                                            <span class="input-group-text" id="basic-addon1"><i class="fas fa-calendar"></i></span>  
                                            {!! Form::select('tipe',['0' => 'Por bolsa', '1' => 'Por kilo', '2' => 'Por monto'], 0, ['class' => 'form-select']) !!} 
                                        </div>
                                    </div>
    
                                    {{-- Cantidad de bolsas vendidas --}}
                                    <div class="col-md-6">     
                                        <label for="name" class="descriptionname">Cantidad</label>
                                        <div class="input-group">
                                            <span class="input-group-text" id="basic-addon1"><i class="fas fa-sort-numeric-up" aria-disabled="true" aria-readonly="true" disabled readonly></i></span>                                
                                            {!! Form::number('stock', null, ['class' => 'form-control']) !!}
                                        </div>     
                                    </div>  
                                    
                                    {{-- Kilos vendidos
                                    <div class="col-md-4">
                                        <label for="name" class="descriptionname">Kilos vendidos</label>
                                        <div class="input-group">
                                            <span class="input-group-text" id="basic-addon1"><i class="fas fa-balance-scale"></i></span>                                
                                            {!! Form::text('kgsale', null, ['class' => 'form-control']) !!}
                                        </div>   
                                    </div>
    
                                    {{-- Monto vendido --}}
                                    {{-- <div class="col-md-4">
                                        <label for="name" class="descriptionname">Monto vendido</label>
                                        <div class="input-group">
                                            <span class="input-group-text" id="basic-addon1"><i class="fas fa-dollar-sign"></i></span>                                
                                            {!! Form::text('amountsale', null, ['class' => 'form-control']) !!}
                                        </div>   
                                    </div> --}}
    
                                    {!! Form::number('tipesale', $p->tipesale, ['class' => 'form-control, hidden']) !!}
                                </div>
                            </div>
                        @endif
        
                        {{-- Boton confirmar compra --}}
                        <div class="mtop16">
                            <div class="row">
                                <div class="col-md-12 mtop16">
                                    {!! Form::submit('Confirmar venta', ['class'=> 'btn btn-success']) !!}
                                </div>
                            </div>
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>    
        </div>



        {{-- INFORMACION DE LA NUEVA SALIDA --}}
        <div class="col-md-5">
            <div class="container-fluid">
                <div class="panel shadow">
                    <div class="header">
                        <h2 class="title"><i class="fas fa-info-circle"></i> Información del producto</h2>
                    </div>
                    
                    <div class="inside">
                        {{-- Nombre del producto --}}
                        <div class="row">
                            <div class="col-md-12">
                                <label for="name" class="descriptionname">Nombre del producto</label>
                                <input class="form-control" type="text" value="{{ $p->name }}" aria-label="Disabled input example" disabled readonly>
                            </div>
                        </div>
                        <div class="row mtop16">
                            {{-- Precio de compra --}}
                            <div class="col-md-4">
                                <label for="name" class="descriptionname">$ de compra</label>
                                <input class="form-control" type="text" value="{{ $p->pricebuy }}" aria-label="Disabled input example" disabled readonly>
                            </div>
                            {{-- Precio de venta --}}
                            <div class="col-md-4">
                                <label for="name" class="descriptionname">$ de venta</label>
                                <input class="form-control" type="text" value="{{ $p->pricesale }}" aria-label="Disabled input example" disabled readonly>
                            </div>
                            {{-- Precio por kilo --}}
                            <div class="col-md-4">
                                <label for="name" class="descriptionname">$ por kilo</label>
                                @if ($p->pricekg == 0)
                                    <input class="form-control" type="text" value="---" aria-label="Disabled input example" disabled readonly>
                                @else
                                <input class="form-control" type="text" value="{{ $p->pricekg }}" aria-label="Disabled input example" disabled readonly> 
                                @endif
                            </div>                            
                        </div>
                        <div class="row mtop16">
                            {{-- Kilos por bolsa --}}
                            <div class="col-md-4">
                                <label for="name" class="descriptionname">Kg / bolsa</label>
                                @if ($p->kgbag == 0)
                                    <input class="form-control" type="text" value="---" aria-label="Disabled input example" disabled readonly>
                                @else
                                <input class="form-control" type="text" value="{{ $p->kgbag }}" aria-label="Disabled input example" disabled readonly>
                                @endif
                            </div>
                            {{-- Cantidad de stock --}}
                            <div class="col-md-4">
                                <label for="name" class="descriptionname">Stock</label>
                                <input class="form-control" type="text" value="{{ $p->stock }}" aria-label="Disabled input example" disabled readonly>
                            </div>
                            {{-- Fecha de vencimiento --}}
                            <div class="col-md-4">
                                <label for="name" class="descriptionname">Vencimiento</label>
                                @if ($p->date == '2001-01-01')
                                    <input class="form-control" type="text" value="---" aria-label="Disabled input example" disabled readonly>
                                @else
                                <input class="form-control" type="text" value="{{ $p->date}}" aria-label="Disabled input example" disabled readonly>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>   
        </div>
    </div>
@endsection