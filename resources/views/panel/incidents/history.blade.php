@extends('app')
@section('panelTitle', 'Historial de  Incidencias')
@section('panelContent')
    <div id="innerContent">
        <h2>Historial de Incidencias del local </h2>
        <table class="table table-historial" border="1">
            <thead>
                <tr>
                    <th>Título</th>
                    <th>Levantada por:</th>
                    <th>Departamento</th>
                    <th>Estado</th>
                    <th>Ver más</th>
                </tr>
            </thead>
        </table>
    </div>
@endsection
