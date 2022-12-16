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
					<h1>Dashboard</h1>
				</div>
				<div class="column">
					<ul class="breadcrumbs">
						<li><a href="{{route('index')}}">Home</a></li>
						<li class="separator">&nbsp;</li>
						<li><a href="{{route('admin.users.index')}}">Conta</a></li>
						<li class="separator">&nbsp;</li>
						<li>Dashboard</li>
					</ul>
				</div>
			</div>
		</div>
		<!-- Page Content-->
		<div class="container padding-bottom-3x mb-2">
			<div class="row">
				@include('layouts.admin.side-menu')	  
				<div class="col-lg-8">
					<div class="col-md-12">
						<h6 class="text-muted text-normal text-uppercase">Dashboard dos dados que estão ativos</h6>
						<hr class="margin-bottom-1x">
						<div class="row">
							<div class="col-sm-6 margin-bottom-1x pb-1">
								<div class="card">
									<div class="card-body">
										<h4 class="card-title">Card title 1</h4>
										<p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
										<a class="btn btn-primary btn-sm" href="#">consultar</a>
									</div>
								</div>
							</div>
							<div class="col-sm-6 margin-bottom-1x pb-1">                
								<div class="card">
									<div class="card-body">
										<h4 class="card-title">Card title 2</h4>
										<p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
										<a class="btn btn-primary btn-sm" href="#">consultar</a>
									</div>
								</div>
							</div>
							<div class="col-sm-6 margin-bottom-1x pb-1">                
								<div class="card">
									<div class="card-body">
										<h4 class="card-title">Card title 3</h4>
										<p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
										<a class="btn btn-primary btn-sm" href="#">consultar</a>
									</div>
								</div>
							</div>
							<div class="col-sm-6 margin-bottom-1x pb-1">                
								<div class="card">
									<div class="card-body">
										<h4 class="card-title">Card title 4</h4>
										<p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
										<a class="btn btn-primary btn-sm" href="#">consultar</a>
									</div>
								</div>
							</div>
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

