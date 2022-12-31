@extends('layouts.main')

@section('title', '')

@section('css')
    @parent
    <style>
        .custom-file-label::after{content:"Procurar"}
        
        #uploads_empresa .custom-file{
            width:49%;
            margin-bottom: 5px;
        }

        #uploads_empresa .main-img{
            width:98.5%;
        }
        .product-thumbnails button{
            float:left;
            display:inline-block;
            width: 10em;
            height: 10em;
        }
        
        .product-thumbnails img{
            width: 8em;
            height: 7em;
        }
        
        .gallery-item img{
            height: 10em;
            width: 10em;
        }
        
        .product-thumbnails .close_img:hover{
/*            background-color:#0a87bf */
        }
        
        .product-gallery {
            padding-top:0px!important;
            border:0px!important;
        }
        .product-thumbnails{margin-top:0px;}
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
				@include('layouts.users.side-menu-company')
				<div class="col-lg-8">
					@if(session('error'))
				<div class="alert alert-danger alert-dismissible fade show text-center margin-bottom-1x"><span class="alert-close" data-dismiss="alert"></span><i class="icon-help"></i>&nbsp;&nbsp;<strong>Erro:</strong> {{session('error')}}</div>
				@endif
				<h6 class="text-muted text-normal text-uppercase">Cadastro de Empresa</h6>
				<hr class="margin-bottom-1x">
				
				@if($errors != null && count($errors) > 0)
					<div class="row">
						<div class="col-sm-8">
							<div class="alert alert-danger">
								<ul>
									@foreach($errors->all() as $error)
										<li>{{$error}}</li>
									@endforeach
								</ul>
							</div>
						</div>
					</div>
                @endif
				@if(session('success'))
				<div class="alert alert-success alert-dismissible fade show text-center margin-bottom-1x"><span class="alert-close" data-dismiss="alert"></span><i class="icon-help"></i>&nbsp;&nbsp;<strong>Successo:</strong> {{session('success')}}</div>
				@endif

					<div class="padding-top-2x mt-2 hidden-lg-up"></div>
					<form class="row" method="POST" enctype="multipart/form-data" action="{{ route('user_store_company') }}">
						@csrf
						<input class="form-control" type="text" id="id" name="id" value="{{ $empresa != null ? $empresa->id : null}}" hidden>
						<div class="col-md-6">
							<div class="form-group">
								<label for="account-fn">RAZÃO SOCIAL</label>
									<input class="form-control" type="text" id="razao_social" placeholder="Digite a Razão Sociali" name="razao_social" value="{{ $user->name }}" required>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label for="account-ln">NOME FANTASIA</label>
								<input class="form-control" type="text" id="account-ln" placeholder="Nome Fantasia" name="nome_fantasia" value="{{ $count_empresa ? $empresa->nome_fantasia : Auth::user()->name }}" required>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label for="account-ln">CNPJ</label>
								<input class="form-control" type="text" id="cnpj" name="cnpj" value="{{ Auth::user()->cnpj ?  App\Repositories\UsersRepository::mask(Auth::user()->cnpj."'",'##.###.###/####-##') : ''  }}"  placeholder="00.000.000/0000-00" onkeyup="mascara('##.###.###/####-##',this,event,true)" maxlength="18">
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label for="account-ln">RESPONSÁVEL</label>
								<input class="form-control" type="text" id="responsavel" name="responsavel" value="{{ $count_empresa ? $empresa->responsavel : Auth::user()->responsavel_empresa }}"  maxlength="255" required>
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
								<input class="form-control" type="text" id="telefone" placeholder="(91)99999-9999" name="telefone" value="{{ App\Repositories\UsersRepository::mask($user->telefone."'",'(##) #####-####') }}" onkeyup="mascara('(##) #####-####',this,event,true)" maxlength="15">
							</div>
						</div>
<!-- 						<div class="col-md-6"> -->
<!-- 							<div class="form-group"> -->
<!-- 								<label for="account-phone">TELEFONE</label> -->
<!--                                    <input class="form-control" type="text" name="telefone" value="{{ $count_empresa ? $empresa->telefone : '' }}" id="account-phone" placeholder="(91)99999-9999" required onkeyup="mascara('(##) #####-####',this,event,true)" maxlength="15">
<!-- 							</div> -->
<!-- 						</div> -->
						<div class="col-md-6">
							<div class="form-group">
								<label for="account-ln">CEP</label>
								<input class="form-control" type="text" name="cep" value="{{ $count_empresa ? $empresa->cep : '' }}" id="cep" placeholder="00000000" onkeyup="mascara('########',this,event,true)" maxlength="9" required>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label for="account-ln">LOGRADOURO</label>
								<input class="form-control" type="text" name="endereco" value="{{ $count_empresa ? $empresa->endereco : '' }}" id="endereco" placeholder="Endereço completo" required>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label for="account-ln">COMPLEMENTO</label>
								<input class="form-control" type="text" name="complemento" value="{{ $count_empresa ? $empresa->complemento : '' }}" id="complemento" placeholder="Complemento para o endereço" >
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label for="account-ln">NÚMERO</label>
								<input class="form-control" type="text" name="numero_endereco" value="{{ $count_empresa ? $empresa->numero_endereco : '' }}" id="account-ln" placeholder="Endereço completo" required>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label for="account-ln">PERÍMETRO</label>
								<input class="form-control" type="text" name="perimetro" value="{{ $count_empresa ? $empresa->perimetro : '' }}" id="account-ln" placeholder="Perímetro da localização da empresa">
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label for="account-ln">BAIRRO</label>
								<input class="form-control" type="text" name="bairro" id="bairro" value="{{ $count_empresa ? $empresa->bairro : '' }}" placeholder="Endereço completo" required>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label for="account-ln">UF</label>
								@php 
									$ufValue = null;
									if($count_empresa){
    								    $state = App\Repositories\LocalityRepository::getEstadoByCodigoUf($empresa->uf);
    								    if($state != null){
    								    	$ufValue = $state->uf;
    								    }
								    }
								@endphp
								<input class="form-control" type="text" name="uf" value="{{ $ufValue }}" id="uf" placeholder="UF" required readonly>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label for="account-ln">CIDADE</label>
								<input class="form-control" type="text" name="cidade" value="{{ $count_empresa ? $empresa->nome_cidade : '' }}" id="cidade" placeholder="Localidade" required readonly>

							</div>
						</div>
						<div class="col-md-12">
							<div class="form-group">
								<label for="account-ln">Rede Social</label>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label for="account-ln">Facebook</label>
								<input class="form-control" type="text" name="facebook" value="{{ $count_empresa ? $empresa->facebook : '' }}" placeholder="Facebook" >
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label for="account-ln">Instagram</label>
								<input class="form-control" type="text" name="instagram" value="{{ $count_empresa ? $empresa->instagram : '' }}" placeholder="Instagram" >
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label for="account-ln">Youtube</label>
								<input class="form-control" type="text" name="youtube" value="{{ $count_empresa ? $empresa->youtube : '' }}" placeholder="Youtube" >
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label for="account-ln">Tiktok</label>
								<input class="form-control" type="text" name="tiktok" value="{{ $count_empresa ? $empresa->tiktok : '' }}" placeholder="Tiktok" >
							</div>
						</div>
						<div class="col-md-12">
							<div class="form-group">
								<label for="account-ln">SERVIÇO / FORNECIMENTO</label><br>
								<div class="row">
									<table class="table table-borderless table-sm">
									@php
										$i = 1;
									@endphp
										<tr>
											@foreach($categories as $category)
											<td>
												<div class="custom-control custom-checkbox custom-control-inline">
													@if($count_empresa)
													<input class="custom-control-input" type="checkbox" id="category_{{$category->id}}" name="category[]" value="{{$category->id}}" {{ in_array($category->id, $empresa_categories) ? 'checked' : '' }} >
													@else
													<input class="custom-control-input" type="checkbox" id="category_{{$category->id}}" name="category[]" value="{{$category->id}}">
													@endif
													<label class="custom-control-label" for="category_{{$category->id}}">{{ Str::upper($category->nome) }}</label>
												</div>
											</td>
											@if($i%5==0)
                                        </tr>
                                        <tr>
										@endif
										@php
											$i = $i + 1;
										@endphp
										@endforeach
									</table>
								</div>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label for="account-ln">CATEGORIA DA EMPRESA</label><br>
								<div class="custom-control custom-radio custom-control-inline">
									<input class="custom-control-input" type="radio" id="empresa_parceira" name="id_categoria_empresas" value="1" {{ isset($empresa->id_categoria_empresas) ? ((intval($empresa->id_categoria_empresas) < 2) ? 'checked' : '') : 'checked' }}>
									<label class="custom-control-label" for="empresa_parceira">PARCEIRA</label>
								</div>
								<div class="custom-control custom-radio custom-control-inline">
									<input class="custom-control-input" type="radio" id="empresa_conveniada" name="id_categoria_empresas" value="2" {{ $count_empresa ? ( $empresa->id_categoria_empresas == 2 ? 'checked' : 'disabled' ) : 'disabled' }}>
									<label class="custom-control-label" for="empresa_conveniada" >COVÊNIADA</label>
								</div>
							</div>
						</div>
						<div class="col-md-6" id="div_desconto" @if($count_empresa) @if($empresa->id_categoria_empresas == 2) style="display: none" @endif @endif>
							<div class="form-group">
								<label for="account-ln">PORCENTAGEM DE DESCONTO OFERECIDO</label>
								<input class="form-control" type="number" name="desconto" id="desconto" value="{{ $count_empresa ? $empresa->desconto : '10' }}" placeholder="%" min="10">
							</div>
						</div>
						
						<!-- Dias da semana -->
						<div class="col-md-6">
							<div class="form-group">
								<label for="account-ln">DIAS DE FUNCIONAMENTO</label><br>
								<div class="custom-control custom-checkbox custom-control-inline">
									@if($count_empresa)
									@php $dias = json_decode($empresa->dias_funcionamento); @endphp
									<input class="custom-control-input" type="checkbox" id="seg" name="seg" {{ $dias->seg ? 'checked' : '' }} >
									@else
									<input class="custom-control-input" type="checkbox" id="seg" name="seg">
									@endif
									<label class="custom-control-label" for="seg">Segunda</label>
								</div>
								<div class="custom-control custom-checkbox custom-control-inline">
									@if($count_empresa)
									@php $dias = json_decode($empresa->dias_funcionamento); @endphp
									<input class="custom-control-input" type="checkbox" id="ter" name="ter" {{ $dias->ter ? 'checked' : '' }} >
									@else
									<input class="custom-control-input" type="checkbox" id="ter" name="ter">
									@endif
									<label class="custom-control-label" for="ter">Terça</label>
								</div>
								<div class="custom-control custom-checkbox custom-control-inline">
									@if($count_empresa)
									@php $dias = json_decode($empresa->dias_funcionamento); @endphp
										<input class="custom-control-input" type="checkbox" id="qua" name="qua" {{ $dias->qua ? 'checked' : '' }} >
									@else
									<input class="custom-control-input" type="checkbox" id="qua" name="qua">
									@endif
									<label class="custom-control-label" for="qua">Quarta</label>
								</div>
								<div class="custom-control custom-checkbox custom-control-inline">
									@if($count_empresa)
									@php $dias = json_decode($empresa->dias_funcionamento); @endphp
									<input class="custom-control-input" type="checkbox" id="qui" name="qui" {{ $dias->qui ? 'checked' : '' }} >
									@else
									<input class="custom-control-input" type="checkbox" id="qui" name="qui">
									@endif
									<label class="custom-control-label" for="qui">Quinta</label>
								</div>
								<div class="custom-control custom-checkbox custom-control-inline">
									@if($count_empresa)
									@php $dias = json_decode($empresa->dias_funcionamento); @endphp
									<input class="custom-control-input" type="checkbox" id="sex" name="sex" {{ $dias->sex ? 'checked' : '' }} >
									@else
									<input class="custom-control-input" type="checkbox" id="sex" name="sex">
									@endif
									<label class="custom-control-label" for="sex">Sexta</label>
								</div>
							</div>							
						</div>
						<div class="col-md-3">
							<div class="form-group">
								<label for="account-ln">HORÁRIO DE ABERTURA</label>
								<input class="form-control" type="time" name="hora_abertura" id="hora_abertura" value="{{ $count_empresa ? $empresa->hora_abertura : '' }}" placeholder="00:00" required>
							</div>
						</div>
						<div class="col-md-3">
							<div class="form-group">
								<label for="account-ln">HORÁRIO DE FECHAMENTO</label>
								<input class="form-control" type="time" name="hora_fechamento" id="hora_fechamento" value="{{ $count_empresa ? $empresa->hora_fechamento : '' }}" placeholder="00:00" required>
							</div>
						</div>

						<!-- Final de semana -->

						<!-- Se faz necessário criar colunas na tabela empresas 
							 para respeitar as novas variáveis colocadas a baixo
							 para que haja um controle melhor dos horários.
							 Segue como sugestão:
								 
							 Coluna: dias_funcionamento_fim_semana
							 Coluna: hora_abertura_fim_semana
							 Coluna: hora_fechamento_fim_semana
							 ....
							 As variáveis do código também precisam respeitar
							 os nomes das colunas da tabela Empresas -->

							 <!-- O Código sugerido está todo comentado 
							 	  a partir da linha 433 à 469 -->
												
							<!-- CSS in line para correção de div -->

						<div class="col-md-6">
							<div class="form-group" style="margin-top: 28px;"> 
								<div class="custom-control custom-checkbox custom-control-inline">
									@if($count_empresa)
									@php $dias = json_decode($empresa->dias_funcionamento); @endphp
									<input class="custom-control-input" type="checkbox" id="sab" name="sab" {{ $dias->sab ? 'checked' : '' }} >
									@else
									<input class="custom-control-input" type="checkbox" id="sab" name="sab">
									@endif
									<label class="custom-control-label" for="sab">Sábado</label>
								</div>
								<div class="custom-control custom-checkbox custom-control-inline">
									@if($count_empresa)
									@php $dias = json_decode($empresa->dias_funcionamento); @endphp
									<input class="custom-control-input" type="checkbox" id="dom" name="dom" {{ $dias->dom ? 'checked' : '' }} >
									@else
									<input class="custom-control-input" type="checkbox" id="dom" name="dom">
									@endif
									<label class="custom-control-label" for="dom">Domingo</label>
								</div>
							</div>
						</div>
						<div class="col-md-3">
							<div class="form-group">
								<label for="account-ln">HORÁRIO DE ABERTURA (FIM DE SEMANA)</label>
								<input class="form-control" type="time" name="hora_abertura" id="hora_abertura" value="{{ $count_empresa ? $empresa->hora_abertura : '' }}" placeholder="00:00" required>
							</div>
						</div>
						<div class="col-md-3">
							<div class="form-group">
								<label for="account-ln">HORÁRIO DE FECHAMENTO (FIM DE SEMANA)</label>
								<input class="form-control" type="time" name="hora_fechamento" id="hora_fechamento" value="{{ $count_empresa ? $empresa->hora_fechamento : '' }}" placeholder="00:00" required>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label for="account-ln">LOGO DA EMPRESA</label>
								<div>
    								<div class="custom-file">
    									<input class="custom-file-input" type="file" name="logo" id="logo">
    									<label class="custom-file-label" for="logo">Ecolha uma logo...</label>
    									<p class="text-muted">Imagens nos formatos: jpg, png, jpeg e gif</p>
    								</div>
								</div>
							</div>
							@if($count_empresa)
							@if($empresa->logo)
							<input type="hidden" name="logo_antiga" value="{{ $empresa->logo }}">
							<div class="form-group">
								<div class="gallery-item">
	                               <img id="img-logo-empresa" class="d-block mx-auto img-thumbnail mb-6" src="{{ url($empresa->capa()) }}" alt="Logo" >
								</div>
							</div>
							@else
							<input type="hidden" name="logo_antiga" value="0">
							<div class="form-group">
								<div class="gallery-item">
									<img id="img-logo-empresa" class="d-block mx-auto img-thumbnail mb-6"/>
								</div>
							</div>
							@endif
							@else
							<div class="form-group">
								<div class="gallery-item">
									<img id="img-logo-empresa" class="d-block mx-auto img-thumbnail mb-6"/>
								</div>
							</div>
							@endif
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label for="account-ln">VIDEO DA EMPRESA</label>
								<div>
    								<div class="custom-file">
    									<input class="form-control" type="text" name="video" value="{{ $count_empresa ? $empresa->video : '' }}" id="video" placeholder="Link do youtube" >
    								</div>
								</div>
							</div>
						</div>
						<div class="col-md-12" id="imagens-empresa">
							<div class="form-group">
								<label for="account-ln">IMAGENS DA EMPRESA</label>
							<div id="uploads_empresa">
								<p class="text-muted">Imagens nos formatos: jpg, png, jpeg e gif</p>
								
                                <div class="custom-file main-img">
                                    <input type="file" name="main-filename[]" class="custom-file-input" id="images">
                                    <label class="custom-file-label" id="filename-label" for="images"><span>Escolha a imagem Principal..</span></label>
                                </div>
                                <div class="custom-file">
                                    <input type="file" name="filename[]" class="custom-file-input" id="images2">
                                    <label class="custom-file-label" id="filename-label2" for="images">Escolha a imagem..</label>
                                </div>
                                <div class="custom-file">
                                    <input type="file" name="filename[]" class="custom-file-input" id="images3">
                                    <label class="custom-file-label" id="filename-label3" for="images">Escolha a imagem..</label>
                                </div>
                                <div class="custom-file">
                                    <input type="file" name="filename[]" class="custom-file-input" id="images4">
                                    <label class="custom-file-label" id="filename-label4" for="images">Escolha a imagem..</label>
                                </div>
                                <div class="custom-file">
                                    <input type="file" name="filename[]" class="custom-file-input" id="images5">
                                    <label class="custom-file-label" id="filename-label5" for="images">Escolha a imagem..</label>
                                </div>
                                </div>
                            </div>
                        </div>
						<div class="col-md-12">
							<div class=product-gallery> 
        							<ul class="product-thumbnails">
        								 @foreach($uploads as $image) 
        									<li>
           										<button class="close delete d-block mx-auto img-thumbnail mb-6"  id="excluir_{{$image->id}}" type="button" aria-label="Close" >
           											<div class="close_img" title="Excluir Imagem"><span aria-hidden="true">&times;</span></div>
                								 	<input id="image_{{$image->id}}" name="image[]" value="{{$image->id}}" hidden> 
           											<img id="{{$image->id}}" value="{{$image->id}}"  name="images[]" src="{{url('storage/images/'.$image->filename)}}" />
    											</button>                		
											</li>							
        								 @endforeach 
                               		</ul> 
                            </div>
						</div>
						<div class="col-md-12">
							<div class="form-group">
								<label for="account-ln">DESCRIÇÃO DO SERVIÇO PRESTADO</label>
								<textarea class="form-control" name="descricao_servico" id="descricao_servico" rows="5">{{ $count_empresa ? $empresa->descricao_servico : '' }}</textarea>
							</div>
						</div>
						<div class="col-12">
							<hr class="mt-2 mb-3">
							<div class="d-flex flex-wrap justify-content-between align-items-center">
								<div class="custom-control custom-checkbox d-block">
									<input class="custom-control-input" type="checkbox" id="subscribe_me" name="subscribe_me" checked>
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
	 <!-- jQuery -->
    <script>
        $(function() {
            // Multiple images preview with JavaScript
            var multiImgPreview = function(input, imgPreviewPlaceholder) {
            	var label = document.getElementById("filename-label");

                if (input.files) {
                    var filesAmount = input.files.length;
                    $('.temp_image').remove();
                    for (i = 0; i < filesAmount; i++) {
                        var reader = new FileReader();
                        reader.onload = function(event) {
                            $li = $($.parseHTML('<li>')).attr('class','temp_image').appendTo(imgPreviewPlaceholder);
                            $button = $($.parseHTML('<button>')).attr('type','button').attr('aria-label','Close').attr('class','close delete d-block mx-auto img-thumbnail mb-6').attr('id', 'excluir_'.concat(Math.random())).appendTo($li);
                            $divClose = $($.parseHTML('<div>')).attr('title','Excluir Imagem;').attr('aria-label','Close').appendTo($button);
                            $span = $($.parseHTML('<span>')).attr('aria-hidden','true').appendTo($divClose);
                            $span.append(document.createTextNode("x") );
                            
                            $($.parseHTML('<img>')).attr('src', event.target.result).attr('id', 'excluir_'.concat(Math.random())).appendTo($button);
                        }
                        label.textContent = input.files[i].name;
                        reader.readAsDataURL(input.files[i]);
                    }
                }
            };
            $('#images').on('change', function() {
                multiImgPreview(this, 'ul.product-thumbnails');
            });
        });
        $(function() {
            // Multiple images preview with JavaScript
            var multiImgPreview = function(input, imgPreviewPlaceholder) {
				var label = document.getElementById("filename-label2");            	
                
                if (input.files) {
                    var filesAmount = input.files.length;
                    $('.temp_image2').remove();
                    for (i = 0; i < filesAmount; i++) {
                        var reader = new FileReader();
                        reader.onload = function(event) {
                            $li = $($.parseHTML('<li>')).attr('class','temp_image2').appendTo(imgPreviewPlaceholder);
                            $button = $($.parseHTML('<button>')).attr('type','button').attr('aria-label','Close').attr('class','close delete d-block mx-auto img-thumbnail mb-6').attr('id', 'excluir_'.concat(Math.random())).appendTo($li);
                            $divClose = $($.parseHTML('<div>')).attr('title','Excluir Imagem;').attr('aria-label','Close').appendTo($button);
                            $span = $($.parseHTML('<span>')).attr('aria-hidden','true').appendTo($divClose);
                            $span.append(document.createTextNode("x") );
                            
                            $($.parseHTML('<img>')).attr('src', event.target.result).attr('id', 'excluir_'.concat(Math.random())).appendTo($button);
                        }
                        label.textContent = input.files[i].name;
                        reader.readAsDataURL(input.files[i]);
                    }
                }
            };
            $('#images2').on('change', function() {
                multiImgPreview(this, 'ul.product-thumbnails');
            });
        });
        $(function() {
            // Multiple images preview with JavaScript
            var multiImgPreview = function(input, imgPreviewPlaceholder) {
				var label = document.getElementById("filename-label3");            	
                
                if (input.files) {
                    var filesAmount = input.files.length;
                    $('.temp_image3').remove();
                    for (i = 0; i < filesAmount; i++) {
                        var reader = new FileReader();
                        reader.onload = function(event) {
                            $li = $($.parseHTML('<li>')).attr('class','temp_image2').appendTo(imgPreviewPlaceholder);
                            $button = $($.parseHTML('<button>')).attr('type','button').attr('aria-label','Close').attr('class','close delete d-block mx-auto img-thumbnail mb-6').attr('id', 'excluir_'.concat(Math.random())).appendTo($li);
                            $divClose = $($.parseHTML('<div>')).attr('title','Excluir Imagem;').attr('aria-label','Close').appendTo($button);
                            $span = $($.parseHTML('<span>')).attr('aria-hidden','true').appendTo($divClose);
                            $span.append(document.createTextNode("x") );
                            
                            $($.parseHTML('<img>')).attr('src', event.target.result).attr('id', 'excluir_'.concat(Math.random())).appendTo($button);
                        }
                        label.textContent = input.files[i].name;
                        reader.readAsDataURL(input.files[i]);
                    }
                }
            };
            $('#images3').on('change', function() {
                multiImgPreview(this, 'ul.product-thumbnails');
            });
        });
        
        $(function() {
            // Multiple images preview with JavaScript
            var multiImgPreview = function(input, imgPreviewPlaceholder) {
				var label = document.getElementById("filename-label4");            	
                
                if (input.files) {
                    var filesAmount = input.files.length;
                    $('.temp_image4').remove();
                    for (i = 0; i < filesAmount; i++) {
                        var reader = new FileReader();
                        reader.onload = function(event) {
                            $li = $($.parseHTML('<li>')).attr('class','temp_image2').appendTo(imgPreviewPlaceholder);
                            $button = $($.parseHTML('<button>')).attr('type','button').attr('aria-label','Close').attr('class','close delete d-block mx-auto img-thumbnail mb-6').attr('id', 'excluir_'.concat(Math.random())).appendTo($li);
                            $divClose = $($.parseHTML('<div>')).attr('title','Excluir Imagem;').attr('aria-label','Close').appendTo($button);
                            $span = $($.parseHTML('<span>')).attr('aria-hidden','true').appendTo($divClose);
                            $span.append(document.createTextNode("x") );
                            
                            $($.parseHTML('<img>')).attr('src', event.target.result).attr('id', 'excluir_'.concat(Math.random())).appendTo($button);
                        }
                        label.textContent = input.files[i].name;
                        reader.readAsDataURL(input.files[i]);
                    }
                }
            };
            $('#images4').on('change', function() {
                multiImgPreview(this, 'ul.product-thumbnails');
            });
        });

        $(function() {
            // Multiple images preview with JavaScript
            var multiImgPreview = function(input, imgPreviewPlaceholder) {
				var label = document.getElementById("filename-label5");            	
                
                if (input.files) {
                    var filesAmount = input.files.length;
                    $('.temp_image5').remove();
                    for (i = 0; i < filesAmount; i++) {
                        var reader = new FileReader();
                        reader.onload = function(event) {
                            $li = $($.parseHTML('<li>')).attr('class','temp_image2').appendTo(imgPreviewPlaceholder);
                            $button = $($.parseHTML('<button>')).attr('type','button').attr('aria-label','Close').attr('class','close delete d-block mx-auto img-thumbnail mb-6').attr('id', 'excluir_'.concat(Math.random())).appendTo($li);
                            $divClose = $($.parseHTML('<div>')).attr('title','Excluir Imagem;').attr('aria-label','Close').appendTo($button);
                            $span = $($.parseHTML('<span>')).attr('aria-hidden','true').appendTo($divClose);
                            $span.append(document.createTextNode("x") );
                            
                            $($.parseHTML('<img>')).attr('src', event.target.result).attr('id', 'excluir_'.concat(Math.random())).appendTo($button);
                        }
                        label.textContent = input.files[i].name;
                        reader.readAsDataURL(input.files[i]);
                    }
                }
            };
            $('#images5').on('change', function() {
                multiImgPreview(this, 'ul.product-thumbnails');
            });
        });

    </script>
    <script type="text/javascript">
        
        $(document).ready(function() {
        
        	searchCEP(document.getElementById("cep").value);

            $(document).on('click','.delete', function() {
            	var component = $(this)[0].id;
            	var myobj = document.getElementById(component);
            	myobj.remove();
            	
            });
              
            $("#empresa_parceira").click(function () {
                $("#div_desconto").show("slow");
                $("#imagens-empresa").show("slow");
            });

            $("#empresa_conveniada").click(function () {
                $("#div_desconto").hide("slow");
                $("#imagens-empresa").hide("slow");
                limpa_imagens_conveniado();
            });

            $("#logo").change(function () {
                const file = $(this)[0].files[0];
                const fileReader = new FileReader();
                fileReader.onloadend = function () {
                    $("#img-logo-empresa").attr('src',fileReader.result);
                };
                fileReader.readAsDataURL(file);
            });
            
            function limpa_imagens_conveniado(){
            	document.getElementById("images").value = null;
            	document.getElementById("filename-label").textContent = 'Escolha a imagem..';
            	document.getElementById("images2").value = null;
            	document.getElementById("filename-label2").textContent = 'Escolha a imagem..';
            	document.getElementById("images3").value = null;
            	document.getElementById("filename-label3").textContent = 'Escolha a imagem..';
            	document.getElementById("images4").value = null;
            	document.getElementById("filename-label4").textContent = 'Escolha a imagem..';
            	document.getElementById("images5").value = null;
            	document.getElementById("filename-label5").textContent = 'Escolha a imagem..';
            	
            	if(document.getElementsByClassName("temp_image") != null){
            		$('.temp_image').remove();
            	}
            	if(document.getElementsByClassName("temp_image2") != null){
            		$('.temp_image2').remove();
            	}
            	if(document.getElementsByClassName("temp_image3") != null){
            		$('.temp_image3').remove();
            	}
            	if(document.getElementsByClassName("temp_image4") != null){
            		$('.temp_image4').remove();
            	}
            	if(document.getElementsByClassName("temp_image5") != null){
            		$('.temp_image5').remove();
            	}
            }

            $("#uf").change(function () {
                $.ajax({
                    method:"POST",
                    data:{
                        uf:$(this).val(),
                        "_token": "{{ csrf_token() }}"
                    },
                    url:"/get-cidades",
                    dataType:"html",
                    beforeSend:function(){
                        $("#cidade").html('<option value="">BUSCANDO CIDADES...</option>');
                    },
                    success:function(o){
                        $("#cidade").html(o);
                    }
                });
            });

            function limpa_formulario_cep() {
                $("#cep").val("");
                $("#endereco").val("");
                $("#bairro").val("");
                $("#uf").val("");
                $("#cidade").val("");
            }

            $("#cep").blur(function() {

                var cep = $(this).val().replace(/\D/g, '');

                if (cep != "") {

                    var validacep = /^[0-9]{8}$/;

                    //Valida o formato do CEP.
                    if(validacep.test(cep)) {

                        $("#endereco").val("...");
                        $("#bairro").val("...");
                        $("#uf").val("...");
                        $("#cidade").val("...");

                        searchCEP(cep);
                    } //end if.
                    else {
                        limpa_formulario_cep();
                        alert("Formato de CEP inválido.");
                    }
                }
            });
        
        	function searchCEP(cep){
    			if(document.getElementById("cep").value != null){
             	 	//Consulta o webservice viacep.com.br/
                    $.getJSON("https://viacep.com.br/ws/"+ cep  +"/json/?callback=?", function(dados) {
                        if (!("erro" in dados)) {
                            $("#endereco").val(dados.logradouro.toUpperCase());
                            $("#bairro").val(dados.bairro.toUpperCase());
                            $("#uf").val(dados.uf.toUpperCase());
                            $("#cidade").val(dados.localidade.toUpperCase());
                        } //end if.
                        else {
                            alert("CEP não encontrado.");
                            limpa_formulario_cep();
                        }
						$("#cep").trigger('keyup')
                    });
                }
            }
	  		//mostrar senha
          // Click event of the showPassword button
          $('#showPassword').on('click', function(){
             
            // Get the password field
            var passwordField = $('#password');
         
            // Get the current type of the password field will be password or text
            var passwordFieldType = passwordField.attr('type');
         
            // Check to see if the type is a password field
            if(passwordFieldType == 'password')
            {
                // Change the password field to text
                passwordField.attr('type', 'text');
         
                // Change the Text on the show password button to Hide
                $(this).val('Esconder');
            } else {
                // If the password field type is not a password field then set it to password
                passwordField.attr('type', 'password');
         
                // Change the value of the show password button to Show
                $(this).val('Mostrar');
            }
          });
          
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
