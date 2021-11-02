@extends('pages.master')

@section('title', 'Lista de presupuestos')

@section('breadcrumb')
    <li class="breadcrumb-item">
        <a href="" class="nav-link"><i class="fas fa-list-ol"></i> Lista de presupuestos</a>
    </li>  
@endsection

@section('content')
<div class="container-fluid">
    <div class="panel shadow">
        <div class="header">
            <h2 class="title"><i class="fas fa-list-ol"></i> Lista de presupuestos</h2>
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
                    @foreach ($budgets as $budget)
                        <tr>
                            <td>{{ $budget->id }}</td>
                            <td>{{ $budget->nameClient }}</td>
                            <td>{{ $budget->nameSeller }}</td>
                            <td>{{ $budget->date }}</td>
                            <td>{{ $budget->totalPrice }}</td>
                            <td>
                                <a href="/budget/{{$budget->id}}/budgetdetail" class="btn btn-primary" data-toggle="tooltip" data-placement="top" title="Detalle"><i class="fas fa-info-circle"></i></a>
                                <a href="/budget/{{$budget->id}}/getpdf" target="_blank" class="btn btn-danger" data-toggle="tooltip" data-placement="top" title="Generar PDF"><i class="far fa-file-pdf"></i></a>
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