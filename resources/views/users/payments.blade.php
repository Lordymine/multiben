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
					<h1>Meus Pagamentos</h1>
				</div>
				<div class="column">
					<ul class="breadcrumbs">
						<li><a href="{{route('index')}}">Home</a></li>
						<li class="separator">&nbsp;</li>
						<li><a href="{{route('users_profile')}}">Conta</a></li>
						<li class="separator">&nbsp;</li>
						<li>Meus Pagamentos</li>
					</ul>
				</div>
			</div>
		</div>
		<!-- Page Content-->
		<div class="container padding-bottom-3x mb-2">
			<div class="row">
				@include('layouts.users.side-menu')
				<div class="col-lg-8">
					<div class="padding-top-2x mt-2 hidden-lg-up"></div>
					<h6 class="text-muted text-normal text-uppercase">Lista de Pagamentos</h6>
					<div class="table-responsive">
						<table class="table">
							<thead>
								<tr>
									<th>#</th>
									<th>Referência</th>
									<th>Tipo</th>
									<th>Data Hora</th>
								</tr>
							</thead>
							<tbody>
							@if($pagamentos != null)
								@foreach($pagamentos as $pagamento)
								<tr>
									<th scope="row">1</th>
									<td>{{ $pagamento->referencia }}</td>
									<td>{{ $pagamento->nome }}</td>
									<td>{{ $pagamento->data_pagamento }}</td>
								</tr>
								@endforeach
							@endif
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
