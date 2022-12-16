@extends('layouts.main')

@section('title', '')

@section('css')
    @parent

@stop

@section('content')
<style>
	.faq-card > a:hover{
		color: #0ca2e5;
		background: red;
	}
</style>
 <!-- Off-Canvas Wrapper-->
 <div class="offcanvas-wrapper">
	<!-- Page Title-->
    <div class="page-title">
		<div class="container">
			<div class="column">
				<h1>Como podemos ajudar?</h1>
			</div>
			<div class="column">
				<ul class="breadcrumbs">
					<li><a href="{{route('index')}}">Home</a></li>
					<li class="separator">&nbsp;</li>
					<li>Perguntas frequentes</li>
				</ul>
			</div>
		</div>
    </div>
    <!-- Page Content-->
    <div class="container padding-top-1x mt-1 padding-bottom-1x mb-2">
		<div class="row">
            <div class="col-lg-4 margin-bottom-1x">
				<div class="card text-center">
					<a href="{{route('faq_assinante')}}" style="text-decoration: none;">
						<div class="card-body">
							<h4 class="card-title"><i class="icon-heart"></i> Para Assinantes</h4>
							<!--<p class="card-text">With supporting text below as a natural lead-in to additional content.</p><a class="btn btn-outline-primary btn-sm" href="#">Go somewhere</a>-->
						</div>
					</a>
				</div>
            </div>
            <div class="col-lg-4 margin-bottom-1x">
				<div class="card text-center">
					<a href="{{route('faq_parceiro')}}" style="text-decoration: none;">
						<div class="card-body">
							<h4 class="card-title"><i class="icon-heart"></i> Para Parceiros</h4>
							<!--<p class="card-text">With supporting text below as a natural lead-in to additional content.</p><a class="btn btn-outline-primary btn-sm" href="#">Go somewhere</a>-->
						</div>
					</a>
				</div>
            </div>
            <div class="col-lg-4 margin-bottom-1x">
				<div class="card text-center">
					<a href="{{route('faq_conveniados')}}" style="text-decoration: none;">
						<div class="card-body">
							<h4 class="card-title"><i class="icon-heart"></i> Para Conveniados</h4>
							<!--<p class="card-text">With supporting text below as a natural lead-in to additional content.</p><a class="btn btn-outline-primary btn-sm" href="#">Go somewhere</a>-->
						</div>
					</a>
				</div>
			</div>
		</div>
    </div>
</div>

@stop

@section('js')
    @parent

@stop

