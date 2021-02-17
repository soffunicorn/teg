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
</head>
<body>

<div class="jumbotron text-center">

    <h1>Historial de incidencias</h1>
    <p>Compañia {{$compa->compañia}} fecha: <?php echo date("j, n, Y"); ?> </p>
</div>


<div id="innerContent">
    <table class="table table-historial" border="1" id="tableIncidents">
        <thead>
        <tr>
            <th>Título</th>
            <th>Responsable:</th>
            <th>Local</th>

        </tr>
        </thead>
        <tbody>
        @if( !empty($Incidents) )
            @foreach($Incidents as $Incident)
                <tr>
                    <td class="td-name">{{$Incident->name}}</td>
                    <td >{{$Incident->responsable}}</td>
                    <td>{{$Incident->n_local}}</td>




                </tr>


            @endforeach
        @endif
        </tbody>
    </table>
</div>


</body>
</html>


