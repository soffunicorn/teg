<?php

namespace App\Http\Controllers;
use App\Models\Local;
use Illuminate\Http\Request;

class LocalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      return view('panel.local.all')->with([
                 'locals' => local::all(),
      ]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('panel.register.local');
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
            'n_local' => ['required', 'max:255'],
            'status' => ['required', 'in:disponible,ocupado,deshabilitado'],
        ];
        $request->validate($rules);
        $local = new Local();
        $local->n_local = $request->input('n_local', null);
        $local->status = $request->input('status', null);
        $local->save();


        return redirect()->back();
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
            'n_local' => ['required', 'max:255', ' alpha_num'],
            'status' => ['required', 'in:disponible,ocupado,deshabilitado'],
        ];
        $request->validate($rules);
        $local =  Local::where('id', $id)->first();

        $local->n_local = $request->input('n_local', null);
        $local->status = $request->input('status', null);
        $local->save();
        return redirect()->back();
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