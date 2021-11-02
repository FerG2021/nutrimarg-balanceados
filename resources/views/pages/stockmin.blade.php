@extends('pages.master')

@section('title', 'Productos en stock mínimo')

@section('breadcrumb')
    <li class="breadcrumb-item">
        <a href="{{ url('/minstock') }}" class="nav-link"><i class="fas fa-minus-square"></i> Productos en stock mínimo</a>
    </li>  
@endsection

@section('content')
<div class="container-fluid">
    <div class="panel shadow">
        <div class="header">
            <h2 class="title"><i class="fas fa-minus-square"></i> Productos en stock mínimo</h2>
        </div>

        {{-- <form class="d-flex mtop16">
            <input name="buscarpor" class="form-control me-2" type="search" placeholder="Ingrese el nombre del producto" aria-label="Search" value="{{ $buscarpor }}">
            <button class="btn btn-primary" type="submit">Buscar</button>
        </form> --}}

        <div class="inside descriptionname">
            <table id="tablestockmin" class="table responsive table-striped table-dark descriptionname table-bordered border-white display" style="width:100%">
                <thead>
                    <tr>
                        <th class="descriptionname aling">Código</th>
                        <th class="descriptionname aling">Nombre</th>
                        <!--<td class="descriptionname aling">Tipo de venta</td>-->
                        <th class="descriptionname aling">Precio de compra</th>
                        <th class="descriptionname aling">Precio de venta</th>
                        <th class="descriptionname aling">Precio por kilo</th>
                        <th class="descriptionname aling">Kilos por bolsa</th>
                        <th class="descriptionname aling">Cantidad de stock</th>
                        <th class="descriptionname aling">Cantidad minima de stock</th>
                        <!--<td class="descriptionname aling">¿Tiene vencimiento?</td>-->
                        <th class="descriptionname aling">Fecha de vencimiento (A/M/D)</th>
                        {{-- <td class="descriptionname aling"></td> --}}
                    </tr>
                </thead>
                <tbody id="bodystockmin">                    
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
                            <!--<td class="descriptionname">
                                <div class="opts">
                                    <a href="'/product'.'/'.$p->id.'/edit' }}" data-toggle="tooltip" data-placement="top" title="Editar">
                                        <i class="fas fa-edit descriptionname"></i>
                                    </a>
                                    <a href="'/product'.'/'.$p->id.'/delete' }}" data-toggle="tooltip" data-placement="top" title="Eliminar" class="delete">
                                        <i class="fas fa-trash-alt descriptionname"></i>
                                    </a>   
                                </div>
                            </td>-->
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection