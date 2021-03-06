@extends('app')
@section('panelTitle', 'Todos los Departamentos')
@section('panelHead')
    <link rel="stylesheet" href="{{asset('panel/assets/css/department.css')}}">

@endsection
@section('panelContent')

    <div class="table">
        <div class="show-department">
            <table id="tableDepartment" class="table" border="1" align="center">
                <thead>
                <tr>
                    <th>Departamento</th>
                    <th>Responsable</th>
                    <th colspan="3">Acciones</th>
                </tr>
                </thead>
                @if( $departments->count() > 0 )

                    <tbody>
                    @foreach($departments as $department)
                        <tr>
                            <td class="td-name"><span>{{$department->name}}</span></td>
                            <td><span>{{$department->user_name}}</span></td>
                            <td>
                                <div class="rowDepartment">

                                    <?php if(session()->get('rol') == 'local' or session()->get('rol') == 'empleado'){ ?>
                                    <button class="viewMore btn " id="viewMore" data-id="{{$department->id}}"
                                            data-toggle="tooltip" data-placement="bottom" title="Ver más"> <i
                                            class="fas fa-plus"></i> </button>
                                    <?php }?>

                                    <?php if(session()->get('rol') == 'super_admin' or session()->get('rol') == 'admin'){ ?>
                                    <a href="{{ url('/department/' .$department->id)  }}"
                                       class="viewMore btn "><i
                                            class="fas fa-plus" data-toggle="tooltip" data-placement="bottom"
                                            title="Editar"></i></a>

                                    <a href="{{ url('/department/' .$department->id) . '/edit' }}"
                                       class="btn btn-sam-blue btn-edit ml-3"><i
                                            class="fas fa-edit" data-toggle="tooltip" data-placement="bottom" title="Editar"></i></a>


                                        <button type="button" class="btn btn-sam-red btn-delete ml-3" data-id="{{$department->id}}"><i
                                                class="fas fa-trash"></i></button>

                                        <?php } ?>
                                    @if(session()->get('rol') !== 'local')
                                            <a href="{{url('/department-incidencia/' .$department->id)}}" class="btn btn-primary btn-reporte" target="_blank">Ver Reporte </a>
                                    @endif

                                </div>

                            </td>
                        </tr>
                    @endforeach


                    </tbody>
                @endif
            </table>
        </div>
        @endsection

        @extends('layouts.modal')
        @section('modalTitle')
            Detalles del  departamento : <span class="department-name"></span>
        @endsection
        @section('modalBody')
            <div class="modalDepartment">

                    <p class="entidad-details" id="detailsName"><b>Nombre del departamento: </b> <span></span>  </p>
                    <p class="entidad-details"  id="detailsTelephone"><b>Telefono: </b>  <span></span> </p>
                    <p class="entidad-details" id="detailsEmail"><b>correo electrónico: </b> <span></span> </p>
                    <p class="entidad-details" id="detailsScheduleFrom"><b>Horario de Entrada: </b> <span></span> </p>
                    <p class="entidad-details" id="detailsScheduleTo"><b>Horario de salida: </b><span></span>  </p>
                    <p class="entidad-details" id="detailsDescription"><b>Descripción: </b><span></span>  </p>
                </div>

        @endsection

        @section('panelScript')
            <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
            <script>
                var modal = jQuery('#modalOpen');
                jQuery('.viewMore').on('click', function () {
                    let id = jQuery(this).data('id');
                    if(id === null || id === ""){
                        return false;
                    }
                    jQuery.ajax({
                      url: '{{url('/getdepartment')}}' + '/' +id,
                       dataType : 'JSON',
                        type: 'GET',
                       success: function (data){
                            if(data.status === "ok"){
                                let department = data.content;
                                modal.find('.department-name').html(department.name);
                                jQuery('#detailsName').find('span').html(department.name);
                                jQuery('#detailsTelephone').find('span').html(department.telephone);
                                jQuery('#detailsEmail').find('span').html(department.email);
                                jQuery('#detailsScheduleFrom').find('span').html(department.schedule_from);
                                jQuery('#detailsScheduleTo').find('span').html(department.schedule_to);
                                jQuery('#detailsDescription').find('span').html(department.description);
                                modal.css('display', 'block');
                                modal.removeClass('fade');
                            }

                       }


                    });


                });

                jQuery('.modalClose').on('click', function () {
                    modal.addClass('fade');
                    modal.css('display', 'none');
                });
                    //delete
                jQuery('.btn-delete').on('click', function (){
                    let id = jQuery(this).data('id');
                    let tr = $(this).closest('tr');
                    let name = $(tr).find('.td-name span').html();

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
                                    url: '{{url('/department')}}' + '/' + id,
                                    dataType : 'JSON',
                                    type: 'DELETE',
                                    success: function (data){
                                        if(data.status === 'ok'){
                                            $(tr).remove();
                                        }

                                    }
                                });

                            }
                        });


                });

            </script>
@endsection
