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
					<h1>Financeiro</h1>
				</div>
				<div class="column">
					<ul class="breadcrumbs">
						<li><a href="{{route('index')}}">Home</a></li>
						<li class="separator">&nbsp;</li>
						<li><a href="{{route('admin.users.index')}}">Conta</a></li>
						<li class="separator">&nbsp;</li>
						<li>Financeiro</li>
					</ul>
				</div>
			</div>
		</div>
		<!-- Page Content-->
		<div class="container padding-bottom-3x mb-2">
			<div class="row">
				@include('layouts.admin.side-menu')
				<!-- Large Modal-->
				<div class="modal fade" id="modalLarge" tabindex="-1" role="dialog">
					<div class="modal-dialog modal-lg" role="document">
						<div class="modal-content">
							<div class="modal-header">
								<h4 class="modal-title">Histórico de Pagamentos do Assinante</h4>
								<button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
							</div>
							<div class="modal-body">
								<div class="table-responsive">
									<table class="table">
										<thead>
											<tr>
												<th>#</th>
												<th>Valor Pago</th>
												<th>Data de Pagamento</th>
												<th>Tipo de Pagamento</th>
											</tr>
										</thead>
									<tbody>
										<tr>
											<th scope="row">1</th>
											<td>Return 1</td>
											<td>Return 2</td>
											<td>Return 3</td>
										</tr>
									</tbody>
								</table>
							</div>
						</div>
						<div class="modal-footer">
							<button class="btn btn-outline-secondary btn-sm" type="button" data-dismiss="modal">Close</button>
							<button class="btn btn-primary btn-sm" type="button">Save changes</button>
						</div>
					</div>
				</div>
			</div>
			<!-- ./ -->
			<div class="col-lg-8">
				<div class="col-md-12 ">
					<h6 class="text-muted text-normal text-uppercase">Lista de assinantes</h6>
					<div class="table-responsive">
						<table class="table">
							<thead>
								<tr>
									<th>#</th>
									<th>Nome</th>
									<th>E-mail</th>
									<th>Código Multben</th>
									<th>Data Criação</th>
									<th>Ações</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<th scope="row">1</th>
									<td>Return 1</td>
									<td>Return 2</td>
									<td>Return 3</td>
									<td>Return 4</td>
									<!--<td><a class="btn btn-sm btn-primary" href="#">Consultar</a></td>-->
									<td><button class="btn btn-sm btn-outline-primary" type="button" data-toggle="modal" data-target="#modalLarge">Consultar</button></td>
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

