@extends('app')
@section('panelTitle', 'Lista de Empleados')

@section('panelContent')
    <div class="worker-wrapper">
        <table id="tableDepartment" class="table" border="1" align="center">
            <thead>
            <tr>
                <th>Nombre y Apellido</th>
                <th>Departamento</th>
                <th>Tipo</th>
                <th colspan="2">Acciones</th>
            </tr>
            </thead>
            @if( $users->count() > 0 )
                <tbody>
                @foreach($users as $user)
                    <tr>

                        <td><span>{{$user->name}}</span> <span>  {{$user->lastname}}</span></td>
                        <td><span>{{$user->department_name}}</span></td>
                        <td><span>  {{$user->tipo}}  </span></td>
                        <td>
                            <div class="rowDepartment">


                                <button class="viewMore btn " id="viewMore" data-id="{{$user->slug}}"
                                        data-toggle="tooltip" data-placement="bottom" title="Ver más"> <i
                                        class="fas fa-plus"></i> </button>

                                <a href="{{ url('/department/' .$user->slug) . '/edit' }}"
                                   class="btn btn-sam-blue btn-edit"><i
                                        class="fas fa-edit" data-toggle="tooltip" data-placement="bottom"
                                        title="Editar"></i></a>

                                <form method="POST" action="{{url('/department/' .$user->slug)}}"
                                      id="formDelete" name="formDelete">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" class="btn btn-sam-red btn-delete" data-name="{{$user->name}}"><i
                                            class="fas fa-trash"></i></button>
                                    <button type="submit" class="btn-real-submit" data-toggle="tooltip"
                                            data-placement="bottom" title="Borrar" style="opacity: 0;"></button>
                                </form>

                            </div>
                        </td>
                    </tr>

                @endforeach
                </tbody>
            @endif
        </table>
    </div>

@endsection




@section('panelScript')
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script>
        var modal = jQuery('#modalOpen');
        jQuery('#viewMore').on('click', function () {
            let id = jQuery(this).data('id');
            if(id === null || id === ""){
                return false;
            }
            jQuery.ajax({
                url: '{{url("/getUserData")}}' + '/' +id,
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
            let button = jQuery(this);
            let name = jQuery(this).data('name');

            swal({
                title: "¿Estas seguro que quieres Eliminar el empleado. " + name + "?",
                text: "Una vez eliminado no hay forma de reestablecerlo",
                icon: "warning",
                buttons: ["Cancelar", "Aceptar"],
                dangerMode: true,
            })
            /*.then((willDelete) => {
                if (willDelete) {
                    button.attr('type', 'submit');
                    button.trigger('click');
                }
            });*/
        });

    </script>
@endsection


