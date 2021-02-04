<!DOCTYPE html>
<html lang="es">
<head>
    <title>Panel de Bienvenida</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>
<body>

<div class="jumbotron text-center">
    <img src="{{asset('logincss/image/logo-company.png')}}" class="mb-4" alt="sambil logo">
    <h1>Bienvenido  {{auth()->user()->name}}  {{auth()->user()->lastname}}</h1>
    <h2>Al sistema de Gestión de incidencias SOSAM</h2>
    <p>Por favor escoge la empresa que vas a gestionar</p>
</div>

<div class="container">
    <div class="row justify-content-md-center">
        @if($departments->count() !== 0)
            @foreach($departments as $department)
                <div class="col-md-4 ">
                    <div class="card p-3">
                        <h4 class="company-title text-center mb-4">{{$department->name}}</h4>
                        <a  href="{{url('setDepartment/' . $department->id)}}" class="btn btn-success ">Elegir</a>
                    </div>
                </div>

            @endforeach
        @endif

    </div>
</div>

</body>
</html>
