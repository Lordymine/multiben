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
</style>

	<!-- Off-Canvas Wrapper-->
	<div class="offcanvas-wrapper">
		<!-- Page Title-->
		<div class="page-title">
			<div class="container">
				<div class="column">
					<h1>Usuários</h1>
				</div>
				<div class="column">
					<ul class="breadcrumbs">
						<li><a href="{{route('index')}}">Home</a></li>
						<li class="separator">&nbsp;</li>
						<li><a href="{{route('admin.users.index')}}">Conta</a></li>
						<li class="separator">&nbsp;</li>
						<li>Usuários</li>
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
						<h6 class="text-muted text-normal text-uppercase">Lista de usuários cadastrados no sistema</h6>
						<div class="table-responsive">
							<table class="table">
								<thead>
									<tr>
										<th>Matricula</th>
										<th>Nome</th>
										<th>Sobrenome</th>
										<th>Email</th>
										<th>Telefone</th>
										<th>CPF</th>
									</tr>
								</thead>
								<tbody>
									@foreach($users as $user)
									<tr>
										<td scope="row">{{$user->matricula}}</td>
										<td>{{$user->name}}</td>
										<td>{{$user->sobrenome}}</td>
										<td>{{$user->email}}</td>
										<td>{{$user->telefone}}</td>
										<td>{{$user->cpf}}</td>
									</tr>
									@endforeach
								</tbody>
							</table>
							<center>
							{{ $users != null ? $users->links() : ''}}</center>
							Total de Registros: {{ $users != null ? $users->total() : 0}}
    						
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

