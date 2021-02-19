<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Incident;
use App\Models\Department;
use App\Models\Local;
use App\Models\Comment;
use App\Models\Company;
use App\Models\User;
use App\Models\Log;
use App\Models\Action;
use App\Models\Record;
use App\Models\StateIn;
use Illuminate\Support\Facades\Auth;
use PDF;


class IncidentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        if(session()->get('rol')== 'local'){
            $estados = StateIn::get();
            $compa =  Company::
       //     join('locals', 'locals.id',  '=', 'incidents.id_local')->
           // join('company_locals','company_locals.id_local','=','locals.id')->
         //   join('companies', 'companies.id', '=', 'company_locals.id_company')->
            join('user_company', 'user_company.id_company', '=', 'companies.id')->
            join('users', 'users.id', '=', 'user_company.id_user')
                ->where('users.id', Auth::user()->id )->
                select('companies.id')->first();

            $Incidents = Incident::
            join('locals', 'locals.id',  '=', 'incidents.id_local')->
            join('incidents_state', 'incidents_state.id',  '=', 'incidents.id_state')->
            join('company_locals','company_locals.id_local','=','locals.id')->
            join('companies', 'companies.id', '=', 'company_locals.id_company')->
            leftJoin('users', 'users.id','=','incidents.id_responsable' )->
            select('incidents.*','locals.n_local','users.name AS responsable', 'incidents_state.name AS state')->
            where('companies.id', $compa->id)->
            whereNotIn('incidents_state.slug', ['delete'] )->get();

            return view('panel.incidents.history')->with([
                'Incidents' =>  $Incidents,
                'estados' =>  $estados
            ]);
        }

        if(session()->get('rol') == 'empleado') {

            $depa = Department::join('users_departments', 'users_departments.id_department', '=', 'departments.id')
                ->join('users', 'users.id', '=', 'users_departments.id_user')
                ->where('users_departments.id_user', Auth::user()->id)->
               // whereNotIn('incidents_state.slug', ['delete'])->
                 select('departments.*')
                ->first();

            $Incidents = Incident::where('id_departament',$depa->id)->
            join('locals', 'locals.id',  '=', 'incidents.id_local')->
            join('incidents_state', 'incidents_state.id',  '=', 'incidents.id_state')->
            leftJoin('users', 'users.id','=','incidents.id_responsable' )->
            select('incidents.*','locals.n_local','users.name AS responsable', 'incidents_state.name AS state')->
            whereNotIn('incidents_state.slug', ['delete'])->get();
         //   where('incidents_state.slug', 'delete')->;

             // dd($Incidents);
            $user = User::
            join('users_departments', 'users_departments.id_user', '=', 'users.id')->
            join('departments', 'users_departments.id_department', '=', 'departments.id')->
                select('users.*')->
            where('departments.id',$depa->id)->get();

            $estados = StateIn::get();

            return view('panel.incidents.history')->with([
                'Incidents' =>  $Incidents,
                'users' => $user,
                'estados' => $estados
            ]);

  }
        if(session()->get('rol') == 'admin'){
            $estados = StateIn::get();
             $Incidents = Incident::join('locals', 'locals.id',  '=', 'incidents.id_local')->
            join('incidents_state', 'incidents_state.id',  '=', 'incidents.id_state')->
            leftJoin('users', 'users.id','=','incidents.id_responsable' )->
             whereNotIn('incidents_state.slug', ['delete'])->
            select('incidents.*','locals.n_local','users.name AS responsable', 'incidents_state.name AS state')->get();


            return view('panel.incidents.history')->with([
                'Incidents' =>  $Incidents,
                'estados' =>  $estados,
            ]);
        }

        $estados = StateIn::get();
        $Incidents =  $Incidents = Incident::join('locals', 'locals.id',  '=', 'incidents.id_local')->
        join('incidents_state', 'incidents_state.id',  '=', 'incidents.id_state')->
        leftJoin('users', 'users.id','=','incidents.id_responsable' )->
        select('incidents.*','locals.n_local','users.name AS responsable')->get();


        return view('panel.incidents.history')->with([
            'Incidents' =>  $Incidents,
            'estados' =>  $estados,
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

        Where('users.id',auth()->user()->id)
            ->select('locals.id','locals.n_local')->
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
                'name'          => 'required',
                'description'   => 'required|string',
                'priority'      => 'required|string',
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
        //Busco el estado que necesito
        $status = StateIn::where('slug', 'porhacer')->first();
        //Creo la incidencia
        $Incident = new Incident();
        $Incident->name             = $request->input('name');
        $Incident->description      = $request->input('description');
        $Incident->priority         = $request->input('priority');
        $Incident->id_departament   = $request->input('id_departament'); //
        $Incident->id_local         = $request->input('id_local'); //
        $Incident->id_state           = $status->id; //Por hacer
        $Incident->deathline        = '2021-02-01 00:15:58';
        $Incident->slug             =  str_shuffle($Incident->name.date("Ymd").uniqid());

        $Incident->save();
        //Guardar para el log y los records
        $action = Action::where('slug', 'new-incident')->first();
        $log = new Log();
        $log->id_user = auth()->user()->id;
        $log->id_action = $action->id;
        $log->save();
        //guardar el record
        $record = new Record();
        $record->id_log = $log->id;
        $record->id_incident = $Incident->id;
        $record->save();
        return redirect('incidents');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {


        $incidents = Incident::select(
        'incidents.*',

      // 'companies.id AS companiesId',
       // 'companies.name AS companiesName',
        'locals.n_local',
        'users.name AS responsable',
        'departments.name AS departmentsName',
        'departments.id AS departmentsId',
         'incidents_state.name AS state'
        )->
        join('locals', 'locals.id',  '=', 'incidents.id_local')->
       //join('company_locals','company_locals.id_local','=','locals.id')->
       //join('companies', 'companies.id', '=', 'company_locals.id_company')->
       // join('user_company', 'user_company.id_company', '=', 'companies.id')->
        //join('users', 'users.id', '=', 'user_company.id_user')->
        leftJoin('users', 'users.id','=','incidents.id_responsable' )->
        join('departments', 'departments.id', '=', 'incidents.id_departament')->
        join('incidents_state', 'incidents_state.id', '=', 'incidents.id_state')->
        where('incidents.slug',$slug)->
        first();



        $comment = Comment::select('comments.*','users.name AS nombre')->
        join('incidents', 'incidents.id', '=', 'comments.id_incident')->
        join('users', 'users.id', '=', 'comments.id_user')->
        where('incidents.slug',$slug)->get();


        return view('panel.incidents.details')->with([
            'Incidents'=> $incidents,
            'comments'=> $comment,
        ]);



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
       // dd($request);
    }

    public function comentario(Request $request)
    {
        $In = Incident::where('slug',$request->input('incidentId'))->first();

        $Comment = new Comment();
        $Comment->content = $request->input('co');
        $Comment->id_incident = $In->id;
        $Comment->id_user = $request->input('userId');
        $Comment->save();

        //Guardar para el log y los records
        $action = Action::where('slug', 'new-comment')->first();
        $log = new Log();
        $log->id_user = auth()->user()->id;
        $log->id_action = $action->id;
        $log->save();
        //guardar el record
        $record = new Record();
        $record->id_log = $log->id;
        $record->id_incident = $In->id;
        $record->save();


        return redirect('/incidents/'.$In->slug);
    }

    public function elegir(Request $request)
    {
        $In = Incident::where('slug',$request->input('incidentId'))->first();
        $In->id_responsable = $request->input('responsable');
        $In->save();
        return redirect('/incidents');
    }

    public function estados(Request $request)
    {
        $slug = $request->input('incidentId'); //estado
        $In = Incident::where('slug', $slug)->first();
        $current_state = StateIn::findOrFail($In->id_state);
        if($current_state->slug === 'finalizada'){
            return  back()->with('errorState','Despúes que el estado de la incidencia es "Finalizada" no se puede cambiar ');
        }

        $In->id_state = $request->input('estado');
        $In->save();

        return redirect('/incidents');
    }





    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id){

      $incident =  Incident::findOrFail($id);

      //Dependiendo del rol del admin borrar fisico o logico
        if( session()->get('rol') == 'admin' ){
            $state =  StateIn::where('slug', 'delete')->first();
            $incident->id_state = $state->id;
            $incident->save();

            return response()->json(array('status' => 'ok'), 200);
        }else if( session()->get('rol') == 'super_admin' ) {
            $comments = Comment::where('id_incident', $id)->get();

            //Se borran los comentarios asociados
            if($comments->count() !== 0){
                foreach ($comments as $comment){
                    $comment->delete();
                }
            }
            //Borrar el incidente defenitivamente
            $incident->delete();
            return response()->json(array('status' => 'ok'), 200);
        }


        return response()->json(array('status' => 'error'), 200);


    }


    public function commentDelete(Request $request, $id)
    {
        if($request->has('id')){
            $comment = Comment::findOrFail($request->id);
            $comment->delete();
            return response()->json(array('status' => 'ok'), 200);
        }


        return response()->json(array('status' => 'error'), 200);

    }

    public function reportedeincidencia($id)
    {

        $compa = Incident::join('records', 'records.id_incident', '=', 'incidents.id')->
                           join('logs', 'logs.id', '=', 'records.id_log')->
                            join('users', 'users.id', '=', 'logs.id_user')->
                            join('user_company', 'user_company.id_user', '=', 'users.id')->
                            join('companies', 'companies.id', '=', 'user_company.id_company')->
                            where('incidents.id', $id)->select('companies.*')->get();


            $Incidents = Incident::
            join('locals', 'locals.id', '=', 'incidents.id_local')->
            join('departments', 'departments.id', '=', 'incidents.id_departament')->
            join('incidents_state', 'incidents_state.id', '=', 'incidents.id_state')->
            join('company_locals', 'company_locals.id_local', '=', 'locals.id')->
            join('companies', 'companies.id', '=', 'company_locals.id_company')->
            leftJoin('users', 'users.id', '=', 'incidents.id_responsable')->
            select('incidents.*', 'locals.n_local', 'users.name AS responsable', 'departments.name AS department_name')->
            where('incidents.id', $id)->
            whereNotIn('incidents_state.slug', ['delete'])->get();

            return view('panel.incidents.reporte')->with([
                'Incidents' => $Incidents,
                'compa' => $compa
            ]);

      /*  $pdf = PDF::loadView('panel.incidents.reporte',compact('Incidents'));
        return $pdf->download('invoice.pdf');*/

    }



}
