<?php

namespace App\Http\Controllers;

use App\Models\Rol;

use Illuminate\Http\Request;


class MainController extends Controller
{
    public function index(){
        $test = Rol::where('slug', 'admin')->first();
        return view('test.welcome');
    }


    public function test(){

        return view('panel.test');
    }

        public function login(){

        return view('login.login');
    }

}
