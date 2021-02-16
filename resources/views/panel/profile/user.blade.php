@extends('app')
@section('panelHead')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@section('panelTitle', '')
@section('panelContent')
    <div class="row" id="userProfile">
        <div class="col-md-4" col-12>
            <div class="card p-5">
                <div class="row mb-3">
                    <div class="col-md-12 col-4">

                        <div class="author text-center">
                            <div class="circle-img"><img src="{{ empty( auth()->user()->avatar ) ? asset('panel/assets/img/default-avatar.png') : asset('panel/assets/uploads/img/' . auth()->user()->avatar)  }}"
                                                         alt="persona" class="img-user">
                            </div>
                            <button class="btn btn-change-image" id="changeImage">Cambiar foto</button>
                            <button class="btn btn-upload-image uniform-bg  hidden" id="uploadImage">Actualizar Foto</button>
                            <input type="file" id="newImage" name="newImage"  class="hidden"  data-userId="{{auth()->user()->id}}"/>

                            <div class="alert hidden" id="alertMessage">
                                <p></p>
                            </div>

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
@section('panelScript')
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

    <script>
        jQuery(document).ready(function () {
            jQuery('#changeImage').on('click', function (){
                jQuery('#newImage').trigger('click');
            });

            jQuery('#newImage').on('change', function (e){
                let tgt = e.target;
                let files = tgt.files;
                if (FileReader) {
                    let fr = new FileReader();
                    fr.onload = function () {
                        jQuery('.img-user').attr('src', fr.result);
                        jQuery('#uploadImage').removeClass('hidden');
                        jQuery('#changeImage').css('display', 'none ');
                    }
                    let url = fr.readAsDataURL(files[0]);
                }

            });

            jQuery('#uploadImage').on('click', function (){
                let self = jQuery(this);
                let userId = jQuery('#newImage').data('userid');
                let media = jQuery('#newImage');
                let formData = new FormData();
                let message = jQuery('#alertMessage');
                formData.append('image', media[0].files[0] );
                formData.append('userId', userId );
                jQuery.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
                    }
                });
                jQuery.ajax({
                        url : '{{url('/changeImage')}}' + '/' + userId,
                    processData: false,
                    enctype: 'multipart/form-data',
                    contentType: false,
                        type: 'POST',
                        data:  formData,
                        success: function (response){
                            console.log(response);
                            if(response.status === 'ok'){
                                if(message.hasClass('alert-warning')){
                                    message.removeClass('alert-warning');
                                }
                                message.addClass('alert-success');
                            }else{
                                if(message.hasClass('alert-success')){
                                    message.removeClass('alert-sucess');
                                }
                                message.addClass('alert-warning');
                            }

                            self.addClass('hidden');
                            message.find('p').html(response.content);
                            message.removeClass('hidden');
                            setTimeout(function (){
                                message.addClass('hidden');
                                jQuery('#changeImage').removeClass('hidden');
                            }, 3000)

                        }
                });

            });

        });
        </script>
@endsection
