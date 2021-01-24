
@extends('app')
@section('panelTitle', 'Editar departamento' )
@section('panelHead')
    <link href="{{asset('panel/assets/css/localregister.css')}}" rel="stylesheet"/>
@endsection
@section('panelContent')
    <div class="edit-department">
        <h4>Editar departamento {{$department->name}}</h4>
        <form method="POST" action="{{url('department/'. $department->id)}}">
            @method('PUT')
            @csrf
            <div class="row">
                <div class="col-md-6 mb-4">
                    <label for="nombre">Nombre del Departamento</label>
                    <input type="text" class="form-control" name="name" id="name" placeholder="" required
                           value="{{$department->name}}">
                </div>
                <div class="col-md-6 mb-4">
                    <label for="nombre">Correo Electrónico</label>
                    <input type="email" class="form-control" name="email" id="email" placeholder=""
                           value="{{$department->email}}">
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 mb-4">
                    <label for="Telefone">Telefono</label>
                    <input type="tel" class="form-control" name="telephone" id="telephone" placeholder=""
                           value="{{$department->telephone}}">
                </div>
                <div class="col-md-6 mb-4">
                    <label for="nombre">Responsable</label>
                    <select name="responsable" id="responsable" class="form-control" required>
                        @if($responsable->count() > 0)

                            <option value="{{$responsable->slug}}" selected>{{$responsable->name}}</option>
                        @else
                        <option selected> -- Seleccionar --</option>
                        @endif

                        @if($users->count() > 0)
                            @foreach($users as $user)
                                <option value="{{$user->slug}}">{{$user->name}}</option>
                            @endforeach
                            <option value="createResponsable">Crear un Responsable</option>

                        @endif
                    </select>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 mb-4">
                    <label for="Horario">Horario de entrada</label>
                    <input type="time" class="form-control" name="schedule_from"
                           id="schedule_from"  placeholder="" value="{{$department->schedule_from}}">
                </div>
                <div class="col-md-6 mb-4">
                    <label for="Horario salida">Horario de salida</label>
                    <input type="time" class="form-control" name="schedule_to"
                           id="schedule_to" placeholder=""  value="{{$department->schedule_to}}">
                </div>

            </div>

            <div class="row">
                <div class="col-md-12">
                    <label for="Descripción">Descripción</label>
                    <textarea class="form-control textarea" name="description"
                              id="description" placeholder="" >{{$department->description}}</textarea>
                </div>
            </div>
            <button type="submit" class="btn btn-submit uniform-bg">Actualizar</button>
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
        </form>
    </div>

@endsection
