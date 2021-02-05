@extends('app')
@section('panelTitle', 'Detalle')
@section('panelHead')
    <link rel="stylesheet" type="text/css"
          href="https://cdn.datatables.net/v/bs4/dt-1.10.23/rr-1.2.7/sp-1.2.2/sl-1.3.1/datatables.min.css"/>
@endsection
@section('panelContent')
    <div class="row">
        <div class="card w-100 p-5">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-8">
                        <h2>{{$department->name}}</h2>
                    </div>
                    <div class="col-md-4">
                        <a  href="{{url('/worker/create/current-department/') . "/" . $id}}}" class="btn btn-blue">Agregar Trabajador </a>
                    </div>
                </div>
                <div class="col-md-12">

                    <p class="entidad-details" id="detailsTelephone"><b>Telefono: </b> {{$department->telephone}} <span></span></p>
                    <p class="entidad-details" id="detailsEmail"><b>correo electrónico: </b> {{$department->email}}  <span></span></p>
                    <p class="entidad-details" id="detailsScheduleFrom"><b>Horario de Entrada: </b> {{$department->schedule_from}}  <span></span></p>
                    <p class="entidad-details" id="detailsScheduleTo"><b>Horario de salida: </b>   <span> {{$department->schedule_to}}</span></p>

                </div>

                <div class="col-md-12">
                    <label>Descripcion:</label>
                    <p>
                        {{$department->description}}
                    </p>
                </div>
            </div>
        </div>


        <div class="col-md-12">
            <hr>
            <h3>Empleados del departamento</h3>
            <div id="innerContent">
                <table id="tableDepartment" class="table" border="1" align="center">
                    <thead>
                    <tr>
                        <th>Nombre y apellido</th>
                        <th>Correo</th>
                    </tr>
                    </thead>
                    @if( $users->count() > 0 )
                        <tbody>
                        @foreach($users as $user)
                            <tr>
                                <td><span>{{$user->name}} {{$user->lastname}}</span></td>
                                <td><span>{{$user->email}}</span></td>
                            </tr>
                        @endforeach
                        </tbody>
                @endif
            </div>
        </div>
    </div>
@endsection
@section('panelScript')


@endsection
