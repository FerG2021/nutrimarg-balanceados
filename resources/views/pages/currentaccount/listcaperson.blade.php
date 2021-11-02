@extends('pages.master')

@section('title', 'Lista de cuenta corriente')

@section('breadcrumb')
    <li class="breadcrumb-item">
        <a href="" class="nav-link"><i class="fas fa-users"></i> Lista de cuenta corriente</a>
    </li>  
@endsection

@section('content')
<div class="container-fluid">
    <div class="panel shadow">
        <div class="header">
            <h2 class="title"><i class="fas fa-users"></i> Lista de cuenta corriente</h2>
        </div>       

        <div class="inside descriptionname">
            <div class="btn-option-list">
                <a href="{{'/currentaccount/listcurrentaccount'}}" class="btn btn-primary">Todas las cuentas</a>
                <a href="{{'/currentaccount/listcaclient'}}" class="btn btn-primary">Lista de personas</a>
                <a href="{{'/currentaccount/listcafirm'}}" class="btn btn-primary">Lista de firmas</a>                
            </div>

            <div class="mtop16">
                <table id="" class="table responsive table-striped table-dark descriptionname table-bordered border-white display" style="width:100%">
                    <thead>
                        <tr>
                            <th>Apellido</th>
                            <th>Nombre</th>
                            <th>DNI</th>
                            <th>Saldo</th>  
                            <th>Fecha última acción</th>                          
                            <th></th>                        
                        </tr>
                    </thead>
                    <tbody>
                       @foreach ($caclients as $caclient)
                            <tr>
                                <td>{{ $caclient->lastNameClient }}</td>
                                <td>{{ $caclient->nameClient }}</td>
                                <td>{{ $caclient->dniClient }}</td>
                                <td>{{ $caclient->balance }}</td>
                                <td>{{ $caclient->datelastaction}}</td>
                                <td>                               
                                    <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                                        <a href="/currentaccount/{{$caclient->id}}/detailclientca" class="btn btn-primary" data-toggle="tooltip" data-placement="top" title="Detalle"><i class="fas fa-info-circle"></i></a>
                                        
                                        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#staticBackdrop{{$caclient->id}}" data-toggle="tooltip" data-placement="top" title="Cobrar">
                                            <i class="fas fa-cash-register"></i>
                                        </button>

                                        <a href="/currentaccount/{{$caclient->id}}/getpdf" target="_blank" class="btn btn-danger" data-toggle="tooltip" data-placement="top" title="PDF"><i class="far fa-file-pdf"></i></a>

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

<!-- Modal -->
    @foreach ($caclients as $caclient)
        <div class="modal fade" id="staticBackdrop{{$caclient->id}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
            <div class="modal-content descriptionname">
                <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Cobrar saldo cuenta corriente</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="/currentaccount/{{$caclient->id}}/paybalance">
                    @csrf
                    <div class="row">                
                        {{-- Saldo de cuenta corriente --}}
                        <div class="col-md-6">
                            <label for="balance">Saldo de cuenta</label>
                            <div class="input-group">
                                <span class="input-group-text" id="basic-addon1"><i class="fas fa-dollar-sign"></i></span>
                                <input type="decimal" class="form-control" id="balance" name="balance" value="{{$caclient->balance}}" readonly>               
                            </div>
                        </div>
                        {{-- Monto a pagar por el cliente --}}
                        <div class="col-md-6">
                            <label for="mountpay">Monto pagado</label>
                            <div class="input-group">
                                <span class="input-group-text" id="basic-addon1"><i class="fas fa-dollar-sign"></i></span>
                                <input type="decimal" class="form-control" id="mountpay" name="mountpay" value="">                          
                            </div>
                        </div>
                        
                        <input type="hidden" name="idClient" id="idClient" value="{{$caclient->clientId}}">         
                        <input type="hidden" name="idClientFirm" id="idClientFirm" value="{{$caclient->clientIdFirm}}">
                    </div>
                </div>
                <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cerrar</button>
                <button type="submit" class="btn btn-success">Cobrar</button>
                </form>
                </div>
            </div>
            </div>
        </div>
    @endforeach
@endsection