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
<!-- 					<a href="{{asset('assinar-plano-passo-3')}}"><span class="angle"></span>3. Formas de Pagamento</a> -->
<!-- 					<a href="{{asset('assinar-plano-passo-2')}}"><span class="angle"></span>2. Endereço</a> -->
<!-- 					<a class="active" href="{{asset('assinar-plano-passo-1')}}"><span class="angle"></span>1. Dados Pessoais</a> -->
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
				<div class="row">
					<div class="col-sm-6">
						<div class="form-group">
							<label for="checkout-email">E-mail Address</label>
							<input class="form-control" type="email" id="checkout-email">
						</div>
					</div>
					<div class="col-sm-6">
						<div class="form-group">
							<label for="checkout-phone">Phone Number</label>
							<input class="form-control" type="text" id="checkout-phone">
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-6">
						<div class="form-group">
							<label for="checkout-company">Company</label>
							<input class="form-control" type="text" id="checkout-company">
						</div>
					</div>
					<div class="col-sm-6">
						<div class="form-group">
							<label for="checkout-country">Country</label>
							<select class="form-control" id="checkout-country">
								<option>Choose country</option>
								<option>Australia</option>
								<option>Canada</option>
								<option>France</option>
								<option>Germany</option>
								<option>Switzerland</option>
								<option>USA</option>
							</select>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-6">
						<div class="form-group">
							<label for="checkout-city">City</label>
							<select class="form-control" id="checkout-city">
								<option>Choose city</option>
								<option>Amsterdam</option>
								<option>Berlin</option>
								<option>Geneve</option>
								<option>New York</option>
								<option>Paris</option>
							</select>
						</div>
					</div>
					<div class="col-sm-6">
						<div class="form-group">
							<label for="checkout-zip">ZIP Code</label>
							<input class="form-control" type="text" id="checkout-zip">
						</div>
					</div>
				</div>
				<div class="row padding-bottom-1x">
					<div class="col-sm-6">
						<div class="form-group">
							<label for="checkout-address1">Address 1</label>
							<input class="form-control" type="text" id="checkout-address1">
						</div>
					</div>
					<div class="col-sm-6">
						<div class="form-group">
							<label for="checkout-address2">Address 2</label>
							<input class="form-control" type="text" id="checkout-address2">
						</div>
					</div>
				</div>
				<div class="checkout-footer">
					<div class="column"><a class="btn btn-outline-secondary" href="{{asset('seja-assinante')}}"><i class="icon-arrow-left"></i><span class="hidden-xs-down">&nbsp;Voltar para os Planos</span></a></div>
					<div class="column"><a class="btn btn-primary" href="{{asset('assinar-plano-passo-2')}}"><span class="hidden-xs-down">Continuar&nbsp;</span><i class="icon-arrow-right"></i></a></div>
				</div>
			</div>
        </div>
    </div>

@stop

@section('js')
@parent



@stop
