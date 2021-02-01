<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Incident;
use App\Models\Department;

class IncidentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('panel.incidents.history');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         //Necesito el id del local
        // consulta el user logeado de cual es su local
        $local = 1;
        $departments = Department::get();
        return view('panel.incidents.create')->with([
            'departments' => $departments, 'local' => $local
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
        $params_array        = $request->toArray();
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
                'name'          => '|unique:incidents',
                'description'   => 'required|alpha',
                'priority'      => 'required|alpha',
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
        $Incident->status           = 1;
        $Incident->slug             =  str_shuffle($Incident->name.date("Ymd").uniqid());
        $Incident->save();
        dd($Incident);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('panel.incidents.details');
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
