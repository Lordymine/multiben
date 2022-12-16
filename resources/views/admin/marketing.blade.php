@extends('layouts.main') @section('title', '') @section('css') @parent
<style>
.custom-file-label::after {
	content: "Procurar"
}

#uploads_empresa .custom-file {
	width: 49%;
	margin-bottom: 5px;
}

#uploads_empresa .main-img {
	width: 98.5%;
}

.product-thumbnails button {
	float: left;
	display: inline-block;
	width: 10em;
	height: 10em;
}

.product-thumbnails img {
	width: 8em;
	height: 7em;
}

.gallery-item img {
	height: 10em;
	width: 10em;
}

.product-thumbnails .close_img:hover {
	/*            background-color:#0a87bf */
	
}

.product-gallery {
	padding-top: 0px !important;
	border: 0px !important;
}

.product-thumbnails {
	margin-top: 0px;
}
</style>
@stop @section('content')
<div class="modal fade" id="modalCentered" tabindex="-1" role="dialog">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<form method="post" enctype="multipart/form-data"
				action="{{ route('alter_avatar') }}">
				@csrf
				<div class="modal-header">
					<h4 class="modal-title">Alterar imagem de perfil</h4>
					<button class="close" type="button" data-dismiss="modal"
						aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label for="account-ln">NOVA IMAGEM DE PERFIL</label>
								<div class="custom-file">
									<input class="custom-file-input" type="file" name="avatar"
										id="avatar"> <label class="custom-file-label" for="logo">Ecolha
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
					<button class="btn btn-outline-secondary btn-sm" type="button"
						data-dismiss="modal">Fechar</button>
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
					<li>Marketing</li>
				</ul>
			</div>
		</div>
	</div>
	<!-- Page Content-->
	<div class="container padding-bottom-3x mb-2">
		<div class="row">
			@include('layouts.users.side-menu-company')
			<div class="col-lg-8">
				<div class="col-md-12">
					<!-- 				<div class="col-lg-8"> -->
					<!-- 					@if(session('error')) -->
					<!-- 				<div class="alert alert-danger alert-dismissible fade show text-center margin-bottom-1x"><span class="alert-close" data-dismiss="alert"></span><i class="icon-help"></i>&nbsp;&nbsp;<strong>Erro:</strong> {{session('error')}}</div> -->
					<!-- 				@endif -->
					<h6 class="text-muted text-normal text-uppercase">Enviar Emails de Marketing</h6>
					<hr class="margin-bottom-1x">

					<!-- 				@if($errors != null && count($errors) > 0) -->
					<!-- 					<div class="row"> -->
					<!-- 						<div class="col-sm-8"> -->
					<!-- 							<div class="alert alert-danger"> -->
					<!-- 								<ul> -->
					<!-- 									@foreach($errors->all() as $error) -->
					<!-- 										<li>{{$error}}</li> -->
					<!-- 									@endforeach -->
					<!-- 								</ul> -->
					<!-- 							</div> -->
					<!-- 						</div> -->
					<!-- 					</div> -->
					<!--                 @endif -->
					@if(session('success'))
					<div class="alert alert-success alert-dismissible fade show text-center margin-bottom-1x"><span class="alert-close" data-dismiss="alert"></span>
					<i class="icon-help"></i>&nbsp;&nbsp;<strong>Successo:</strong> {{session('success')}}</div>
					@endif 

					<div class="padding-top-2x mt-2 hidden-lg-up"></div>
					<form class="row" method="POST" enctype="multipart/form-data" action="{{ route('admin.send.marketing.mail') }}">
						@csrf
						<div class="col-md-12">
							<div class="form-group">
								<label for="account-fn">TÍTULO</label> <input
									class="form-control" type="text" id="titulo"
									placeholder="Digite um título para o email" name="titulo"
									required>
							</div>
						</div>
						<div class="col-md-12">
							<div class="form-group">
								<label for="account-ln">CORPO</label>
								<textarea class="form-control" name="corpo"
									id="corpo" rows="5"r required></textarea>
							</div>
						</div>

						<div class="col-md-6">
							<div class="form-group">
								<label for="account-ln">ADICIONAR IMAGEM</label>
								<div>
									<div class="custom-file">
										<input class="custom-file-input" type="file" name="logo"
											id="logo"> <label class="custom-file-label" for="logo">Ecolha
											uma imagem...</label>
										<p class="text-muted">Imagens nos formatos: jpg, png, jpeg e
											gif</p>
									</div>
								</div>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<div class="gallery-item">
									<img id="img-logo-empresa"
										class="d-block mx-auto img-thumbnail mb-6" alt="Imagem" >
								</div>
							</div>
						</div>
						
						<div class="col-md-12">
							<div class="form-group">
								<label for="account-ln">ENVIAR PARA</label><br>
								<div class="custom-control custom-radio custom-control-inline">
									<input class="custom-control-input" type="radio"
										id="enviar_todos" name="enviar_para" value="1" checked>
									<label class="custom-control-label" for="enviar_todos">TODOS</label>
								</div>
								<div class="custom-control custom-radio custom-control-inline">
									<input class="custom-control-input" type="radio"
										id="enviar_ativos" name="enviar_para" value="2">
									<label class="custom-control-label" for="enviar_ativos">APENAS ATIVOS</label>
								</div>
								<div class="custom-control custom-radio custom-control-inline">
									<input class="custom-control-input" type="radio"
										id="enviar_inativos" name="enviar_para" value="3">
									<label class="custom-control-label" for="enviar_inativos">APENAS INATIVOS</label>
								</div>
							</div>
						</div>

						<div class="col-12">
							<hr class="mt-2 mb-3">
							<div
								class="d-flex flex-wrap justify-content-between align-items-center">
								<div class="custom-control custom-checkbox d-block">
									<input class="custom-control-input" type="checkbox"
										id="subscribe_me" name="subscribe_me" checked>
								</div>
								<button class="btn btn-primary margin-right-none" type="submit" onclick="showPleaseWait();">Enviar Email</button>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
</div>

@stop @section('js') @parent
<script type="text/javascript">
        
        $(document).ready(function() {
        
            $("#logo").change(function () {
                const file = $(this)[0].files[0];
                const fileReader = new FileReader();
                fileReader.onloadend = function () {
                    $("#img-logo-empresa").attr('src',fileReader.result);
                };
                fileReader.readAsDataURL(file);
            });
            
            
        });
        
        function showPleaseWait() {    
        	$title = document.getElementById('titulo').value;
        	$body = document.getElementById('corpo').value;

            if ($title != '' && $body != '' && document.querySelector("#pleaseWaitDialog") == null) {
                var modalLoading = '<div class="modal" id="pleaseWaitDialog" data-backdrop="static" data-keyboard="false" role="dialog">\
                    <div class="modal-dialog">\
                        <div class="modal-content">\
                            <div class="modal-header">\
                                <h5 class="modal-title">Por favor aguarde enquanto enviamos todos os emails.</h5>\
                            </div>\
                            <div class="modal-body">\
                                <div class="progress">\
                                  <div class="progress-bar progress-bar-success progress-bar-striped active" role="progressbar"\
                                  aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width:100%; height: 40px">\
                                  </div>\
                                </div>\
                            </div>\
                        </div>\
                    </div>\
                </div>';
                $(document.body).append(modalLoading);
            }
          
            $("#pleaseWaitDialog").modal("show");
        }
        
    </script>

@stop
