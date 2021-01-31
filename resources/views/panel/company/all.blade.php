
@extends('app')
@section('panelTitle', 'Registro de Compañia')
@section('panelHead')
    <link href="{{asset('panel/assets/css/localregister.css')}}" rel="stylesheet"/>
    <link href="{{asset('uniform/css/style.css')}}" rel="stylesheet"/>
@endsection
@section('panelContent')
    <div class="allCompany">
        <table class=" table" id="tablesCompany">
            <thead>
            <tr>
                <th>Nombre Comercial</th>
                <th>Razón Social</th>
                <th>Local</th>
                <th>Dueño:</th>
                <th>Acciones</th>
            </tr>
            </thead>
            <tbody>
            @if($companies->count() !== 0)
                @foreach($companies as $company)
                    <tr>
                        <td><p>{{$company->name}}</p></td>
                        <td><p>{{$company->business_reason}}</p></td>
                        <td><p>{{$company->n_local}}</p></td>
                        <td><p>{{$company->user_name}}</p></td>
                        <td>
                            <button class="viewMore btn " id="viewMore" data-id="{{$company->slug}}"
                                    data-toggle="tooltip" data-placement="bottom" title="Ver más"> <i
                                    class="fas fa-plus"></i> </button>

                            <a href="{{ url('/companyEdit/' . $company->slug)}}"
                               class="btn btn-sam-blue btn-edit"><i
                                    class="fas fa-edit" data-toggle="tooltip" data-placement="bottom"
                                    title="Editar"></i></a>

                            <form method="POST" action="{{url('/company/' .$company->slug)}}"
                                  id="formDelete" name="formDelete">
                                @csrf
                                @method('DELETE')
                                <button type="button" class="btn btn-sam-red btn-delete" data-name="{{$company->slug}}"><i
                                        class="fas fa-trash"></i></button>
                                <button type="submit" class="btn-real-submit" data-toggle="tooltip"
                                        data-placement="bottom" title="Borrar" style="opacity: 0;"></button>
                            </form>

                        </td>

                    </tr>

                @endforeach
            @endif
            </tbody>
        </table>
    </div>

@endsection
@section('panelScript')
    <script>
        jQuery(document).ready(function ($) {


        });
    </script>
@endsection
