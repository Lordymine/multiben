@extends('layouts.main')

@section('title', '')

@section('css')
    @parent
    <style>
        .custom-file-label::after{content:"Procurar"}
    </style>
@stop

@section('content')
	<div class="modal fade" id="modalCentered" tabindex="-1" role="dialog">
		<div class="modal-dialog modal-dialog-centered" role="document">
			<div class="modal-content">
				<form method="post" enctype="multipart/form-data"action="{{ route('alter_avatar') }}">
					@csrf
					<div class="modal-header">
						<h4 class="modal-title">Alterar imagem de perfil</h4>
						<button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					</div>
					<div class="modal-body">
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label for="account-ln">NOVA IMAGEM DE PERFIL</label>
									<div class="custom-file">
										<input class="custom-file-input" type="file" name="avatar" id="avatar">
										<label class="custom-file-label" for="logo">Ecolha uma logo...</label>
										<p class="text-muted">Imagens nos formatos: jpg, png, jpeg e gif</p>
									</div>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<div class="user-avatar">
										<div class="user-avatar"><img style="display: none" id="img-logo" alt="User"></div>
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
					@if(session('success'))
					<div class="alert alert-success alert-dismissible fade show text-center margin-bottom-1x"><span class="alert-close" data-dismiss="alert"></span><i class="icon-help"></i>&nbsp;&nbsp;<strong>Successo:</strong> {{session('success')}}</div>
					@endif

					@if(session('error'))
					<div class="alert alert-danger alert-dismissible fade show text-center margin-bottom-1x"><span class="alert-close" data-dismiss="alert"></span><i class="icon-help"></i>&nbsp;&nbsp;<strong>Erro:</strong> {{session('error')}}</div>
					@endif
					@if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    					
					<div class="padding-top-2x mt-2 hidden-lg-up"></div>
					<form class="row" method="POST" action="{{ route('user_update') }}">
						@csrf
						<div class="col-md-6">
							<div class="form-group">
								<label for="account-fn">NOME</label>
									<input class="form-control" type="text" id="account-fn" placeholder="Digite seu nome e nome do meio aqui" name="name" value="{{ Auth::user()->name }}" required>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label for="account-fn">SOBRENOME</label>
								<input class="form-control" type="text" id="sobrenome" placeholder="Digite seu sobrenome aqui" name="sobrenome" value="{{ Auth::user()->sobrenome }}" required>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label for="account-ln">DATA DE NASCIMENTO</label>
								<input class="form-control" type="date" id="rg" placeholder="Data de Nascimento" name="data_nascimento" value="{{ Auth::user()->data_nascimento }}">
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label for="account-ln">RG</label>
								<input class="form-control" type="text" id="rg" placeholder="Identidade" name="rg" value="{{ Auth::user()->rg }}">
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label for="account-ln">CPF</label>
								<input class="form-control" type="text" id="cpf" placeholder="###.###.###-##" name="cpf" value="{{ Auth::user()->cpf ?  App\Repositories\UsersRepository::mask(Auth::user()->cpf."'",'###.###.###-##') : ''  }}"  onkeyup="mascara('###.###.###-##',this,event,true)" maxlength="14">
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label for="account-email">E-MAIL </label>
								<input class="form-control" type="email" id="email" name="email" value="{{ Auth::user()->email }}" placeholder="exemplo@exemplo.com" required>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label for="account-phone">TELEFONE</label>
								<input class="form-control" type="text" id="telefone" placeholder="(91)99999-9999" name="telefone" value="{{ App\Repositories\UsersRepository::mask(Auth::user()->telefone."'",'(##) #####-####') }}" onkeyup="mascara('(##) #####-####',this,event,true)" maxlength="15">
							</div>
						</div>
						<div class="col-12">
							<hr class="mt-2 mb-3">
							<div class="d-flex flex-wrap justify-content-between align-items-center">
								<div class="custom-control custom-checkbox d-block">
<!-- 									<input class="custom-control-input" type="checkbox" id="subscribe_me" name="subscribe_me" {{ Auth::user()->subscribe_me ? 'checked' : '' }}> -->
<!-- 									<label class="custom-control-label" for="subscribe_me">Receber novidades</label> -->
								</div>
								<button class="btn btn-primary margin-right-none" type="submit">Salvar Alterações</button>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
	
@stop

@section('js')
    @parent
    <script>
        $(document).ready(function () {
            $("#avatar").change(function () {
                const file = $(this)[0].files[0]
                const fileReader = new FileReader()
                fileReader.onloadend = function () {
                    $("#img-logo").show();
                    $("#img-logo").attr('src',fileReader.result)
                }
                fileReader.readAsDataURL(file);
            });
        });
    </script>
@stop