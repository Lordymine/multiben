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
						<li><a href="{{route('admin.users.index')}}">Conta</a></li>
						<li class="separator">&nbsp;</li>
						<li>Sócios</li>
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
						<h6 class="text-muted text-normal text-uppercase">Lista de sócios cadastrados na plataforma</h6>
						<div class="table-responsive">
							<table class="table">
								<thead>
									<tr>
										<th>#</th>
										<th>Usuário (ID)</th>
										<th>Matrícula</th>
										<th>Aceito</th>
										<th>Ações</th>
									</tr>
								</thead>
								<tbody>
									@foreach($socios as $socio)
									<tr>
										<th scope="row">{{$socio->id}}</th>
										<td>{{$socio->user_id}}</td>
										<td>{{$socio->matricula}}</td>
										<td>{{$socio->aceito}}</td>
										<td>Ações</td>
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

