@extends('app')
@section('panelTitle', 'Crear Incidencias')
@section('panelHead')
@endsection
@section('panelContent')
    <div class="form-incidents">
        <form method="POST" action="{{url('/incidents')}}">
            <div class="row mb-3">
                <div class="col-12 col-md-12">
                    <label for="title"> Título de la incidencia</label>
                    <input type="text" class="form-control" name="name" id="name"/>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-12 col-md-6">
                    <label for="title"> Departamento</label>
                    <select name="id_department" id="id_department" class="form-control">
                        <option selected>--- Seleccionar ---</option>
                        @if( !empty($departments) )
                            @foreach($departments as $department)
                                <option value="{{$department->id}}">{{$department->name}} </option>
                            @endforeach
                        @endif
                    </select>
                </div>
                <div class="col-12 col-md-6">
                    <label for="title"> Prioridad</label>
                    <select name="priority" id="priority" class="form-control">
                        <option value="" selected >-- Seleccionar --</option>
                        <option value="baja">Baja</option>
                        <option value="media">Media</option>
                        <option value="alta">Alta</option>
                    </select>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-12 col-md-12">
                    <label for="title"> Descripción</label>
                    <textarea name="description" id="description" class="textarea form-control" ></textarea>
                </div>
            </div>
            <input type="hidden" value="{{$local}}" name="id_local">

            <button type="submit" class="btn btn-submit uniform-bg" id="btn-sumit">Reportar incidencias</button>
        </form>
    </div>
@endsection
