<!--
=========================================================
* Paper Dashboard 2 - v2.0.1
=========================================================

* Product Page: https://www.creative-tim.com/product/paper-dashboard-2
* Copyright 2020 Creative Tim (https://www.creative-tim.com)

Coded by www.creative-tim.com

 =========================================================

* The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.
-->
<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <link rel="apple-touch-icon" sizes="76x76" href="{{asset('panel/img/apple-icon.png')}}">
  <link rel="icon" type="image/png" href="{{asset('panel/img/favicon.png')}}">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <title>
      @yield('panelTitle')
  </title>

  <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
  <!--     Fonts and icons     -->
  <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
  <link href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">
  <!-- CSS Files -->
    @yield('panelHead')
  <link href="{{asset('panel/assets/css/bootstrap.min.css')}}" rel="stylesheet" />
  <link href="{{URL::asset('panel/assets/css/paper-dashboard.css')}}" rel="stylesheet" />
    <link rel="stylesheet" href="{{asset('uniform/css/style.css')}}">
</head>

<body class="">
  <div class="wrapper ">
    <div class="sidebar" data-color="white" data-active-color="danger">
      <div class="logo">
        <a href="" class="simple-text logo-normal">

          <div class="logo-image-big">
              <img src="{{asset('logincss/image/logo-company.png')}}">
          </div>
        </a>
      </div>
      <div class="sidebar-wrapper">
        <ul class="nav">
          <li>        <h5>Incidencias</h5>
              <ul>
                  <li><a href="{{url('incidents')}}">Ver incidencias </a></li>
                  <?php if(session()->get('rol') == 'local'){ ?>
                  <li><a href="{{url('incidents/create')}}">Crear incidencias </a></li>
                  <?php } ?>
              </ul>
          </li>

            <li>
              <h5>Departmentos</h5>
              <ul>
                  <li><a href="{{url('department')}}"> Ver  Departamentos </a></li>
                  <?php if(session()->get('rol') == 'super_admin' or session()->get('rol') == 'admin'){ ?>
                  <li><a href="{{url('department/create')}}">Crear Departamentos </a></li>
                  <?php } ?>
                  <?php if(session()->get('rol') == 'empleado' or session()->get('rol') == 'admin'){ ?>
                  <li><a href="{{url('midepa')}}">Mi departamento </a></li>
                  <?php } ?>
              </ul>
          </li>
            <li>
              <h5>Empresas</h5>
              <ul>
                  <?php if(session()->get('rol') != 'local'){ ?>
                  <li><a href="{{url('company')}}"> Ver Empresas   </a></li>
                      <?php } ?>
                  <?php if(session()->get('rol') == 'super_admin' or session()->get('rol') == 'admin'){ ?>
                  <li><a href="{{url('company/create')}}">Crear Empresas </a></li>
                  <?php } ?>
              </ul>
          </li>
            <li>
              <h5>Locales</h5>
              <ul>
                  <?php if(session()->get('rol') != 'local'){ ?>
                  <li><a href="{{url('locales')}}"> Ver  Locales </a></li>
                      <?php } ?>
                      <?php if(session()->get('rol') == 'super_admin' or session()->get('rol') == 'admin'){ ?>
                  <li><a href="{{url('locales/create')}}">Crear Locakes </a></li>
                  <?php } ?>
              </ul>
          </li>

        </ul>
      </div>
    </div>
    <div class="main-panel" style="height: 100vh;">
      <!-- Navbar -->
      <nav class="navbar navbar-expand-lg navbar-absolute fixed-top navbar-transparent">
        <div class="container-fluid">
          <div class="navbar-wrapper">
            <div class="navbar-toggle">
              <button type="button" class="navbar-toggler">
                <span class="navbar-toggler-bar bar1"></span>
                <span class="navbar-toggler-bar bar2"></span>
                <span class="navbar-toggler-bar bar3"></span>
              </button>
            </div>
            <a class="navbar-brand" href="javascript:;">  @yield('panelTitle')</a>
          </div>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navigation" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-bar navbar-kebab"></span>
            <span class="navbar-toggler-bar navbar-kebab"></span>
            <span class="navbar-toggler-bar navbar-kebab"></span>
          </button>
          <div class="collapse navbar-collapse justify-content-end" id="navigation">
           <!--  <form>
              <div class="input-group no-border">
                <input type="text" value="" class="form-control" placeholder="Search...">
                <div class="input-group-append">
                  <div class="input-group-text">
                    <i class="nc-icon nc-zoom-split"></i>
                  </div>
                </div>
              </div>
            </form> -->
            <ul class="navbar-nav">
              <li class="nav-item btn-rotate dropdown">
                <a class="nav-link dropdown-toggle" href="http://example.com" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="nc-icon nc-single-02"></i>
                </a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
                <a  class="nav-link" href="{{url('profile')}}">Mi perfil</a>
                  <a class="dropdown-item" href="#">{{session()->get('tipo')}}</a>
                  <a class="dropdown-item" href="#">   {{session()->get('rol')}} </a>
                    <a class="dropdown-item" href="{{ route('logout') }}"
                       onclick="event.preventDefault();
                                       document.getElementById('logout-form').submit();">
                        {{ __('Logout') }}
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </div>
              </li>


            </ul>
          </div>
        </div>
      </nav>
      <!-- End Navbar -->
      <div class="content mb-5">

            @yield('panelContent')

      </div>
      <footer class="footer" style="position: absolute; bottom: 0; width: -webkit-fill-available;">
        <div class="container-fluid">
          <div class="row">
            <nav class="footer-nav">
              <ul>
                <li><a href="https://www.creative-tim.com" target="_blank"></a></li>
                <li><a href="https://www.creative-tim.com/blog" target="_blank"></a></li>
                <li><a href="https://www.creative-tim.com/license" target="_blank"></a></li>
              </ul>
            </nav>
            <div class="credits ml-auto">
              <span class="copyright">

              </span>
            </div>
          </div>
        </div>
      </footer>
    </div>
  </div>
  <!--   Core JS Files   -->
  <script src="{{asset('panel/assets/js/core/jquery.min.js')}}"></script>
  <script src="{{asset('panel/assets/js/core/popper.min.js')}}"></script>
  <script src="{{asset('panel/assets/js/core/bootstrap.min.js')}}"></script>
{{--  <script src="{{asset('panel/assets/js/plugins/perfect-scrollbar.jquery.min.js')}}"></script>--}}

  <!-- Chart JS -->
  <script src="{{asset('panel/assets/js/plugins/chartjs.min.js"')}}></script>
  <!--  Notifications Plugin    -->
  <script src="{{asset('panel/assets/js/plugins/bootstrap-notify.js"')}}></script>
  <!-- Control Center for Now Ui Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="{{asset('panel/assets/js/paper-dashboard.min.js')}}" type="text/javascript"></script>
    @yield('panelScript')

</body>
</html>
