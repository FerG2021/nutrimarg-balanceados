@extends('pages.master')

@section('title', 'Nuevo ingreso de productos')

@section('breadcrumb')
    <li class="breadcrumb-item">
        <a href="{{ url('/movsproductsadd'.'/'.$p->id.'/add') }}" class="nav-link"><i class="fas fa-plus"></i> Nuevo ingreso de producto</a>
    </li>  
@endsection

@section('content')
    <div class="row">
        <div class="col-md-7">
            <div class="container-fluid">
                <div class="panel shadow">
                    <div class="header">
                        <h2 class="title"><i class="fas fa-plus"></i> Nuevo ingreso de producto</h2>
                    </div>

                    <div class="inside">           
                
                        {{-- Creacion del formulario para el nuevo ingreso --}}
                        {!! Form::open(['url' => 'movsproductsadd/'.$p->id.'/add', 'files' => true]) !!}
        
                        {{-- Nombre del producto --}}
                        <div class="row">
                            <label for="name" class="descriptionname">Nombre del producto</label>
                            <div class="input-group">
                                <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard" aria-disabled="true" aria-readonly="true"></i></span>                                
                                {!! Form::text('name', $p->name, ['class' => 'form-control', 'readonly']) !!}
                            </div>         
                        </div>
        
                        {{-- Cantidad a comprar --}}
                        <div class="row mtop16">
                            <label for="stock" class="descriptionname">Cantidad a comprar</label>
                            <div class="input-group">
                                <span class="input-group-text" id="basic-addon1"><i class="fas fa-boxes"></i></i></span>
                                {!! Form::number('stock', null, ['class' => 'form-control']) !!}
                            </div>    
                        </div>
        
                        {{-- Precio de compra --}}
                        <div class="row mtop16">
                            <div class="col-md-6">
                                <label for="pricebuy" class="descriptionname">Precio de compra</label>
                                <div class="input-group">
                                    <span class="input-group-text" id="basic-addon1"><i class="fas fa-tag"></i></span>
                                    {!! Form::number('pricebuy', null, ['class' => 'form-control', 'min' => '0.00', 'step' => 'any']) !!}
                                </div>     
                            </div>   
                            <div class="col-md-6">
                                <label for="pricebuy" class="descriptionname">Porcentaje para venta</label>
                                <div class="input-group">
                                    <span class="input-group-text" id="basic-addon1"><i class="fas fa-percentage"></i></span>
                                    {!! Form::number('porcpricesale', null, ['class' => 'form-control', 'min' => '0.00', 'step' => 'any']) !!}
                                </div>     
                            </div>   
                        </div>
        
                        {{-- Boton confirmar compra --}}
                        <div class="mtop16">
                            <div class="row">
                                <div class="col-md-12 mtop16">
                                    {!! Form::submit('Confirmar compra', ['class'=> 'btn btn-success']) !!}
                                </div>
                            </div>
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>    
        </div>
        {{-- INFORMACION DEL NUEVO INGRESO --}}
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