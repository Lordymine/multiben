@extends('layouts.main')

@section('title', '')

@section('css')
    @parent
    <style>
        .custom-file-label::after{content:"Procurar"}
    </style>
@stop

@section('content')
	<!-- Off-Canvas Wrapper-->
	<div class="offcanvas-wrapper">
		<!-- Page Title-->
		<div class="page-title">
			<div class="container">
				<div class="column">
					<h1>Minha Empresa</h1>
				</div>
				<div class="column">
					<ul class="breadcrumbs">
						<li><a href="{{route('index')}}">Home</a></li>
						<li class="separator">&nbsp;</li>
						<li><a href="{{route('users_profile')}}">Conta</a></li>
						<li class="separator">&nbsp;</li>
						<li>Minha Empresa</li>
					</ul>
				</div>
			</div>
		</div>
		<!-- Page Content-->
		<div class="container padding-bottom-3x mb-2">
			<div class="row">
				@include('layouts.users.side-menu')
				<div class="col-lg-8">
				@if(session('error'))
				<div class="alert alert-danger alert-dismissible fade show text-center margin-bottom-1x"><span class="alert-close" data-dismiss="alert"></span><i class="icon-help"></i>&nbsp;&nbsp;<strong>Erro:</strong> {{session('error')}}</div>
				@endif
				<h6 class="text-muted text-normal text-uppercase">Cadastro de Empresa</h6>
				<hr class="margin-bottom-1x">
				@if($errors != null && count($errors) > 0)
					<div class="row">
						<div class="col-sm-8">
							<div class="alert alert-warning">
								<ul>
									@foreach($errors->all() as $error)
										<li>{{$error}}</li>
									@endforeach
								</ul>
							</div>
						</div>
					</div>
                @endif
				@if($count_empresa)
				<form class="row" method="POST" enctype="multipart/form-data" action="{{ route('user_update_company') }}">
					<input type="hidden" name="id" value="{{ encrypt($empresa->id) }}">
					@else
					<form class="row" method="POST" enctype="multipart/form-data" action="{{ route('user_store_company') }}">
					@endif
					@csrf
						<div class="col-md-6">
							<div class="form-group">
								<label for="account-fn">RAZÃO SOCIAL</label>
								<input class="form-control" type="text" name="razao_social" value="{{ $count_empresa ? $empresa->razao_social : '' }}" id="account-fn" placeholder="Razao Social" required>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label for="account-ln">CNPJ</label>
								<input class="form-control" type="text" name="cnpj" value="{{ $count_empresa ? $empresa->cnpj : '' }}" id="account-ln" placeholder="00.000.000/0000-00" onkeyup="mascara('##.###.###/####-##',this,event,true)" maxlength="18" required>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label for="account-ln">NOME FANTASIA</label>
								<input class="form-control" type="text" id="account-ln" placeholder="Nome Fantasia" name="nome_fantasia" value="{{ $count_empresa ? $empresa->nome_fantasia : '' }}" required>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label for="account-phone">SENHA</label>
								<input class="form-control" type="password" name="password" value="{{ $count_empresa ? ($empresa->password ? decrypt($empresa->password) : '') : '' }}" id="password">
							</div>
    						<p><input type="button" id="showPassword" value="Mostrar" class="btn-primary" /></p>
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
								<label for="account-phone">TELEFONE</label>
								<input class="form-control" type="text" name="telefone" value="{{ $count_empresa ? $empresa->telefone : '' }}" id="account-phone" placeholder="(91)99999-9999" required onkeyup="mascara('(##) #####-####',this,event,true)" maxlength="15">
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label for="account-ln">CEP</label>
								<input class="form-control" type="text" name="cep" value="{{ $count_empresa ? $empresa->cep : '' }}" id="cep" placeholder="00000000" onkeyup="mascara('########',this,event,true)" maxlength="8" required>
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
<!-- 								<select class="form-control" id="uf" name='uf'> -->
<!-- 									<option value="">Escolha o UF...</option> -->
<!-- 									@foreach($ufs as $uf) -->
<!-- 									<option {{ $count_empresa ? (($empresa->uf==$uf->id) ? 'selected' : '') : '' }} value="{{$uf->id}}">{{$uf->nome}}</option> -->
<!-- 									@endforeach -->
<!-- 								</select> -->
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

<!-- 								<div class="invalid-tooltip">Por favor selecione um serviço válido.</div> -->
<!-- 								<div class="valid-tooltip">Serviço aceito!</div> -->
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label for="account-ln">CIDADE</label>
<!-- 								<select class="form-control" id="cidade" name='cidade' required=""> -->
<!-- 									@if($count_empresa) -->
<!-- 									<option value="{{$empresa->id_cidade}}">{{$empresa->nome_cidade}}</option> -->
<!-- 									@else -->
<!-- 									<option value="">Selecione a UF</option> -->
<!-- 									@endif -->
<!-- 								</select> -->
<!-- 								<div class="invalid-tooltip">Por favor selecione um serviço válido.</div> -->
<!-- 								<div class="valid-tooltip">Serviço aceito!</div> -->
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
						<div class="col-md-6"></div>
						<div class="col-md-6">
							<div class="form-group">
								<label for="account-ln">CATEGORIA DA EMPRESA</label><br>
								<div class="custom-control custom-radio custom-control-inline">
									<input class="custom-control-input" type="radio" id="empresa_parceira" name="id_categoria_empresas" value="1" {{ $count_empresa ? ( $empresa->id_categoria_empresas == 2 ? '' : 'checked' ) : '' }}>
									<label class="custom-control-label" for="empresa_parceira">PARCEIRA</label>
								</div>
								<div class="custom-control custom-radio custom-control-inline">
									<input class="custom-control-input" type="radio" id="empresa_conveniada" name="id_categoria_empresas" value="2" {{ $count_empresa ? ( $empresa->id_categoria_empresas == 2 ? 'checked' : '' ) : '' }}>
									<label class="custom-control-label" for="empresa_conveniada">COVÊNIADA</label>
								</div>
							</div>
						</div>
						<div class="col-md-6" id="div_desconto" @if($count_empresa) @if($empresa->id_categoria_empresas == 2) style="display: none" @endif @endif>
							<div class="form-group">
								<label for="account-ln">PORCENTAGEM DE DESCONTO OFERECIDO</label>
								<input class="form-control" type="number" name="desconto" id="desconto" value="{{ $count_empresa ? $empresa->desconto : '5' }}" placeholder="%" min="5">
							</div>
						</div>
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
						<div class="col-md-6">
							<div class="form-group">
								<label for="account-ln">LOGO DA EMPRESA</label>
								<div class="custom-file">
									<input class="custom-file-input" type="file" name="logo" id="logo">
									<label class="custom-file-label" for="logo">Ecolha uma logo...</label>
									<p class="text-muted">Imagens nos formatos: jpg, png, jpeg e gif</p>
								</div>
							</div>
						</div>
						<div class="col-md-12">
							@if($count_empresa)
							@if($empresa->logo)
							<input type="hidden" name="logo_antiga" value="{{ $empresa->logo }}">
							<div class="form-group">
								<div class="gallery-item">
									<img id="img-logo-empresa" class="d-block mx-auto img-thumbnail mb-6" src="{{asset($empresa->capa())}}" alt="Logo" style="max-width: 20em;max-height: 30em;">
								</div>
							</div>
							@else
							<input type="hidden" name="logo_antiga" value="0">
							<div class="form-group">
								<div class="gallery-item">
									<img id="img-logo-empresa" class="d-block mx-auto img-thumbnail mb-6" style="max-width: 20em;max-height: 30em;" />
								</div>
							</div>
							@endif
							@else
							<div class="form-group">
								<div class="gallery-item">
									<img id="img-logo-empresa" class="d-block mx-auto img-thumbnail mb-6" style="max-width: 20em;max-height: 30em;" />
								</div>
							</div>
							@endif
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

    <script type="text/javascript">

        $(document).ready(function() {

            $("#empresa_parceira").click(function () {
                $("#div_desconto").show("slow");
            });

            $("#empresa_conveniada").click(function () {
                $("#div_desconto").hide("slow");
            });

            $("#logo").change(function () {
                const file = $(this)[0].files[0];
                const fileReader = new FileReader();
                fileReader.onloadend = function () {
                    $("#img-logo-empresa").attr('src',fileReader.result);
                };
                fileReader.readAsDataURL(file);
            });

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

                        //Consulta o webservice viacep.com.br/
                        $.getJSON("https://viacep.com.br/ws/"+ cep +"/json/?callback=?", function(dados) {
                            if (!("erro" in dados)) {
                                $("#endereco").val(dados.logradouro.toUpperCase());
                                $("#bairro").val(dados.bairro.toUpperCase());
                                $("#uf").val(dados.uf.toUpperCase());
                                $("#cidade").val(dados.localidade.toUpperCase());
                            } //end if.
                            else {
                                limpa_formulario_cep();
                                alert("CEP não encontrado.");
                            }
                        });
                    } //end if.
                    else {
                        limpa_formulario_cep();
                        alert("Formato de CEP inválido.");
                    }
                }
            });
        });
        
        
		//mostrar senha
		$(document).ready(function(){
     
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
        });
    </script>

@stop


