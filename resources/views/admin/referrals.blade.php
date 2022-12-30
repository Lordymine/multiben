@extends('layouts.main')

@section('title', '')

@section('css')
    @parent

@stop

@section('content')
<style>
    .page-item {
        display: inline-block;
        width: 36px;
        height: 36px;
        font-size: 14px;
        font-weight: 500;
        line-height: 34px;
        text-align: center;
    }

    .page-item > a {
        display: block;
        width: 36px;
        height: 36px;
        transition: all .3s;
        border: 1px solid transparent;
        border-radius: 50%;
        color: #606975;
        line-height: 34px;
        text-decoration: none;
    }

    .page-item > a:hover {
        border-color: #e1e7ec;
        background-color: #f5f5f5;
    }
    
    .page-item.active {
        border-color: #e1e7ec;
        background-color: #f5f5f5;
        border-radius: 50%;
        
    }
    
    .table td 
    {
        text-align: center; 
        vertical-align: middle;
        padding: .35rem;
    }
    .table th 
    {
        text-align: center; 
        vertical-align: middle;
        padding: .35rem;
    }
    
    tbody tr.selected td {
        background: none repeat scroll 0 0 #ffa;
        color: #000000;
    }
</style>
	<!-- Off-Canvas Wrapper-->
	<div class="offcanvas-wrapper">
		<!-- Page Title-->
		<div class="page-title">
			<div class="container">
				<div class="column">
					<h1>Indicações</h1>
				</div>
				<div class="column">
					<ul class="breadcrumbs">
						<li><a href="{{route('index')}}">Home</a></li>
						<li class="separator">&nbsp;</li>
						<li><a href="{{route('admin.users.index')}}">Conta</a></li>
						<li class="separator">&nbsp;</li>
						<li>Indicações</li>
					</ul>
				</div>
			</div>
		</div>
		<!-- Page Content-->
		<div class="container padding-bottom-3x mb-2">
			<div class="row">
				@include('layouts.admin.side-menu')
				<div class="col-lg-8">
					<div class="col-md-12 ">
						<h6 class="text-muted text-normal text-uppercase">Lista de indicações realizadas na plataforma</h6>
						<div class="table-responsive">
							<table class="table table-striped">
								<thead>
									<tr>
										<th>#</th>
										<th>De</th>
										<th>E-mail</th>
										<th>Para</th>
										<th>Data Hora</th>
									</tr>
								</thead>
								<tbody>
									@foreach($dados as $convidado)
									<tr>
										<th scope="row">1</th>
										<td>{{ $convidado->user->name}} {{$convidado->user->sobrenome}}</td>
										<td>{{ $convidado->user->email }}</td>
										<td>{{ $convidado->email_convidado }}</td>
										<td>{{ $convidado->created_at}}</td>
									</tr>
									@endforeach
								</tbody>
							</table>
							<center>
							{{ $dados != null ? $dados->links() : ''}}</center>
							Total de Registros: {{ $dados != null ? $dados->total() : 0}}
    							
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

