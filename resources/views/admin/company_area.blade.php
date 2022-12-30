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
					<h1>Área Empresa</h1>
				</div>
				<div class="column">
					<ul class="breadcrumbs">
						<li><a href="{{route('index')}}">Home</a></li>
						<li class="separator">&nbsp;</li>
						<li><a href="{{route('admin.users.index')}}">Conta</a></li>
						<li class="separator">&nbsp;</li>
						<li>Área Empresa</li>
					</ul>
				</div>
			</div>
		</div>
		<!-- Page Content-->
		<div class="container padding-bottom-3x mb-2">
			<div class="row justify-content-center">
				<div class="col-md-6">
					<form action="{{route('empresa.autentica')}}" class="login-box" method="post">
						<h4 class="margin-bottom-1x">Acesso Restrito</h4>
						@csrf

						@if($errors->all())
							@foreach($errors->all() as $error)
								<p>{{$error}}</p>
							@endforeach
						@endif
						<div class="form-group input-group">
							<input class="form-control" name="cnpj" type="text" placeholder="CNPJ" required><span class="input-group-addon"><i class="icon-head"></i></span>
						</div>
						<div class="form-group input-group">
							<input class="form-control" name="password" type="password" placeholder="Senha" required><span class="input-group-addon"><i class="icon-lock"></i></span>
						</div>
						<div class="d-flex flex-wrap justify-content-between padding-bottom-1x">
							<div class="custom-control custom-checkbox">
								<input class="custom-control-input" type="checkbox" id="remember_me" checked>
								<label class="custom-control-label" for="remember_me">Lembrar Acesso</label>
							</div>
							<a class="navi-link" href="account-password-recovery.html">Recuperar Acesso?</a>
						</div>
						<div class="text-center text-sm-right">
							<button class="btn btn-primary margin-bottom-none" type="submit">ENTRAR</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
	
@stop

@section('js')
    @parent

@stop