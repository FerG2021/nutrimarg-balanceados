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
            <div class="btn-back">
                <a href="/currentaccount/listcurrentaccount" class="btn btn-primary">Atrás</a>
            </div>

            <div class="mtop16">
                <table id="" class="table responsive table-striped table-dark descriptionname table-bordered border-white display" style="width:100%">
                    <thead>
                        <tr>
                            <th>Fecha</th>
                            <th>Pago</th>
                            <th>Saldo adeudado</th>                            
                            <th></th>                        
                        </tr>
                    </thead>
                    <tbody>
                       @foreach ($clientcadetails as $clientcadetail)
                            <tr>
                                <td>{{ $clientcadetail->date }}</td>
                                <td>{{ $clientcadetail->pay }}</td>
                                <td>{{ $clientcadetail->sale }}</td>
                                <td>  
                                    @if ($clientcadetail->typemovement == 0)
                                        <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                                            <a href="/currentaccount/{{$clientcadetail->idsale}}/detailsaleclientca" class="btn btn-primary" data-toggle="tooltip" data-placement="top" title="Detalle"><i class="fas fa-info-circle"></i></a>
                                            
                                            {{-- <a href="/client/{{$clientcadetail->id}}/deleteclient" class="btn btn-danger"  data-toggle="tooltip" data-placement="top" title="Eliminar"><i class="fas fa-trash-alt"></i></a> --}}
                                        </div>
                                    @endif                            
                                    
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