@extends('app')
@section('panelTitle', 'Historial de  Incidencias')
@section('panelHead')
    <link rel="stylesheet" type="text/css"
          href="https://cdn.datatables.net/v/bs4/dt-1.10.23/rr-1.2.7/sp-1.2.2/sl-1.3.1/datatables.min.css"/>
@endsection
@section('panelContent')
    <div id="innerContent">
        <table class="table table-historial" border="1" id="tableIncidents">
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
                <td>Otorgamiento de permisos para remodelación</td>
                <td>Jhon Snow</td>
                <td>Obras Civiles</td>
                <td>En Progreso</td>
                <td>
                    <div class="rowDepartment">
                        <form action="" method="">
                            <button class="viewMore btn " id="viewMore" data-id=""
                                    data-toggle="tooltip" data-placement="bottom" title="Ver más"><i
                                    class="fas fa-plus"></i></button>
                        </form>

                        <a href=""
                           class="btn btn-sam-blue btn-edit"><i
                                class="fas fa-edit" data-toggle="tooltip" data-placement="bottom"
                                title="Editar"></i></a>

                        <form method="POST" action=""
                              id="formDelete" name="formDelete">
                            @csrf
                            @method('DELETE')
                            <button type="button" class="btn btn-sam-red btn-delete" data-name=""><i
                                    class="fas fa-trash"></i></button>
                            <button type="submit" class="btn-real-submit" data-toggle="tooltip"
                                    data-placement="bottom" title="Borrar" style="opacity: 0;"></button>
                        </form>


                    </div>

                </td>
            </tr>

            <tr>
                <td>Inspección de local de feria de comida</td>
                <td>Federico Ricón</td>
                <td>Higiene y seguridad</td>
                <td>En progreso</td>
                <td>
                    <div class="rowDepartment">
                        <form action="" method="">
                            <button class="viewMore btn " id="viewMore" data-id=""
                                    data-toggle="tooltip" data-placement="bottom" title="Ver más"><i
                                    class="fas fa-plus"></i></button>
                        </form>

                        <a href=""
                           class="btn btn-sam-blue btn-edit"><i
                                class="fas fa-edit" data-toggle="tooltip" data-placement="bottom"
                                title="Editar"></i></a>

                        <form method="POST" action=""
                              id="formDelete" name="formDelete">
                            @csrf
                            @method('DELETE')
                            <button type="button" class="btn btn-sam-red btn-delete" data-name=""><i
                                    class="fas fa-trash"></i></button>
                            <button type="submit" class="btn-real-submit" data-toggle="tooltip"
                                    data-placement="bottom" title="Borrar" style="opacity: 0;"></button>
                        </form>


                    </div>


                </td>
            </tr>
            </tbody>
        </table>
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
