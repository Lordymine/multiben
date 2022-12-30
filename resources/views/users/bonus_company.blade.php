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

    <div class="modal" id="modalDadosSolic" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
		</div>
    </div>

	<!-- Off-Canvas Wrapper-->
	<div class="offcanvas-wrapper">
		<!-- Page Title-->
		<div class="page-title">
			<div class="container">
				<div class="column">
					<h1>Solicitações de Bônus</h1>
				</div>
				<div class="column">
					<ul class="breadcrumbs">
						<li><a href="{{route('index')}}">Home</a></li>
						<li class="separator">&nbsp;</li>
						<li><a href="{{route('users_profile')}}">Conta</a></li>
						<li class="separator">&nbsp;</li>
						<li>Empresa</li>
					</ul>
				</div>
			</div>
		</div>
		<!-- Page Content-->
		<div class="container padding-bottom-3x mb-2">
			<div class="row">
				@include('layouts.users.side-menu-company')
				<div class="col-lg-8">
    				@csrf
    				@if(session('success'))
    				<div class="alert alert-success alert-dismissible fade show text-center margin-bottom-1x"><span class="alert-close" data-dismiss="alert"></span><i class="icon-help"></i>&nbsp;&nbsp;<strong>Successo:</strong> {{session('success')}}</div>
    				@endif
    				<div class="col-md-12">
        				<form action="{{ route('bonus-concluir-voucher') }}">
            				<h6 class="text-muted text-normal text-uppercase">Solicitações de Bônus</h6>
            				<div class="table-responsive">
            					<table class="table table-striped">
            						<thead>
                                        <tr>
                                        	<th></th>
            								<th>#</th>
            								<th>Voucher</th>
            								<th>Status</th>
            								<th>CPF Solicitante</th>
            								<th>Valor</th>
            								<th>Data da Solicitação</th>
            							</tr>
                                    </thead>
            						<tbody>
    								<?php $existePendente = null?>
            						@if($solicitacoes != null)
                                        @foreach($solicitacoes as $solicitacao)
                							<tr>
                								@if($solicitacao->status != null && $solicitacao->status == 'Aprovado' && $solicitacao->empresa_id != null)
                								<?php $existePendente = true?>
                								<td scope="row"><input type="radio" class="radio-option" id="data{{encrypt($solicitacao->id)}}" name="data" value="{{encrypt($solicitacao->id)}}"></option></td>
                								@else
                								<td></td>
                								@endif
                								<td scope="row">{{ $loop->iteration + $solicitacoes->firstItem() - 1 }}</td>
                                                <td><a href="{{'solicitation-detail/'.encrypt($solicitacao->id)}}" class="create-modal">{{  $solicitacao->voucher }}</a></td>
                                                <td>{{  $solicitacao->status }}</td>
                								<td><span title="{{ $solicitacao->user->name.' '.$solicitacao->user->sobrenome}}">{{  $solicitacao->user->cpf }}</span></td>
                								<td>{{  $solicitacao->valor == null ? '0,00' : number_format($solicitacao->valor,2) }}</td>
                                                <td>{{  date('d/m/Y H:i', strtotime($solicitacao->created_at))}}</td>
                							</tr>
                                        @endforeach
            						@endif
            						
            						</tbody>
            					</table>
            				</div>
            				<center>{{ $solicitacoes != null ? $solicitacoes->links() : ''}}</center>
            				Total de Registros: {{ $solicitacoes != null ? $solicitacoes->total() : 0 }}
            				<center>
            				@if($existePendente != null)
            				<div class="info-label" style="display: inline;" data-toggle="tooltip" title="Selecione uma solicitação PENDENTE e clique aqui para Finaliza-la">
            					<center><button class="btn btn-primary btn-sm" type="submit" id="finalizar" disabled>Finalizar Solicitação</button></center>
            				</div>
            				@else
            				<div class="info-label" style="display: inline;" data-toggle="tooltip" title="Sem solicitações Pendentes para finalizar">
            					<center><button class="btn btn-primary btn-sm" disabled>Finalizar Solicitação</button></center>
            				</div>
            				@endif
            			</form>
        			</div>
				</div>
			</div>
		</div>
	</div>

@stop

@section('js')
    @parent
<script>
	$(".radio-option").click(function () {
		$("#finalizar").removeAttr("disabled");
		$(this).closest('tr').addClass("selected").siblings().removeClass("selected");
	});
    
    $('.create-modal').click(function(event) {
    	$(this).closest('tr').addClass("selected").siblings().removeClass("selected");
        event.preventDefault();

        var url = $(this).attr('href');

        $("#modalDadosSolic").modal('show');

        $.ajax({
            url: url,
            type: 'GET',
            dataType: 'html',
        })
        .done(function(response) {
            $("#modalDadosSolic").find('.modal-dialog').html(response);
        });

    });
	
</script>

@stop
