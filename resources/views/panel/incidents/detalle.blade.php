@extends('app')
@section('panelTitle', 'Detalle')
@section('panelHead')
    <link rel="stylesheet" type="text/css"
          href="https://cdn.datatables.net/v/bs4/dt-1.10.23/rr-1.2.7/sp-1.2.2/sl-1.3.1/datatables.min.css"/>
@endsection
@section('panelContent')
<div class="row">
    <div class="col-md-12 row">
      <div class="col-md-6">
     <h2>Titulo de la Incidencia</h2>
      </div>
      <div class="col-md-3">
          Estado: Activo
      </div>
        <div class="col-md-3">
            Fecha de inicio: 20/12/2019
        </div>
        <div class="col-md-12">
        <label>Descripcion:</label> <p>
            "But I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and I will give you a complete account of the system, and expound the actual teachings of the great explorer of the truth, the master-builder of human happiness. No one rejects, dislikes, or avoids pleasure itself, because it is pleasure, but because those who do not know how to pursue pleasure rationally encounter consequences that are extremely painful. Nor again is there anyone who loves or pursues or desires to obtain pain of itself, because it is pain, but because occasionally circumstances occur in which toil and pain can procure him some great pleasure. To take a trivial example, which of us ever undertakes laborious physical exercise, except to obtain some advantage from it? But who has any right to find fault with a man who chooses to enjoy a pleasure that has no annoying consequences, or one who avoids a pain that produces no resultant pleasure?"
        </p>
        </div>
    </div>

    <div class="col-md-12 card card-body" style="background: #FFFFFF">
        <hr>
    <h3>Comentarios</h3>
    <div id="innerContent">
        <table class="table table-historial" border="1" id="tableIncidents">
            <thead>
            <tr>
                <th>Autor</th>
                <th>Mensaje</th>
                <th>Fecha</th>
            </tr>
            </thead>
            <tbody>
            <tr>

                <td>Jhon Snow</td>
                <td>Otorgamiento de permisos para remodelación</td>
                <td>10/01/02</td>
            </tr>
            </tbody>
        </table>
    </div>
    </div>
    </div>
@endsection
@section('panelScript')
    <script type="text/javascript"
            src="https://cdn.datatables.net/v/bs4/dt-1.10.23/rr-1.2.7/sp-1.2.2/sl-1.3.1/datatables.min.js"></script>
    <script>
        jQuery(document).ready(function () {
            jQuery('#tableIncidents').DataTable({
                "order": [[0, "asc"]],
                searchPanes: {
                    viewTotal: true,
                    columns: [3]
                },
                "paging": false,
                "ordering": true,
                "pageLength": 20,
                "language": {
                    "info": "Total de Incidencias _TOTAL_ ",
                    "search": "Búscar :",
                    "paginate": {
                        "previous": "<",
                        "next": ">"
                    },
                    "lengthMenu": "Mostrar _MENU_ resultados por página",
                },
                columnDefs: [
                    searchPanes: {
                options : [
                         {
                        label: 'Estado',
                        value: function(rowData, rowIdx) {
                            return rowData[4] < 20;
                        }
                    },
                ]
                }],
            });
        });
    </script>

@endsection
