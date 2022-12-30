@extends('layouts.main')

@section('title', '')

@section('css')
@parent

@stop

@section('content')
	<!-- Page Title-->
	<div class="page-title">
		<div class="container">
			<div class="column">
				<h1>Assinar Plano</h1>
			</div>
			<div class="column">
				<ul class="breadcrumbs">
					<li><a href="{{asset('home')}}">Home</a></li>
					<li class="separator">&nbsp;</li>
					<li><a href="{{asset('seja-assinante')}}">Seja Assinante</a></li>
					<li class="separator">&nbsp;</li>
					<li>Assinar Plano</li>
				</ul>
			</div>
		</div>
	</div>
	<iframe src="{{ $iugu_url }}" height="600"></iframe>
	
	<!-- Page Content-->
    <div class="container padding-bottom-3x mb-2">  
		<div class="card text-center">
			<div class="card-body padding-top-2x">
				<h3 class="card-title">Obrigado(a) pela Assinatura em um dos nossos planos!</h3>
				<p class="card-text">Seu pedido foi feito e será processado o mais rápido possível.</p>
				<!--  <p class="card-text">Anote o número do seu pedido, que é <span class="text-medium">34VB5540K83</span></p>-->
				<p class="card-text">Você receberá um e-mail em breve com a confirmação do seu pedido.
				<u>Agora você pode:</u>
				</p>
				<div class="padding-top-1x padding-bottom-1x"><a class="btn btn-outline-secondary" href="{{route('users_profile')}}">Voltar para Perfil</a><a class="btn btn-outline-primary" href="{{route('home')}}"><i class="icon-"></i>&nbsp;Ir para Home</a></div>
			</div>
		</div>
    </div>

@stop

@section('js')
@parent



@stop
