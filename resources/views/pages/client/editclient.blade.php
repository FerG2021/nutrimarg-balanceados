@extends('pages.master')

@section('title', 'Editar proveedor')

@section('breadcrumb')
    <li class="breadcrumb-item">
        <a href="" class="nav-link"><i class="fas fa-user-edit"></i> Editar cliente</a>
    </li>  
@endsection

@section('content')
    <div class="container-fluid">
        <div class="panel shadow">
            <div class="header">
                <h2 class="title"><i class="fas fa-user-edit"></i> Editar cliente</h2>
            </div>

            <div class="inside">
                <form action="/client/{{$id}}/editclient" method="POST">
                @csrf
                    <div class="row">
                        {{-- DNI del cliente --}}
                        <div class="col-md-12 descriptionname">
                            <label for="dniClient">DNI del cliente</label>
                            <div class="input-group mb-3">
                                <span class="input-group-text" id="basic-addon1"><i class="fas fa-sort-numeric-up"></i></span>
                                <input id="dniClient" name="dniClient" type="number" class="form-control" aria-describedby="basic-addon1" value="{{$client->dni}}">
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
                                    <input id="nameClient" name="nameClient" type="text" class="form-control" aria-describedby="basic-addon1" value="{{$client->nameClient}}">
                                </div>
                            </div>
                            {{-- Apellido del cliente --}}
                            <div class="col-md-6">
                                <label for="lastnameClient">Apellido del cliente</label>
                                <div class="input-group mb-3">
                                    <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
                                    <input id="lastnameClient" name="lastnameClient" type="text" class="form-control" aria-describedby="basic-addon1" value="{{$client->lastNameClient}}">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="mtop16">
                        <div class="row descriptionname">
                            {{-- Direccion del cliente --}}
                            <div class="col-md-4">
                                <label for="directionClient">Direcci??n del cliente</label>
                                <div class="input-group mb-3">
                                    <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
                                    <input id="directionClient" name="directionClient" type="text" class="form-control" aria-describedby="basic-addon1" value="{{$client->directionClient}}">
                                </div>
                            </div>
                            {{-- Tel??fono del cliente --}}
                            <div class="col-md-4">
                                <label for="phoneClient">Tel??fono del cliente</label>
                                <div class="input-group mb-3">
                                    <span class="input-group-text" id="basic-addon1"><i class="fas fa-phone"></i></span>
                                    <input id="phoneClient" name="phoneClient" type="text" class="form-control" aria-describedby="basic-addon1" value="{{$client->phoneClient}}">
                                </div>
                            </div>
                            {{-- Mail del cliente --}}
                            <div class="col-md-4">
                                <label for="mailClient">Mail del cliente (opcional)</label>
                                <div class="input-group mb-3">
                                    <span class="input-group-text" id="basic-addon1"><i class="fas fa-envelope"></i></span>
                                    <input id="mailClient" name="mailClient" type="email" class="form-control" aria-describedby="basic-addon1" value="{{$client->mailClient}}">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="mtop16">
                        <button class="btn btn-success descriptionname">Actualizar cliente</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
@endsection
    
