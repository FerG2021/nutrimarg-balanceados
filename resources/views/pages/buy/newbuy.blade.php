@extends('pages.master')

@section('title', 'Nueva compra')

@section('breadcrumb')
    <li class="breadcrumb-item">
        <a href="{{ url('/budget.newbudget') }}" class="nav-link"><i class="fas fa-shopping-basket"></i> Nueva compra</a>
    </li>  
@endsection

@section('content')

    <div class="row">
        <div id="liveAlertPlaceholder"></div>
        <div class="col-md-12">
            <div class="container-fluid">
                <div class="panel shadow">
                    <div class="header">
                        <h2 class="title"><i class="fas fa-shopping-basket"></i> Nueva compra</h2>
                    </div>       
            
                   {{-- AGREGAR PRODUCTO AL PRESUPUESTO --}}
                    <div class="inside">  
                        <h5 class="descriptionname">Datos nueva compra</h5>
                        <form action="{{ url('/buy/newbuy') }}" id="formNewBudget" method="POST">
                        @csrf
                            <div class="mtop16">
                                <div class="row">
                                    <div class="col-md-12">
                                        <label for="nameSeller" class="descriptionname">Nombre del comprador</label>
                                        <div class="input-group">
                                            <span class="input-group-text" id="basic-addon1"><i class="fas fa-user-tie"></i></span>
                                            <input type="text" class="form-control" id="nameSeller" name="nameSeller" value="{{Auth::user()->name }}  {{Auth::user()->lastname }}" readonly>
                                        </div>
                                        
                                    </div>
                                </div>
                            </div>
                            <div class="mtop16">
                                <div class="row">
                                    <div class="col-md-12">
                                        <label for="nameProvider" class="descriptionname">Nombre del proveedor</label>
                                        <div class="input-group">
                                            <span class="input-group-text" id="basic-addon1"><i class="fas fa-truck"></i></span>
                                            <select name="nameProvider" id="nameProvider" class="form-select">
                                                <option selected>Seleccione un proveedor</option>
                                                @foreach ($providers as $provider)
                                                    <option value="{{ $provider->nameProvider }}">{{ $provider->nameProvider }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>                               
                            </div>
                            <div class="mtop16">
                                <div class="row">
                                    <div class="col-md-12">
                                        <label for="date" class="descriptionname">Fecha de compra</label>
                                        <div class="input-group">
                                            <span class="input-group-text" id="basic-addon1"><i class="fas fa-calendar-alt"></i></i></span>
                                            <input type="date" class="form-control" id="date" name="date" value="">
                                            {{-- <input type="date" class="form-control" id="dateBudget" name="dateBudget" value="{{$now->format('Y-m-d')}}" readonly> --}}
                                        </div>
                                    </div>                 
                                </div>
                            </div> 
                            <div class="mtop16">
                                <button class="btn btn-success" type="submit">Generar compra</button>
                            </div>                           
                        </form>      
                    </div>
                </div>
            </div>
        </div>
    </div> 

@endsection
{{-- <a href="{{ url('/budget.getpdf') }}" target="_blank">Imprimir</a>    --}}

