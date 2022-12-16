<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FaqController extends Controller
{
	public function Faq()
	{
		return view('faq.index');
	}
	public function faqAssinante()
	{
		return view('faq.faq_assinante');
	}
	public function faqParceiro()
	{
		return view('faq.faq_parceiro');
	}
	public function faqConveniados()
	{
		return view('faq.faq_conveniados');
	}
}
