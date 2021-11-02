@extends('pages.master')

@section('title', 'Nueva compra')

@section('breadcrumb')
    <li class="breadcrumb-item">
        <a href="" class="nav-link"><i class="fas fa-shopping-cart"></i> Nueva venta</a>
    </li>  
@endsection

@section('content')

    <div class="row">
        <div id="liveAlertPlaceholder"></div>
        <div class="col-md-12">
            <div class="container-fluid">
                <div class="panel shadow">
                    <div class="header">
                        <h2 class="title"><i class="fas fa-shopping-cart"></i> Nueva venta</h2>
                    </div>       
            
                   {{-- AGREGAR PRODUCTO AL PRESUPUESTO --}}
                    <div class="inside">  
                        <h5 class="descriptionname">Datos nueva venta - Persona</h5>
                        <div class="bntaddclient mtop16 descriptionname">
                            <label for="newClient">¿No existe el cliente?</label>
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                                Añadir nuevo cliente
                            </button>
                        </div>
                        <form action="{{ url('/sale/newsalep') }}" id="formNewBudget" method="POST">
                        @csrf
                            <div class="mtop16">
                                <div class="row">
                                    <div class="col-md-12">
                                        <label for="nameSeller" class="descriptionname">Nombre del vendedor</label>
                                        <div class="input-group">
                                            <span class="input-group-text" id="basic-addon1"><i class="fas fa-user-tie"></i></span>
                                            <input type="text" class="form-control" id="nameSeller" name="nameSeller" value="{{Auth::user()->name }}  {{Auth::user()->lastname }}" readonly>
                                        </div>                           
                                    </div>
                                </div>
                                <div class="row mtop16">
                                    {{-- Nombre del comprador --}}
                                    <div class="col-md-12">
                                        <label for="nameBuyer" class="descriptionname">Nombre del comprador</label>
                                        <div class="input-group">
                                            <span class="input-group-text" id="basic-addon1"><i class="fas fa-user-tie"></i></span>
                                            <select name="nameBuyer" id="nameBuyer" class="form-select" onchange="selectIdClient();">
                                                <option selected disabled>Seleccione un cliente</option>
                                                @foreach ($clients as $client)
                                                    <option value="{{$client->id}}" data-name = "{{$client->lastNameClient}} {{$client->nameClient}}">{{$client->lastNameClient}} {{$client->nameClient}}</option>
                                                @endforeach
                                            </select>
                                        </div>     
                                    </div>
                                </div>
                            </div>
                            <div class="row mtop16">
                                {{-- Fecha de venta --}}
                                <div class="col-md-12">
                                    <label for="dateSale" class="descriptionname">Fecha de venta</label>
                                        <div class="input-group">
                                            <span class="input-group-text" id="basic-addon1"><i class="fas fa-calendar-alt"></i></span>
                                            <input type="date" id="dateSale" name="dateSale" class="form-control">
                                        </div>     
                                </div>
                                <input type="hidden" name="idClient" id="idClient" value="">
                                <input type="hidden" name="nameClient" id="nameClient" value="">
                            </div>
                            <div class="mtop16">                            
                                <button class="btn btn-success" type="submit">Generar venta</button>
                            </div>                           
                        </form>      
                    </div>
                </div>
            </div>
        </div>
    </div> 

    <!-- Modal añadir nuevo cliente-->
    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
        <div class="modal-content descriptionname">
            <div class="modal-header">
            <h5 class="modal-title" id="staticBackdropLabel">Añadir nuevo cliente</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
            <form action="{{url('/sale/addnewclientsale')}}" method="POST">
            @csrf
                <div class="row">
                    {{-- DNI del cliente --}}
                    <div class="col-md-12 descriptionname">
                        <label for="dniClient">DNI del cliente</label>
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon1"><i class="fas fa-sort-numeric-up"></i></span>
                            <input id="dniClient" name="dniClient" type="number" class="form-control" aria-describedby="basic-addon1">
                        </div>
                    </div>
                </div>
                <div class="mtop16">
                    <div class="row descriptionname">
                        {{-- Nombre del cliente --}}
                        <div class="col-md-6">
                            <label for="nameClient">Nombre del cliente</label>
                            <div class="input-group mb-3">
                                <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
                                <input id="nameClient" name="nameClient" type="text" class="form-control" aria-describedby="basic-addon1">
                            </div>
                        </div>
                        {{-- Apellido del cliente --}}
                        <div class="col-md-6">
                            <label for="lastnameClient">Apellido del cliente</label>
                            <div class="input-group mb-3">
                                <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
                                <input id="lastnameClient" name="lastnameClient" type="text" class="form-control" aria-describedby="basic-addon1">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mtop16">
                    <div class="row descriptionname">
                        {{-- Direccion del cliente --}}
                        <div class="col-md-4">
                            <label for="directionClient">Dirección del cliente</label>
                            <div class="input-group mb-3">
                                <span class="input-group-text" id="basic-addon1"><i class="fas fa-compass"></i></span>
                                <input id="directionClient" name="directionClient" type="text" class="form-control" aria-describedby="basic-addon1">
                            </div>
                        </div>
                        {{-- Teléfono del cliente --}}
                        <div class="col-md-4">
                            <label for="phoneClient">Teléfono del cliente</label>
                            <div class="input-group mb-3">
                                <span class="input-group-text" id="basic-addon1"><i class="fas fa-phone"></i></span>
                                <input id="phoneClient" name="phoneClient" type="text" class="form-control" aria-describedby="basic-addon1">
                            </div>
                        </div>
                        {{-- Mail del cliente --}}
                        <div class="col-md-4">
                            <label for="mailClient">Mail del cliente (opcional)</label>
                            <div class="input-group mb-3">
                                <span class="input-group-text" id="basic-addon1"><i class="fas fa-envelope"></i></span>
                                <input id="mailClient" name="mailClient" type="email" class="form-control" aria-describedby="basic-addon1">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cerrar</button>
            <button type="submit" class="btn btn-success">Añadir</button>
            </form>
            </div>
        </div>
        </div>
    </div>

@endsection
{{-- <a href="{{ url('/budget.getpdf') }}" target="_blank">Imprimir</a>    --}}

