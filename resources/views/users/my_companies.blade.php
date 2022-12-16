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
					<h1>Minhas Empresas</h1>
				</div>
				<div class="column">
					<ul class="breadcrumbs">
						<li><a href="{{route('index')}}">Home</a></li>
						<li class="separator">&nbsp;</li>
						<li><a href="{{route('users_profile')}}">Conta</a></li>
						<li class="separator">&nbsp;</li>
						<li>Empresa</li>
					</ul>
				</div>
			</div>
		</div>
		<!-- Page Content-->
		<div class="container padding-bottom-3x mb-2">
			<div class="row">
				@include('layouts.users.side-menu')
				<div class="col-lg-8">
				@csrf
				@if(session('success'))
				<div class="alert alert-success alert-dismissible fade show text-center margin-bottom-1x"><span class="alert-close" data-dismiss="alert"></span><i class="icon-help"></i>&nbsp;&nbsp;<strong>Successo:</strong> {{session('success')}}</div>
				@endif
				<h6 class="text-muted text-normal text-uppercase">Lista de Empresas</h6>
				<div class="table-responsive">
					<table class="table">
						<thead>
							<tr>
								<th>#</th>
								<th>Razão Social</th>
								<th>Nome Fantasia</th>
								<th>CNPJ</th>
								<th>Ação</th>
							</tr>
						</thead>
						<tbody>
							@foreach($empresas as $empresa)
							<tr class="table-active">
								<th scope="row">1</th>
								<td>{{ $empresa->razao_social }}</td>
								<td>{{ $empresa->nome_fantasia }}</td>
								<td>{{ App\Repositories\UsersRepository::mask($empresa->cnpj."'",'##.###.###/####-##') }}</td>
								<td><a class="btn btn-primary btn-sm" href="{{route('user_create_company',encrypt($empresa->id))}}">Editar</a></td>
							</tr>
							@endforeach
						</tbody>
					</table>
				</div>
					<center><a class="btn btn-primary btn-sm" href="{{route('user_create_company')}}">Cadastrar Outra Empresa</a></center>
				</div>
			</div>
		</div>
	</div>

@stop

@section('js')
    @parent

@stop
