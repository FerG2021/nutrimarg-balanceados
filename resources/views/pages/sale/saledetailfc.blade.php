@extends('pages.master')

@section('title', 'Detalle nueva venta')

@section('breadcrumb')
    <li class="breadcrumb-item">
        <a href="{{ url('/budget.newbudget') }}" class="nav-link"><i class="fas fa-plus-circle"></i> Nueva venta (Firma comercial)</a>
    </li>  
@endsection

@section('content')

<div class="row">
    <div id="liveAlertPlaceholder"></div>
    <div class="col-md-12">
        <div class="container-fluid">
            <div class="panel shadow">
                <div class="header">
                    <h2 class="title"><i class="fas fa-clipboard-list"></i> Nueva venta (Firma comercial) - Venta N: {{$id}}</h2>
                </div>       
        
               {{-- AGREGAR PRODUCTO AL PRESUPUESTO --}}
               <div class="inside">

                    <div class="btn-add">
                        {{-- <a href="/budget/{{$id}}/addnewbudgetproduct" class="btn btn-success"><i class="fas fa-plus"></i> Agregar producto</a>  --}}
                        <div class="client-detail">
                            <div class="col-md-6 descriptionname">
                                @foreach ($clients as $client)
                                    <label for="nameClient">Nombre del cliente</label>
                                    <div class="input-group">
                                        <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
                                        <input type="text" name="nameClient" id="nameClient" class="form-control" readonly value="{{$client->nameFirm}}">
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <div class="btn-group mtop10" role="group" aria-label="Basic mixed styles example">
                            {{-- Agregar producto --}}
                            <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalAddProduct">
                                Agregar producto
                            </button>
                            {{-- Nuevo producto --}}
                            {{-- <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalAddNewProduct">
                                Agregar nuevo producto
                            </button>   --}}
                            {{-- Consultar producto --}}
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalConsultProduct">
                                Consultar producto
                            </button>    
                        </div>
                    </div>                        

                    <div class="table mtop10 descriptionname">
                        
                            <table class="table responsive table-striped table-dark descriptionname table-bordered border-white display" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>Cantidad</th>
                                        <th>Bolsa</th>
                                        <th>Kilos</th>
                                        <th>Monto</th>
                                        <th>Descripción</th>
                                        <th>Precio de compra</th>
                                        <th>Subtotal</th>
                                        <th></th>
                                        
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($saleproducts as $saleproduct)
                                        <tr>
                                            <td>{{ $saleproduct->cantProduct }}</td>
                                            <td>{{ $saleproduct->cantBagSale }}</td>
                                            <td>{{ $saleproduct->cantKgSale }}</td>
                                            <td>{{ $saleproduct->cantMountSale }}</td>
                                            <td>{{ $saleproduct->name }}</td>
                                            <td>{{ $saleproduct->priceProductSale }}</td>
                                            <td>{{ $saleproduct->subtotal }}</td>
                                            <td>
                                                <a href="/sale/{{$saleproduct->id}}/deletesaleproductcf" class="btn btn-danger" id="btnquitar" data-toggle="tooltip" data-placement="top" title="Quitar"><i class="fas fa-trash-alt"></i></a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                        <th><input id="totalBudget3" name="totalBudget3" type="hidden" value="" readonly></th>
                                        <th></th>
                                        <th>TOTAL:</th>
                                        <th><input id="totalBudget6" name="totalBudget6" type="decimal" value="" readonly></th>
                                        <th></th>    
                                    </tr>
                                </tfoot>
                            </table>
                    </div>

                        <form action="{{ url('/sale/addnewsaleconfirmfc') }}" id="formpricebudget" method="POST">
                        @csrf
                            <input type="hidden" id="dateSale" name="dateSale" value="{{$sale->dateSale}}">
                            <input type="hidden" id="totalBudgetInput6" name="totalBudgetInput6" value="">
                            <input type="hidden" id="totalBudgetInput3" name="totalBudgetInput3" value="">
                            <input type="hidden" id="idSaleInput" name="idSaleInput" value="{{$id}}">
                            @foreach ($clients as $client)
                                <input type="hidden" id="idClientInput" name="idClientInput" value="{{$client->id}}">
                                <input type="hidden" id="dniClient" name="dniClient" value="{{$client->cuit}}">
                                <input type="hidden" id="nameClientInput" name="nameClientInput" value="{{$client->socialReasonFirm}}">
                                <input type="hidden" id="lastNameClientInput" name="lastNameClientInput" value="{{$client->nameFirm}}">
                            @endforeach
                            <div class="row">
                                <div class="col-md-3">
                                    <label for="totalPayClient" class="descriptionname">Total pagado por el cliente</label>
                                    <div class="input-group">
                                        <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
                                        <input type="decimal" id="totalPayClient" name="totalPayClient" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="btn">
                                <button class="btn btn-success">Guardar venta</button>
                        </form>
                                <a href="/sale/{{$id}}/cancelnewsalefc" class="btn btn-danger">Cancelar venta</a>    
                            </div>
                      
                </div>

            </div>
        </div>
    </div>


    <!-- Modal agregar producto al presupuesto-->
    <div class="modal fade" id="modalAddProduct" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title descriptionname" id="staticBackdropLabel">Agregar producto a la venta</h5>
                <button type="reset" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="/sale/{{$id}}/addnewsaleproductfc" method="POST" id="modalAddProduct">
                @csrf
                    <div class="row">
                        {{-- ID de producto en tabla productos en stock --}}
                        <input type="hidden" id="idProduct" name="idProduct" value="">
                        {{-- Nombre del producto --}}
                        <div class="col-md-12">
                            <label for="nameProduct" class="descriptionname">Nombre del producto</label>
                            <div class="input-group">
                                <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
                                <select name="nameProduct" id="nameProduct" class="form-select" onchange="selectProductSale(this);">
                                    <option selected>Seleccione un producto</option>
                                    @foreach ($products as $product)
                                        <option value="{{$product->name}}" data-id="{{$product->id}}" data-pricesale="{{$product->pricesale}}" data-tipesale="{{$product->tipesale}}" data-pricekg="{{$product->pricekg}}" data-kgbag="{{$product->kgbag}}">{{$product->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>                   
                    </div>
                    <div class="row mtop16">
                        {{-- Kilos por bolsa --}}
                        <div class="col-md-6">
                            <label for="kgbag" class="descriptionname">Kilos por bolsa</label>
                            <div class="input-group">
                                <span class="input-group-text" id="basic-addon1"><i class="fas fa-dollar-sign"></i></span>
                                <input type="number" id="kgbag" name="kgbag" class="form-control" readonly>
                            </div>
                        </div>
                        {{-- Precio por kilo --}}
                        <div class="col-md-6">
                            <label for="pricekg" class="descriptionname">Precio por kilo</label>
                            <div class="input-group">
                                <span class="input-group-text" id="basic-addon1"><i class="fas fa-dollar-sign"></i></span>
                                <input type="decimal" id="pricekg" name="pricekg" class="form-control" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="row mtop16">
                        {{-- Precio de venta --}}
                        <div class="col-md-4">
                            <label for="pricesale" class="descriptionname">Precio de venta</label>
                            <div class="input-group">
                                <span class="input-group-text" id="basic-addon1"><i class="fas fa-dollar-sign"></i></span>
                                <input type="number" id="pricesale" name="pricesale" class="form-control" readonly>
                            </div>
                        </div>
                        {{-- Forma de venta por bolsa --}}
                        <div class="col-md-4">
                            <label for="typesalebag" class="descriptionname">Forma de venta</label>
                            <div class="input-group">
                                <span class="input-group-text" id="basic-addon1"><i class="fas fa-sort-numeric-up"></i></span>
                                <select name="typesalebag" id="typesalebag" class="form-select">
                                    <option disabled>-- Forma de venta --</option>
                                    <option value="1">Por bolsa</option>
                                    <option value="2">Por kilo</option>
                                    <option value="3">Por monto</option>
                                    <option value="4" selected>Por unidad</option>
                                </select>
                            </div>
                        </div>
                        {{-- Cantidad a vender --}}
                        <div class="col-md-4">
                            <label for="cant" class="descriptionname">Cantidad a vender</label>
                            <div class="input-group">
                                <span class="input-group-text" id="basic-addon1"><i class="fas fa-sort-numeric-up"></i></span>
                                <input type="number" id="cant" name="cant" class="form-control">
                            </div>
                        </div>                        
                        {{-- Porcentaje para la venta --}}
                        {{-- <div class="col-md-4">
                            <label for="porcsale" class="descriptionname">Porcentaje para venta</label>
                            <div class="input-group">
                                <span class="input-group-text" id="basic-addon1"><i class="fas fa-percentage"></i></span>
                                <input type="decimal" id="porcsale" name="porcsale" class="form-control">
                            </div>
                        </div> --}}
                        {{-- ID de venta --}}
                        <input type="hidden" id="buyId" name="buyId" class="form-control" value="{{$id}}">

                        {{-- tipo de venta --}}
                        <input type="hidden" id="tipesaleinput" name="tipesaleinput" value="">

                        
                    </div>
                
            </div>
            <div class="modal-footer">
                <button type="reset" class="btn btn-danger" data-bs-dismiss="modal">Cerrar</button>
                <button type="submit" class="btn btn-success">Añadir</button>
            </form>
            </div>
        </div>
        </div>
    </div>
    
    <!-- Modal nuevo producto-->
    <div class="modal fade" id="modalAddNewProduct" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title descriptionname" id="staticBackdropLabel">Agregar nuevo producto</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{url('/buy/addnewproduct')}}" method="POST">
                @csrf    
                    <div class="row">
                        {{-- Código del producto --}}
                        <div class="col-md-6">
                            <label for="code" class="descriptionname">Código del producto</label>
                            <div class="input-group">
                                <span class="input-group-text" id="basic-addon1"><i class="fas fa-barcode"></i></span>
                                <input type="number" id="code" name="code" class="form-control">
                            </div>
                        </div>
                        {{-- Nombre del producto --}}
                        <div class="col-md-6">
                            <label for="name" class="descriptionname">Nombre del producto</label>
                            <div class="input-group">
                                <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
                                <input type="text" id="name" name="name" class="form-control">
                            </div>
                        </div>
                    </div> 
                    <div class="mtop16">
                        <div class="row">  
                            <!--Tipo de venta-->  
                            <div class="col-md-2 mtop16">
                                <label for="tipesale" class="descriptionname">Tipo de venta</label> 
                                <div class="input-group">
                                    <span class="input-group-text" id="basic-addon1"><i class="fas fa-shopping-bag"></i></span>  
                                    <select name="tipesale" id="tipesale" class="form-select">
                                        <option value="0">Por unidad</option>
                                        <option value="1">Por bolsa</option>
                                    </select>
                                </div>                               
                            </div>   
                            <!--Precio de compra-->  
                            <div class="col-md-2 mtop16">
                                <label for="pricebuy" class="descriptionname">Precio de compra</label>
                                <div class="input-group">
                                    <span class="input-group-text" id="basic-addon1"><i class="fas fa-tag"></i></span>
                                    <input type="decimal" id="pricebuy" name="pricebuy" class="form-control" value="">
                                </div>                       
                            </div>       
                            {{-- Porcentaje de precio de venta --}}
                            <div class="col-md-2 mtop16">
                                <label for="porcpricesale" class="descriptionname">Porcentaje para venta</label>
                                <div class="input-group">
                                    <span class="input-group-text" id="basic-addon1"><i class="fas fa-percentage"></i></span>
                                    <input type="decimal" id="porcpricesale" name="porcpricesale" class="form-control" value="">
                                </div>                       
                            </div>
                            <!--Precio por kilo-->  
                             <div class="col-md-3 mtop16">
                                <label for="pricekg" class="descriptionname">Precio por kilo</label>
                                <div class="input-group">
                                    <span class="input-group-text" id="basic-addon1"><i class="fas fa-tag"></i></span>
                                    <input type="decimal" id="pricekg" name="pricekg" class="form-control" value="">
                                </div>                       
                            </div>       
                            <!--Cantidad de kilos por bolsa-->  
                            <div class="col-md-3 mtop16">
                                <label for="kgbag" class="descriptionname">Cantidad de kilos por bolsa</label>
                                <div class="input-group">
                                    <span class="input-group-text" id="basic-addon1"><i class="fas fa-tag"></i></span>
                                    <input type="number" id="kgbag" name="kgbag" class="form-control" value="">
                                </div>                       
                            </div>                    
                        </div>
                    </div>
     
                    <div class="mtop16">
                        <div class="row">
                            <!--Cantidad de stock-->  
                            {{-- <div class="col-md-3 mtop16">
                                <label for="stock" class="descriptionname">Cantidad de stock</label>
                                <div class="input-group">
                                    <span class="input-group-text" id="basic-addon1"><i class="fas fa-boxes"></i></i></span>
                                    <input type="decimal" id="stock" name="stock" class="form-control" value="">
                                </div>                       
                            </div>   --}}
                            <!--Stock minimo-->  
                            <div class="col-md-6 mtop16">
                                <label for="stockmin" class="descriptionname">Cantidad de stock mínimo</label>
                                <div class="input-group">
                                    <span class="input-group-text" id="basic-addon1"><i class="fas fa-exclamation-triangle"></i></span>
                                    <input type="decimal" id="stockmin" name="stockmin" class="form-control" value="">
                                </div>                       
                            </div>  
                            <!--Vencimiento del producto-->  
                            <div class="col-md-3 mtop16">
                                <label for="expiration" class="descriptionname">Vencimiento del producto</label>
                                <div class="input-group">
                                    <span class="input-group-text" id="basic-addon1"><i class="fas fa-calendar"></i></span>                 
                                    <select name="expiration" id="expiration" class="form-select">
                                        <option value="0">No</option>
                                        <option value="1">Si</option>
                                    </select>
                                </div>
                            </div>  
                            <!--Fecha de vencimiento-->  
                            <div class="col-md-3 mtop16">
                                <label for="date" class="descriptionname">Fecha de vencimiento</label>
                                <div class="input-group">
                                    <span class="input-group-text" id="basic-addon1"><i class="fas fa-calendar"></i></span>
                                    <input type="date" id="date" name="date" class="form-control" value="">
                                </div>                       
                            </div>                             
                        </div>
                    </div>
    
                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cerrar</button>
                <button type="submit" class="btn btn-success">Guardar</button>
            </form>
            </div>
        </div>
        </div>
    </div>

    <!-- Modal consulta de producto-->
    <div class="modal fade" id="modalConsultProduct" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title descriptionname" id="exampleModalLabel"> Consultar producto</h5>
            <button type="button" class="btn-close descriptionname" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <div class="panel shadow">
                        {{-- <div class="header">
                            <h2 class="title"><i class="fas fa-search"></i> Consultar producto</h2>
                        </div>            --}}
                        
                        <div class="table mtop16 descriptionname">
                            <div class="inside-consult">
                                <table id="" class="table responsive table-striped table-dark descriptionname table-bordered border-white display" style="width:100%">
                                    <thead>
                                        <tr>
                                            <td class="descriptionname">Código</td>
                                            <td class="descriptionname">Descripción</td>
                                            <td class="descriptionname">Stock</td>
                                            <td class="descriptionname">Precio de venta</td>                               
                                        </tr>
                                    </thead>
                                    <tbody>                                
                                        @foreach ($productconsults as $p)
                                            <tr>
                                                <td class="descriptionname" id="name">{{ $p->code }}</td>
                                                <td class="descriptionname" id="name">{{ $p->name }}</td>
                                                <td class="descriptionname" id="stock">{{ $p->stock }}</td>
                                                <td class="descriptionname" id="pricesale">{{ $p->pricesale }}</td>                                     
                                            </tr>
                                        @endforeach                                
                                    </tbody>
                                    <tfoot>                                 
                                    </tfoot>
                                </table>                                  
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div> 
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cerrar</button>                
            </div>               
        </div>
        </div>
    </div>
</div>

        <!-- Modal para nuevo producto y modificar producto-->
        

@endsection
{{-- <a href="{{ url('/budget.getpdf') }}" target="_blank">Imprimir</a>    --}}

