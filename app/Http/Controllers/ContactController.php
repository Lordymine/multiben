<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use Mail;
use App\Mail\ContactMail;

class ContactController extends Controller
{
	public function Contact()
	{
		return view('contact.contato');
	}
	
	public function postContact(Request $request)
	{
		$fields=$request->validate([
			'name'=>'required|between:3,50',
			'email'=>'required|email|between:5,50',
			'subject'=>'required|between:5,50',
			'question'=>'required|min:5'
		]);
	
		Mail::to('convite@multben.com.br')->send(new ContactMail($fields));
		
		Session::flash('success','E-mail enviado com sucesso!');
		return redirect()->route('contact');
	}
}
