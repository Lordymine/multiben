<?php

namespace App\Http\Controllers;

use App\User;

class WorksController extends Controller
{
	public function howItworks()
	{
		return view('how_works.index');
	}

	public function searchUserRegistration($stateId)
	{
	    $user = User::where('matricula', $stateId)->first();

	    if ($user != null) {
    	    $name = $user->name ." ". $user->sobrenome;
	        return response()->json($name);
	    } else {
	        return response()->json(
	          'Código do indicador não encontrado!'
	        , 500);
	    }
	}
}
