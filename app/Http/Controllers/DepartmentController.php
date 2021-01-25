<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Rol;
use App\Models\Type;
use App\Models\User;
use App\Models\Department;
use App\Models\UserDepartment;
use phpDocumentor\Reflection\Types\False_;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
class DepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //selecciona los departamentos con sus responsables
        /*Select departments.*, users.name AS user_name, users.id AS users.name FROM
        Departments   JOIN  users_departments ON users_departments.id_department = departments.id
         JOIN  USERS on users.id = users_departments.id_user
         JOIN ROLES on roles.id = users.id_rol
        JOIN TYPES on types.id = users.id_type
        where roles.slug = 'empleado' and types.slug = 'boss'
         *
         * */
        $departments = Department::join('users_departments', 'users_departments.id_department', '=', 'departments.id')
            ->join('users', 'users.id', '=', 'users_departments.id_user')
            ->join('roles', 'roles.id', '=', 'users.id_rol')->join('types', 'types.id', '=', 'users.id_type')->
            where('roles.slug', 'empleado')->where('types.slug', 'boss')->select('departments.*', 'users.name AS user_name', 'users.id AS user_id' )->get();


        //select * from departments;
        return view ('panel.department.all')->with([
            'departments' => $departments,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = User::join('roles', 'users.id_rol', '=', 'roles.id')->where('roles.slug', 'empleado')
            ->select('users.*', 'roles.slug AS rol_slug')->get();

        return view('panel.register.department')->with([
            'users' => $users
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
            'name' => ['required',  'max:255', 'unique:departments'],
            'email' => ['unique:departments,email', 'max:255', 'required'],
            //  'telephone' => ['numeric','max:11' ],
            //   'schedule_from' => ['date_format:H:i:s' ],
            // 'schedule_to' => ['date_format:H:i:s' ],
            'description' => [ 'max:3000' ],
        ];
        $request->validate($rules);
        $userSlug = $request->responsable;
        //Creo el departamento
        $department = new Department();
        $department->name = $request->name;
        $department->email = $request->email;
        $department->telephone = $request->telephone;
        $department->schedule_from = $request->schedule_from;
        $department->schedule_to = $request->schedule_to;
        $department->description = $request->description;
        $department->status = "Disponible";
        $department->save();
        // Si tenemos o no el resposable, sino crearlo
        if($userSlug !== 'createResponsable'){
            /**  Select id from users where slug like %user_slug% **/
            $userObject = User::where('slug', $userSlug)->first(); //seleccionar el id con el el slug
        }else{
            //Crear un nuevo usuario
            $userRules  =  [
                'responsableName' => ['string', 'required', 'max:255' ],
                'responsableLastname' => ['string', 'max:255' ],
                'responsableMail' => ['unique:users,email', 'max:255', 'required'],
            ];
            $request->validate($userRules);
            //Buscamos las foreign key
            $userType = Type::where('slug', 'boss')->first();
            $userRol = Rol::where('slug', 'empleado')->first();
            //procedemos a crear el usuario
            $userObject = new User();
            $userObject->name = $request->responsableName;
            $userObject->lastname = !empty($request->responsableLastName) ? $request->responsableLastName : "";
            $userObject->email = $request->responsableMail;
            //llenado automatico de campos
            $password = Str::random(10); //password
            $userObject->password = $password;
            $userObject->slug = str_shuffle("user" . $request->name . date("Ymd") . uniqid());
            $userObject->id_rol = $userRol->id;
            $userObject->id_type = $userType->id;
            $userObject->save();

        }
        if(empty($userObject)){
            return false;
        }

        $userObject->Departments()->attach($department);

        return view ('panel.department.all');
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

        $department = Department::findorFail($id);
        //Lo que estoy buscando es la tabla principal
        $responsable = User::join('types', 'types.id', '=', 'users.id_type')
            ->join('users_departments', 'users_departments.id_user', '=', 'users.id')
            ->join('roles', 'roles.id', '=', 'users.id_rol' )
            ->join('departments', 'departments.id', '=', 'users_departments.id_department')
            ->where('departments.id', $id)->where('types.slug', 'boss')
            ->where('roles.slug', 'empleado')->select('users.*')->first();

        $users = User::join('roles', 'users.id_rol', '=', 'roles.id')->where('roles.slug', 'empleado')
            ->where('users.id', 'NOT IN', $responsable->id)->select('users.*', 'roles.slug AS rol_slug')->get();

        return view('panel.department.edit')->with([
            'department' => $department,
            'responsable' => $responsable,
            'users' => $users,
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

        $rules = [
            'name' => ['required',  'max:255'],
            'email' => ['email', 'max:255', 'required'],
            'schedule_from' => ['date_format:H:i'],
            'schedule_to' => ['date_format:H:i', 'after:schedule_from'],
            'description' => [ 'max:3000' ],
        ];

        $request->validate($rules);
        $department = Department::findOrFail($id);
        $department->name = $request->name;
        $department->telephone = $request->telephone;
        $department->email = $request->email;
        $department->schedule_from = $request->time_start;
        $department->schedule_to = $request->time_end;
        $department->description = $request->description;
        $department->save();
        if(!empty($request->responsable)){
            $user =  User::where('slug', $request->responsable)->first();
            $userDepartment = UserDepartment::where('id_department', $id)->firstOrFail();
            $userDepartment->id_user = $user->id;
            $userDepartment->save();
        }
        return view ('panel.department.all');


    }



    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

    }

    /**
     * Return the department instance from an ID
     *
     * @param  int  $id
     */
    public function getDepartment($id){
        $id = (int) $id;

        try
        {
            $department = Department::findOrfail($id);
            return response()->json(array('status' => 'ok', 'content' => $department), 200);
        }
// catch(Exception $e) catch any exception
        catch(ModelNotFoundException $e)
        {
            return response()->json(array('status' => 'error', 'content' => $e), 404);
        }



    }

}
