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
					<h1>Minha empresa</h1>
				</div>
				<div class="column">
					<ul class="breadcrumbs">
						<li><a href="{{route('index')}}">Home</a></li>
						<li class="separator">&nbsp;</li>
						<li>Minha empresa</li>
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
					<h6 class="text-muted text-normal text-uppercase">Área administrativa das empresas</h6>
					<hr class="margin-bottom-1x">
					<center><h1>Seja Bem-vindo!</h1></center>
				</div>
			</div>
		</div>
	</div>
@stop

@section('js')
    @parent

@stop
