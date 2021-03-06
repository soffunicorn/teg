@extends('app')
@section('panelTitle', 'Registro de Compañia')
@section('panelHead')
    <link href="{{asset('panel/assets/css/localregister.css')}}" rel="stylesheet"/>
    <link href="{{asset('uniform/css/style.css')}}" rel="stylesheet"/>
@endsection
@section('panelContent')
    <div class="form-registro">
        <form method="POST" action="{{url('/company')}}" id="registroLocales" name="registroLocales">
            @csrf

            <div class="row">
                <div class="col-md-6 mb-4">
                    <label for="nombre">Razón Social</label>
                    <input type="text" class="form-control" name="business_reason" id="business_reason" placeholder=""
                           required>
                </div>

                <div class="col-md-6 mb-4">
                    <label for="Razón Social">R.I.F</label>
                    <input type="text" class="form-control" placeholder="Ej: J-123545-5" name="rif"
                           id="rif" required>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 mb-4">
                    <label for="nombre">Nombre Comercial</label>
                    <input type="text" class="form-control" name="name" id="name" placeholder="">
                </div>
                <div class="col-md-6 mb-4">
                    <label for="Córreo Eléctronico">Córreo Eléctronico </label>
                    <input type="email" class="form-control" name="email" id="email" placeholder="mail@mail.com">
                </div>
            </div>

            <div class="row" id="changeDiv">

                <div class="col-md-4 mb-4">
                    <label for="Teléfono">Teléfono</label>
                    <input type="number" class="form-control" name="telephone" id="telephone"
                           placeholder="ej: 04145965">
                </div>
                @if($locals->count() !== 0)
                <div class="col-md-4 mb-4">
                    <label for="local">Seleccione el local</label>
                    <select name="local" id="local" class="form-control">
                        <option value="" selected> --seleccionar --</option>
                        @foreach($locals as $local)
                        <option value="{{$local->id}}"> {{$local->n_local}}</option>
                        @endforeach
                    </select>
                </div>
                 @endif
                <input type="hidden" name="registOwner" id="registOwner" value="NO">
            <!--
                <div class="col-md-4 mb-4">
                    <label for="flexCheckDefault">El dueño esta registrado</label>
                    <select class="form-control" name="registOwner" id="registOwner">
                        <option value="" selected>-- Seleccionar --</option>
                        <option value="SI">Si</option>
                        <option value="NO"> No</option>
                    </select>

                </div>

                <div class="col-md-12 mb-4 hidden" id="selectOwner">
                    @if($users->count() !== 0)

                        <label for="">Seleccionar dueño</label>
                        <select class="form-control" name="owner_company" id="owner_company">
                            <option value="" selected>-- Seleccionar --</option>
                            @foreach($users as $user)
                                <option
                                    value="{{$user->user_slug}}"> {{ $user->user_name . " " . !empty($user->user_lastname) ?  $user->user_lastname : "" }}   </option>
                            @endforeach
                        </select>
                    @else
                        <div class="alert alert-warning hidden">
                            <p>No hay usuarios disponibles </p>
                        </div>
                    @endif
                </div>-->
            </div>


            <div class=" mb-4" id="createOwner">
                <h4 class="sub-title">Datos para crear el usuario</h4>
                <div class="row">

                    <div class="col-md-4 mb-4">
                        <label for="">Nombre del dueño</label>
                        <input type="text" name="nameOwner" id="nameOwner" class="form-control" />
                    </div>

                    <div class="col-md-4 mb-4">
                        <label for="">Apellido del dueño</label>
                        <input type="text" name="lastnameOwner" id="lastnameOwner" class="form-control" />
                    </div>

                    <div class="col-md-4 mb-4">
                        <label for="">Correo electrónico del dueño</label>
                        <input type="email" name="emailOwner" id="emailOwner" class="form-control" />
                    </div>

                </div>
                <hr class="divider">
            </div>


            <div class="row ">

                <div class="col-md-6 col-6 mb-4">
                    <label for="Horario">Horario de Apertura: </label>
                    <input type="time" class="form-control" name="schedule_from" id="schedule_from"
                           placeholder="">
                </div>
                <div class="col-md-6 col-6 mb-4">
                    <label for="Horario">Horario de Cierra: </label>
                    <input type="time" class="form-control" name="schedule_to" id="schedule_to"
                           placeholder="">
                </div>

            </div>


            <div class="row">
                <div class="col-md-12 mb-4">
                    <label for="Descripción">Descripción de la empresa </label>
                    <textarea name="description" class="form-control textarea" id="description" cols="30"
                              rows="10"></textarea>
                </div>
            </div>

            <div class="mb-4">
                <button type="submit" id="localSubmit" class="btn btn-submit uniform-bg mx-auto d-block">Registrar
                </button>
            </div>
            @if($errors->any())
                <div class="alert alert-danger">
                    @foreach ($errors->all() as $error)
                        <p>{{$error}}</p>
                    @endforeach
                </div>
            @endif

        </form>
    </div>

@endsection
@section('panelScript')
    <script>
        jQuery(document).ready(function ($) {

            $('#registOwner').on('click', function () {
                let selectOwner = $('#selectOwner');
                let createOwner = $('#createOwner');

                if ($(this).val() === 'SI') {
                    toggleHidden(selectOwner);

                } else if ($(this).val() === 'NO') {
                    toggleHidden(createOwner);
                }

            });

        });

        function toggleHidden(element) {
            if ($(element).hasClass('hidden')) {
                $(element).removeClass('hidden');
            } else {
                $(element).addClass('hidden');
            }

        }
    </script>


@endsection
