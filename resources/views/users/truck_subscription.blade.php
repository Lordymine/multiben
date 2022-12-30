@extends('layouts.main') @section('title', '') @section('css') @parent
<style>
	.custom-file-label::after {
		content: "Procurar"
	}
</style>
@stop @section('content')
<div class="modal fade" id="modalCentered" tabindex="-1" role="dialog">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<form method="post" enctype="multipart/form-data" action="{{ route('alter_avatar') }}">
				@csrf
				<div class="modal-header">
					<h4 class="modal-title">Alterar imagem de perfil</h4>
					<button class="close" type="button" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label for="account-ln">NOVA IMAGEM DE PERFIL</label>
								<div class="custom-file">
									<input class="custom-file-input" type="file" name="avatar" id="avatar"> <label class="custom-file-label" for="logo">Ecolha
										uma logo...</label>
									<p class="text-muted">Imagens nos formatos: jpg, png, jpeg e
										gif</p>
								</div>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<div class="user-avatar">
									<div class="user-avatar">
										<img style="display: none" id="img-logo" alt="User">
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button class="btn btn-outline-secondary btn-sm" type="button" data-dismiss="modal">Fechar</button>
					<button class="btn btn-primary btn-sm" type="submit">Salvar</button>
				</div>
			</form>
		</div>
	</div>
</div>
<!-- Off-Canvas Wrapper-->
<div class="offcanvas-wrapper">
	<!-- Page Title-->
	<div class="page-title">
		<div class="container">
			<div class="column">
				<h1>Perfil</h1>
			</div>
			<div class="column">
				<ul class="breadcrumbs">
					<li><a href="{{route('index')}}">Home</a></li>
					<li class="separator">&nbsp;</li>
					<li><a href="{{route('users_profile')}}">Conta</a></li>
					<li class="separator">&nbsp;</li>
					<li>Perfil</li>
				</ul>
			</div>
		</div>
	</div>
	<!-- Page Content-->
	<div class="container padding-bottom-3x mb-2">

		<div class="row">
			@include('layouts.users.side-menu')
			<div class="col-lg-8">
				<h6 class="text-muted text-normal text-uppercase">Meu Plano</h6>
				<hr class="margin-bottom-1x">

				<form action="{{ route('alter_plano') }}" method="post">
					@csrf
					
					@if($mensagem != null)
					<div class="alert alert-warning alert-dismissible fade show text-center margin-bottom-1x">
						<span class="alert-close" data-dismiss="alert"></span><i class="icon-help"></i>&nbsp;&nbsp;<strong>{{$mensagem}}</strong>
					</div>
					@endif

					<div class="col-md-6">

						<div class="form-group">
							@if($url != null && $fatura != 'expired')
							<p>
								<a href="{{ $url }}" target="_blank" class="btn margin-right-none"><span>2ª Via Boleto</span></a>
							</p>
							@endif
						</div>
					</div>

					<div class="padding-top-2x mt-2 hidden-lg-up"></div>
					<div class="col-md-6">
						<div class="form-group">
							<label for="account-fn">PLANO</label> 
							<select name="iugu_plan" id="iugu_plan" class="form-control">
								<option value="IND" {!! ($subscription->iugu_plan == 'IND') ? 'selected' : '' !!} >Indivídua</option>
								<option value="FAM" {!! ($subscription->iugu_plan == 'FAM') ? 'selected' : '' !!} >Familiar</option>
							</select>
						</div>
					</div>
					<div class="col-md-5">
						<button type="submit"  class="btn btn-primary">{{ __('Mudar de Plano') }}</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
</div>
</div>

@stop @section('js') @parent @stop