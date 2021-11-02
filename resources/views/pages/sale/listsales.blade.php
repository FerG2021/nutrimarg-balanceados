@extends('pages.master')

@section('title', 'Lista de ventas')

@section('breadcrumb')
    <li class="breadcrumb-item">
        <a href="" class="nav-link"><i class="fas fa-list-ol"></i> Lista de ventas</a>
    </li>  
@endsection

@section('content')
<div class="container-fluid">
    <div class="panel shadow">
        <div class="header">
            <h2 class="title"><i class="fas fa-list-ol"></i> Lista de ventas</h2>
        </div>  
        
        {{-- <div class="btn-select mtop10">
            <a href="/sale/listsales" class="btn btn-primary">Todas las ventas</a>
            <a href="/sale/listsalescf" class="btn btn-primary">Consumidor final</a>
            <a href="/sale/listsalesp" class="btn btn-primary">Personas</a>
            <a href="/sale/listsalesfc" class="btn btn-primary">Firma comercial</a>
        </div> --}}

        <div class="filter-date mtop10">
            <form action="/sale/filterdate" method="post">
            @csrf
                <div class="row descriptionname">
                    <div class="col-md-2">
                    </div>            
                    <div class="col-md-4">
                        <label for="dateinit">Fecha de inicio</label>
                        <div class="input-group">
                            <span class="input-group-text" id="basic-addon1"><i class="fas fa-calendar-alt"></i></span>
                            <input type="date" name="dateinit" name="dateinit" class="form-control" >
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label for="datefinish">Fecha de fin</label>
                        <div class="input-group">
                            <span class="input-group-text" id="basic-addon1"><i class="fas fa-calendar-alt"></i></span>
                            <input type="date" name="datefinish" id="datefinish" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-2">   
                        <label for="datefinish"></label>                
                        <div class="input-group">
                            <button class="btn btn-primary">Filtrar</button>
                            <a href="/sale/listsales" class="btn btn-danger">Limpiar</a>  
                        </div>                                         
                    </div>            
                </div>
            </form>
        </div>

        <div class="inside descriptionname">
            <table class="table responsive table-striped table-dark descriptionname table-bordered border-white display" style="width:100%">
                <thead>
                    <tr>
                        <th>Código</th>
                        <th>Cliente</th>
                        <th>Vendedor</th>
                        <th>Fecha de emisión</th>
                        <th>Precio total</th>
                        <th></th>
                        
                    </tr>
                </thead>
                <tbody>
                    @foreach ($sales as $sale)
                        <tr>
                            <td>{{ $sale->id }}</td>
                            <td>{{ $sale->nameBuyer }}</td>
                            <td>{{ $sale->nameSeller }}</td>
                            <td>{{ $sale->dateSale }}</td>
                            <td>{{ $sale->totalPrice }}</td>
                            <td>
                                <a href="/sale/{{$sale->id}}/saledetail" class="btn btn-primary" data-toggle="tooltip" data-placement="top" title="Detalle"><i class="fas fa-info-circle"></i></a>
                                <a href="/sale/{{$sale->id}}/getpdf" target="_blank" class="btn btn-danger" data-toggle="tooltip" data-placement="top" title="Generar PDF"><i class="far fa-file-pdf"></i></a>
                                {{-- <a href="/budget/{{$budget->id}}/getpdf" target="_blank"><i class="far fa-file-pdf"></i> Generar PDF</a> --}}
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
@endsection