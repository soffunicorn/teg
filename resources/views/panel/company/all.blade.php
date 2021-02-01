
@extends('app')
@section('panelTitle', 'Registro de Compañia')
@section('panelHead')

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
                            <button class="viewMore btn"  data-id="{{$company->slug}}"
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


@extends('layouts.modal')
@section('modalTitle')
    Detalles de la empresa : <span class="company-name"></span>
@endsection

@section('modalBody')
    <div class="modalDepartment">
        <div class="row">
        <p class="entidad-details col-md-6" id="detailsOwner"><b>Arrendatario: </b> <span></span>  </p>
        <p class="entidad-details  col-md-6" id="detailsName"><b>Nombre comercial: </b> <span></span>  </p>
        <p class="entidad-details  col-md-6" id="BussinesRason"><b>Razón Social: </b><span></span>  </p>
        <p class="entidad-details  col-md-6" id="detailsLocal"><b>Local: </b><span></span>  </p>
        <p class="entidad-details  col-md-6" id="detailsRif"><b>Rif: </b> <span></span>  </p>
        <p class="entidad-details  col-md-6"  id="detailsTelephone"><b>Telefono: </b>  <span></span> </p>
        <p class="entidad-details  col-md-6" id="detailsEmail"><b>correo electrónico: </b> <span></span> </p>
        <p class="entidad-details  col-md-6" id="detailsScheduleFrom"><b>Horario de Entrada: </b> <span></span> </p>
        <p class="entidad-details  col-md-6" id="detailsScheduleTo"><b>Horario de salida: </b><span></span>  </p>
        <p class="entidad-details  col-md-12" id="detailsDescription"><b>Descripción: </b><span></span>  </p>
        </div>

    </div>

@endsection

@section('panelScript')
    <script>

        jQuery(document).ready(function ($) {
            var modal = jQuery('#modalOpen');
            $('.viewMore').on('click', function () {
                    let slug = $(this).data('id');
                jQuery.ajax({
                    url: '{{url('/getCompany')}}' + '/' +slug,
                    dataType : 'JSON',
                    type: 'GET',
                    success: function (data){
                        if(data.status === "ok"){
                            let company = data.content;
                            modal.find('.company-name').html(company.name);
                            jQuery('#detailsName').find('span').html(company.name);
                            jQuery('#detailsRif').find('span').html(company.rif);
                            jQuery('#BussinesRason').find('span').html(company.business_reason);
                            jQuery('#detailsLocal').find('span').html(company.n_local);
                            jQuery('#detailsOwner').find('span').html(company.user_name + " " + company.user_lastname);
                            jQuery('#detailsTelephone').find('span').html(company.telephone);
                            jQuery('#detailsEmail').find('span').html(company.email);
                            jQuery('#detailsScheduleFrom').find('span').html(company.schedule_from);
                            jQuery('#detailsScheduleTo').find('span').html(company.schedule_to);
                            jQuery('#detailsDescription').find('span').html(company.description);


                            modal.css('display', 'block');
                            modal.removeClass('fade');
                        }

                    }
                });

             });
            //close Modal
            jQuery('.modalClose').on('click', function () {
                modal.addClass('fade');
                modal.css('display', 'none');
            });

        });
    </script>
@endsection
