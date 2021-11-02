@extends('pages.master')

@section('title', 'Lista de proveedores')

@section('breadcrumb')
    <li class="breadcrumb-item">
        <a href="" class="nav-link"><i class="fas fa-list-ol"></i> Lista de proveedores</a>
    </li>  
@endsection

@section('content')
<div class="container-fluid">
    <div class="panel shadow">
        <div class="header">
            <h2 class="title"><i class="fas fa-list-ol"></i> Lista de proveedores</h2>
        </div>       

        <div class="inside descriptionname">
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
                   @foreach ($providers as $provider)
                        <tr>
                            <td>{{ $provider->cuit }}</td>
                            <td>{{ $provider->nameProvider }}</td>
                            <td>{{ $provider->socialReason }}</td>
                            <td>{{ $provider->direction }}</td>
                            <td>{{ $provider->phone }}</td>
                            <td>{{ $provider->mail }}</td>
                            <td>                               
                                <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                                    <a href="/provider/{{$provider->id}}/editprovider" class="btn btn-primary" data-toggle="tooltip" data-placement="top" title="Editar"><i class="fas fa-edit"></i></a>
                                    <a href="/provider/{{$provider->id}}/deleteprovider" class="btn btn-danger"  data-toggle="tooltip" data-placement="top" title="Eliminar"><i class="fas fa-trash-alt"></i></a>
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
@endsection