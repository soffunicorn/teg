<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Incident;
use App\Models\Department;
use App\Models\Local;
use App\Models\Comment;
use Illuminate\Support\Facades\Auth;


class IncidentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        session()->get('rol');
        $Incidents = Incident::get();
        return view('panel.incidents.history')->with([
            'Incidents' =>  $Incidents
        ]);
        }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $locals = Local::
        join('company_locals','company_locals.id_local','=','locals.id')->
        join('companies','company_locals.id_company','=','companies.id')->
        join('user_company', 'user_company.id_company', '=', 'companies.id')->
        join('users', 'users.id', '=', 'user_company.id_user')->
        Where('users.id',auth()->user()->id)->
        //Where('companies.id',)->
        get();

        $departments = Department::get();
        return view('panel.incidents.create')->with([
            'departments' => $departments, 'locals' => $locals
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {


    }
    public function store(Request $request)
    {

     //******* ARRAY
    $params_array   = $request->toArray();

        // Validamos datos correctos
        if (empty($params_array))
        {
            $data = array(
                'status' => 'error',
                'code'   =>  404,
                'msj'    => 'Los datos de la peticion estan dañados',
            );
            return response()->json($data, $data['code']);
        }

        $params_array = array_map('trim', $params_array);

        $validador = \Validator::make($params_array,
            [
               // 'name'          => '|unique:incidents',
                'description'   => 'required|alpha',
                'priority'      => 'required|alpha',
                'id_departament'=> 'required',
                'id_local'      => 'required',
            ]
        );
        //Segun la respuesta continuo o no
        if ($validador->fails())
        {
            $data = array(
                'status' => 'error',
                'code'   =>  404,
                'msj'    => 'El Formulario no a sido llenado correctamente',
                'errors' => $validador->errors()
            );
            return response()->json($data, $data['code']);
        }
        //Creo la incidencia
        $Incident = new Incident();
        $Incident->name             = $request->input('name');
        $Incident->description      = $request->input('description');
        $Incident->priority         = $request->input('priority');
        $Incident->id_departament   = $request->input('id_departament'); //
        $Incident->id_local         = $request->input('id_local'); //
        //$Incident->status           = 1;
        $Incident->deathline        = '2021-02-01 00:15:58';
        $Incident->slug             =  str_shuffle($Incident->name.date("Ymd").uniqid());

        $Incident->save();
        return redirect('/incidents');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $Incidents = Incident::select(
        'incidents.*',
        'companies.id AS companiesId',
        'companies.name AS companiesName',
        'n_local',
        'responsable AS responsable.name',
        'departments.name AS departmentsName',
        'departments.id AS departmentsId',
        )->
        join('locals','incidents.id_local','=','locals.id')->
        join('company_locals','company_locals.id_local','=','locals.id')->
        join('companies','company_locals.id_company','=','companies.id')->
        //join('user_company', 'user_company.id_company', '=', 'companies.id')->
        //join('users', 'users.id', '=', 'user_company.id_user')->
        join('users AS responsable', 'incidents.id_responsable', '=', 'responsable.id')->
        join('departments', 'incidents.id_departament', '=', 'departments.id')->
        where('incidents.id',$id)->
        first();

        $comment = Comment::select('comments.*','usars.name AS nombre')->
        join('incidents', 'incidents.id', '=', 'comments.id_incident')->
        join('users', 'users.id', '=', 'comments.id_user')->
        where('incidents.id',$id)->
        get();

        return view('panel.incidents.details')->with(['Incidents'=> $Incidents,'comment'=>$comment]);
    }



    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        dd($request);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
