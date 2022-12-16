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
					<h1>Pagamentos Recebidos</h1>
				</div>
				<div class="column">
					<ul class="breadcrumbs">
						<li><a href="{{route('index')}}">Home</a></li>
						<li class="separator">&nbsp;</li>
						<li><a href="{{route('admin.users.index')}}">Conta</a></li>
						<li class="separator">&nbsp;</li>
						<li>Pagamentos Recebidos</li>
					</ul>
				</div>
			</div>
		</div>
		<!-- Page Content-->
		<div class="container mb-2">
			<div class="row">
				@include('layouts.admin.side-menu')	  
				<div class="col-lg-8">
					<div class="col-md-12">
						<h6 class="text-muted text-normal text-uppercase">Lista de pagamentos recebidos</h6>
						<div class="table-responsive">
							<table class="table">
								<thead>
									<tr>
										<th>#</th>
										<th>E-mail</th>
										<th>Código Multben</th>
										<th>Valor Recebeido</th>
										<th>Data/Hora</th>
										<th>Código da Empresa</th>
									</tr>
								</thead>
								<tbody>
									<tr>
										<th scope="row">1</th>
										<td>Return 1</td>
										<td>Return 2</td>
										<td>Return 3</td>
										<td>Return 4</td>
										<td>Return 5</td>
									</tr>
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

