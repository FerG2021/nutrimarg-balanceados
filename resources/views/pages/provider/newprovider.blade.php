@extends('pages.master')

@section('title', 'Nuevo proveedor')

@section('breadcrumb')
    <li class="breadcrumb-item">
        <a href="" class="nav-link"><i class="fas fa-truck"></i> Nuevo proveedor</a>
    </li>  
@endsection

@section('content')
    <div class="container-fluid">
        <div class="panel shadow">
            <div class="header">
                <h2 class="title"><i class="fas fa-truck"></i> Nuevo proveedor</h2>
            </div>

            <div class="inside">
                <form action="{{ url('/provider/newprovider') }}" method="POST">
                @csrf
                    <div class="row">
                        <div class="col-md-12">
                            <label for="nameProvider" class="descriptionname">Nombre del proveedor</label>
                            <div class="input-group">
                                <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
                                <input type="text" class="form-control" name="nameProvider" id="nameProvider">
                            </div>
                        </div>
                    </div>

                    <div class="mtop16">
                        <div class="row">
                            <div class="col-md-12">
                                <label for="socialReason" class="descriptionname">Razón social</label>
                                <div class="input-group">
                                    <span class="input-group-text" id="basic-addon1"><i class="fas fa-keyboard"></i></span>
                                    <input type="text" class="form-control" name="socialReason" id="socialReason">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="mtop16">
                        <div class="row">
                            <div class="col-md-6">
                                <label for="cuit" class="descriptionname">CUIT (sin guiones)</label>
                                <div class="input-group">
                                    <span class="input-group-text" id="basic-addon1"><i class="fas fa-sort-numeric-up"></i></span>
                                    <input type="number" class="form-control" name="cuit" id="cuit">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label for="direction" class="descriptionname">Dirección</label>
                                <div class="input-group">
                                    <span class="input-group-text" id="basic-addon1"><i class="fas fa-compass"></i></span>
                                    <input type="text" class="form-control" name="direction" id="direction">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="mtop16">
                        <div class="row">
                            <div class="col-md-6">
                                <label for="phone" class="descriptionname">Teléfono (sin guiones)</label>
                                <div class="input-group">
                                    <span class="input-group-text" id="basic-addon1"><i class="fas fa-phone"></i></span>
                                    <input type="number" class="form-control" name="phone" id="phone">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label for="mail" class="descriptionname">Mail</label>
                                <div class="input-group">
                                    <span class="input-group-text" id="basic-addon1"><i class="fas fa-envelope"></i></span>
                                    <input type="email" class="form-control" name="mail" id="mail">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="mtop16">
                        <button class="btn btn-success descriptionname">Guardar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
@endsection
    
