@extends('app')
@section('panelTitle', 'Historial de  Auditorias')
@section('panelHead')
@endsection
@section('panelContent')
    <div id="auditoriasInit">
        <table class="table" id="auditoriasTable">
            <thead>
                <tr>
                    <th>Fecha</th>
                    <th>Acción</th>
                    <th>Nombre del usuario</th>
                    <th>Correo del usuario</th>
                    <th>Descripción</th>
                </tr>
                @if($logs->count() !== 0 )
                    <tbody>
                        @foreach($logs as $log)
                            <?php  $date = date('d M \d\e Y - h:ma', strtotime($log->log_fecha)) ?>
                            <tr>
                                <td>{{$date}}</td>
                                <td>{{$log->title}}</td>
                                <td>{{$log->user_name}} {{ " " . $log->user_lastname}}</td>
                                <td>{{$log->user_mail}}</td>
                                <td>{{$log->description}}</td>
                            </tr>

                        @endforeach
                    </tbody>
                @endif
            </thead>
        </table>
    </div>



@endsection
@section('panelScript')
    <script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.10.23/rr-1.2.7/sp-1.2.2/sl-1.3.1/datatables.min.js"></script>
    <script>
        jQuery(document).ready(function () {
            jQuery('#auditoriasTable').DataTable({
                "order": [[0, "desc"]],
                searchPanes: {
                    viewTotal: true,
                    columns: [3]
                },
                "paging": true,
                "ordering": true,
                "pageLength": 10,
                "language": {
                    "info": "Total de Incidencias _TOTAL_ ",
                    "search": "Búscar :",
                    "paginate": {
                        "previous": "<",
                        "next": ">"
                    },
                    "lengthMenu": "Mostrar _MENU_ resultados por página",
                },
            });
        });
    </script>


@endsection
