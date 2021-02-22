<!DOCTYPE html>
<html lang="es">

<head>
    <title>Reporte de Incidencias por Local</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>
<body>
<div class="jumbotron text-center">

    <h1>Historial de incidencias por local</h1>
    <h4>Local {{$local->n_local}}, fecha: <?php echo date("j/d/Y"); ?> </h4>
    <p>Total de Incidencias:  <span style="color:#E72C2E"><b>{{$incidents->count()}} </b></span></p>
</div>


<div id="innerContent">
    @if( $incidents->count() !== 0  )
        <table class="table table-historial" border="1" id="tableIncidents">
            <thead>
            <tr>
                <th>Fecha</th>
                <th>Estado</th>
                <th>Creador</th>
                <th>Incidencia</th>
                <th>Descripción</th>
                <th>Responsable</th>
                <th>Departamento</th>

            </tr>
            </thead>
            <tbody>

                @foreach($incidents as $incident)
                    <?php $date = date('d/m/Y h:i a', strtotime($incident->incident_fecha)) ?>
                        <tr>
                            <td>{{$date}}</td>
                            <td>{{$incident->incident_state}}</td>
                            <td>{{$incident->creador_name . " " . $incident->creador_lastname}}</td>
                            <td>{{$incident->incident_name}}</td>
                            <td>{{$incident->incident_description}}</td>
                            <td>{{$incident->res_name . " "}} {{$incident->res_lastname}}</td>
                            <td>{{$incident->depart_name}}</td>
                        </tr>

                @endforeach
            </tbody>
        </table>
        @else
            <h5>No hay Incidencias disponible para este local</h5>
    @endif
    </div>



</body>
</html>


