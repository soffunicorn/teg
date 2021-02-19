@extends('app')
@section('panelTitle', 'Detalle')
@section('panelHead')
    <link rel="stylesheet" type="text/css"
          href="https://cdn.datatables.net/v/bs4/dt-1.10.23/rr-1.2.7/sp-1.2.2/sl-1.3.1/datatables.min.css"/>
@endsection
@section('panelContent')
    <div class="bg-white details-wrapper">

        <div class="row">
            <div class="col-md-12">
                <h2>{{$Incidents->name}}</h2>
            </div>
        </div>

        <div class="row mb-4">
            <div class="col-md-4">
                <p class="meta-data"><b>Estado: </b> {{$Incidents->state}}</p>
            </div>
            <div class="col-md-4">
                <p class="meta-data"><b>Fecha de inicio:</b> {{$Incidents->created_at}}</p>
            </div>
            <div class="col-md-4">
                <p class="meta-data"><b>Local:</b> {{$Incidents->n_local}}</p>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <p class="meta-data"><b>Descripcion:</b></p>
                <p>
                    {{$Incidents->description}}
                </p>
            </div>
        </div>


        <hr>


        <div class="row mt-5 mb-5 w-100">
            <div class="col-md-6">
                <h3>Comentarios</h3>
            </div>
            <div class="col-md-6">
                <button type="button" class="btn btn-primary float-right" data-toggle="modal" data-target="#myModal">
                    Hacer un comentario
                </button>
            </div>
        </div>
        <div class="row" style="background: #FFFFFF">
            @if( $comments->count() > 0 )

                @foreach($comments as $comment)
                    <div class="comments-box mb-5 col-12">
                        <div class="inner-comments-box row">
                            <div class="col-md-2">
                                <div class="comments-image">

                                    <img src="{{ !empty(auth()->user()->avatar) ? asset('panel/assets/uploads/img/' . auth()->user()->avatar) :asset('panel/assets/img/default-avatar.png')}}" class="mini-avatar"
                                         alt="avatar">
                                </div>
                            </div>
                            <div class="col-md-10">
                                <div class="comments-description">
                                    <div class="d-flex flex-row justify-content-between">
                                        <p class="date"><b>Fecha:</b>
                                            {{ $comment->created_at  }}

                                        </p>
                                        @if(session()->get('rol') == 'super_admin' or session()->get('rol') == 'admin')
                                        <button class="btn btn-delete btn-d-comment text-white bg-danger" data-id="{{$comment->id}}"><i
                                                class="fas fa-trash"></i></button>
                                        @endif
                                    </div>

                                    <p class="user-comment"><b>{{$comment->nombre}} dijo:</b></p>
                                    <p>{{$comment->content}}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach

            @endif
        </div>
    </div>


    <!-- Button to Open the Modal -->


    <!-- The Modal -->
    <div class="modal" id="myModal">
        <div class="modal-dialog">
            <form action="{{url('/comentar')}}" METHOD="POST">
                <div class="modal-content">
                @csrf
                <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 class="modal-title">Comentario</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>

                    <!-- Modal body -->
                    <div class="modal-body">
                        <textarea class="form-control" name="co" required></textarea>
                        <input type="hidden" id="incidentId" name="incidentId" value="{{$Incidents->slug}}">
                        <input type="hidden" id="userId" name="userId"
                               value="{{\Illuminate\Support\Facades\Auth::user()->id}}">
                    </div>

                    <!-- Modal footer -->
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-submit">Enviar</button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                    </div>

                </div>
            </form>
        </div>
    </div>
@endsection
@section('panelScript')
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
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

            //

            $('.btn-d-comment').on('click', function (){
                let id = $(this).data('id');
                let _this = $(this);

                swal({
                    title: "¿Estas seguro que quieres Eliminar el dpto. " + name + "?",
                    text: "Una vez eliminado no hay forma de reestablecerlo",
                    icon: "warning",
                    buttons: ["Cancelar", "Aceptar"],
                    dangerMode: true,
                })
                    .then((willDelete) => {
                        if (willDelete) {
                            $.ajax({
                                url: '{{url('/deleteComment')}}' + '/' + id,
                                dataType : 'JSON',
                                type: 'POST',
                                data: {
                                    id: id,
                                },
                                success: function (data){
                                    if(data.status === 'ok'){
                                        $(_this).closest('.comments-box').remove();
                                    }

                                }
                            });

                        }
                    });





            });


        });






    </script>

@endsection
