@extends('pages.master')

@section('title', 'Historial de compras')

@section('breadcrumb')
    <li class="breadcrumb-item">
        <a href="" class="nav-link"><i class="fas fa-list-alt"></i> Historial de compras</a>
    </li>  
@endsection

@section('content')
<div class="container-fluid">
    <div class="panel shadow">
        <div class="header">
            <h2 class="title"><i class="fas fa-list-alt"></i> Historial de compras</h2>
        </div>       

        <div class="inside">
            <div class="mtop16 descriptionname">
                <table class="table responsive table-striped table-dark descriptionname table-bordered border-white display" style="width:100%">
                    <thead>
                        <tr>
                            <th>Nro compra</th>
                            <th>Proveedor</th>
                            <th>Comprador</th>
                            <th>Fecha de compra</th>
                            <th>Precio total</th>
                            <th></th>
                            
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($buys as $buy)
                            <tr>
                                <td>{{ $buy->id }}</td>
                                <td>{{ $buy->nameProvider }}</td>
                                <td>{{ $buy->nameSeller }}</td>
                                <td>{{ $buy->date }}</td>
                                <td>{{ $buy->totalPrice }}</td>
                                <td>
                                    <div class="btn-group" role="group" aria-label="Basic example">
                                        <a href="/buy/{{$buy->id}}/buydetail" class="btn btn-primary" data-toggle="tooltip" data-placement="top" title="Detalle"><i class="fas fa-info-circle"></i></a>
                                        <a href="/buy/{{$buy->id}}/getpdf" target="_blank" class="btn btn-danger" data-toggle="tooltip" data-placement="top" title="Generar PDF"><i class="far fa-file-pdf"></i></a>
                                        {{-- <a href="/budget/{{$budget->id}}/getpdf" target="_blank"><i class="far fa-file-pdf"></i> Generar PDF</a> --}}
                                    </div>                                
                                </td>
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
@endsection