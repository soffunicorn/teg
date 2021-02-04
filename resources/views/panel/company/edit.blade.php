@extends('app')
@section('panelTitle', 'Registro de Compañia')
@section('panelHead')
    <link href="{{asset('panel/assets/css/localregister.css')}}" rel="stylesheet"/>
    <link href="{{asset('uniform/css/style.css')}}" rel="stylesheet"/>
@endsection
@section('panelContent')
    <div class="formEdit">
        <form method="POST" action="{{url('/company/' . $company->id )}}" id="registroLocales" name="registroLocales">
            @method('PUT')
            @csrf
            <div class="row">
                <div class="col-md-6 mb-4">
                    <label for="nombre">Razón Social</label>
                    <input type="text" class="form-control" name="business_reason" id="business_reason" placeholder=""
                           required value="{{$company->business_reason}}">
                </div>

                <div class="col-md-6 mb-4">
                    <label for="Razón Social">R.I.F</label>e'{
                    <input type="text" class="form-control" placeholder="Ej: J-123545-5" name="rif"
                           id="rif" value="{{$company->rif}}" required>
                </div>
            </div>

            <div class="row">
                <div class="col-md-4 mb-4">
                    <label for="nombre">Nombre Comercial</label>
                    <input type="text" class="form-control" name="name" id="name" value="{{$company->name}}" placeholder="">
                </div>
                <div class="col-md-4 mb-4">
                    <label for="Córreo Eléctronico">Córreo Eléctronico </label>
                    <input type="email" class="form-control" name="email" id="email" placeholder="mail@mail.com" value="{{$company->email}}" >
                </div>

                <div class="col-md-4 mb-4">
                    <label for="Córreo Eléctronico">Estado de la empresa </label>

                </div>

            </div>

            <div class="row" id="changeDiv">

                <div class="col-md-4 mb-4">
                    <label for="Teléfono">Teléfono</label>
                    <input type="number" class="form-control" name="telephone" id="telephone"
                           placeholder="ej: 04145965" value="{{$company->telephone}}">
                </div>

                    <div class="col-md-4 mb-4">
                        <label for="local">Seleccione el local</label>
                        <select name="local" id="local" class="form-control">
                            <option value="{{$company->local_id}}" selected> {{$company->n_local}}</option>
                            @if($locals->count() !== 0)
                            @foreach($locals as $local)
                                <option value="{{$local->id}}"> {{$local->n_local}}</option>
                            @endforeach
                            @endif
                        </select>
                    </div>


                <div class="col-md-4 mb-4">
                    <label for="flexCheckDefault">Dueño del local</label>
                    <select class="form-control" name="currentOwner" id="currentOwner">
                        <option value="{{$company->slug}}" selected>{{$company->user_name . " " . !empty($company->user_lastname) ? $company->user_lastname : " " }}</option>
                        <option value="other">Seleccionar otro dueño</option>
                    </select>

                </div>

                <div class="col-md-12 mb-4 hidden" id="selectOwner">
                    @if($users->count() !== 0)

                        <label for="">Seleccionar dueño</label>
                        <select class="form-control" name="owner_company" id="owner_company">
                            <option value="" selected>-- Seleccionar --</option>
                            @foreach($users as $user)
                                <option
                                    value="{{$user->user_slug}}"> {{ $user->user_name . " " }} {{ $user->user_lastname}}   </option>
                            @endforeach
                        </select>
                    @else
                        <div class="alert alert-warning hidden">
                            <p>No hay usuarios disponibles </p>
                        </div>
                    @endif
                </div>
            </div>


            <div class="hidden mb-4" id="createOwner">
                <h4 class="sub-title">Datos para crear el usuario</h4>
                <div class="row">

                    <div class="col-md-4 mb-4">
                        <label for="">Nombre del dueño</label>
                        <input type="text" name="nameOwner" id="nameOwner" class="form-control" required/>
                    </div>

                    <div class="col-md-4 mb-4">
                        <label for="">Apellido del dueño</label>
                        <input type="text" name="lastnameOwner" id="lastnameOwner" class="form-control" required/>
                    </div>

                    <div class="col-md-4 mb-4">
                        <label for="">Correo electrónico del dueño</label>
                        <input type="email" name="emailOwner" id="emailOwner" class="form-control" required/>
                    </div>

                </div>
                <hr class="divider">
            </div>


            <div class="row ">

                <div class="col-md-6 col-6 mb-4">
                    <label for="Horario">Horario de Apertura: </label>
                    <input type="time" class="form-control" name="schedule_from" id="schedule_from"
                           placeholder="" value="{{$company->schedule_from}}">
                </div>
                <div class="col-md-6 col-6 mb-4">
                    <label for="Horario">Horario de Cierra: </label>
                    <input type="time" class="form-control" name="schedule_to" id="schedule_to"
                           placeholder="" value="{{$company->schedule_to}}">
                </div>

            </div>


            <div class="row">
                <div class="col-md-12 mb-4">
                    <label for="Descripción">Descripción del local </label>
                    <textarea name="description" class="form-control textarea" id="description" cols="30"
                              rows="10">{{$company->description}} </textarea>
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
            jQuery('#currentOwner').on('change', function () {
                if($(this).val() === 'other'){
                    $('#selectOwner').removeClass('hidden');
                }else{
                    if(! $('#selectOwner').hasClass('hidden') ){
                        $('#selectOwner').addClass('hidden');

                    }
                }
            });
        });
        </script>


@endsection
