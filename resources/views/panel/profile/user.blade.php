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
                        <h3 class="user-name">Sofia Singer</h3>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-8">
            <div class="card card-user">
                <div class="card-header">
                    <h5 class="card-title">Editar Perfil</h5>
                </div>
                <div class="card-body">
                    <form action="" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-md-6 pr-1">
                                <div class="form-group">
                                    <label>Compañia</label>
                                    <input type="text" class="form-control" disabled="" placeholder="Company"
                                           value="Creative Code Inc.">
                                </div>
                            </div>
                            <div class="col-md-6 pl-1">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Correo Electrónico</label>
                                    <input type="email" class="form-control" placeholder="Email" value="mail@mail.com">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 pr-1">
                                <div class="form-group">
                                    <label>Nombre</label>
                                    <input type="text" class="form-control" placeholder="Nombre de usuario"
                                           value="Sofia">
                                </div>
                            </div>
                            <div class="col-md-6 pl-1">
                                <div class="form-group">
                                    <label>Apellido</label>
                                    <input type="text" class="form-control" placeholder="Last Name" value="Singer">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 pr-1">
                                <div class="form-group">
                                    <label>Contraseña</label>
                                    <input type="password" class="form-control" placeholder="City" value="Melbourne">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="update ml-auto mr-auto">
                                <button type="submit" class="btn uniform-bg">Actualizar datos</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
