<?php

namespace App\Http\Controllers;

use App\Models\Incident;
use App\Models\Log;
use App\Models\Action;
use App\Models\Record;
use App\Models\Local;
use App\Models\Department;
use App\Models\User;
use App\Models\Rol;
use App\Models\Type;
use Illuminate\Http\Request;

class AuditoriaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = Rol::whereNotIn('slug', ['super_admin'])->get();

        $logs = Log::join('actions', 'actions.id', '=', 'logs.id_action')->
                     join('users', 'users.id', '=', 'logs.id_user')->
                     join('roles', 'roles.id', '=', 'id_rol')->whereIn('roles.slug', $roles)->
                     select('logs.id AS log_id', 'logs.created_at AS log_fecha', 'users.name AS user_name',
                    'users.lastname AS user_lastname', 'users.email as user_mail', 'actions.*' )
                     ->orderBy('logs.created_at', 'desc')->get();

        return view ('panel/admin/all-auditoria')->with([
             'logs' => $logs
        ]);

    }

    public function  index_incidents(){

        $logs = Record::join('logs', 'logs.id','=', 'records.id_log')->
                        join('incidents', 'incidents.id', '=', 'records.id')->
                        join('actions', 'actions.id', '=', 'logs.id_action')->
                        join('users AS creador', 'creador.id', '=', 'logs.id_user')->
                        join('locals', 'locals.id', '=', 'incidents.id_local')->
                        leftJoin('departments', 'departments.id', '=', 'incidents.id_departament')->
                        leftJoin('users AS responsable', 'responsable.id', '=', 'incidents.id_responsable')->
                       // join('roles', 'roles.id', '=', 'id_rol')->whereIn('roles.slug', $roles)->
                        select('actions.*', 'incidents.name AS incident_title', 'incidents.slug AS incident_id', 'locals.n_local', 'departments.name AS department',
                        'responsable.name AS responsable_name', 'responsable.lastname  AS responsable_lastname', 'creador.name
                         AS creador_name', 'creador.lastname  AS creador_lastname', 'records.created_at AS fecha', 'records.id AS record' )->get();
    //' creador.email AS creador_email'

        return view ('panel/admin/auditoria-incident')->with([
            'logs' => $logs,
        ]);
    }

   /* public function  show_incidents($slug){
        $incident  = Incident::where('slug', $slug)->first();



    }*/


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
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
