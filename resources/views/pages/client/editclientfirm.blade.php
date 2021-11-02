@extends('pages.master')

@section('title', 'Editar proveedor')

@section('breadcrumb')
    <li class="breadcrumb-item">
        <a href="" class="nav-link"><i class="fas fa-user-edit"></i> Editar cliente - Firma</a>
    </li>  
@endsection

@section('content')
    <div class="container-fluid">
        <div class="panel shadow">
            <div class="header">
                <h2 class="title"><i class="fas fa-user-edit"></i> Editar cliente - Firma</h2>
            </div>

            <div class="inside">
                <form action="/clientfirm/{{$id}}/editclientfirm" method="POST">
                @csrf
                <div class="row">
                    {{-- CUIT del cliente --}}
                    <div class="col-md-12 descriptionname">
                        <label for="cuitClientFirm">CUIT</label>
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon1"><i class="fas fa-sort-numeric-up"></i></span>
                            <input id="cuitClientFirm" name="cuitClientFirm" type="number" class="form-control" aria-describedby="basic-addon1" value="{{$clientfirm->cuit}}">
                        </div>
                    </div>
                </div>
                <div class="mtop16">
                    <div class="row descriptionname">
                        {{-- Nombre de la firma --}}
                        <div class="col-md-6">
                            <label for="nameFirm">Nombre de la firma</label>
                            <div class="input-group mb-3">
                                <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
                                <input id="nameFirm" name="nameFirm" type="text" class="form-control" aria-describedby="basic-addon1" value="{{$clientfirm->nameFirm}}">
                            </div>
                        </div>
                        {{-- Razon social --}}
                        <div class="col-md-6">
                            <label for="socialReasonFirm">Razón social</label>
                            <div class="input-group mb-3">
                                <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
                                <input id="socialReasonFirm" name="socialReasonFirm" type="text" class="form-control" aria-describedby="basic-addon1" value="{{$clientfirm->socialReasonFirm}}">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mtop16">
                    <div class="row descriptionname">
                        {{-- Direccion del cliente --}}
                        <div class="col-md-4">
                            <label for="directionFirm">Dirección</label>
                            <div class="input-group mb-3">
                                <span class="input-group-text" id="basic-addon1"><i class="fas fa-compass"></i></span>
                                <input id="directionFirm" name="directionFirm" type="text" class="form-control" aria-describedby="basic-addon1" value="{{$clientfirm->directionFirm}}">
                            </div>
                        </div>
                        {{-- Teléfono del cliente --}}
                        <div class="col-md-4">
                            <label for="phoneFirm">Teléfono</label>
                            <div class="input-group mb-3">
                                <span class="input-group-text" id="basic-addon1"><i class="fas fa-phone"></i></span>
                                <input id="phoneFirm" name="phoneFirm" type="text" class="form-control" aria-describedby="basic-addon1" value="{{$clientfirm->phoneFirm}}">
                            </div>
                        </div>
                        {{-- Mail del cliente --}}
                        <div class="col-md-4">
                            <label for="mailFirm">Mail (opcional)</label>
                            <div class="input-group mb-3">
                                <span class="input-group-text" id="basic-addon1"><i class="fas fa-envelope"></i></span>
                                <input id="mailFirm" name="mailFirm" type="email" class="form-control" aria-describedby="basic-addon1" value="{{$clientfirm->mailFirm}}">
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
    
