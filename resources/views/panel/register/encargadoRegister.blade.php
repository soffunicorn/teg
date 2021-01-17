@extends('app')
@section('panelTitle', 'Registro de Locales')
@section('panelHead')
    <link href="{{asset('panel/assets/css/localregister.css')}}" rel="stylesheet"/>
    <link href="{{asset('uniform/css/style.css')}}" rel="stylesheet"/>
@endsection
@section('panelContent')
<div class="form-registro">

        <div class="row">

            <h2>Registro de usuario</h2>
            <div class="col-md-12 mb-4">

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

                    <div class="col-md-6 mb-4 mt-4">
                        <label for="rol">Rol</label>
                       <select name="rol" id="rol" class="form-control">
                           <option>Administrado</option>
                           <option>Supervisor</option>
                           <option>Empleado</option>
                       </select>
                    </div>



                </div>
            </div>
        </div>

        <div class="row mb-4">
            <button type="submit" id="localSubmit" class="btn btn-submit uniform-bg mx-auto d-block">Registrar
            </button>
        </div>

</div>


@endsection
