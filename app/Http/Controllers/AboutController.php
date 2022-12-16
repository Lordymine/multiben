<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AboutController extends Controller
{
	public function aboutUs()
	{
		return view('about_us.index');
	}
}
