@extends('layouts.main')

@section('title', '')

@section('css')
    @parent

@stop

@section('content')
	<!-- Off-Canvas Wrapper-->
	<div class="offcanvas-wrapper">
		<!-- Page Title-->
		<div class="page-title">
			<div class="container">
				<div class="column">
					<h1>Lista de Pagamentos Usados</h1>
				</div>
				<div class="column">
					<ul class="breadcrumbs">
						<li><a href="{{route('index')}}">Home</a></li>
						<li class="separator">&nbsp;</li>
						<li>Lista de Pagamentos Usados</li>
					</ul>
				</div>
			</div>
		</div>
		<!-- Page Content-->
		<div class="container padding-bottom-3x mb-2">
			<div class="row">
				@include('layouts.companies_admin.side-menu')
				<div class="col-lg-8">
					@if(session('success'))
						<div class="alert alert-success alert-dismissible fade show text-center margin-bottom-1x"><span class="alert-close" data-dismiss="alert"></span><i class="icon-help"></i>&nbsp;&nbsp;<strong>Successo:</strong> {{session('success')}}</div>
					@endif
					<div class="padding-top-2x mt-2 hidden-lg-up"></div>
					<h6 class="text-muted text-normal text-uppercase">Dinheiro já utilizado pelos clientes.</h6>
					<hr class="margin-bottom-1x">
					<div class="table-responsive">
						<table class="table">
							<thead>
								<tr>
									<th>Nome do Cliente</th>
									<th>Matrícula</th>
									<th>Telefone</th>
									<th>Email</th>
									<th>Valor Pago</th>
									<th>Usou desconto?</th>
								</tr>
							</thead>
							<tbody>
								@foreach($payments as $payment)
								<tr>
									<td>{{$payment->name}}</td>
									<td>{{$payment->matricula}}</td>
									<td>{{$payment->telefone}}</td>
									<td>{{$payment->email}}</td>
									<td>R$ {{$payment->valor_pago}}</td>
									<td><a class="btn btn-warning  btn-sm" href="#">Usado</a></td>
								</tr>
								@endforeach
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>

@stop

@section('js')
    @parent

@stop
