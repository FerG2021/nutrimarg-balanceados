@extends('pages.master')

@section('title', 'Productos en stock mínimo')

@section('breadcrumb')
    <li class="breadcrumb-item">
        <a href="{{ url('/budget.newbudget') }}" class="nav-link"><i class="fas fa-plus-circle"></i> Agregar producto</a>
    </li>  
@endsection

@section('content')

    <div class="row">
        <div id="liveAlertPlaceholder"></div>
        
            <div class="container-fluid">
                <div class="panel shadow">
                    <div class="header">
                        <h2 class="title"><i class="fas fa-plus-circle"></i> Agregar producto</h2>
                    </div>       
            
                   {{-- AGREGAR PRODUCTO AL PRESUPUESTO --}}
                   <div class="inside">

                        <div class="btn-back">
                            <a href="/budget/{{$id}}/addnewbudget" type="button" class="btn btn-primary"><i class="fas fa-arrow-left"></i> Atrás</a>
                        </div>
                        <div class="mtop16">
                            <h5 class="title descriptionname">Añadir producto al presupuesto N: {{$id}}</h5>
                        </div>
                        <form action="{{ url('/budget.addnewbudgetproduct') }}" id="formaddproductsbudget" method="POST">
                            @csrf
                            {{-- Nombre del producto --}}
                            <div class="row">
                                <div class="col-md-12">
                                    <label for="nameSelectForm" class="descriptionname">Nombre del producto</label>
                                    <div class="input-group">
                                        <span class="input-group-text" id="basic-addon1"><i class="fas fa-box"></i></span>
                                        <select name="nameSelectForm" id="nameSelectForm" class="form-control" onchange="selectProduct(this);">
                                            <option selected>Seleccione un producto</option>
                                            @foreach ($products as $product)
                                                <option value="{{ $product->name }}" data-pricesale="{{ $product->pricesale }}">{{ $product->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="mtop16">
                                <div class="row">
                                    {{-- Precio de venta --}}
                                    <div class="col-md-6">
                                        <label for="pricesaleForm" class="descriptionname">Precio</label>
                                        <div class="input-group">
                                            <span class="input-group-text" id="basic-addon1"><i class="fas fa-dollar-sign"></i></span>
                                            <input type="number" id="pricesaleForm" name="pricesaleForm" class="form-control" value="" readonly>
                                        </div>  
                                    </div>
                                    {{-- Cantidad --}}
                                    <div class="col-md-6">
                                        <label for="cantBudgetForm" class="descriptionname">Cantidad</label>
                                        <div class="input-group">
                                            <span class="input-group-text" id="basic-addon1"><i class="fas fa-shopping-cart"></i></span>
                                            <input type="number" id="cantBudgetForm" name="cantBudgetForm" class="form-control" value="">
                                        </div>
                                        
                                    </div>
                                    {{-- ID de presupuesto --}}
                                    <div>
                                        <input type="hidden" id="idBudget" name="idBudget" value="{{$id}}">
                                    </div>
                                </div>
                            </div>



                            <button class="btn btn-success mtop16"><i class="fas fa-plus"></i> Añadir producto</button>
                        </form>

                                               
                   </div>

                </div>
            </div>
        

        

@endsection
{{-- <a href="{{ url('/budget.getpdf') }}" target="_blank">Imprimir</a>    --}}

