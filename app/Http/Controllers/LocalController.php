<?php

namespace App\Http\Controllers;
use App\Models\Action;
use App\Models\Local;
use App\Models\Log;
use App\Models\State;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use PDF;

class LocalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $states = State::whereNotIn('slug', ['todo', 'process', 'done', 'unavailable'])->get();
        $locales = local::join('states', 'states.id', '=', 'locals.id_state')->
                          whereIn('slug', ['available', 'busy', 'disabled'])->
                          select('locals.*', 'states.id AS state_id', 'states.state AS state_name')->get();
      return view('panel.local.all')->with([
                 'locals' => $locales,
                 'states' => $states,
      ]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $states = State::whereNotIn('slug', ['todo', 'process', 'done', 'unavailable', 'busy'])->get();
        return view('panel.register.local')->with([
            'states' => $states,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $rules = [
            'n_local' => [Rule::unique('locals'), 'max:255'],
            'status' => ['required'],
        ];
        $request->validate($rules);
        $status = State::where('slug', $request->status)->first();

        $local = new Local();
        $local->n_local = $request->input('n_local', null);
        $local->id_state = $status->id;
        $local->save();

        //Update local
        $action = Action::where('slug', 'new-local')->first();
        $log = new Log();
        $log->id_user = auth()->user()->id;
        $log->id_action = $action->id;
        $log->save();

        return redirect('locales');
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
        $rules = [
            'n_local' => [Rule::unique('locals')->ignore($id), 'max:255', ' string'],
        ];
        $request->validate($rules);
        $local =  Local::findOrfail($id);
        // buscar el status para setearlo
        $state = State::findOrFail($request->status);
        $local->n_local = $request->input('n_local', null);
        $local->id_state = $state->id;
        $local->save();

        //Actualizado el log
       $log = new Log();
       $log->updateLog('update-local');

        return redirect('locales');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $local = Local::findorFail($id);
        $status = State::where('slug', 'disabled')->first();
        $local->id_state = $status->id;
        $local->save();

        //Actualizado el log
        $action = Action::where('slug', 'delete-local')->first();
        $log = new Log();
        $log->id_user = auth()->user()->id;
        $log->id_action = $action->id;
        $log->save();

        return redirect()->back();
    }

//reporte
    public function incidenciasLocal($id){

        $local = Local::findOrfail($id);
        $incidents = Local::join('incidents', 'incidents.id_local', '=', 'locals.id')->
        leftJoin('users AS responsable', 'responsable.id', '=', 'incidents.id_responsable')->
        leftJoin('departments', 'departments.id', 'incidents.id_responsable')->
        join('incidents_state', 'incidents_state.id', '=', 'incidents.id_state' )->
        join('company_locals', 'company_locals.id_local', '=', 'locals.id' )->
        join('companies', 'companies.id', '=', 'company_locals.id_company' )->
        join('user_company', 'user_company.id_company', '=', 'companies.id' )->
        join('users AS creador', 'creador.id', '=', 'user_company.id_user' )->
        where('locals.id', $id)->select('locals.*', 'incidents.name AS incident_name', 'incidents.description AS incident_description',
            'creador.name AS creador_name', 'creador.lastname AS creador_lastname', 'responsable.name AS res_name',
            'responsable.lastname AS res_lastname', 'companies.name',  'incidents.created_at AS incident_fecha', 'departments.name AS depart_name',
            'incidents_state.name AS incident_state')->
            orderBy('incidents.created_at', 'desc')->get();


        return view('panel.local.localxIncidencias')->with([
            'incidents' => $incidents,
            'local' => $local,
        ]);
        /*$pdf = PDF::loadView('panel.local.localxIncidencias' ,compact('incidents','local'));
        return $pdf->download('incidenciasxlocal'.$local->n_local .'.pdf');*/

    }

}
