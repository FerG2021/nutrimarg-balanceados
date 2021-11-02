@extends('pages.master')

@section('title', 'Detalle de cuenta corriente')

@section('breadcrumb')
    <li class="breadcrumb-item">
        <a href="" class="nav-link"><i class="fas fa-users"></i> Detalle de cuenta corriente</a>
    </li>  
@endsection

@section('content')
<div class="container-fluid">
    <div class="panel shadow">
        <div class="header">
            <h2 class="title"><i class="fas fa-users"></i> Detalle de cuenta corriente</h2>
        </div>       

        <div class="inside descriptionname">
            {{-- <div class="btn-option-list">
                <a href="{{'/client/listclient'}}" class="btn btn-primary">Lista de personas</a>
                <a href="{{'/client/listclientfirm'}}" class="btn btn-primary">Lista de firmas</a>                
            </div> --}}

            {{-- <div class="mtop16">
                <table id="" class="table responsive table-striped table-dark descriptionname table-bordered border-white display" style="width:100%">
                    <thead>
                        <tr>
                            <th>Cantidad</th>
                            <th>Bolsas</th>
                            <th>Kilos</th>
                            <th>Monto</th>
                            <th>Decripción</th>
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
                                    <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                                        <a href="/currentaccount/{{$saleproduct->idsale}}/detailsaleclientca" class="btn btn-primary" data-toggle="tooltip" data-placement="top" title="Detalle"><i class="fas fa-info-circle"></i></a> 
                                    </div>
                                </td>
                            </tr> 
                       @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th>TOTAL:</th>
                            <th><input id="totalBudget" name="totalBudget" type="decimal" value="" readonly></th>
                            <th></th>    
                        </tr>
                    </tfoot>
                </table>
            </div> --}}

            <div class="table mtop16 descriptionname">
                        
                {{-- <table class="table responsive table-striped table-dark descriptionname table-bordered border-white display" style="width:100%">
                    <thead>
                        <tr>
                            <th>Cantidad</th>
                            <th>Bolsa</th>
                            <th>Kilos</th>
                            <th>Monto</th>
                            <th>Descripción</th>
                            <th>Precio de compra</th>
                            <th>Subtotal</th>                            
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
                        </tr>
                    </tfoot>
                </table> --}}

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
                                
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th><input id="totalBudget3" name="totalBudget3" type="hidden" value="" readonly></th>
                            <th><input id="totalBudgetInput3" name="totalBudgetInput3" type="hidden" value="" readonly></th>
                            <th>TOTAL:</th>
                            <th><input id="totalBudget6" name="totalBudget6" type="decimal" value="" readonly></th>
                              
                        </tr>
                    </tfoot>
                </table>
            </div>
           
        </div>
    </div>
</div>
@endsection