<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PrivacyController extends Controller
{
	public function privacyPolicy()
	{
		return view('privacy.politica-de-privacidade');
	}
	public function termsConditions()
	{
		return view('privacy.termos-e-condicoes-de-uso');
	}
}
