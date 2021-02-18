@extends('app')
@section('panelTitle', 'Historial de  Incidencias')
@section('panelHead')
@endsection
@section('panelContent')
    <div id="auditoriasInit">
        <table class="table" id="auditoriasInicidentTable">
            <thead>
            <tr>
                <th>Fecha</th>
                <th>Log</th>
                <th>Creador</th>
                <th>Local</th>
                <th>Descripción</th>
                <th>Acciones</th>
            </tr>
            @if($logs->count() !== 0 )
                <?php $i = 0; ?>
                <tbody>
                @foreach($logs as $log)
             <?php  $date = date('d M \d\e Y - h:ma', strtotime($log->fecha)) ?>
                    <tr>
                        <td data-count="{{$i}}">{{$date}}</td>
                        <td>{{$log->title}}</td>
                        <td>{{$log->creador_name}} {{ " " . $log->creador_lastname}}</td>
                        <td>{{$log->n_local}}</td>
                        <td>{{$log->description}}</td>
                        <td><a href="{{url('show-audi-incident/'.$log->incident_id)}}" class="viewMore btn" id="viewMore"  title="Ver más">
                                <i class="fas fa-plus"> </i></a></td>
                    </tr>
                        <?php $i++; ?>
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
            jQuery('#auditoriasInicidentTable').DataTable({
                "order": [[1, "desc"]],
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
