<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Rol;
use App\Models\User;
use App\Models\Department;
use App\Models\UserDepartment;
class DepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //select * from user_department
        $users = Department::
        join('users_departments', 'departments.id', '=', 'users_departments.id')->
        join('users', 'users_departments.id_user', '=', 'users.id')
            ->select('departments.*', 'users.name AS user_name', 'users.id AS user_id' )->get();

        //select * from departments;
       return view ('panel.department.all')->with([
           'departments' => $users,
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
           'name' => ['required',  'max:255'],
          // 'email' => ['email',  'max:255', ],
           'telephone' => ['max:11' ],
        //   'schedule_from' => ['date_format:H:i:s' ],
          // 'schedule_to' => ['date_format:H:i:s' ],
           'description' => [ 'max:3000' ],
        ];
        $request->validate($rules);
       $user_slug = $request->user_slug;
        $department = new Department();
        $department->name = $request->name;
        $department->email = $request->email;
        $department->telephone = $request->telephone;
        $department->schedule_from = $request->schedule_from;
        $department->schedule_to = $request->schedule_to;
        $department->description = $request->description;
        $department->status = "Disponible";
        $department->save();
        //$departament_id = Department::findOrFail($departament->id);
        /**  Select id from users where slug like %user_slug% **/
        $user = User::where('slug', $user_slug)->first(); //seleccionar el id con el el slug
        $user->Departments()->attach($department);
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
