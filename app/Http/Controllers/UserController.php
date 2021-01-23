<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Rol;
use App\Models\User;
use App\Models\Type;
use App\Models\Department;
use App\Models\UserDepartment;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request)
    {
        //dd("testing");
        dd($request->all());
    }

    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function createWorkers()
    {
        //formulario para usaurios del centrocomercial
        $departments = Department::all();
        return view('panel.register.encargadoRegister')->with([
            'departments' => $departments,
        ]);
    }


    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

    }

    public function storeWorkers(Request $request)
    {
        $password = Hash::make(Str::random(8)); //password
        $rules = [
            'name' => ['string', 'max:255', 'required'],
            'lastname' => ['string', 'max:255'],
            'mail' => ['unique:users,email', 'max:255', 'required'],
        ];

        $request->validate($rules);
        $rol = $tipo = "";
        if (!empty($request->rol)) {
            switch ($request->rol) {
                case "admin" :
                    $rol = "admin";
                    $tipo = "boss";
                    break;
                case  "bossArea"  :
                    $rol = "empleado";
                    $tipo = "boss";
                    break;
                case "employee"   :
                    $rol = "empleado";
                    $tipo = "worker";
            }
        }

       //Validaciones
        if (empty($rol) && empty($tipo)) {
            return false;
        }
        if (empty($request->department)) {
            return false;
        }
        //Búscar el rol y el tipo por slug
        $rolModel = Rol::where('slug', $rol)->first();
        $tipoModel = Type::where('slug', $tipo)->first();
        //registro del usuario

        $user = new User();
        $user->name = $request->name;
        $user->lastname = !empty($request->lastname) ? $request->lastname : "";
        $user->email = $request->mail;
        $user->password = $password;

        $user->slug = str_shuffle("user" . $request->name . date("Ymd") . uniqid());
        $user->id_rol = $rolModel->id;
        $user->id_type = $tipoModel->id;
        $user->save();


        //llenado de la tabla user_department
        $department = Department::where('id',$request->department)->first();
        $userDepartment = new UserDepartment();
        $userDepartment->id_department = $department->id();
        $userDepartment->id_user = $user->id();
        $userDepartment->save();
    }

    public function storeLocatarios(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
