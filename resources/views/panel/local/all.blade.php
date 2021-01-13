@extends('app')
@section('panelTitle', 'Registro de Locales')

@section('panelContent')
    <div class="row">
        <div class="show-local col-6">
            <table id="table-lcoal" class="table" border="1">
                <thead>
                <tr>
                    <th>Número de local</th>
                    <th>Estado del local</th>
                    <th>Editar</th>
                    <th>Borrar</th>
                </tr>
                </thead>
                @if( !empty($locals) )
                    <tbody>
                    @foreach($locals as $local)
                        <tr>
                            <td><span class="n_local" data-local="{{$local->n_local}}">{{$local->n_local}}</span></td>
                            <td><span class="status" data-status="{{$local->status}}">{{$local->status}}</span></td>
                            <td>
                                <button  data-id="{{$local->id}}" class="btn btn-sam-blue btn-edit"><i
                                        class="fas fa-edit"></i></button>
                            </td>
                            <td>
                                <form method="POST" action="{{url('/locales/' .$local->id)}}"  id="formDelete" name="formDelete">
                                    @csrf
                                    @method('DELETE')
                                    <button  type="button"  class="btn btn-sam-red btn-delete"><i
                                            class="fas fa-trash"></i></button>
                                    <button type="submit" class="btn-real-submit" style="opacity: 0;"></button>
                                </form>

                            </td>
                        </tr>

                    @endforeach
                    </tbody>
                @endif
            </table>
        </div>

        <div class="form-register col-6">
            <form method="POST" action="{{url('/locales')}}" class="card-body card">
                @csrf
                <label for="Número de Local">Número de local</label>

                <input type="text" name="n_local" id="n_local" required class="form-control mb-3"
                       placeholder="EJ: L-149">

                <select name="status" id="status" class="form-control">
                    <label for="Número de Local">Estado del local</label>
                    <option selected> --Seleccionar --</option>
                    <option value="disponible">Disponible</option>
                    <option value="ocupado">Ocupado</option>
                    <option value="deshabilitado">Deshabilitado</option>
                </select>
                <button type="submit" class="btn uniform-bg"> Crear</button>
            </form>
        </div>

    </div>
@endsection
@extends('layouts.modal')
@section('modalTitle', 'Editando el Local')
@section('modalBody')
    <form method="POST"  action="{{url('/locales/')}}" id="formEditLocal" name="formEditLocal">
        @csrf
        @method('PUT')
        <input type="hidden"  id="index" name="index" value="" required/>
        <input type="text"  id="n_local" name="n_local" value=""  class="form-control mb-3" required/>
        <select name="status" id="status" class="form-control mb-3">
            <label for="Número de Local">Estado del local</label>
            <option selected> --Seleccionar --</option>
            <option value="disponible">Disponible</option>
            <option value="ocupado">Ocupado</option>
            <option value="deshabilitado">Deshabilitado</option>
        </select>
        <button type="submit" class="btn uniform-bg"> Editar</button>
    </form>

@endsection

@section('panelScript')
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script>
        var modal = jQuery('#modalOpen');
        jQuery('.btn-edit').on('click', function () {
            let form = jQuery('#formEditLocal');
            let id = jQuery(this).data('id');
            let tr = jQuery(this).closest('tr');
            let n_local = tr.find('span.n_local').data('local');
            let status = tr.find('span.status').data('status');
            modal.css('display', 'block');
            modal.removeClass('fade');
            let action = form.attr('action').replace(/locales/g, "locales/" + id);
            form.attr('action', action);
            form.find('#index').val(id);
            form.find('#n_local').val(n_local);
            form.find('#status').val(status);

        });

        jQuery('.modalClose').on('click', function (){
            modal.addClass('fade');
            modal.css('display', 'none');
        });
        jQuery('.btn-delete').on('click', function (){
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
                        button.attr('type', 'submit');
                        button.trigger('click');
                    }
                });
        });

    </script>
@endsection
