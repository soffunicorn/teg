@extends('app')
@section('panelTitle', 'Registro de Departamentos')
@section('panelHead')
    <link href="{{asset('panel/assets/css/localregister.css')}}" rel="stylesheet"/>
    <link href="{{asset('uniform/css/style.css')}}" rel="stylesheet"/>
@endsection

@section('panelContent')
    <div class="form-registro">
        <h3>Registro de Departamentos</h3>
        <form method="POST" action="{{url('/department')}}" name="departmentRegister" id="departmentRegister">
           @csrf
            <div class="row">
                <div class="col-md-6 mb-4">
                    <label for="nombre">Nombre del Departamento</label>
                    <input type="text" class="form-control" name="name" id="name" placeholder="" required>
                </div>
                <div class="col-md-6 mb-4">
                    <label for="nombre">Correo Electrónico</label>
                    <input type="email" class="form-control" name="email" id="email" placeholder="">
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 mb-4">
                    <label for="Telefone">Telefono</label>
                    <input type="tel" class="form-control" name="telephone" id="telephone" placeholder="">
                </div>
                <div class="col-md-6 mb-4">
                    <label for="nombre">Responsable</label>
                    <select name="responsable" id="responsable" class="form-control" required>

                        @if($users->count() > 0)
                            <option  selected> -- Seleccionar --</option>
                            @foreach($users as $user)
                                <option value="{{$user->slug}}">{{$user->name}}</option>
                            @endforeach
                            <option value="createResponsable">Crear un Responsable </option>
                            @else
                            <option value="createResponsable" selected>Crear un Responsable </option>

                            @endif
                    </select>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 mb-4">
                    <label for="Horario">Horario de entrada</label>
                    <input type="time" class="form-control" name="schedule_from"
                           id="schedule_from"
                           placeholder="">
                </div>
                <div class="col-md-6 mb-4">
                    <label for="Horario salida">Horario de salida</label>
                    <input type="time" class="form-control" name="schedule_to"
                           id="schedule_to"
                           placeholder="">
                </div>

            </div>

            <div class="row">
                <div class="col-md-12">
                    <label for="Descripción">Descripción</label>
                    <textarea  class="form-control textarea" name="description"
                              id="description" placeholder=""></textarea>
                </div>
            </div>
            <div class="hidden mt-4 mb-4" id="createResponsible">
                <h3 class="sub-title mb-4">Crear Responsable para el departamento</h3>
                <div class="row">
                    <div class="col-md-4">
                        <label for="Nombre">Nombre: </label>
                        <input type="text" class="form-control" name="responsableName" id="responsableName"
                               placeholder="">
                    </div>

                    <div class="col-md-4">
                        <label for="Apellido">Apellido: </label>
                        <input type="text" class="form-control" name="responsableLastname" name="responsableLastname"
                               placeholder="">
                    </div>
                    <div class="col-md-4 mb-4">
                        <label for="Córreo Eléctronico">Córreo Eléctronico</label>
                        <input type="email" class="form-control" name="responsableMail" id="responsableMail" placeholder="mail@mail.com">
                    </div>
                </div>
            </div>
            <div class="row mb-4" style="padding: 0 15px">
                <button type="submit" class="btn btn-submit uniform-bg">Registrar Departamento</button>
            </div>

        </form>
        @if($errors->any())
            <div class="alert alert-danger">
                <p><strong>Opps Something went wrong</strong></p>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif


    </div>
@endsection

@section('panelScript')
    <script>
        jQuery(document).ready(function ($) {
            if(jQuery('#responsable').val() === 'createResponsable'){
                toggleResponsable();
            }

            jQuery('#responsable').on('change', function (){
                if(jQuery(this).val() === 'createResponsable'){
                    toggleResponsable();
                }

            });
        });
        function toggleResponsable(){
            if( jQuery('#createResponsible').hasClass('hidden')){
                jQuery('#createResponsible').removeClass('hidden');
            }else{
                jQuery('#createResponsible').addClass('hidden');
            }

        }

    </script>

@endsection
