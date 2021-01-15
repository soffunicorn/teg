@extends('app')
@section('panelTitle', 'Registro de Locales')

@section('panelContent')
    <div class="table">
        <div class="show-department">
            <table id="table-lcoal" class="table" border="1">
                <thead>
                <tr>
                    <th>Departamento</th>
                    <th>Responsable</th>
                    <th>Ver más</th>
                    <th>Editar</th>
                    <th>Borrar</th>
                </tr>
                </thead>
                @if( !empty($departments) )
                    <tbody>
                    @foreach($departments as $department)
                        <tr>
                            <td><span>{{$department->name}}</span></td>
                            <td><span>{{$department->user_name}}</span></td>
                            <td><span><button class="viewMore" data-id="{{$department->id}}"> + </button></span></td>
                            <td>
                                <button  data-id="{{$department->id}}" class="btn btn-sam-blue btn-edit"><i
                                        class="fas fa-edit"></i></button>
                            </td>
                            <td>
                                <form method="POST" action="{{url('/department/' .$department->id)}}"  id="formDelete" name="formDelete">
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
@endsection
