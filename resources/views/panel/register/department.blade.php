@extends('app')
@section('panelTitle', 'Registro de Departamentos')
@section('panelHead')
    <link href="{{asset('panel/assets/css/localregister.css')}}" rel="stylesheet"/>
    <link href="{{asset('uniform/css/style.css')}}" rel="stylesheet"/>
@endsection
@section('panelContent')
    <div class="form-registro">
        <h3>Registro de Departamentos</h3>
        <form action="" name="departmentRegister" id="departmentRegister">
            <div class="row">
                <div class="col-md-6 mb-4">
                    <label for="nombre">Nombre del Departamento</label>
                    <input type="text" class="form-control" name="DepartamenName" placeholder="" required>
                </div>
                <div class="col-md-6 mb-4">
                    <label for="nombre">Correo Electrónico</label>
                    <input type="email" class="form-control" name="DepartamenEmail" id="DepartamenEmail" placeholder="">
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 mb-4">
                    <label for="Telefone">Telefono</label>
                    <input type="tel" class="form-control" name="DepartamenTelephone" placeholder="">
                </div>
                <div class="col-md-6 mb-4">
                    <label for="nombre">Responsable</label>
                    <select name="status" id="status" class="form-control" required>
                        <option value="" selected> -- Seleccionar --</option>
                        @if(!empty($users))
                            @foreach($users as $user)
                                <option value="{{$user->id}}">{{$user->name}}</option>
                            @endforeach
                            @endif
                    </select>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 mb-4">
                    <label for="Descripción">Horario de entrada</label>
                    <input type="time" class="form-control" name="DepartamenTimeFrom"
                           id="DepartamenTimeFrom"
                           placeholder="">
                </div>
                <div class="col-md-6 mb-4">
                    <label for="Descripción">Horario de salida</label>
                    <input type="time" class="form-control" name="DepartamenTimeTo"
                           id="DepartamenTimeTo"
                           placeholder="">
                </div>

            </div>

            <div class="row">
                <div class="col-md-12">
                    <label for="Descripción">Descripción</label>
                    <textarea type="tel" class="form-control textarea" name="DepartamenDescription"
                              id="DepartamenDescription" placeholder=""></textarea>
                </div>
            </div>
            <div class="row mb-4">
                <button type="submit" class="btn btn-submit uniform-bg">Registrar Departamento</button>
            </div>

        </form>
    </div>
@endsection
