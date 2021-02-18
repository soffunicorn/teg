<!DOCTYPE html>
<html lang="es">

<head>
    <title>Reporte de Incidencias por Departamento</title>
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
    </style>

</head>
<body>
<div class="jumbotron text-center">

    <?php $img_path = '\panel\assets\img\barquisimeto.png'; ?>
    <img src="{{  public_path() . $img_path }}" width="100px" height="auto"  class="mb-3" alt="SOSAM SYSTEM">

    <h1>Historial de incidencias por Departamento</h1>
    <h4>Departamento: {{$department->name}}, fecha: <?php echo date("j/d/Y"); ?> </h4>
    <p>Total de Incidencias:  <span style="color:#E72C2E"><b>{{$incidents->count() }} </b></span></p>
</div>


<div id="innerContent" style="padding: 0 10px">
    @if( $incidents->count() !== 0  )
        <table class="table table-historial" border="1" id="tableIncidents">
            <thead>
            <tr>
                <th>Fecha de Creación</th>
                <th>Estado</th>
                <th>Responsable</th>
                <th>Incidencia</th>
                <th>Descripción</th>
            </tr>
            </thead>
            <tbody>

            @foreach($incidents as $incident)
                <?php $date = date('d/m/Y h:i a', strtotime($incident->created_at)) ?>
                <tr>
                    <td>{{$date}}</td>
                    <td>{{$incident->state}}</td>
                    <td>{{$incident->res_name . " " . $incident->res_lastname}}</td>
                    <td>{{$incident->name}}</td>
                    <td>{{$incident->description}}</td>
                </tr>

            @endforeach
            </tbody>
        </table>
    @else
        <h5>No hay Incidencias disponible para este departamento</h5>
    @endif
</div>



</body>
</html>


