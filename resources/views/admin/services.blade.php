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
					<h1>Serviços</h1>
				</div>
				<div class="column">
					<ul class="breadcrumbs">
						<li><a href="{{route('index')}}">Home</a></li>
						<li class="separator">&nbsp;</li>
						<li><a href="{{route('admin.users.index')}}">Conta</a></li>
						<li class="separator">&nbsp;</li>
						<li>Serviços</li>
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
						<h6 class="text-muted text-normal text-uppercase">Lista de serviços cadastrados na plataforma</h6>
						<div class="table-responsive">
							<table class="table">
								<thead>
									<tr>
										<th>#</th>
										<th>Descrição</th>
										<th>Categoria</th>
										<th>Valor</th>
										<th>Desconto</th>
										<th>Empresa (ID)</th>
										<th>Ações</th>
									</tr>
								</thead>
								<tbody>
									@foreach($servicos as $service)
									<tr>
										<th scope="row">{{$service->id}}</th>
										<td>{{$service->descricao}}</td>
										<td>{{$service->atividade_servico_id}}</td>
										<td>{{$service->valor}}</td>
										<td>{{$service->desconto}}</td>
										<td>{{$service->empresa_id}}</td>
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

