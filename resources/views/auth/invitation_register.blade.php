@extends('layouts.main')

@section('title', '')

@section('css')
    @parent
<style>
/* Chrome, Safari, Edge, Opera */
input::-webkit-outer-spin-button,
input::-webkit-inner-spin-button {
  -webkit-appearance: none;
  margin: 0;
}

/* Firefox */
input[type=number] {
  -moz-appearance: textfield;
}

@media (min-width: 320px) and (max-width: 1199px) {
	.view-mobile{
		display: block;
	}
}
@media (min-width: 1200px) {
	.view-mobile{
		display: none;
	}
}

</style>
@stop

@section('content')

	<div class="offcanvas-wrapper">
		<!-- Page Title-->
		<div class="page-title">
			<div class="container">
				<div class="column">
					<h1>Criar Conta</h1>
				</div>
				<div class="column">
					<ul class="breadcrumbs">
						<li>
							<a href="{{route('index')}}">Início</a>
						</li>
						<li class="separator">&nbsp;</li>
						<li>
							<a href="#">Conta</a>
						</li>
						<li class="separator">&nbsp;</li>
						<li>Criar Conta</li>
					</ul>
				</div>
			</div>
		</div>
		<!-- Page Content-->
		<div class="container padding-bottom-3x mb-2">
			@if($aviso ?? '')
			<div class="alert alert-primary" style="margin-bottom: 20px" role="alert">
				<strong>{{ $aviso ?? '' }}</strong>
			</div>
			@endif
			@error('cpf')
                <div class="view-mobile alert alert-danger">{{ $message }}</div>
            @enderror
			@error('password')
                <div class="view-mobile alert alert-danger">{{ $message }}</div>
            @enderror
			<div class="row">
				<div class="col-md-12">
					<div class="padding-top-3x hidden-md-up"></div>
					<div class="padding-top-1x hidden-md-up"></div>
					<h3 class="margin-bottom-1x">Dados de Cadastro</h3>
					<p>O registro leva menos de um minuto, mas oferece controle total sobre seus pedidos.</p>
					<div id="form_pessoa_fisica">
    					<form class="row" method="POST" action="{{ route('register') }}" autocomplete="off">
    						@csrf
    						<input hidden id="invitation_token" name="invitation_token" value="{{$invitation_token}}" type="text">
    						<input hidden class="custom-control-input" type="radio" id="pessoa_fisica" name="selectRadio" value="1" onclick="javascript:cpfOrCnpjCheck();" checked>
    						
    						<div class="col-sm-6">
    							<div class="form-group">
    								<label for="reg-fn">Nome</label>
    								<input class="form-control @error('name') is-invalid @enderror" type="text" id="name" name='name' value="{{ old('name') }}" autocomplete="name" required >
    								@error('name')
    								<span class="invalid-feedback" role="alert">
    									<strong>{{ $message }}</strong>
    								</span>
    								@enderror
    							</div>
    						</div>
    						<div class="col-sm-6">
    							<div class="form-group">
    								<label for="reg-fn">Sobrenome</label>
    								<input class="form-control @error('sobrenome') is-invalid @enderror" type="text" id="sobrenome" name="sobrenome" placeholder="Sobrenome" required value="{{ old('sobrenome') }}">
    								@error('sobrenome')
    								<span class="invalid-feedback" role="alert">
    									<strong>{{ $message }}</strong>
    								</span>
    								@enderror
    							</div>
    						</div>
    						<div class="col-md-6">
    							<div class="form-group">
    								<label for="account-ln">CPF</label>
    								@error('cpf')
    								<input class="form-control @error('cpf') is-invalid @enderror" type="text" id="cpf" placeholder="###.###.###-##" name="cpf" autofocus onkeyup="mascara('###.###.###-##',this,event,true)" maxlength="14" required value="{{ old('cpf') }}">
    								<span class="invalid-feedback" role="alert">
    									<strong>{{ $message }}</strong>
    								</span>
    								@else
    								<input class="form-control @error('cpf') is-invalid @enderror" type="text" id="cpf" placeholder="###.###.###-##" name="cpf" onkeyup="mascara('###.###.###-##',this,event,true)" maxlength="14" required value="{{ old('cpf') }}">
    								@enderror
    							</div>
    						</div>
    						<div class="col-sm-6">
    							<div class="form-group">
    								<label for="reg-email">E-mail</label>
    								<input class="form-control @error('email') is-invalid @enderror" type="email" name="email" id="email" placeholder="exemplo@exemplo.com" required value="{{ old('email') }}">
    								@error('email')
    								<span class="invalid-feedback" role="alert">
    									<strong>{{ $message }}</strong>
    								</span>
    								@enderror
    							</div>
    						</div>
    						<div class="col-sm-6">
    							<div class="form-group">
    								<label for="reg-phone">Telefone</label>
    								<input class="form-control @error('telefone') is-invalid @enderror" type="tel" id="telefone" name='telefone' placeholder="(00)00000-0000" onkeyup="mascara('(##) #####-####',this,event,true)" maxlength="15" value="{{ old('telefone') }}">
    								@error('telefone')
    								<span class="invalid-feedback" role="alert">
    									<strong>{{ $message }}</strong>
    								</span>
    								@enderror
    							</div>
    						</div>
    						<div class="col-sm-6"></div>
    						<div class="col-sm-6">
    							<div class="form-group">
    								<label for="reg-pass">Senha</label>
    								<input class="form-control @error('password') is-invalid @enderror" type="password" name="password" id="password2" placeholder="Senha" required value="{{ old('password') }}">
    								@error('password')
    								<span class="invalid-feedback" role="alert">
    									<strong>{{ $message }}</strong>
    								</span>
    								@enderror
    							</div>
    						</div>
    						<div class="col-sm-6">
    							<div class="form-group">
    								<label for="reg-pass-confirm">Confirmar Senha</label>
    								<input class="form-control" type="password" name="password_confirmation" id="password_confirmation" placeholder="Confirmar Senha" required>
    							</div>
    						</div>
    						<div class="col-12 text-center text-sm-right" style="margin-bottom: 20px;">
								<input type="button" id="showPassword2" style="margin-right: 6px;" value="Mostrar" class="btn-primary" />
    						</div>
    						<div class="col-12 text-center text-sm-right">
    							{{-- <button class="btn btn-primary margin-bottom-none" type="submit" data-toggle="modal" data-target="#modalDefault">Salvar</button> --}}
    							<button class="btn btn-primary margin-bottom-none" type="submit" data-toggle="modal" data-target="#modalDefault">Salvar</button>
    						</div>
    						
    						<input type="text" id="cnpj_hidden" name="cnpj" hidden>
    					</form>
					</div>
					{{-- <!-- Janela Modal  Video -->
					<div class="modal fade" id="modalDefault"  tabindex="1" role="dialog" style="display: none;" aria-hidden="true">
						<div class="modal-dialog" role="document">
							<div class="modal-content">
								<div class="modal-header">
									<h4 class="modal-title">Como funciona<h4>
									<button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">x</span></button>
								</div>
								<div class="modal-body">
									  <!--
									  <iframe width="420" height="315"
									  src="https://www.youtube.com/embed/tgbNymZ7vqY?autoplay=1">
									  </iframe>
									  -->
									<iframe width="727" height="409" src="https://www.youtube.com/embed/gTQWpDICrbI" frameborder="0" allow="accelerometer; autoplay=1; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
								</div>
								<div class="modal-footer">
									<button class="btn btn-primary margin-bottom-none" type="button" data-dismiss="modal" onclick="window.location.href='{{asset('payment')}}'">Sair</button>
								</div>
							</div>
						</div>
					</div>
					<!-- fim Janela Modal video --> --}}
				</div>
			</div>
		</div>
	</div>

@stop

@section('js')
    @parent
<script type="text/javascript">

    // ações do botão de mostrar e esconder senha
    $(document).ready(function(){
 	  validateErrorOnArea();
    
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
      
      function validateErrorOnArea(){
     	$error1 = document.getElementById('error_cnpj');
     	$error2 = document.getElementById('error_email');
     	$error3 = document.getElementById('error_password');
     	$error4 = document.getElementById('error_telefone');
     	$error5 = document.getElementById('error_razaoS');
     	
      	if($error1 != null || $error2 != null || $error3 != null || $error4 != null || $error5 != null){
      		document.getElementById('pessoa_juridica').checked = true;
      		document.getElementById('form_pessoa_fisica').style.display = 'none';
        	document.getElementById('form_pessoa_juridica').style.display = 'block';
      	}else{
      		document.getElementById('pessoa_fisica').checked = true;
      		document.getElementById('form_pessoa_fisica').style.display = 'block';
        	document.getElementById('form_pessoa_juridica').style.display = 'none';
      	}
      }
      
      // Click event of the showPassword button
      $('#showPassword2').on('click', function(){
         
        // Get the password field
        var passwordField = $('#password2');
        var passwordFieldConfirm = $('#password_confirmation');
     
        // Get the current type of the password field will be password or text
        var passwordFieldType = passwordField.attr('type');
        var passwordFieldConfirmType = passwordFieldConfirm.attr('type');
     
        // Check to see if the type is a password field
        if(passwordFieldType == 'password' && passwordFieldConfirmType == 'password')
        {
            // Change the password field to text
            passwordField.attr('type', 'text');
            passwordFieldConfirm.attr('type', 'text');
     
            // Change the Text on the show password button to Hide
            $(this).val('Esconder');
        } else {
            // If the password field type is not a password field then set it to password
            passwordField.attr('type', 'password');
            passwordFieldConfirm.attr('type', 'password');
     
            // Change the value of the show password button to Show
            $(this).val('Mostrar');
        }
      });
      // Click event of the showPassword button
      $('#showPassword3').on('click', function(){
         
        // Get the password field
        var passwordField = $('#password3');
     
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
