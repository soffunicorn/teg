<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Company;
use App\Models\Type;
use App\Models\Rol;
use App\Models\State;
use App\Models\companyLocal;
use App\Models\local;

use Illuminate\Support\Str;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $companies = Company::join('company_locals', 'company_locals.id_company', '=', 'companies.id')->
                              join('user_company', 'user_company.id_company', '=', 'companies.id')->
                              join('users', 'users.id', '=', 'user_company.id_user')->
                              join('roles', 'roles.id', '=', 'users.id_rol')->
                              join('types', 'types.id', '=', 'users.id_type')->
                              join('locals', 'locals.id', '=', 'company_locals.id_local')->
                              join('states', 'states.id', '=', 'locals.id_state')->
                              where('roles.slug', 'local')->where('types.slug', 'owner')->
                              select('companies.*', 'users.name AS user_name', 'users.slug AS user_slug', 'locals.n_local')->get();


        return view('panel.company.all')->with([
            'companies' => $companies,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = User::join('roles', 'roles.id', '=', 'users.id_rol')->
                       join('types', 'types.id', '=', 'users.id_type')->
                       where('types.slug', 'owner')->where('roles.slug', 'local')->
                       select('users.name AS user_name', 'users.lastname AS user_lastname', 'users.slug AS user_slug')->get();
        $locals = local::join('states', 'states.id', '=', 'locals.id_state')->
                         where('states.slug', 'available')->select('locals.*')->get();

        return view('panel.register.company')->with([
            'users' => $users,
            'locals' => $locals
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
            'name' => ['max:255'],
            'business_reason' => ['required',  'max:255', 'unique:companies'],
            'rif' => ['required',  'max:255', 'unique:companies'],
            'email' => ['unique:companies,email', 'max:255', 'required'],
            'description' => [ 'max:3000'],
            'telephone' => ['numeric'],
        ];
        $request->validate($rules); //validar
        //buscar los estados
        $state = State::where('slug', 'available')->first();
        //guardar la compañia
        $company = new Company();
        $company->name = $request->name;
        $company->business_reason = $request->business_reason;
        $company->slug =str_shuffle("comp" . $request->name . date("Ymd") . uniqid());
        $company->rif = $request->rif;
        $company->id_state = $state->id;
        $company->email = $request->email;
        $company->description = $request->description;
        $company->telephone = $request->telephone;
        $company->schedule_to = !empty($request->schedule_to) ? $request->schedule_to : "";
        $company->schedule_from = !empty($request->schedule_from) ? $request->schedule_from : "";
        $company->save();
        //Si la comañia es de un usuario registrado sino lo creo
        if(! $request->has('local')){
            return false;
        }
        $local = local::where('id_state', $request->local )->first();
        $local->companies()->attach($company);
        //updtear el status del local
        $state = State::where('slug', 'busy')->first(); //busco el estado ocupado
        $local->id_state = $state->id; // le seteo el id busy al local
        $local->save(); //guardo

        if($request->has('registOwner') && $request->registOwner === 'SI' ){
            $user_slug = $request->owner_company;
            $user = User::where('slug', $user_slug)->first();
        } else if ($request->has('registOwner') &&  $request->registOwner === 'NO' ){

                $userRoles  = [
                  'nameOwner' => ['required', 'max:255', 'required'],
                  'lastnameOwner' => [ 'max:255'],
                  'emailOwner' =>['unique:users,email', 'max:255', 'required'],
                ];

                $request->validate($userRoles);
                $password = Str::random(10);
                $type = Type::where('slug', 'owner')->first();
                $rol = Rol::where('slug', 'local')->first();
                //TODO enviar mail con password al usuario
                $slug = str_shuffle("user" . $request->nameOwner . date("Ymd") . uniqid());
                $user = new User();
                $user->name = $request->nameOwner;
                $user->lastname = $request->lastnameOwner;
                $user->email = $request->emailOwner;
                $user->slug = $slug;
                $user->password = $password;
                $user->id_rol = $rol->id;
                $user->id_type = $type->id;
                $user->save();
        }
        if(empty($user)){
           return  false;
        }
        //lenar la tabla relacional user_company
        $user->Companies()->attach($company);

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
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function companyEdit($slug)
    {
        $edit = Company::where('slug', '=', $slug)->firstOrFail();
    $company =  Company::join('company_locals', 'company_locals.id_company', '=', 'companies.id')->
        join('user_company', 'user_company.id_company', '=', 'companies.id')->
        join('users', 'users.id', '=', 'user_company.id_user')->
        join('roles', 'roles.id', '=', 'users.id_rol')->
        join('types', 'types.id', '=', 'users.id_type')->
        join('locals', 'locals.id', '=', 'company_locals.id_local')->
        join('states', 'states.id', '=', 'locals.id_state')->
        where('companies.id', $edit->id)->
        where('roles.slug', 'local')->where('types.slug', 'owner')->
        select('companies.*', 'users.name AS user_name', 'users.lastname AS user_lastname', 'users.slug AS user_slug', 'locals.n_local', 'locals.id AS local_id')->first();

        $users = User::join('roles', 'roles.id', '=', 'users.id_rol')->
        join('types', 'types.id', '=', 'users.id_type')->
        where('types.slug', 'owner')->where('roles.slug', 'local')->where( 'users.slug', '=', $company->user_slug)->
        select('users.name AS user_name', 'users.lastname AS user_lastname', 'users.slug AS user_slug')->get();

        $locals = local::join('states', 'states.id', '=', 'locals.id_state')->
        where('states.slug', 'available')->select('locals.*')->get();

        $status = States::whereNotIn('slug', ['todo', 'process', 'done', 'unavailable'])->get();

        return view('panel.company.edit')->with([
            'company' => $company,
            'users' => $users,
            'locals' => $locals,
            'states' => $status
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
        $company = Company::where('id', $id)->firstOrFail();
        $rules = [
            'name' => ['max:255'],
            'business_reason' => ['required',  'max:255', 'unique:companies'],
            'rif' => ['required',  'max:255', 'unique:companies'],
            'email' => ['unique:companies,email', 'max:255', 'required'],
            'description' => [ 'max:3000'],
            'telephone' => ['numeric'],
        ];
        $request->validate($rules);



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
