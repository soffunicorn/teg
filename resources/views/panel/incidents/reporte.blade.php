<!DOCTYPE html>
<html lang="en">

<head>
    <title>Bootstrap Example</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <style>
        html{
            margin:0;
        }
        body{
            font-family: 'Helvetica';
        }
    </style>


</head>
<body>

<div class="jumbotron text-center">

    <h1>Incidencia {{$Incidents[0]->name}}</h1>
    <h4>Empresa: {{$compa[0]->name}}  </h4>
    <h6>fecha del reporte: <span style="color:#a71d2a;"><b><?php echo date("j/m/Y"); ?></b></span></h6>
</div>


<div id="innerContent"  style="padding:0 10px">
    <table class="table table-historial" border="1" id="tableIncidents" >
        <thead>
        <tr>
            <th>Fecha de creación</th>
            <th>Descripción</th>
            <th>Estado</th>
            <th>Responsable:</th>
            <th>Departamento:</th>
            <th>Local</th>

        </tr>
        </thead>
        <tbody>
        @if( !empty($Incidents) )
            @foreach($Incidents as $Incident)
                <?php $date = date('d/m/Y h:i a', strtotime($Incident->created_at))   ?>
                <tr>
                    <td>{{$date}}</td>
                    <td>{{$Incident->description}}</td>
                    <td>{{$Incident->state}}</td>
                    <td >{{!empty($Incident->responsable) ? $Incident->responsable :  'No se ha asignado'}}</td>
                    <td>{{$Incident->department_name}}a
                    <td>{{$Incident->n_local}}</td>




                </tr>


            @endforeach
        @endif
        </tbody>
    </table>
</div>


</body>
</html>


