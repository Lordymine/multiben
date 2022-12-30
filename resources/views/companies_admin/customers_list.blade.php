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
					<h1>Lista de Clientes Autorizados</h1>
				</div>
				<div class="column">
					<ul class="breadcrumbs">
						<li><a href="{{route('index')}}">Home</a></li>
						<li class="separator">&nbsp;</li>
						<li>Lista de Clientes Autorizados</li>
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
					<h6 class="text-muted text-normal text-uppercase">Dinheiro já transferido pela Multben para sua conta.</h6>
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
								@foreach($customers as $customer)
								<tr>
									<td>{{$customer->name}}</td>
									<td>{{$customer->matricula}}</td>
									<td>{{$customer->telefone}}</td>
									<td>{{$customer->email}}</td>
									<td>R$ {{$customer->valor_pago}}</td>
									<td><a class="btn btn-success  btn-sm" href="#">Usar</a></td>
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
