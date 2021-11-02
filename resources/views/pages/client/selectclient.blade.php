@extends('pages.master')

@section('title', 'Nuevo cliente')

@section('breadcrumb')
    <li class="breadcrumb-item">
        <a href="" class="nav-link"><i class="fas fa-user-plus"></i> Nuevo cliente</a>
    </li>  
@endsection

@section('content')
    <div class="container-fluid">
        <div class="panel shadow">
            <div class="header">
                <h2 class="title"><i class="fas fa-user-plus"></i> Nuevo cliente</h2>
            </div>

            <div class="inside">
                <div class="title-select descriptionname">
                    <h3>Seleccione el tipo de cliente</h3>
                </div>

                <div class="button-option-select mtop16">
                    <a href="{{url('client/newclient')}}" class="btn btn-primary">Persona</a>
                    <a href="{{url('client/newclientfirm')}}" class="btn btn-primary">Firma comercial</a>
                </div>
            </div>
        </div>
    </div>
    
@endsection
    
