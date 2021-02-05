@extends('app')
@section('panelTitle', 'Historial de  Incidencias')
@section('panelHead')
    <link rel="stylesheet" type="text/css"
          href="https://cdn.datatables.net/v/bs4/dt-1.10.23/rr-1.2.7/sp-1.2.2/sl-1.3.1/datatables.min.css"/>
@endsection
@section('panelContent')
    <div id="innerContent">
        <table class="table table-historial" border="1" id="tableIncidents">
            <thead>
            <tr>
                <th>Título</th>
                <th>Levantada por:</th>
                <th>Departamento</th>
                <th>Ver más</th>
            </tr>
            </thead>
            <tbody>
            @if( !empty($Incidents) )
                            @foreach($Incidents as $Incident)


            <tr>
                <td>{{$Incident->name}}</td>
                <td>{{$Incident->responsable}}</td>
                <td>{{$Incident->n_local}}</td>

                <td>


                        <a href="{{url('incidents/'.$Incident->slug)}}" class="viewMore btn" id="viewMore"  title="Ver más">
                            <i class="fas fa-plus"> </i></a>

                    <?php if(session()->get('rol') == 'empleado' or session()->get('rol') == 'admin'){ ?>
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal{{$Incident->id}}">
                        Elegir responsable
                    </button>

                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#estado{{$Incident->id}}">
                        Cambia de estado
                    </button>
                    <?php } ?>

                    <div class="modal" id="myModal{{$Incident->id}}">
                        <div class="modal-dialog">
                            <form action="{{url('/elegir')}}" METHOD="POST">
                                <div class="modal-content">
                                @csrf
                                <!-- Modal Header -->
                                    <div class="modal-header">
                                        <h4 class="modal-title">Responsable</h4>
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
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
                                        <input type="hidden" id="incidentId" name="incidentId" value="{{$Incident->slug}}">
                                        <input type="hidden" id="userId" name="userId"  value="{{\Illuminate\Support\Facades\Auth::user()->id}}">
                                    </div>

                                    <!-- Modal footer -->
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-submit" >Enviar</button>
                                        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                                    </div>

                                </div>
                            </form>
                        </div>
                    </div>


                    <div class="modal" id="estado{{$Incident->id}}">
                        <div class="modal-dialog">
                            <form action="{{url('/estados')}}" METHOD="POST">
                                <div class="modal-content">
                                @csrf
                                <!-- Modal Header -->
                                    <div class="modal-header">
                                        <h4 class="modal-title">Estados</h4>
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    </div>

                                    <!-- Modal body -->
                                    <div class="modal-body">
                                        <select name="estado" class="form-control">
                                            @if( !empty($estados) )
                                                @foreach($estados as $estado)
                                                    <option value="{{$estado->id}}"> {{$estado->name}}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                        <input type="hidden" id="incidentId" name="incidentId" value="{{$Incident->slug}}">
                                        <input type="hidden" id="userId" name="userId"  value="{{\Illuminate\Support\Facades\Auth::user()->id}}">
                                    </div>

                                    <!-- Modal footer -->
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-submit" >Enviar</button>
                                        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                                    </div>

                                </div>
                            </form>
                        </div>
                    </div>

                    <!--    <a href="{{url('incidents/'.$Incident->slug.'/edit')}}"
                           class="btn btn-sam-blue btn-edit"><i
                                class="fas fa-edit" data-toggle="tooltip" data-placement="bottom"
                                title="Editar"></i></a>-->









                </td>


            </tr>


            @endforeach
                        @endif
            </tbody>
        </table>
    </div>
@endsection
@section('panelScript')
    <script type="text/javascript"
            src="https://cdn.datatables.net/v/bs4/dt-1.10.23/rr-1.2.7/sp-1.2.2/sl-1.3.1/datatables.min.js"></script>
    <script>
        jQuery(document).ready(function () {
            jQuery('#tableIncidents').DataTable({
                "order": [[0, "asc"]],
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
        });
    </script>

@endsection
