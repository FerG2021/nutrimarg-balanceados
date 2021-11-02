@extends('pages.master')

@section('title', 'Nuevo cliente')

@section('breadcrumb')
    <li class="breadcrumb-item">
        <a href="" class="nav-link"><i class="fas fa-shopping-cart"></i> Nuevo venta</a>
    </li>  
@endsection

@section('content')
    <div class="container-fluid">
        <div class="panel shadow">
            <div class="header">
                <h2 class="title"><i class="fas fa-shopping-cart"></i> Nuevo venta</h2>
            </div>

            <div class="inside">

                {{-- verificar si hay algún producto con stock minimo --}}
                <div class="control-stock">
                    @foreach ($products as $product)
                        @if ($product->stockmin >= $product->stock)
                            {{-- toast para notificaciones --}}
                            <div class="position-fixed bottom-0 end-0 p-3" style="z-index: 11">
                                <div id="liveToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
                                    <div class="toast-header bg-danger text-white">
                                        {{-- <img src="..." class="rounded me-2" alt="..."> --}}
                                        <i class="fas fa-exclamation-triangle mright5"></i>
                                        <strong class="me-auto"> Notificación de stock mínimo</strong>
                                        {{-- <small>11 mins ago</small> --}}
                                        <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                                    </div>
                                    <div class="toast-body bg-danger text-white bg-opacity-10"> 
                                        <b>Hay productos que alcanzaron su stock mínimo. Hacé click en el botón para más información</b> <br>
                                        <a href="/minstock" type="button" class="btn btn-secondary btn-sm">Ver stock mínimo</a>
                                    </div>
                                </div>
                            </div>
                        @else
                            
                        @endif
                    @endforeach
                </div>

                
                

                <div class="title-select descriptionname">
                    <h3>Seleccione el tipo de cliente para la venta</h3>
                </div>

                <div class="button-option-select mtop16">

                    <form action="{{url('/sale/newsalecf')}}" method="POST">
                    @csrf
                        <input type="hidden" class="form-control" id="nameSeller" name="nameSeller" value="{{Auth::user()->name }}  {{Auth::user()->lastname }}" readonly>

                        <input type="hidden" class="form-control" id="dateBudget" name="dateBudget" value="{{$now->format('Y-m-d')}}" readonly>

                        <button type="submit" class="btn btn-primary mright10">Consumidor final</button>                   

                        <a href="{{url('/sale/newsalep')}}" class="btn btn-primary mright10">Persona</a>
                        
                        <a href="{{url('/sale/newsalefc')}}" class="btn btn-primary mright10">Firma comercial</a>
                    </form>

                    {{-- <a href="{{url('/sale/newsalecf')}}" class="btn btn-primary">Consumidor final</a>                     --}}
                    {{-- <a href="{{url('/sale/newsalep')}}" class="btn btn-primary">Persona</a>
                    <a href="{{url('/sale/newsalefc')}}" class="btn btn-primary">Firma comercial</a> --}}
                </div>
            </div>
        </div>
    </div>
    
@endsection
    
