@extends('pages.master')

@section('title', 'Lista de clientes - Firmas')

@section('breadcrumb')
    <li class="breadcrumb-item">
        <a href="" class="nav-link"><i class="fas fa-users"></i> Lista de clientes - Firmas</a>
    </li>  
@endsection

@section('content')
<div class="container-fluid">
    <div class="panel shadow">
        <div class="header">
            <h2 class="title"><i class="fas fa-users"></i> Lista de clientes - Firmas</h2>
        </div>       

        <div class="inside descriptionname">
            <div class="btn-option-list">
                <a href="{{'/client/listclient'}}" class="btn btn-primary">Lista de personas</a>
                <a href="{{'/client/listclientfirm'}}" class="btn btn-primary">Lista de firmas</a>                
            </div>

            <div class="mtop16">
                <table id="" class="table responsive table-striped table-dark descriptionname table-bordered border-white display" style="width:100%">
                    <thead>
                        <tr>
                            <th>CUIT</th>
                            <th>Nombre</th>
                            <th>Razón social</th>
                            <th>Dirección</th>
                            <th>Teléfono</th>
                            <th>Mail</th>
                            <th></th>                        
                        </tr>
                    </thead>
                    <tbody>
                       @foreach ($clientFirms as $clientFirm)
                            <tr>
                                <td>{{ $clientFirm->cuit }}</td>
                                <td>{{ $clientFirm->nameFirm }}</td>
                                <td>{{ $clientFirm->socialReasonFirm }}</td>
                                <td>{{ $clientFirm->directionFirm }}</td>
                                <td>{{ $clientFirm->phoneFirm }}</td>
                                <td>{{ $clientFirm->mailFirm }}</td>
                                <td>                               
                                    <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                                        <a href="/clientfirm/{{$clientFirm->id}}/editclientfirm" class="btn btn-primary" data-toggle="tooltip" data-placement="top" title="Editar"><i class="fas fa-edit"></i></a>
                                        <a href="/clientfirm/{{$clientFirm->id}}/deleteclientfirm" class="btn btn-danger"  data-toggle="tooltip" data-placement="top" title="Eliminar"><i class="fas fa-trash-alt"></i></a>
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