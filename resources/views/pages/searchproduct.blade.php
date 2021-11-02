@extends('pages.master')

@section('title', 'Productos en almacén')

@section('breadcrumb')
    <li class="breadcrumb-item">
        <a href="{{ url('/addproduct') }}" class="nav-link"><i class="fas fa-boxes"></i> Productos en almacén</a>
    </li>  
@endsection

@section('content')
<div class="container-fluid">
    <div class="panel shadow">
        <div class="header">
            <h2 class="title"><i class="fas fa-box"></i> Nuevo producto</h2>
        </div>

        <!--<div class="search opts mtop16">
            <form class="d-flex">
                <input class="form-control me-2" type="search" placeholder="Ingrese nombre del producto" aria-label="Search" name="search">
                
                <button class="btn btn-primary" type="submit"><a href=" {url('/')}} " class="asearch">Buscar</a></button>
                <button class="btn btn-danger" type="submit"><a href=" {url('/')}} " class="asearch">Cancelar</a> </button>                
            </form>
            
        </div>-->

        <form class="d-flex mtop16">
            <input name="buscarpor" class="form-control me-2" type="search" placeholder="Search" aria-label="Search" value="{{ $buscarpor }}">
            <button class="btn btn-success" type="submit">Buscar</button>
        </form>
        

        <div class="inside">
            <table class="table table-striped mtop16">
                <thead>
                    <tr>
                        <td class="descriptionname aling">Código</td>
                        <td class="descriptionname aling">Nombre</td>
                        <!--<td class="descriptionname aling">Tipo de venta</td>-->
                        <td class="descriptionname aling">Precio de compra</td>
                        <td class="descriptionname aling">Precio de venta</td>
                        <td class="descriptionname aling">Precio por kilo</td>
                        <td class="descriptionname aling">Kilos por bolsa</td>
                        <td class="descriptionname aling">Cantidad de stock</td>
                        <td class="descriptionname aling">Cantidad minima de stock</td>
                        <!--<td class="descriptionname aling">¿Tiene vencimiento?</td>-->
                        <td class="descriptionname aling">Fecha de vencimiento (A/M/D)</td>
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
                            <td class="descriptionname">{{ $p->pricesale}}</td>
                            <!--Pregunta para ver si el producto se vende por bolsa o por unidad-->
                                @if ($p->tipesale == '0')
                                    <td class="descriptionname">{{ '----'}}</td>
                                    <td class="descriptionname">{{ '----'}}</td>
                                @else
                                    <td class="descriptionname">{{ $p->pricekg}}</td>
                                    <td class="descriptionname">{{ $p->kgbag}}</td>
                                @endif
                            <!--<td class="descriptionname">$p->pricekg}}</td>-->
                            <!--td class="descriptionname">$p->kgbag}}</td>-->
                            <td class="descriptionname">{{ $p->stock}}</td>
                            <td class="descriptionname">{{ $p->stockmin}}</td>
                            <!--Pregunta para ver si el producto tiene fecha de vencimiento-->
                                @if ($p->date == '2001-01-01')
                                    <td class="descriptionname">{{ '----' }}</td>
                                @else
                                    <td class="descriptionname">{{ $p->date}}</td>
                                @endif
                            <!--<td class="descriptionname"> $p->date }}</td>-->
                            <td class="descriptionname">
                                <div class="opts">
                                    <a href="{{ '/product'.'/'.$p->id.'/edit' }}" data-toggle="tooltip" data-placement="top" title="Editar">
                                        <i class="fas fa-edit descriptionname"></i>
                                    </a>
                                    <a href="{{'/product'.'/'.$p->id.'/delete' }}" data-toggle="tooltip" data-placement="top" title="Eliminar" class="delete">
                                        <i class="fas fa-trash-alt descriptionname"></i>
                                    </a>   
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection