@extends('app')
@section('panelTitle', 'Historial de  Incidencias')
@section('panelHead')
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.10.23/rr-1.2.7/sp-1.2.2/sl-1.3.1/datatables.min.css"/>
@endsection
@section('panelContent')
    <div id="innerContent">
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
            <tbody>
                <tr>
                    <td>Otorgamiento de  permisos para remodelación</td>
                    <td>Local L-154</td>
                    <td>Higiene y seguridad</td>
                    <td>En Progreso</td>
                    <td>En Progreso</td>
                </tr>
            </tbody>
        </table>
    </div>
@endsection
@section('panelScript')
    <script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.10.23/rr-1.2.7/sp-1.2.2/sl-1.3.1/datatables.min.js"></script>
@endsection
