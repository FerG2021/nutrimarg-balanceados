@extends('pages.master')

@section('title', 'Agregar productos presupuesto')

@section('breadcrumb')
    <li class="breadcrumb-item">
        <a href="{{ url('/budget.newbudget') }}" class="nav-link"><i class="fas fa-plus-circle"></i> Nuevo presupuesto</a>
    </li>  
@endsection

@section('content')

    <div class="row">
        <div id="liveAlertPlaceholder"></div>
        <div class="col-md-12">
            <div class="container-fluid">
                <div class="panel shadow">
                    <div class="header">
                        <h2 class="title"><i class="fas fa-clipboard-list"></i> Nuevo presupuesto - Presupuesto N: {{$id}}</h2>
                    </div>       
            
                   {{-- AGREGAR PRODUCTO AL PRESUPUESTO --}}
                   <div class="inside">

                        <div class="btn-add">
                            <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                                {{-- <a href="/budget/{{$id}}/addnewbudgetproduct" class="btn btn-success"><i class="fas fa-plus"></i> Agregar producto</a>     --}}
                                <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                                    Agregar producto
                                </button>               
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                    {{-- <i class="fas fa-search"></i> Consultar producto --}}
                                    Consultar producto
                                </button>    
                            </div>
                        </div>                        

                        <div class="table mtop16 descriptionname">
                            
                                <table class="table responsive table-striped table-dark descriptionname table-bordered border-white display" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>Cantidad</th>
                                            <th>Descripción</th>
                                            <th>Precio</th>
                                            <th>Subtotal</th>
                                            <th></th>
                                            
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($budgetproducts as $budgetproduct)
                                            <tr>
                                                <td>{{ $budgetproduct->cantProduct }}</td>
                                                <td>{{ $budgetproduct->name }}</td>
                                                <td>{{ $budgetproduct->priceProduct }}</td>
                                                <td>{{ $budgetproduct->subtotal }}</td>
                                                <td>
                                                    <a href="/budget/{{$budgetproduct->id}}/deletebudgetproduct" class="btn btn-danger">Quitar</a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th></th>
                                            <th></th>
                                            <th>TOTAL:</th>
                                            <th><input id="totalBudget3" name="totalBudget3" type="decimal" value="" readonly></th>
                                            <th></th>
                                        </tr>
                                    </tfoot>
                                </table>
                        </div>

                            <form action="{{ url('/budget.addnewbudget') }}" id="formpricebudget" method="POST">
                                @csrf
                                <input type="hidden" id="totalBudgetInput3" name="totalBudgetInput3" value="">
                                <input type="hidden" id="idInput" name="idInput" value="{{$id}}">
                                <button class="btn btn-success"><i class="far fa-check-circle"></i> Guardar presupuesto</button>
                            </form>

                            
                   </div>

                </div>
            </div>
        </div>


        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title descriptionname" id="exampleModalLabel"><i class="fas fa-search"></i> Consultar producto</h5>
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
                                                <td class="descriptionname">Descripción</td>
                                                <td class="descriptionname">Stock</td>
                                                <td class="descriptionname">Precio</td>                               
                                            </tr>
                                        </thead>
                                        <tbody>                                
                                            @foreach ($products as $p)
                                                <tr>
                                                    
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
            </div>
            </div>
        </div>
    </div>
        {{-- <div class="col-md-6">
            <div class="container-fluid">
                <div class="panel shadow">
                    <div class="header">
                        <h2 class="title"><i class="fas fa-search"></i> Consultar producto</h2>
                    </div>           
                    
                    <div class="inside-consult mtop16">
                        <table id="" class="table responsive table-striped table-dark descriptionname table-bordered border-white display mtop16" style="width:100%">
                            <thead>
                                <tr>
                                    <td class="descriptionname">Descripción</td>
                                    <td class="descriptionname">Stock</td>
                                    <td class="descriptionname">Precio</td>                               
                                </tr>
                            </thead>
                            <tbody>                                
                                @foreach ($products as $p)
                                    <tr>
                                        
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
        </div>  --}}

    <!-- Modal -->
    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
        <div class="modal-content descriptionname">
            <div class="modal-header">
            <h5 class="modal-title" id="staticBackdropLabel">Agregar producto al presupuesto</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
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
                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cerrar</button>
                <button type="submit" class="btn btn-success">Añadir</button>
            </div>
                </form>
        </div>
        </div>
    </div>
        

@endsection
{{-- <a href="{{ url('/budget.getpdf') }}" target="_blank">Imprimir</a>    --}}

