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
                    <label for="nombre">Nombre del local</label>
                    <input type="text" class="form-control" name="name" id="name" placeholder="" required>
                </div>

                <div class="col-md-6 mb-4">
                    <label for="Razón Social">Razón Social</label>
                    <input type="text" class="form-control" name="business_reason" id="business_reason" placeholder="">
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 mb-4">
                    <label for="Córreo Eléctronico">Córreo Eléctronico </label>
                    <input type="email" class="form-control" name="email" id="email" placeholder="mail@mail.com">
                </div>

                <div class="col-md-6 mb-4">
                    <label for="Teléfono">Teléfono</label>
                    <input type="number" class="form-control" name="telephone" id="telephone"
                           placeholder="ej: 04145965">
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 mb-4">
                    <select name="status" class="form-control" id="status">
                        <option value="disponible">Disponible</option>
                        <option value="disponible">No Disponible</option>
                    </select>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <label for="Horario">Horario de Apertura: </label>
                    <input type="time" class="form-control" name="schedule_from" id="schedule_from"
                           placeholder="">
                </div>
                <div class="col-md-6">
                    <label for="Horario">Horario de Cierra: </label>
                    <input type="time" class="form-control" name="schedule_to" id="schedule_to"
                           placeholder="">
                </div>
            </div>
                <div class="row">
                    <div class="col-md-12 mb-4">
                        <label for="Descripción">Descripción </label>
                        <textarea name="description" class="form-control textarea" id="description" cols="30"
                                  rows="10"></textarea>
                    </div>
                </div>
                <div class="row mb-4">
                    <button type="submit" id="localSubmit" class="btn btn-submit uniform-bg mx-auto d-block">Registrar
                    </button>
                </div>
        </form>
    </div>

@endsection
