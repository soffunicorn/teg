<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;
use App\Models\Rol;
use App\Models\Type;
use App\Models\User;
use App\Models\Department;
use App\Models\UserDepartment;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     *
     * /*preguntar si es un tipo locatario
     * si es de departamento ->buscar el departamento
     * si es de locatario si tiene mas de una preguntar empresa
     *
     */

    public function index()
    {
        $userRol = Rol::join('users', 'users.id_rol', '=', 'roles.id')->
                        where('users.id', auth()->user()->id);
        $userType = Type::join('users', 'users.id_type', '=', 'types.id')->
                        where('users.id', auth()->user()->id);

        //Preguntar que tipo y rol es

        if($userRol->slug  === 'empleado' && $userType->slug === 'boss'){ ///*Jefe de departamento empleado de sambil  */
            //preguntar si es tiene mas de un dpto
            $department = Department::join('users_departments', 'users_departments.id_department', '=', 'departments.id')->
                                      join('users', 'users.id',  '=', 'users_departments.id_user' )->
                                      join('roles', 'roles.id', '=', 'users.id_rol')->
                                      join('types', 'types.id', '=', 'users.id_type')->
                                      where('users.id',auth()->user()->id)->
                                      where('roles.slug', $userRol->slug )->
                                      where('types.slug', $userType->slug )->select('departments.*')->get();

            if($department->count() > 1){
                return view('vista_para_escoger_department')->with(['departments' => $department]);
            }else if($department->count() === 1){
                //setear Dpto
                User::setCurrentDepartment($department[0]->id);
                // panel para el departamento
                return view('vista_panel');
            }

        }else if($userRol->slug  === 'empleado' && $userType->slug === 'worker' ){ /*Trabajador de departamento empleado de sambil  */
            //setear el depto
            $department = Department::join('users_departments', 'users_departments.id_department', '=', 'departments.id')->
            join('users', 'users.id',  '=', 'users_departments.id_user' )->
            join('roles', 'roles.id', '=', 'users.id_rol')->
            join('types', 'types.id', '=', 'users.id_type')->
            where('users.id',auth()->user()->id)->
            where('roles.slug', $userRol->slug )->
            where('types.slug', $userType->slug )->select('departments.*')->first();

            if($department->count() !== 0){
                User::setCurrentDepartment($department->id); //setear el dpto
                return view('vista_panel');
            }
        } else if($userRol->slug === 'local' && $userType->slug === 'owner' ){ /*Arrendatario de un local  */
            //preguntar si es tiene mas de una empresa
            $company = Company::join('user_company', 'user_company.id_user', '=', 'users.id' )->
                                join('companies', 'companies.id', '=', 'user_company.id_company')->
                                join('roles', 'roles.id', '=', 'users.id_rol')->
                                join('types', 'types.id', '=', 'users.id_type')->
                                where('roles.slug',$userRol->slug)-> where('types.slug', $userType->slug )->
                                where('users.id', auth()->user()->id)->select('companies.*')->get();

            if($company->count() > 1){
                return view('vista_para_escoger_company')->with(['companies' => $company]);
            }else if($company->count() === 1){
                User::setCurrentDepartment($company[0]->id); //setear el company
                return view('vista_panel');
            }


        }else if($userRol->slug === 'local'  && $userType->slug === 'boss_local' ){ /*Supervisor del depto  */
            $company = Company::join('user_company', 'user_company.id_user', '=', 'users.id' )->
            join('companies', 'companies.id', '=', 'user_company.id_company')->
            join('roles', 'roles.id', '=', 'users.id_rol')->
            join('types', 'types.id', '=', 'users.id_type')->
            where('roles.slug',$userRol->slug)-> where('types.slug', $userType->slug )->
            where('users.id', auth()->user()->id)->select('companies.*')->first();

            if($company->count() !== 0) {
                User::setCurrentCompany($company->id); //setear el company
                return view('vista_panel');
            }

        }else if($userRol->slug === 'local'  && $userType->slug === 'worker_local'  ){ /*Empleado  del depto  */
            //setear el dpto
            $company = Company::join('user_company', 'user_company.id_user', '=', 'users.id' )->
            join('companies', 'companies.id', '=', 'user_company.id_company')->
            join('roles', 'roles.id', '=', 'users.id_rol')->
            join('types', 'types.id', '=', 'users.id_type')->
            where('roles.slug',$userRol->slug)-> where('types.slug', $userType->slug )->
            where('users.id', auth()->user()->id)->select('companies.*')->first();

            if($company->count() !== 0) {
                User::setCurrentCompany($company->id); //setear el company
                return view('vista_panel');
            }

        }else if($userRol->slug === 'admin' && $userType->slug === 'boss' ){

            return view('vista_admin');
        }else{
            // super_admin
            return view('super_admin');

        }


        return view('home');
    }
}
