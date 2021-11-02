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
        
        <div class="control-last-action">
           @if ($deudors == 1)            
               {{-- toast para notificaciones --}}
               <div class="position-fixed bottom-0 end-0 p-3" style="z-index: 11">
                <div id="liveToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
                    <div class="toast-header bg-danger text-white">
                        {{-- <img src="..." class="rounded me-2" alt="..."> --}}
                        <i class="fas fa-exclamation-triangle mright5"></i>
                        <strong class="me-auto"> Notificación de saldo adeudado</strong>
                        {{-- <small>11 mins ago</small> --}}
                        <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                    </div>
                    <div class="toast-body bg-danger text-white bg-opacity-10"> 
                        <b>Hay clientes con fecha de ultima actualización de saldo mayores a 30 días</b> <br>
                        {{-- <a href="/minstock" type="button" class="btn btn-secondary btn-sm">Ver stock mínimo</a> --}}
                        <div class="btn-group" >
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                Clientes
                            </button>
                            <button  type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#exampleModa2">
                                Firmas
                            </button>
                        </div>
                    </div>
                </div>
            </div>
           @else
               
           @endif
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
                            <th>Apellido / RS</th>
                            <th>Nombre</th>
                            <th>DNI / CUIT</th>
                            <th>Saldo</th>  
                            <th>Fecha última acción</th>                           
                            <th></th>                        
                        </tr>
                    </thead>
                    <tbody>
                       @foreach ($clientcas as $clientca)
                            <tr>
                                <td>{{ $clientca->lastNameClient }}</td>
                                <td>{{ $clientca->nameClient }}</td>
                                <td>{{ $clientca->dniClient }}</td>
                                <td>{{ $clientca->balance }}</td>
                                <td>{{ $clientca->datelastaction}}</td>
                                <td>                               
                                    <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                                        <a href="/currentaccount/{{$clientca->id}}/detailclientca" class="btn btn-primary" data-toggle="tooltip" data-placement="top" title="Detalle"><i class="fas fa-info-circle"></i></a>
                                        
                                        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#staticBackdrop{{$clientca->id}}" data-toggle="tooltip" data-placement="top" title="Cobrar">
                                            <i class="fas fa-cash-register"></i>
                                        </button>

                                        <a href="/currentaccount/{{$clientca->id}}/getpdf" target="_blank" class="btn btn-danger" data-toggle="tooltip" data-placement="top" title="PDF"><i class="far fa-file-pdf"></i></a>

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
    @foreach ($clientcas as $clientca)
        <div class="modal fade" id="staticBackdrop{{$clientca->id}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
            <div class="modal-content descriptionname">
                <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Cobrar saldo cuenta corriente</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="/currentaccount/{{$clientca->id}}/paybalance">
                    @csrf
                    <div class="row">                
                        {{-- Saldo de cuenta corriente --}}
                        <div class="col-md-6">
                            <label for="balance">Saldo de cuenta</label>
                            <div class="input-group">
                                <span class="input-group-text" id="basic-addon1"><i class="fas fa-dollar-sign"></i></span>
                                <input type="decimal" class="form-control" id="balance" name="balance" value="{{$clientca->balance}}" readonly>               
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
                        
                        <input type="hidden" name="idClient" id="idClient" value="{{$clientca->clientId}}">         
                        <input type="hidden" name="idClientFirm" id="idClientFirm" value="{{$clientca->clientIdFirm}}">
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


<!-- Modal para detalle de deudores - Personas -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content descriptionname">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Clientes con deuda</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <table id="" class="table responsive table-striped table-dark descriptionname table-bordered border-white display" style="width:100%">
                <thead>
                    <tr>
                        <th>Apellido</th>
                        <th>Nombre</th>
                        <th>DNI</th>
                        <th>Saldo</th>  
                        <th>Fecha última acción</th>                           
                                              
                    </tr>
                </thead>
                <tbody>
                    @foreach ($clientcas as $clientca)
                        @if ($clientca->deudors == 1 && $clientca->clientIdFirm == 0)
                            <tr>
                                <td>{{ $clientca->lastNameClient }}</td>
                                <td>{{ $clientca->nameClient }}</td>
                                <td>{{ $clientca->dniClient }}</td>
                                <td>{{ $clientca->balance }}</td>
                                <td>{{ $clientca->datelastaction}}</td>                               
                            </tr> 
                        @endif
                   @endforeach
                </tbody>
                <tfoot>
                    
                </tfoot>
            </table>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cerrar</button>
          {{-- <button type="button" class="btn btn-primary">Save changes</button> --}}
        </div>
      </div>
    </div>
</div>

<!-- Modal para detalle de deudores - Firmas -->
<div class="modal fade" id="exampleModa2" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content descriptionname">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Clientes con deuda</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <table id="" class="table responsive table-striped table-dark descriptionname table-bordered border-white display" style="width:100%">
                <thead>
                    <tr>
                        <th>Rs</th>
                        <th>Nombre</th>
                        <th>CUIT</th>
                        <th>Saldo</th>  
                        <th>Fecha última acción</th>                           
                                              
                    </tr>
                </thead>
                <tbody>
                    @foreach ($clientcas as $clientca)
                        @if ($clientca->deudors == 1 && $clientca->clientId == 0)
                            <tr>
                                <td>{{ $clientca->lastNameClient }}</td>
                                <td>{{ $clientca->nameClient }}</td>
                                <td>{{ $clientca->dniClient }}</td>
                                <td>{{ $clientca->balance }}</td>
                                <td>{{ $clientca->datelastaction}}</td>                               
                            </tr> 
                        @endif
                   @endforeach
                </tbody>
                <tfoot>
                    
                </tfoot>
            </table>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cerrar</button>
          {{-- <button type="button" class="btn btn-primary">Save changes</button> --}}
        </div>
      </div>
    </div>
</div>