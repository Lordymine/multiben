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
				<h1>Quem Somos</h1>
			</div>
			<div class="column">
				<ul class="breadcrumbs">
					<li><a href="{{route('index')}}">Home</a></li>
					<li class="separator">&nbsp;</li>
					<li>Quem Somos</li>
				</ul>
			</div>
		</div>
    </div>
    <!-- Page Content-->
    <div class="container padding-bottom-3x mb-2">
		<div class="row justify-content-center">
			<!-- Content-->
			<div class="col-lg-10">
				<h2 class="padding-top-2x">Quem Somos</h2>
				<p class="lead text-justify">Somos uma plataforma que <strong>conecta pessoas</strong> que buscam usufruir do consumo inteligente com as empresas que proporcionam essa prática.</p>
				<p class="lead text-justify">Nosso propósito é te oferecer serviços e produtos de qualidade com custo reduzido. Proporcionando economia para quem contrata e amplas possibilidades de venda para quem é fornecedor ou prestador de serviços.</p>
				<p class="lead text-justify"><strong>Aqui na Multben o futuro já chegou.</strong> E no futuro, pessoas se unem para que todos tenham benefícios. </p>
			</div>
        </div>
    </div>
</div>

@stop

@section('js')
    @parent

@stop

