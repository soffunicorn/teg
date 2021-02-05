@extends('app')
@section('panelTitle', '')
@section('panelContent')
    <div class="row" id="userProfile">
        <div class="col-md-4" col-12>
            <div class="card p-5">
                <div class="row mb-3">
                    <div class="col-md-12 col-4">

                        <div class="author">
                            <div class="circle-img"><img src="{{asset('panel/assets/img/default-avatar.png')}}"
                                                         alt="persona" class="img-user">
                            </div>
                            <button class="btn btn-change-image">Cambiar foto</button>
                        </div>
                    </div>

                    <div class="col-md-12 col-8">
                        <h3 class="user-name">{{auth()->user()->name}}  {{ auth()->user()->lastname }}</h3>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-8">
            <div class="card card-user">
                <div class="card-header">
                    <h5 class="card-title">Editar Datos Básicos</h5>
                </div>
                <div class="card-body">
                    <form action="{{url('change-profile') . auth()->user()->slug}} " method="POST">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-md-6 pr-1">
                                <div class="form-group">
                                    <label>Nombre</label>
                                    <input type="text" class="form-control" placeholder="{{auth()->user()->name}}"
                                           value="" >
                                </div>
                            </div>
                            <div class="col-md-6 pl-1">
                                <div class="form-group">
                                    <label>Apellido</label>
                                    <input type="text" class="form-control" placeholder="Last Name" value="{{auth()->user()->lastname}}">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 pl-1">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Correo Electrónico</label>
                                    <input type="email" class="form-control" placeholder="Email" value="{{auth()->user()->email}}">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="update ml-auto mr-auto">
                                <button type="submit" class="btn uniform-bg">Actualizar datos</button>
                            </div>
                        </div>
                    </form>
                    <hr class="mb-4 mt-4">
                    <h4>Editar la contraseña</h4>
                    <form action="{{url('password-edit' ) . "/" . auth()->user()->slug}} " method="POST">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-md-6 pr-1 ">
                                <div class="form-group">
                                    <label>Contraseña</label>
                                    <input type="password" class="form-control" name="password" id="password" placeholder="City" value="{{auth()->user()->getAuthPassword()}}">
                                </div>
                            </div>
                            <div class="col-md-6 d-flex align-items-center">
                                <button type="submit" class="btn uniform-bg" style="height: fit-content;">Actualizar Contraseña</button>
                            </div>
                            @if(session()->has('message'))
                                <div class="alert alert-success mx-auto d-block">
                                    {{ session()->get('message') }}
                                </div>
                            @endif
                        </div>
                    </form>


                </div>




            </div>
        </div>
    </div>
@endsection
