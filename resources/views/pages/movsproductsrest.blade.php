@extends('pages.master')

@section('title', 'Salida de productos')

@section('breadcrumb')
    <li class="breadcrumb-item">
        <a href="{{ url('/movsproductsrest') }}" class="nav-link"><i class="fas fa-arrow-left"></i> Salida de productos</a>
    </li>  
@endsection

@section('content')
<div class="container-fluid">
    <div class="panel shadow">
        <div class="header">
            <h2 class="title"><i class="fas fa-arrow-left"></i> Salida de productos</h2>
        </div>

        {{-- <form class="d-flex mtop16">
            <input name="buscarpor" class="form-control me-2" type="search" placeholder="Ingrese el nombre del producto" aria-label="Search" value="{{ $buscarpor }}">
            <button class="btn btn-primary" type="submit" data-toggle="tooltip" data-placement="top" title="Buscar producto">Buscar</button>
        </form> --}}

        <div class="inside">
            <table id="" class="table responsive table-striped table-dark descriptionname table-bordered border-white display" style="width:100%">
                <thead>
                    <tr>
                        <td class="descriptionname aling">Código</td>
                        <td class="descriptionname aling">Nombre</td>
                        <!--<td class="descriptionname aling">Tipo de venta</td>-->
                        <td class="descriptionname aling">Precio de compra</td>
                        {{-- <td class="descriptionname aling">Precio de venta</td>
                        <td class="descriptionname aling">Precio por kilo</td>
                        <td class="descriptionname aling">Kilos por bolsa</td> --}}
                        <td class="descriptionname aling">Cantidad de stock</td>
                        {{-- <td class="descriptionname aling">Cantidad minima de stock</td> --}}
                        <!--<td class="descriptionname aling">¿Tiene vencimiento?</td>-->
                        {{-- <td class="descriptionname aling">Fecha de vencimiento (A/M/D)</td> --}}
                        <td class="descriptionname aling"></td>
                    </tr>
                </thead>
                <tbody>                    
                    @foreach ($products as $p)
                        <tr>
                            <td class="descriptionname">{{ $p->code }}</td>
                            <td class="descriptionname">{{ $p->name}}</td>
                            <!--<td> $p->tipesale}}</td>-->
                            <td class="descriptionname">{{ $p->pricebuy}}</td>
                            {{-- <td class="descriptionname">{{ $p->pricesale}}</td>
                            <!--Pregunta para ver si el producto se vende por bolsa o por unidad-->
                                @if ($p->tipesale == '0')
                                    <td class="descriptionname">{{ '----'}}</td>
                                    <td class="descriptionname">{{ '----'}}</td>
                                @else
                                    <td class="descriptionname">{{ $p->pricekg}}</td>
                                    <td class="descriptionname">{{ $p->kgbag}}</td>
                                @endif --}}
                            <!--<td class="descriptionname">$p->pricekg}}</td>-->
                            <!--td class="descriptionname">$p->kgbag}}</td>-->
                            <td class="descriptionname">{{ $p->stock}}</td>
                            {{-- <td class="descriptionname">{{ $p->stockmin}}</td> --}}
                            <!--Pregunta para ver si el producto tiene fecha de vencimiento-->
                                {{-- @if ($p->date == '2001-01-01')
                                    <td class="descriptionname">{{ '----' }}</td>
                                @else
                                    <td class="descriptionname">{{ $p->date}}</td>
                                @endif --}}
                            <!--<td class="descriptionname"> $p->date }}</td>-->
                            <td class="descriptionname">
                                <div class="opts">
                                    <a href="{{ '/movsproductsrest'.'/'.$p->id.'/rest' }}" data-toggle="tooltip" data-placement="top" title="Nueva venta" class="btn btn-success"><i class="fas fa-cart-arrow-down"></i></i>          
                                    </a>        
                                    <!-- Button trigger modal -->
                                    {{-- <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#infoProducts{{ $p->id }}">
                                        {{ $p->name }}
                                    </button> --}}
                                    <a href="" type="button" data-toggle="tooltip" data-placement="top" title="Detalle del producto" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#infoProducts{{ $p->id }}">
                                        <i class="fas fa-info-circle"></i>         
                                    </a>  
                                </div>                         
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

           @foreach ($products as $p)
               <!-- Modal -->
                <div class="modal fade" id="infoProducts{{$p->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                            <h5 class="modal-title descriptionname" id="exampleModalLabel">Detalle del producto</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body descriptionname">
                                <div class="inside">
                                    {{-- Nombre del producto --}}
                                    <div class="row">
                                        <label for="name" class="descriptionname">Nombre del producto</label>
                                        <input type="text" name="" id="" class="form-control" value="{{$p->name}}" aria-label="Disabled input example" disabled readonly>
                                    </div>  
                                    
                                    <div class="row mtop16">
                                        {{-- Precio de compra --}}
                                        <div class="col-md-4">
                                            <label for="name" class="descriptionname">Precio de compra</label>
                                        <input type="text" name="" id="" class="form-control" value="{{$p->pricebuy}}" aria-label="Disabled input example" disabled readonly>
                                        </div>
                                        {{-- Precio de venta --}}
                                        <div class="col-md-4">
                                            <label for="name" class="descriptionname">Precio de venta</label>
                                        <input type="text" name="" id="" class="form-control" value="{{$p->pricesale}}" aria-label="Disabled input example" disabled readonly>
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
           @endforeach

        </div>
    </div>
</div>
@endsection

<script>
   
</script>