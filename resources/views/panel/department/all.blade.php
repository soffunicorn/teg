@extends('app')
@section('panelTitle', 'Registro de Locales')

@section('panelContent')
    <div class="table">
        <div class="show-department">
            <table id="table-lcoal" class="table" border="1" align="center">
                <thead>
                <tr>
                    <th>Departamento</th>
                    <th>Responsable</th>
                    <th colspan="3">Acciones</th>
                </tr>
                </thead>
                @if( !empty($departments) )
                    <tbody>
                    @foreach($departments as $department)
                        <tr>
                            <td><span>{{$department->name}}</span></td>
                            <td><span>{{$department->user_name}}</span></td>
                            <td>
                                <div class="row">
                                    <div class="col-md-4">
                                        <span><button class="viewMore" data-id="{{$department->id}}"
                                                      data-toggle="tooltip" data-placement="bottom" title="Ver más"> <i
                                                    class="fas fa-plus"></i> </button></span>
                                    </div>
                                    <div class="col-md-4">
                                        <button data-id="{{$department->id}}" class="btn btn-sam-blue btn-edit"><i
                                                class="fas fa-edit" data-toggle="tooltip" data-placement="bottom"
                                                title="Editar"></i></button>

                                    </div>
                                    <div class="col-md-4">
                                        <form method="POST" action="{{url('/department/' .$department->id)}}"
                                              id="formDelete" name="formDelete">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button" class="btn btn-sam-red btn-delete"><i
                                                    class="fas fa-trash"></i></button>
                                            <button type="submit" class="btn-real-submit" data-toggle="tooltip"
                                                    data-placement="bottom" title="Borrar" style="opacity: 0;"></button>
                                        </form>
                                    </div>
                                </div>
                            </td>
                        </tr>

                    @endforeach
                    </tbody>
                @endif
            </table>
        </div>
@endsection
