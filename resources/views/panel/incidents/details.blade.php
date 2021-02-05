
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
              <p class="meta-data"><b>Estado: </b> Activo</p>
            </div>
            <div class="col-md-4">
                <p class="meta-data"><b>Fecha de inicio:</b>  {{$Incidents->created_at}}</p>
            </div>
            <div class="col-md-4">
                <p class="meta-data"><b>Local:</b>  {{$Incidents->n_local}}</p>
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

        <div class="col-md-12" style="background: #FFFFFF">
            <hr>
            <h3>Comentarios</h3>
            <div class="comments-box">
                <div class="inner-comments-box">
                    <div class="comments-image">
                        <img src="{{asset('panel/assets/img/default-avatar.png')}}" class="mini-avatar"
                             alt="avatar">
                    </div>
                    <div class="comments-description">
                        <p class="date"><b>Fecha:</b> 15/01/2021 </p>
                        <p class="user-comment"><b>Sofia Singer dijo:</b></p>
                        <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.
                            Lorem Ipsum has been the industry's standard dummy text ever since the 1500s,
                            when an unknown printer took a galley of type and scrambled it to make a type
                            specimen book. It has survived not only five centuries</p>
                    </div>

                </div>
            </div>

        </div>
    </div>
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
                columnDefs: [
                    searchPanes
        :
            {
                options : [
                    {
                        label: 'Estado',
                        value: function (rowData, rowIdx) {
                            return rowData[4] < 20;
                        }
                    },
                ]
            }
        ],
        })
            ;
        });
    </script>

@endsection
