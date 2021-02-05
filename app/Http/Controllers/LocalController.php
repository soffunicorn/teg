<?php

namespace App\Http\Controllers;
use App\Models\Local;
use App\Models\State;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class LocalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $states = State::whereNotIn('slug', ['todo', 'process', 'done', 'unavailable', 'busy'])->get();
        $locales = local::join('states', 'states.id', '=', 'locals.id_state')->
                          whereIn('slug', ['available', 'busy', 'disabled'])->
                          select('locals.*', 'states.slug AS state_slug', 'states.state AS state_name')->get();
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
       // dd($request->all());
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
        $state = State::where('slug', 'busy');
        $local->n_local = $request->input('n_local', null);
        $local->status = $state->id;
        $local->save();
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
        $local->delete();
        return redirect()->back();
    }
}
