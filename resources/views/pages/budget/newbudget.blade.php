@extends('pages.master')

@section('title', 'Nuevo presupuesto')

@section('breadcrumb')
    <li class="breadcrumb-item">
        <a href="{{ url('/budget.newbudget') }}" class="nav-link"><i class="fas fa-plus-circle"></i> Nuevo presupuesto</a>
    </li>  
@endsection

@section('content')

    <div class="row">
        <div id="liveAlertPlaceholder"></div>
        <div class="col-md-12">
            <div class="container-fluid">
                <div class="panel shadow">
                    <div class="header">
                        <h2 class="title"><i class="fas fa-clipboard-list"></i> Nuevo presupuesto</h2>
                    </div>       
            
                   {{-- AGREGAR PRODUCTO AL PRESUPUESTO --}}
                    <div class="inside">  
                        <h5 class="descriptionname">Datos nuevo presupuesto</h5>
                        <form action="{{ url('/budget.newbudget') }}" id="formNewBudget" method="POST">
                        @csrf
                            <div class="row mtop16">
                                <div class="col-md-12">
                                    <label for="nameSeller" class="descriptionname">Nombre del vendedor</label>
                                    <div class="input-group">
                                        <span class="input-group-text" id="basic-addon1"><i class="fas fa-user-tie"></i></span>
                                        <input type="text" class="form-control" id="nameSeller" name="nameSeller" value="{{Auth::user()->name }}  {{Auth::user()->lastname }}" readonly>
                                    </div>
                                    
                                </div>
                            </div>
                            <div class="mtop16">
                                <div class="row">
                                    <div class="col-md-12">
                                        <label for="nameClient" class="descriptionname">Nombre del cliente</label>
                                        <div class="input-group">
                                            <span class="input-group-text" id="basic-addon1"><i class="fas fa-user"></i></span>
                                            <input type="text" class="form-control" id="nameClient" name="nameClient" value="">
                                        </div>
                                    </div>
                                </div>                               
                            </div>
                            <div class="mtop16">
                                <div class="row">
                                    <div class="col-md-12">
                                        <label for="dateBudget" class="descriptionname">Fecha</label>
                                        <div class="input-group">
                                            <span class="input-group-text" id="basic-addon1"><i class="fas fa-calendar-alt"></i></i></span>
                                            <input type="date" class="form-control" id="dateBudget" name="dateBudget" value="{{$now->format('Y-m-d')}}" readonly>
                                        </div>
                                    </div>                 
                                </div>
                            </div> 
                            <div class="mtop16">
                                <button class="btn btn-success" type="submit">Generar presupuesto</button>
                            </div>                           
                        </form>      
                    </div>
                </div>
            </div>
        </div>
    </div> 

@endsection
{{-- <a href="{{ url('/budget.getpdf') }}" target="_blank">Imprimir</a>    --}}

