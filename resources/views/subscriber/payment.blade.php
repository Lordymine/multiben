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
			<div class="col-xl-9 col-lg-8">
				<div class="checkout-steps">
					<a href="{{asset('assinar-plano-passo-4')}}">4. Resumo da Assinatura</a>
					<a class="active" href="{{asset('assinar-plano-passo-3')}}"><span class="angle"></span>3. Formas de Pagamento</a>
					<a class="completed" href="{{asset('assinar-plano-passo-2')}}"><span class="step-indicator icon-circle-check"></span><span class="angle"></span>2. Endereço</a>
					<a class="completed" href="{{asset('assinar-plano-passo-1')}}"><span class="step-indicator icon-circle-check"></span><span class="angle"></span>1. Dados Pessoais</a>
				</div>
				<h4>Escolha a Forma de Pagamento</h4>
				<hr class="padding-bottom-1x">
				<div class="accordion" id="accordion" role="tablist">
					<div class="card">
						<div class="card-header" role="tab">
							<h6><a class="collapsed"  href="#card" data-toggle="collapse"><i class="icon-columns"></i>Pagamento com Cartão de Crédito</a></h6>
						</div>
						<div class="collapse" id="card" data-parent="#accordion" role="tabpanel">
							<div class="card-body">
								<p>Nós aceitamos os seguintes cartões de créditos:&nbsp;<img class="d-inline-block align-middle" src="img/payment/credit-cards.png" style="width: 120px;" alt="Cerdit Cards"></p>
								<div class="card-wrapper"></div>
								<form class="interactive-credit-card row">
									<div class="form-group col-sm-6">
										<input class="form-control" type="text" name="number" placeholder="Número do Cartão" required>
									</div>
									<div class="form-group col-sm-6">
										<input class="form-control" type="text" name="name" placeholder="Nome Completo" required>
									</div>
									<div class="form-group col-sm-3">
										<input class="form-control" type="text" name="expiry" placeholder="MM/YY" required>
									</div>
									<div class="form-group col-sm-3">
										<input class="form-control" type="text" name="cvc" placeholder="CVC" required>
									</div>
									<div class="col-sm-6">
										<button class="btn btn-outline-primary btn-block margin-top-none" type="submit">Submit</button>
									</div>
								</form>
							</div>
						</div>
					</div>
					<!-- -->
					<div class="card">
						<div class="card-header" role="tab">
							<h6><a class="collapsed" href="#paypal" data-toggle="collapse"><i class="icon-paper"></i>Pagamento com Boleto</a></h6>
						</div>
						<div class="collapse" id="paypal" data-parent="#accordion" role="tabpanel">
							<div class="card-body"><!--
								<p>PayPal - the safer, easier way to pay</p>
								<form class="row" method="post">
									<div class="col-sm-6">
										<div class="form-group">
											<input class="form-control" type="email" placeholder="E-mail" required>
										</div>
									</div>
									<div class="col-sm-6">
										<div class="form-group">
											<input class="form-control" type="password" placeholder="Password" required>
										</div>
									</div>
									<div class="col-12">
										<div class="d-flex flex-wrap justify-content-between align-items-center"><a class="navi-link" href="#">Forgot password?</a>
											<button class="btn btn-outline-primary margin-top-none" type="submit">Log In</button>
										</div>
									</div>
								</form>-->
							</div>
						</div>
					</div>
					<!-- -->
					<div class="card">
						<div class="card-header" role="tab">
							<h6><a class="collapsed" href="#points" data-toggle="collapse"><i class="icon-file"></i>Pagamento com Débito Online</a></h6>
						</div>
						<div class="collapse" id="points" data-parent="#accordion" role="tabpanel">
							<div class="card-body"><!--
								<p>You currently have<span class="text-medium"> 290</span> Reward Points to spend.</p>
								<div class="custom-control custom-checkbox d-block">
									<input class="custom-control-input" type="checkbox" id="use_points">
									<label class="custom-control-label" for="use_points">Use my Reward Points to pay for this order.</label>
								</div>-->
							</div>
						</div>
					</div>
					<!-- -->
				</div>
				<div class="checkout-footer margin-top-1x">
					<div class="column"><a class="btn btn-outline-secondary" href="{{asset('assinar-plano-passo-2')}}"><i class="icon-arrow-left"></i><span class="hidden-xs-down">&nbsp;Voltar</span></a></div>
					<div class="column"><a class="btn btn-primary" href="{{asset('assinar-plano-passo-4')}}"><span class="hidden-xs-down">Continuar&nbsp;</span><i class="icon-arrow-right"></i></a></div>
				</div>
			</div>
        </div>
    </div>
@stop
	
@section('js')
@parent



@stop
