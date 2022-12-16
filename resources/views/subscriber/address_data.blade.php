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
	<!-- Page Content-->
    <div class="container padding-bottom-3x mb-2">
        <div class="row  justify-content-center">
			<!-- Checkout Adress-->
			<div class="col-xl-9 col-lg-8">
				<div class="checkout-steps">
					<a href="{{asset('assinar-plano-passo-4')}}">4. Resumo da Assinatura</a>
					<a href="{{asset('assinar-plano-passo-3')}}"><span class="angle"></span>3. Formas de Pagamento</a>
					<a class="active" href="{{asset('assinar-plano-passo-2')}}"><span class="angle"></span>2. Endereço</a>
					<a class="completed" href="{{asset('assinar-plano-passo-1')}}"><span class="angle"></span><span class="step-indicator icon-circle-check"></span>1. Dados Pessoais</a>
				</div>
				<h4>Billing Address</h4>
				<hr class="padding-bottom-1x">
				<div class="row">
					<div class="col-sm-6">
						<div class="form-group">
							<label for="checkout-fn">First Name</label>
							<input class="form-control" type="text" id="checkout-fn">
						</div>
					</div>
					<div class="col-sm-6">
						<div class="form-group">
							<label for="checkout-ln">Last Name</label>
							<input class="form-control" type="text" id="checkout-ln">
						</div>
					</div>
				</div>
				<div class="checkout-footer margin-top-1x">
					<div class="column"><a class="btn btn-outline-secondary" href="{{asset('assinar-plano-passo-1')}}"><i class="icon-arrow-left"></i><span class="hidden-xs-down">&nbsp;Voltar</span></a></div>
					<div class="column"><a class="btn btn-primary" href="{{asset('assinar-plano-passo-3')}}"><span class="hidden-xs-down">Continuar&nbsp;</span><i class="icon-arrow-right"></i></a></div>
				</div>
			</div>
        </div>
    </div>

@stop

@section('js')
@parent



@stop
