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
					<h1>Minhas Indicações</h1>
				</div>
				<div class="column">
					<ul class="breadcrumbs">
						<li><a href="{{route('index')}}">Home</a></li>
						<li class="separator">&nbsp;</li>
						<li><a href="{{route('users_profile')}}">Conta</a></li>
						<li class="separator">&nbsp;</li>
						<li>Minhas Indicações</li>
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
						<h6 class="text-muted text-normal text-uppercase">Indicar amigo para a fazer parte da plataforma</h6>
						<hr class="margin-bottom-1x">
						<form class="row" method="POST" action="{{ route('user_store_referrals') }}">
							@csrf
							<div class="col-md-12">
								<div class="form-group">
									<label for="account-fn">E-MAIL DO AMIGO</label>
									<input class="form-control" type="text" id="account-fn" placeholder="Digite o e-mail do seu amigo/conhecido/família aqui" name="email_convidado" value="" required>
								</div>
							</div>
							<div class="col-12">
								<hr class="mt-2 mb-3">
								<div class="d-flex flex-wrap justify-content-between align-items-center">
									<div class="custom-control custom-checkbox d-block">
										<input class="custom-control-input" type="checkbox" id="subscribe_me" name="subscribe_me" checked>
									</div>
									<button class="btn btn-primary margin-right-none" type="submit">Indicar Amigo</button>
								</div>
							</div>
						</form>
					</div>
					<div class="col-md-12 padding-top-2x">
						<h6 class="text-muted text-normal text-uppercase">Lista de indicados que aceitaram seu convite</h6>
						<hr class="margin-bottom-1x">
						<div class="table-responsive">
							<table class="table table-striped">
								<thead>
									<tr>
										<th>#</th>
										<th>Nome</th>
										<th>E-mail</th>
										<th>Data Hora</th>
										<th>Status</th>
									</tr>
								</thead>
								<tbody>
									@foreach($convidados as $convidado)
									<tr>
										<th scope="row">1</th>
										<td>{{ $convidado->name }}</td>
										<td>{{ $convidado->email }}</td>
										<td>{{ $convidado->created_at }}</td>
										<td>{{ $convidado->ativoEmAlgumPlano() != null ? ($convidado->ativoEmAlgumPlano() == '1' ? 'Ativo' : 'Inativo') : ''}}</td>
									</tr>
									@endforeach
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
