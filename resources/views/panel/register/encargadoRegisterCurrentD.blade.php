@extends('app')
@section('panelTitle', 'Registro de Empleados Sambil')
@section('panelHead')
    <link href="{{asset('panel/assets/css/localregister.css')}}" rel="stylesheet"/>
    <link href="{{asset('uniform/css/style.css')}}" rel="stylesheet"/>
@endsection
@section('panelContent')
    <div class="form-registro">
        <form method="POST" action="{{{url('/workers/store/CurrentD')}}}">
            @csrf
        <div class="row">
            <div class="col-md-12 mb-4">

                <div class="row">

                    <div class="col-md-6">
                        <label for="Nombre">Nombre: </label>
                        <input type="text" class="form-control" name="name" id="name"
                               placeholder="">
                    </div>

                    <div class="col-md-6">
                        <label for="Apellido">Apellido: </label>
                        <input type="text" class="form-control" name="lastname" name="lastname"
                               placeholder="">
                    </div>

                    <div class="col-md-6 mb-4 mt-4">
                        <label for="Teléfono">Teléfono</label>
                        <input type="number" class="form-control" name="phone"  id="phone" placeholder="ej: 04145965">
                    </div>

                    <div class="col-md-6 mb-4 mt-4">
                        <label for="Córreo Eléctronico">Córreo Eléctronico</label>
                        <input type="email" class="form-control" name="mail" id="mail" placeholder="mail@mail.com">
                    </div>

                    <div class="col-md-6 mb-4 mt-4">
                        <label for="rol">Rol</label>
                        <select name="rol" id="rol" class="form-control">
                            <option selected> --- Seleccionar ---</option>
                            <option value="bossArea">Jefe de departamento </option>
                            <option value="employee">Empleado </option>

                        </select>
                    </div>
                    <div class="col-md-6 mb-4 mt-4 hidden">
                        <label for="rol">Departamento</label>

                            @if( !empty($department) )

                                <input type="hidden" value="{{$department->slug}}"  name="department" id="department"  />
                                <input type="text" value="{{$department->name}}" disabled="" class="form-control"  />

                            @endif

                    </div>

                </div>
            </div>
        </div>

        <div class="row mb-4">
            <button type="submit" id="localSubmit" class="btn btn-submit uniform-bg mx-auto d-block">Registrar
            </button>
        </div>
            @if( session()->has('fallo') )
                <div class="alert alert-warning">
                    {{session()->get('fallo')}}
                </div>
            @endif


        @if ($errors->any())
            <div class="alert alert-danger">
            @foreach ($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
            </div>
        @endif
        </form>
    </div>


@endsection
@section('panelScript')
    <script>
        jQuery(document).ready(function ($) {
            jQuery('#rol').on('change', function (){
                if(jQuery(this).val() === 'bossArea' || jQuery(this).val() === 'employee'  ){
                    jQuery('#department').closest('.col-md-6').removeClass('hidden');
                }else{
                    jQuery('#department').closest('.col-md-6').addClass('hidden');
                }
            });
        });

    </script>
@endsection
