@extends('app')
@section('panelTitle', 'Registro de Locales')
@section('panelHead')
    <link href="{{asset('panel/assets/css/localregister.css')}}" rel="stylesheet"/>
    <link href="{{asset('uniform/css/style.css')}}" rel="stylesheet"/>
@endsection
@section('panelContent')
    <div class="form-registro">
        <h4>Datos de la empresa</h4>
        <form action="" id="registroLocales" name="registroLocales">
            <div class="row">
                <div class="col-md-6 mb-4">
                    <label for="nombre">Nombre del negocio</label>
                    <input type="text" class="form-control" name="localName" placeholder="">
                </div>

                <div class="col-md-6 mb-4">
                    <label for="Número o código del local">Número o código del local</label>
                    <select  class="form-control" name="localName">
                        <option>select</option>
                    </select>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 mb-4">
                    <label for="Razón Social">Razón Social</label>
                    <input type="text" class="form-control" name="localSocial" placeholder="">
                </div>

                <div class="col-md-6 mb-4">
                    <label for="Teléfono">Teléfono del local</label>
                    <input type="number" class="form-control" name="localPhonw" placeholder="ej: 04145965">
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 mb-4">
                    <label for="Córreo Eléctronico">Córreo Eléctronico de la empresa</label>
                    <input type="email" class="form-control" name="localName" placeholder="mail@mail.com">
                </div>

                <div class="col-md-6 mb-4">
                    <div class="row">

                        <div class="col-md-5">
                            <label for="Horario">Abre: </label>
                            <input type="time" class="form-control" name="localScheduleFrom" id="localScheduleFrom"
                                   placeholder="">
                        </div>
                        <div class="col-md-5">
                            <label for="Horario">Cierra: </label>
                            <input type="time" class="form-control" name="localScheduleTo" name="localScheduleTo"
                                   placeholder="">
                        </div>
                    </div>
                </div>

                <div class="col-md-12 mb-4">
                    <div class="row">
                        <div class="col-md-12 mb-4">
                            <label for="Descripción">Descripción </label>
                            <textarea name="localDescription" class="form-control textarea" id="localDescription" cols="30"
                                      rows="10"></textarea>
                        </div>
                    </div>
                    <h4>Datos del locatario</h4>
                    <div class="row">

                        <div class="col-md-6">
                            <label for="Nombre">Nombre: </label>
                            <input type="text" class="form-control" name="localScheduleFrom" id="localScheduleFrom"
                                   placeholder="">
                        </div>
                        <div class="col-md-6">
                            <label for="Apellido">Apellido: </label>
                            <input type="text" class="form-control" name="localScheduleTo" name="localScheduleTo"
                                   placeholder="">
                        </div>

                        <div class="col-md-6 mb-4 mt-4">
                            <label for="Teléfono">Teléfono</label>
                            <input type="number" class="form-control" name="localPhonw" placeholder="ej: 04145965">
                        </div>
                        <div class="col-md-6 mb-4 mt-4">
                            <label for="Córreo Eléctronico">Córreo Eléctronico</label>
                            <input type="email" class="form-control" name="localName" placeholder="mail@mail.com">
                        </div>
                    </div>
                </div>
            </div>

            <div class="row mb-4 submit-row">
                <button type="submit" id="DepartmentSubmit" class="btn btn-submit uniform-bg mx-auto d-block">Registrar
                </button>
            </div>
        </form>
    </div>

@endsection
