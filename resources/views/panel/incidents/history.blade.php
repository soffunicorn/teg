@extends('app')
@section('panelTitle', 'Historial de  Incidencias')
@section('panelHead')
    <link rel="stylesheet" type="text/css"
          href="https://cdn.datatables.net/v/bs4/dt-1.10.23/rr-1.2.7/sp-1.2.2/sl-1.3.1/datatables.min.css"/>
@endsection
@section('panelContent')
    <div id="innerContent">
        <div class="leyendaWrapper">
            <p>Leyenda: de Botones de Acción</p>
            <div class="rowLeyenda mb-5">
             <button type="button"  class="viewMore btn btn-leyenda">Ver Detalle de la incidencia</button>

                <?php if(session()->get('rol') == 'empleado' or session()->get('rol') == 'admin'){ ?>
                <button type="button" class="btn btn-primary btn-leyenda">Elegir responsable  <i class="fas fa-user-check"></i></button>
                <button type="button" class="btn  btn-success btn-leyenda">Cambiar de estado  <i class="fas fa-pencil-alt"></i></button>
                <?php } ?>
                <button type="button"  class="btn btn-leyenda btn-reporte">Crear reporte de la Incidencia <i class="fas fa-file-download"></i></button>
            </div>
        </div>

        <table class="table table-historial" border="1" id="tableIncidents">
            <thead>
            <tr>
                <th>Fecha</th>
                <th>Título</th>
                <th>Responsable:</th>
                <th>Estado</th>
                <th>Local</th>
                <th>Acciones</th>
            </tr>
            </thead>
            <tbody>
            @if( !empty($Incidents) )
                @foreach($Incidents as $Incident)
                    <?php $date = date('d/m/Y h:i a', strtotime($Incident->created_at)) ; ?>
                    <tr>
                        <td>{{$date}}</td>
                        <td class="td-name">{{$Incident->name}}</td>
                        <td>{{$Incident->responsable}}</td>
                        <td>{{$Incident->state}}</td>
                        <td>{{$Incident->n_local}}</td>

                        <td>
                            <div class="d-flex wrapper-button">

                            <a href="{{url('incidents/'.$Incident->slug)}}" class="viewMore btn" id="viewMore"
                               title="Ver más">
                                <i class="fas fa-plus"> </i></a>

                            <?php if(session()->get('rol') == 'empleado' or session()->get('rol') == 'admin'){ ?>
                            <button type="button" class="btn btn-primary" data-toggle="modal"
                                    data-target="#myModal{{$Incident->id}}">
                                <i class="fas fa-user-check"></i>
                            </button>
                            @if($Incident->slug !== 'finalizada')
                                <button type="button" class="btn  btn-success" data-toggle="modal"
                                        data-target="#estado{{$Incident->id}}">
                                    <i class="fas fa-pencil-alt"></i>
                                </button>
                            @endif

                            <?php } ?>

                            @if(session()->get('rol') == 'admin' || session()->get('rol') === 'super_admin' )
                                <button type="button" class="btn btn-danger btn-d-incidents text-white"
                                        data-id="{{$Incident->id}}"><i class="fas fa-trash"></i></button>
                            @endif

                            <div class="modal" id="myModal{{$Incident->id}}">
                                <div class="modal-dialog">
                                    <form action="{{url('/elegir')}}" METHOD="POST">
                                        <div class="modal-content">
                                        @csrf
                                        <!-- Modal Header -->
                                            <div class="modal-header">
                                                <h4 class="modal-title">Responsable</h4>
                                                <button type="button" class="close" data-dismiss="modal">&times;
                                                </button>
                                            </div>

                                            <!-- Modal body -->
                                            <div class="modal-body">
                                                <select name="responsable" class="form-control">
                                                    @if( !empty($users) )
                                                        @foreach($users as $user)
                                                            <option value="{{$user->id}}"> {{$user->name}}</option>
                                                        @endforeach
                                                    @endif
                                                </select>
                                                <input type="hidden" id="incidentId" name="incidentId"
                                                       value="{{$Incident->slug}}">
                                                <input type="hidden" id="userId" name="userId"
                                                       value="{{\Illuminate\Support\Facades\Auth::user()->id}}">
                                            </div>

                                            <!-- Modal footer -->
                                            <div class="modal-footer">
                                                <button type="submit" class="btn btn-submit">Enviar</button>
                                                <button type="button" class="btn btn-danger" data-dismiss="modal">
                                                    Cancelar
                                                </button>
                                            </div>

                                        </div>
                                    </form>
                                </div>
                            </div>


                            <div class="modal" id="estado{{$Incident->id}}">
                                <div class="modal-dialog">
                                    <form action="{{url('estados')}}" METHOD="POST">
                                        <div class="modal-content">
                                        @csrf
                                        <!-- Modal Header -->
                                            <div class="modal-header">
                                                <h4 class="modal-title">Estados</h4>
                                                <button type="button" class="close" data-dismiss="modal">&times;
                                                </button>
                                            </div>

                                            <!-- Modal body -->
                                            <div class="modal-body">
                                                <select name="estado" class="form-control" id="stateSelect">
                                                    @if( $estados->count() != 0 )
                                                        @foreach($estados as $estado)
                                                            <option value="{{$estado->id}}"> {{$estado->name}}</option>
                                                        @endforeach
                                                    @endif
                                                </select>
                                                <input type="hidden" id="incidentId" name="incidentId"
                                                       value="{{$Incident->slug}}">
                                                <input type="hidden" id="userId" name="userId"
                                                       value="{{\Illuminate\Support\Facades\Auth::user()->id}}">
                                            </div>

                                            <!-- Modal footer -->
                                            <div class="modal-footer">
                                                <button type="submit" class="btn btn-submit">Enviar</button>
                                                <button type="button" class="btn btn-danger" data-dismiss="modal">
                                                    Cancelar
                                                </button>
                                            </div>

                                        </div>
                                    </form>
                                </div>
                            </div>

                        <!--    <a href="{{url('incidents/'.$Incident->slug.'/edit')}}"
                           class="btn btn-sam-blue btn-edit"><i
                                class="fas fa-edit" data-toggle="tooltip" data-placement="bottom"
                                title="Editar"></i></a>-->

                            <a class="btn btn-leyenda btn-reporte" target="_blank" href="{{ url('/reportedeincidencia/' . $Incident->id ) }}"> <i class="fas fa-file-download"></i></a>
                            </div>
                        </td>


                    </tr>


                @endforeach
            @endif
            </tbody>
        </table>
        @if(session()->has('errorState'))
            <div id="errorState" class="hidden">{{ session()->get('errorState') }} </div>
        @endif
    </div>
@endsection
@section('panelScript')
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="https://kit.fontawesome.com/8a63346959.js" crossorigin="anonymous"></script>
    <script type="text/javascript"
            src="https://cdn.datatables.net/v/bs4/dt-1.10.23/rr-1.2.7/sp-1.2.2/sl-1.3.1/datatables.min.js"></script>
    <script>
        jQuery(document).ready(function () {
            jQuery('#tableIncidents').DataTable({
                "order": [[0, "desc"]],
                searchPanes: {
                    viewTotal: true,
                    columns: [3]
                },
                "paging": false,
                "ordering": true,
                "pageLength": 20,
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

            //borrar

            $('.btn-d-incidents').on('click', function () {
                let id = $(this).data('id');
                let tr = $(this).closest('tr');
                let name = $(tr).find('.td-name').html();
                var _this = $(this);

                swal({
                    title: "¿Estas seguro que quieres Eliminar la Incidencia. " + name + "?",
                    text: "Una vez eliminado no hay forma de reestablecerlo",
                    icon: "warning",
                    buttons: ["Cancelar", "Aceptar"],
                    dangerMode: true,
                })
                    .then((willDelete) => {
                        if (willDelete) {
                            $.ajax({
                                url: '{{url('/incidents')}}' + '/' + id,
                                dataType: 'JSON',
                                type: 'DELETE',
                                success: function (data) {
                                    if (data.status === 'ok') {
                                        $(tr).remove();
                                    }

                                }
                            });

                        }
                    });


            });
            if($('#errorState').text().length > 0){

                swal({
                    title: "¡Atención!",
                    text: $('#errorState').text(),
                    icon: "warning",
                    buttons: ["Aceptar"],
                    dangerMode: true,
                })
            }

        });


    </script>

@endsection
