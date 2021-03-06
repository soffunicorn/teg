<!doctype html>
<html lang="es">

<head>
    <meta charset="utf-8" />
    <link rel="icon" type="image/png" href="{{asset('panel/img/favicon.png')}}">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
    <!-- CSS Files -->
    <link href="{{asset('panel/assets/css/bootstrap.min.css')}}" rel="stylesheet" />
    <link rel="stylesheet" href="{{asset('logincss/login.css')}}">
    <link rel="stylesheet" href="{{asset('uniform/css/style.css')}}">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title>
        @yield('loginTitle')
    </title>
</head>
<body>
<div class="container-fluid px-1 px-md-5 px-lg-1 px-xl-5 py-5 mx-auto">
    <div class="card card0 border-0">
        <div class="row d-flex">
            <div class="col-lg-6">
                <div class="card1 pb-5">
                    <div class="row"> <img src="{{asset('logincss/image/logo-company.png')}}" class="logo"> </div>
                    <div class="row px-3 justify-content-center mt-4 mb-5 border-line"> <img src="{{asset('logincss/image/helpdd.jpg')}}" class="main-image"> </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="card2 card border-0 px-4 py-5">
                    <div class="row mb-4 px-3">
                        <h2 class="mb-0 text-center mt-2 m-title">Iniciar sesión</h2>
                    </div>
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                    <div class="row px-3 mb-4">
                        <div class="line"></div> <small class="or text-center"><i class="fas fa-award c-award"></i></small>
                        <div class="line"></div>
                    </div>
                    <div class="row px-3">
                         <input class="mb-4 @error('email') is-invalid @enderror" type="text" name="email" placeholder="Correo Electrónico" value="{{ old('email') }}" required autocomplete="email" autofocus>
                        @error('email')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror
                    </div>
                    <div class="row px-3">
                        <input type="password" class=" @error('password') is-invalid @enderror"  name="password" placeholder="Contraseña"  required autocomplete="current-password">
                        @error('password')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror

                    </div>
                    <div class="row px-3 mb-4">

                        <div class="custom-control custom-checkbox custom-control-inline">
                            <input class="" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                        </div>

                       <a href="{{ route('password.request') }}" class="ml-auto mb-0 text-sm">¿Olvidaste la contraseña?</a>
                    </div>
                    <div class="row mb-3 px-3"> <button type="submit" class="btn  uniform-bg btn-submit text-center">Iniciar sesión</button> </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="uniform-bg py-4">
            <div class="row px-3"> <small class="ml-4 ml-sm-5 mb-2">Copyright &copy; 2021. Todos los derechos reservados.</small>
                <div class="social-contact mr-5 ml-sm-auto"> <small >Desarrollado por: Sofia Singer</small></div>
            </div>
        </div>
    </div>
</div>

<!--   Core JS Files   -->
<script src="{{asset('panel/assets/js/core/jquery.min.js')}}"></script>
<script src="{{asset('panel/assets/js/core/popper.min.js')}}"></script>
<script src="{{asset('panel/assets/js/core/bootstrap.min.js')}}"></script>
<script src="https://kit.fontawesome.com/80fdb2ae94.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js"></script>

</body>
</html>

