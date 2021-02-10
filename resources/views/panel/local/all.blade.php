@extends('app')
@section('panelTitle', 'Registro de Locales')

@section('panelContent')
    <div class="row">

        <div class="show-local col-12">
            <table id="table-lcoal" class="table" border="1">
                <thead>
                <tr>
                    <th>Número de local</th>
                    <th>Estado del local</th>
                    @if(session()->get('rol') !== 'empleado' )
                        <th colspan="2">Acciones</th>
                    @endif
                </tr>
                </thead>
                @if( !empty($locals) )
                    <tbody>
                    @foreach($locals as $local)
                        <tr>
                            <td><span class="n_local" data-local="{{$local->n_local}}">{{$local->n_local}}</span></td>
                            <td><span class="status" data-status="{{$local->state_id}}">{{$local->state_name}}</span></td>
                            @if(session()->get('rol') !== 'empleado' )
                                <td>
                                    <button data-id="{{$local->id}}" data-action="{{url('locales/' . $local->id)}}"
                                            class="btn btn-sam-blue btn-edit"><i
                                            class="fas fa-edit"></i></button>
                                </td>

                                <td>
                                    <form method="POST" action="{{url('/locales/' .$local->id)}}" id="formDelete"
                                          name="formDelete">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" class="btn btn-sam-red btn-delete"><i
                                                class="fas fa-trash"></i></button>
                                        <button type="submit" class="btn-real-submit btn-real-delete"
                                                style="opacity: 0;"></button>
                                    </form>

                                </td>
                            @endif
                        </tr>

                    @endforeach
                    </tbody>
                @endif
            </table>
        </div>


    </div>
@endsection
@extends('layouts.modal')
@section('modalTitle', 'Editando el Local')
@section('modalBody')
    <form action="{{url('locales/')}}" method="POST" id="formEditLocal" name="formEditLocal">
        @method('PUT')
        @csrf
        <input type="hidden" id="index" name="index" value="" required/>
        <input type="text" id="n_local" name="n_local" value="" class="form-control mb-3" required/>
        <select name="status" id="status" class="form-control mb-3">
            <label for="Número de Local">Estado del local</label>

            @if($states->count() !== 0)
                @foreach($states as $state)
                    <option value="{{$state->id}}">{{$state->state}} </option>
                @endforeach
            @endif
        </select>

        <button type="submit" class="btn uniform-bg"> Editar</button>

    </form>

@endsection

@section('panelScript')
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script>

        jQuery(function () {
            jQuery('[data-toggle="tooltip"]').tooltip()
        });

        var modal = jQuery('#modalOpen');
        jQuery('.btn-edit').on('click', function () {
            let form = jQuery('#formEditLocal');
            let id = jQuery(this).data('id');
//    let actionbtn = jQuery(this).data('action');
            let tr = jQuery(this).closest('tr');
            let n_local = tr.find('span.n_local').data('local');
            let status = tr.find('span.status').data('status');
            let statusName = tr.find('span.status').html();

            modal.css('display', 'block');
            modal.removeClass('fade');
   let action = form.attr('action');
  form.attr('action', action + '/' + id);
            form.find('#index').val(id);
            form.find('#n_local').val(n_local);
            form.find('#status').val(status);

        });

        jQuery('.modalClose').on('click', function () {
            modal.addClass('fade');
            modal.css('display', 'none');
        });
        jQuery('.btn-delete').on('click', function () {
            let button = jQuery(this);
            swal({
                title: "¿Estas seguro que quieres Eliminarlo?",
                text: "Una vez eliminado no hay forma de reestablecerlo",
                icon: "warning",
                buttons: ["Cancelar", "Aceptar"],
                dangerMode: true,
            })
                .then((willDelete) => {
                    if (willDelete) {
                        let form = button.closest('#formDelete');
                        form.submit()

                    }
                });
        });

    </script>
@endsection
