<?php

namespace App\Http\Controllers;

use App\Models\Action;
use App\Models\Log;
use Illuminate\Http\Request;

class LogController extends Controller
{

    /**
     * Update the specified resource in storage.
     *
     * String action, slug de la accion
     * @return \Illuminate\Http\Response
     */
    public function updateLog($action){
        $action = Action::where('slug', $action)->first();
        $log = new Log();
        $log->id_user = auth()->user()->id;
        $log->id_action = $action->id;
        $log->save();
        return true;
    }


}
