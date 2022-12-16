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
					<h1>Sócios</h1>
				</div>
				<div class="column">
					<ul class="breadcrumbs">
						<li><a href="{{route('index')}}">Home</a></li>
						<li class="separator">&nbsp;</li>
						<li><a href="{{route('users_profile')}}">Conta</a></li>
						<li class="separator">&nbsp;</li>
						<li>Sócios</li>
					</ul>
				</div>
			</div>
		</div>
		<!-- Page Content-->
		<div class="container padding-bottom-3x mb-2">
			<div class="row">
				@include('layouts.users.side-menu')
				<div class="col-lg-8">
					<div class="col-md-12">
						@if(session('success'))
						<div class="alert alert-success alert-dismissible fade show text-center margin-bottom-1x"><span class="alert-close" data-dismiss="alert"></span><i class="icon-help"></i>&nbsp;&nbsp;<strong>Successo:</strong> {{session('success')}}</div>
						@endif
						
						@if(session('error'))
						<div class="alert alert-danger alert-dismissible fade show text-center margin-bottom-1x"><span class="alert-close" data-dismiss="alert"></span><i class="icon-help"></i>&nbsp;&nbsp;<strong>Erro:</strong> {{session('error')}}</div>
						@endif
					
						<div class="padding-top-2x mt-2 hidden-lg-up"></div>
						<h6 class="text-muted text-normal text-uppercase">Cadastro de Sócio</h6>
						<hr class="margin-bottom-1x">
						<form class="row" method="POST" action="{{ route('user_add_business_partner') }}">
							@csrf
							<div class="col-md-12">
								<div class="form-group">
									<label for="account-fn">CÓDIGO MULTBEN</label>
									<input class="form-control" type="text" id="account-fn" placeholder="Digite o código Multben do seu sócio aqui" name="name" value="" required>
								</div>
								<div class="form-group">
									<label for="account-fn">NOME DO SÓCIO</label>
									<input class="form-control" type="text" id="account-fn" placeholder="Digite o nome do seu sócio aqui" name="name" value="" required>
								</div>
							</div>
							<div class="col-12">
								<hr class="mt-2 mb-3">
								<div class="d-flex flex-wrap justify-content-between align-items-center">
									<div class="custom-control custom-checkbox d-block">
										<input class="custom-control-input" type="checkbox" id="subscribe_me" name="subscribe_me" checked>
									</div>
									<button class="btn btn-primary margin-right-none" type="submit">Adicionar Sócio</button>
								</div>
							</div>
						</form>
					</div>
					<div class="col-md-12 padding-top-2x">
						<h6 class="text-muted text-normal text-uppercase">Lista de Sócios</h6>
						<hr class="margin-bottom-1x">
						<div class="table-responsive">
							<table class="table table-inverse table-striped">
								<thead>
									<tr>
										<th>#</th>
										<th>Nome</th>
										<th>E-mail</th>
										<th>Telefone</th>
										<th><center>Remover sócio</center></th>
									</tr>
								</thead>
								<tbody>@foreach($socios as $socio)
									<tr>
										<td scope="row">1</td>
										<td>{{ $socio->name }}</td>
										<td>{{ $socio->email }}</td>
										<td>{{ $socio->telefone }}</td>@if($socio->aceito  == 'N')
										<td><center><span class="text-warning">AGUARDANDO A RESPOSTA DO CONVITE</span></center></td>@else
										<td><center><a href="{{route('user_remove_business_partner',encrypt($socio->id))}}"><i class="icon-trash"></i></i></i></a></center></td>@endif
									</tr>@endforeach
								</tbody>		
							</table>
						</div>
					</div>
				</div>	
			</div>
		</div>
	</div>
	
@stop

@section('js')
    @parent

@stop
