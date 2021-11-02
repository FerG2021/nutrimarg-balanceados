<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title') - Nutrimarg</title>
    <link rel="shortcut icon" href="{{url('static/images/n.png') }}">

    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="routeName" content="{{ Route::currentRouteName() }}">

    <!--boostrap-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
    
    <!--ruta absoluta hacia la carpeta public para CSS-->
    <link rel="stylesheet" href="{{ url('static/css/pages.css?v='.time()) }}">
    <!--fontawesome-->
    <script src="https://kit.fontawesome.com/b5b44e16f8.js" crossorigin="anonymous"></script>
    <!--google fonts-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">   
    
    <!--Añadir script de JS-->
    <script type="text/javascript" src="{{ asset('js/main.js') }}"></script> 
    <!--script para jquery-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script> 
    <!--script para lightbox-->
    <script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui/dist/fancybox.umd.js"></script>
    <!-- Development version -->
    <script src="https://unpkg.com/@popperjs/core@2/dist/umd/popper.js"></script>
    <!-- Datatables -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.11.1/datatables.min.css"/>



    {{-- Datatables --}}
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.11.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.1/js/dataTables.bootstrap5.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.1/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.1/css/dataTables.bootstrap5.min.css">
    

    
    
    <script>
        $(document).ready(function(){
            $('[data-toggle="tooltip"]').tooltip()
        });
    </script>
    @livewireStyles

    
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.11.2/datatables.min.css"/>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.1/css/bootstrap.min.css">

    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.1/css/dataTables.bootstrap5.min.css">

    {{-- Popper --}}
    <script src="https://unpkg.com/@popperjs/core@2/dist/umd/popper.js"></script>

    <script src="https://cdn.datatables.net/plug-ins/1.11.1/api/sum().js"></script>

</head>
<body>
    <div class="wrapper">
        <div class="col1">@include('pages.sidebar')</div>
        <div class="col2">
            <nav class="navbar navbar-expand-lg shadow">
                <div class="collapse navbar-collapse">                   
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a href="{{ url('/home') }}" class="nav-link"><i class="fas fa-home"></i> Dashboard</a>                            
                        </li>
                    </ul>
                    <div class="notification">
                        <a href="" type="button"  data-bs-toggle="tooltip" data-bs-placement="bottom" title="Notificaciones"><i class="fas fa-bell"></i></a>
                        <a href="{{ url('/logout') }}" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Salir"><i class="fas fa-power-off"></i></a>                       
                    </div>
                </div>
            </nav> 
            
            <div class="page">                
                <div class="container-fluid">
                    <nav aria-label="breadcrumb shadow">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{ url('/home') }}" class="nav-link"><i class="fas fa-home"></i> Dashboard</a>                                
                            </li>
                            @section('breadcrumb') <!--para reemplazar el nombre en cada una de las secciones-->
                            @show
                        </ol>
                    </nav>
                </div>

                <!--FUNCION QUE PERMITE MOSTRAR LAS ALERTAS DE LA APLICACION--> 
                @if (Session::has('message'))
                    <div class="container">
                        <div class="mtop16 alert alert-{{Session::get('typealert')}}" style="display: none;">
                            {{Session::get('message')}}
                            @if ($errors->any())
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{$error}}</li>
                                @endforeach
                            </ul>    
                            @endif
                            <script>
                                $('.alert').slideDown();
                                setTimeout(function(){$('.alert').slideUp();}, 10000);
                            </script>
                        </div>
                    </div>        
                @endif

                @section('content')  
                @show                 
                
            </div>
        </div>
    </div>
    @livewireScripts

    {{-- Datatables --}}
    {{-- <script type="text/javascript" src="datatables/DataTables/datatables.min.js"></script> --}}
    <script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.11.2/datatables.min.js"></script>

    {{-- Sum datatables --}}
    <script src="https://cdn.datatables.net/plug-ins/1.11.1/api/sum().js"></script>

    {{-- <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script> --}}

    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.11.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.1/js/dataTables.bootstrap5.min.js"></script>
    
    

    <script src="https://unpkg.com/@popperjs/core@2/dist/umd/popper.js"></script>

    <script type="text/javascript" src="{{ asset('js/main.js') }}"></script> 

    {{-- DATATABLE SUM --}}
    <script src="https://cdn.datatables.net/plug-ins/1.11.1/api/sum().js"></script>

</body>


</html>