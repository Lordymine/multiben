@extends('layouts.main')

@section('title', '')

@section('css')
@parent

@stop

@section('content')
	<style>
		.pricing {
			position: relative;
			margin-bottom: 15px;
			border: 2px solid #eee;
		}
		.pricing-active {
			border: 3px solid #36d7ac;
			margin-top: -10px;
			box-shadow: 7px 7px rgba(54, 215, 172, 0.2);
		}
		.pricing:hover {
			border: 3px solid #1bd59a;
		}
		.pricing:hover h4 {
			color: #2a57ac;
		}
		.pricing-head {
			text-align: center;
		}
		.pricing-head h3,
		.pricing-head h4 {
			margin: 0;
			line-height: normal;
		}
		.pricing-head h3 span,
		.pricing-head h4 span {
			display: block;
			margin-top: 5px;
			font-size: 14px;
			font-style: italic;
		}
		.pricing-head h3 {
			font-weight: 300;
			color: #fafafa;
			padding: 12px 0;
			font-size: 27px;
			/*background: #2a57ac;*/
			/*border-radius: 9px 9px 0px 0px;*/
		}
		.pricing-head h4 {
			color: #606975;
			padding: 5px 0;
			font-size: 54px;
			font-weight: 300;
			background: #fbfef2;
			border-bottom: solid 1px #f5f9e7;
		}
		.pricing-head-active h4 {
			color: #36d7ac;
		}
		.pricing-head h4 i {
			top: -8px;
			font-size: 28px;
			font-style: normal;
			position: relative;
		}
		.pricing-head h4 span {
			top: -10px;
			font-size: 14px;
			font-style: normal;
			position: relative;
		}
		.pricing-content li {
			color: #606975;
			font-size: 14px;
			padding: 7px 25px;
			/*border-bottom: solid 1px #f5f9e7;*/
		}
		.pricing-content li [class*=" icon-check"], [class^="icon-check"]{
			color: #1bd59a;
			font-weight: bold;
		}
		.pricing-content li [class*=" icon-cross"], [class^="icon-cross"]{
			color: #e5e5e5;
			font-weight: bold;
		}
		.pricing-footer {
			color: #777;
			font-size: 11px;
			line-height: 17px;
			text-align: center;
			padding: 0 20px 19px;
		}
		.price-active,
		.pricing:hover {
			z-index: 9;
		}
		.price-active h4 {
			color: #36d7ac;
		}
		.no-space-pricing .pricing:hover {
			transition: box-shadow 0.2s ease-in-out;
		}
		.no-space-pricing .price-active .pricing-head h4,
		.no-space-pricing .pricing:hover .pricing-head h4 {
			color: #36d7ac;
			padding: 15px 0;
			font-size: 80px;
			transition: color 0.5s ease-in-out;
		}
		.yellow-crusta.btn {
			color: #FFFFFF;
			background-color: #1bd59a;
		}
		.yellow-crusta.btn:hover,
		.yellow-crusta.btn:focus,
		.yellow-crusta.btn:active,
		.yellow-crusta.btn.active {
			color: #FFFFFF;
			background-color: #54c3a0;
		}
		.btn-buy{
			color: #777;
			font-size: 11px;
			line-height: 17px;
			text-align: center
		}
		@media (min-width: 320px) and (max-width: 1199px) {
			.view-mobile{
				display: block;
			}
			.view-desktop{
				display: none;
			}
		}
		@media (min-width: 1200px) {
			.view-mobile{
				display: none;
			}
		}

		.not-active {
          pointer-events: none;
          cursor: default;
          text-decoration: none;
          color: black;
        }

	</style>
	<!-- Page Title-->
	<div class="page-title">
		<div class="container">
			<div class="column">
				<h1>Seja Assinante</h1>
			</div>
			<div class="column">
				<ul class="breadcrumbs">
					<li><a href="{{asset('home')}}">Home</a></li>
					<li class="separator">&nbsp;</li>
					<li>Seja Assinante</li>
				</ul>
			</div>
		</div>
	</div>
	<div class="container padding-bottom-3x mb-2">
		<div class="row view-desktop" >
			<div class="col-md-4">
				<div class="pricing hover-effect">
					<div class="pricing-head">
						<h3 style="color: #ff843b; border-top: solid 5px #ff843b;"><span> Plano </span> IND</h3>
					</div>
					<ul class="pricing-content list-unstyled">
						<li><i class="icon-check"></i> Acesso Irrestrito a todos os parceiros</li>
						<li><i class="icon-check"></i> Uso Ilimitado</li>
						<li><i class="icon-check"></i> Desconto em todos os parceiros</li>
						<li><i class="icon-check"></i> Bônus de Indicação</li>
						<li><i class="icon-check"></i> Uso Individual</li>
						<li><i class="icon-cross"></i> Uso Individual + 3 Dependentes Diretos</li>
						<li><i class="icon-cross"></i> Cadastramento MEI</li>
						<li><i class="icon-cross"></i> Anotações Mensais MEI</li>
						<li><i class="icon-cross"></i> Emissão e NF</li>
						<li><i class="icon-cross"></i> Emissão de Guias Mensais</li>
						<li><i class="icon-cross"></i> Declaração MEI Mensal</li>
						<li><i class="icon-cross"></i> Declaração MEI Anual</li>
						<li><i class="icon-cross"></i> Declaração IR Pessoa Física Anual</li>
					</ul>
					<div class="pricing-head">
						<h4 ><i>R$</i>27<i>,00</i><span>	/ mensal </span></h4>
					</div>
					<div class="pricing-footer">
						@if($activePlan == null)
							<a href="{{ route('assinar_plano', ['price' => '27,00', 'description' => 'IND']) }}" class="btn yellow-crusta">Assinar</a>
						@elseif($activePlan == 'IND')
							<span class="alert-warning">{{$message}}</span>
						@endif
					</div>
				</div>
			</div>
			<div class="col-md-4">
				<div class="pricing hover-effect">
					<div class="pricing-head">
						<h3 style="color: #008fff; border-top: solid 5px #008fff;"><span> Plano</span>FAM</h3>
					</div>
					<ul class="pricing-content list-unstyled">
						<li><i class="icon-check"></i> Acesso Irrestrito a todos os parceiros</li>
						<li><i class="icon-check"></i> Uso Ilimitado</li>
						<li><i class="icon-check"></i> Desconto em todos os parceiros</li>
						<li><i class="icon-check"></i> Bônus de Indicação</li>
						<li><i class="icon-cross"></i> Uso Individual</li>
						<li><i class="icon-check"></i> Uso Individual + 3 Dependentes Diretos</li>
						<li><i class="icon-cross"></i> Cadastramento MEI</li>
						<li><i class="icon-cross"></i> Anotações Mensais MEI</li>
						<li><i class="icon-cross"></i> Emissão e NF</li>
						<li><i class="icon-cross"></i> Emissão de Guias Mensais</li>
						<li><i class="icon-cross"></i> Declaração MEI Mensal</li>
						<li><i class="icon-cross"></i> Declaração MEI Anual</li>
						<li><i class="icon-cross"></i> Declaração IR Pessoa Física Anual</li>
					</ul>
					<div class="pricing-head">
						<h4><i>R$</i>47<i>,00</i><span> / mensal </span></h4>
					</div>
					<div class="pricing-footer">
						<!--<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut non libero magna psum olor . </p>-->
						@if($activePlan == null)
						<a href="{{ route('assinar_plano', ['price' => '47,00', 'description' => 'FAM']) }}" class="btn yellow-crusta">Assinar</a>
						@elseif($activePlan == 'FAM')
							<span class="alert-warning">{{$message}}</span>
						@endif
					</div>
				</div>
			</div>
		</div>

		<div class="row view-mobile">
			<div class="col-lg-12">
				<div class="table-responsive">
					<table class="table">
						<thead>
							<tr>
								<th>
									<div class="pricing-head"><h3 style="color: #ff843b; border-top: solid 5px #ff843b;"><span> Plano </span> IND</h3></div>
								</th>
								<th>
									<div class="pricing-head"><h3 style="color: #008fff; border-top: solid 5px #008fff;"><span> Plano</span>FAM</h3></div>
								</th>
							</tr>
						</thead>
						<tbody>
							<tr class="text-center">
								<th colspan="6" style="padding-bottom: 0px; color: #6f7174;">Acesso Irrestrito a todos os parceiros</th>
							</tr>
							<tr class="text-center">
								<th style="border-color: white;"><i class="icon-check"></i></th>
								<td style="border-color: white;"><i class="icon-check"></i></td>
							</tr>
							<tr class="text-center">
								<th colspan="6" style="padding-bottom: 0px; color: #6f7174;">Uso Ilimitado</th>
							</tr>
							<tr class="text-center">
								<th style="border-color: white;"><i class="icon-check"></i></th>
								<td style="border-color: white;"><i class="icon-check"></i></td>
							</tr>
							<tr class="text-center">
								<th colspan="6" style="padding-bottom: 0px; color: #6f7174;">Desconto em todos os parceiros</th>
							</tr>
							<tr class="text-center">
								<th style="border-color: white;"><i class="icon-check"></i></th>
								<td style="border-color: white;"><i class="icon-check"></i></td>
							</tr>
							<tr class="text-center">
								<th colspan="6" style="padding-bottom: 0px; color: #6f7174;">Bônus de Indicação</th>
							</tr>
							<tr class="text-center">
								<th style="border-color: white;"><i class="icon-check"></i></th>
								<td style="border-color: white;"><i class="icon-check"></i></td>
							</tr>
							<tr class="text-center">
								<th colspan="6" style="padding-bottom: 0px; color: #6f7174;">Uso Individual</th>
							</tr>
							<tr class="text-center">
								<th style="border-color: white;"><i class="icon-check"></i></th>
								<td style="border-color: white;"><i class="icon-cross"></i></td>
							</tr>
							<tr class="text-center">
								<th colspan="6" style="padding-bottom: 0px; color: #6f7174;">Uso Individual + 3 Dependentes Diretos</th>
							</tr>
							<tr class="text-center">
								<th style="border-color: white;"><i class="icon-cross"></i></th>
								<td style="border-color: white;"><i class="icon-check"></i></td>
							</tr>
							</tr>

							<tr class="text-center">
								<th style="padding-bottom: 0px;">
									<div class="pricing-head">
										<h5><i style="color: #ff843b;">R$ 27,00</i><br></h5><h6><span style="font-size:small"> / mensal </span></h6>
									</div>
								</th>
								<th style="padding-bottom: 0px;">
									<div class="pricing-head">
										<h5><i style="color: #008fff;">R$ 47,00</i><br></h5><h6><span  style="font-size:small"> / mensal </span></h6>
									</div>
								</th>
							</tr>
							<tr>
								<th style="border-color: white;">
									<div class="btn-buy">
										@if($activePlan == null)
											<a href="{{ route('assinar_plano', ['price' => '27,00', 'description' => 'IND']) }}" class="btn btn-sm yellow-crusta">Assinar</a>
										@elseif($activePlan == 'IND')
                							<span class="alert-warning">{{$message}}</span>
                						@endif
									</div>
								</th>
								<th style="border-color: white;">
									<div class="btn-buy">
										@if($activePlan == null)
											<a href="{{ route('assinar_plano', ['price' => '47,00', 'description' => 'FAM']) }}" class="btn btn-sm  yellow-crusta">Assinar</a>
										@elseif($activePlan == 'FAM')
                							<span class="alert-warning">{{$message}}</span>
                						@endif
									</div>
								</th>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
		</div>

	</div>
@stop

@section('js')
@parent



@stop
