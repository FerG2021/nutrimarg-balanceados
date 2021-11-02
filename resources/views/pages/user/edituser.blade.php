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
                <form action="/user/{{$id}}/edituser" method="post">
                @csrf
                        {{-- Nombre del usuario --}}
                        <div class="row descriptionname">
                            <div class="col-md-12">
                                <label for="name">Nombre</label>
                                <div class="input-group mb-3">
                                    <span class="input-group-text" id="basic-addon1"><i class="fas fa-user"></i></span>
                                    <input type="text" class="form-control" name="name" id="name" value="{{$user->name}}">
                                </div>
                            </div>
                        </div>
                        {{-- Apellido del usuario --}}
                        <div class="row descriptionname">
                            <div class="col-md-12">
                                <label for="lastname">Apellido</label>
                                <div class="input-group mb-3">
                                    <span class="input-group-text" id="basic-addon1"><i class="fas fa-user"></i></span>
                                    <input type="text" class="form-control" name="lastname" id="lastname" value="{{$user->lastname}}">
                                </div>
                            </div>
                        </div>
                        {{-- Usuario --}}
                        <div class="row descriptionname">
                            {{-- Usuario --}}
                            <div class="col-md-6">
                                <label for="userName">Nombre de usuario</label>
                                <div class="input-group mb-3">
                                    <span class="input-group-text" id="basic-addon1"><i class="fas fa-user-tag"></i></span>
                                    <input type="text" class="form-control" name="userName" id="userName" value="{{$user->userName}}">
                                </div>
                            </div>
                            {{-- Tipo de usuario --}}
                            <div class="col-md-6">
                                <label for="typeuser">Tipo de usuario</label>
                                <div class="input-group mb-3">
                                    <span class="input-group-text" id="basic-addon1"><i class="fas fa-key"></i></span>
                                    {!! Form::select('typeuser',['0' => 'Administrador', '1' => 'Empleado'], $user->role, ['class' => 'form-select']) !!} 
                                </div>
                            </div>
                        </div>
                        {{-- Contraseña --}}
                        <div class="row descriptionname">
                            <div class="col-md-12">
                                <label for="password">Contraseña</label>
                                <div class="input-group mb-3">
                                    <span class="input-group-text" id="basic-addon1"><i class="fas fa-key"></i></span>
                                    <input type="password" class="form-control" name="password" id="password">
                                </div>
                            </div>
                        </div>
                        {{-- Confirmar contraseña --}}
                        <div class="row descriptionname">
                            <div class="col-md-12">
                                <label for="cpassword">Confirmar contraseña</label>
                                <div class="input-group mb-3">
                                    <span class="input-group-text" id="basic-addon1"><i class="fas fa-key"></i></span>
                                    <input type="password" class="form-control" name="cpassword" id="cpassword">
                                </div>
                            </div>
                        </div>                    
                        {{-- Boton guardar --}}
                        <div class="row">
                            <div class="col-md-3">
                                <button class="btn btn-success">Guardar usuario</button>
                            </div>
                        </div>
                    </form>
            </div>
        </div>
    </div>
    
@endsection
    
