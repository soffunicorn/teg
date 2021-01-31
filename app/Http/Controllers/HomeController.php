<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
        $user = auth()->user()->id; // tengo todos los datos del usuario




        return view('home');
    }
}
