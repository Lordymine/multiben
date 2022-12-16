@extends('layouts.main')

@section('title', '')

@section('css')
@parent

@stop

@section('content')
	<!-- Page Title-->
	<div class="page-title">
		<div class="container">
			<div class="column">
				<h1>Assinar Plano</h1>
			</div>
			<div class="column">
				<ul class="breadcrumbs">
					<li><a href="{{asset('home')}}">Home</a></li>
					<li class="separator">&nbsp;</li>
					<li><a href="{{asset('seja-assinante')}}">Seja Assinante</a></li>
					<li class="separator">&nbsp;</li>
					<li>Assinar Plano</li>
				</ul>
			</div>
		</div>
	</div>
	<!-- Page Content-->
	
    <div class="container">
		<h3>Finalizar Assinatura</h3>
		<hr class="padding-bottom-1x">
	</div>
    <div class="container padding-bottom-3x mb-2">
	<form  class="row" enctype="multipart/form-data" action="{{ route('finalizar_assinatura') }}"  method="POST">
    	@csrf
        <div class="row justify-content-center  col-12">
			<div class="col-xl-9 col-lg-8">
<!-- 				<div class="checkout-steps"> -->
<!-- 					<a class="active" href="{{asset('assinar-plano-passo-4')}}">4. Resumo da Assinatura</a> -->
<!-- 					<a class="completed" href="{{asset('assinar-plano-passo-3')}}"><span class="step-indicator icon-circle-check"></span><span class="angle"></span>3. Formas de Pagamento</a> -->
<!-- 					<a class="completed" href="{{asset('assinar-plano-passo-2')}}"><span class="step-indicator icon-circle-check"></span><span class="angle"></span>2. Endereço</a> -->
<!-- 					<a class="completed" href="{{asset('assinar-plano-passo-1')}}"><span class="step-indicator icon-circle-check"></span><span class="angle"></span>1. Dados Pessoais</a> -->
<!-- 				</div> -->
				
				<center><h4>Endereço de Cobrança</h4></center>
				<hr class="padding-bottom-1x">
				@if($error != null)
					<div class="row">
						<div class="col-sm-8">
							<div class="alert alert-warning">
								<ul>
									<li>{{$error}}</li>
								</ul>
							</div>
						</div>
					</div>
                @endif
				<div class="row">
					<div class="col-sm-4">
						<div class="form-group">
							<label for="checkout-zip">CEP</label>
							<input required class="form-control" placeholder="00000000"  onkeyup="mascara('#####-###',this,event,true)" maxlength="9" type="text" name="zip_code" id="zip_code">
						</div>
					</div>
					<div class="col-sm-4">
						<div class="form-group">
							<label for="checkout-address1">LOGRADOURO</label>
							<input required class="form-control" type="text" name="street" id="street">
						</div>
					</div>
					<div class="col-sm-4">
						<div class="form-group">
							<label for="checkout-address2">BAIRRO</label>
							<input required="true" class="form-control" type="text" name="district" id="district">
						</div>
					</div>
					<div class="col-sm-4">
						<div class="form-group">
							<label for="checkout-address2">NÚMERO</label>
							<input required="true" class="form-control" type="text" name="number" id="number">
						</div>
					</div>
    				</div>
				</div>
				<div class="container table-responsive shopping-cart">
					<table class="table">
						<thead>
							<tr>
								<th>Plano escolhido</th>
								<th class="text-center">Subtotal</th>
								<th></th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td>
									<div class="product-info">
									<input type="hidden" name="description" id="description" value="{{ $description }}">
										<h4 class="product-title">PLANO {{ $description }}<small>x 1</small></h4><span><em>Renovação:</em> mensal</span>
									</div>
								</td>
								<td class="text-center text-lg text-medium">{{ $price }}</td>
								<!--<td class="text-center"><a class="btn btn-outline-primary btn-sm" href="cart.html">Editar</a></td>-->
							</tr>
						</tbody>
					</table>
				</div>
				<div class="shopping-cart-footer">
					<div class="column"></div>
					<input type="hidden" name=price id="price" value="{{ $price }}">
					<div class="column text-lg">Total: <span class="text-medium">{{ $price }}</span></div>
				</div>
				<div class="row padding-top-1x mt-3">
					<div class="col-sm-6">
						<h5>Assinatura para:</h5>
						<ul class="list-unstyled">
							<li><span class="text-muted">Cliente:</span>{{ $user->name}} {{ $user->sobrenome }}</li>
							<li><span class="text-muted">CPF:</span>{{ $user->cpf }}</li>
							<li><span class="text-muted" >Contato:</span> {{ App\Repositories\UsersRepository::mask($user->telefone."'",'(##) #####-####') }}</li>
							
						</ul>
					</div>
					<div class="col-sm-6">
						<h5>Método de Pagamento:</h5>
						<ul class="list-unstyled">
<!-- 							<li><span class="text-muted">Cartão de Crédito:</span>**** **** **** 5300</li> -->
							<li><span class="text-muted">Boleto Bancário</span></li>
						</ul>
					</div>
				</div>
				
				<div class="checkout-footer margin-top-1x">
<!-- 					<div class="column"><a class="btn btn-outline-secondary" href="{{asset('assinar-plano-passo-3')}}"><i class="icon-arrow-left"></i><span class="hidden-xs-down">&nbsp;Voltar</a></div> -->
    			 	<div class="column">
        			 	<button  class="btn btn-primary" type="search" id="credito" style="float:right">
                            <span>Confirmar</span>
                        </button>
                    </div>
<!-- 					<div class="column"><a class="btn btn-primary" href="{{asset('users/assinatura-realizada-com-sucesso')}}">Concluir</a></div> -->
				</div>
			</div>
		</div>
	 </form>
	</div>

@stop

@section('js')
@parent

<script type="text/javascript">

	function limpa_formulario_cep() {
        $("#street").val("");
        $("#district").val("");
    }
    
    $("#zip_code").blur(function() {
    
        var cep = $(this).val().replace(/\D/g, '');
    
        if (cep != "") {
    
            var validacep = /^[0-9]{8}$/;
    
            //Valida o formato do CEP.
            if(validacep.test(cep)) {
    
                $("#street").val("...");
                $("#district").val("...");
    
                //Consulta o webservice viacep.com.br/
                $.getJSON("https://viacep.com.br/ws/"+ cep +"/json/?callback=?", function(dados) {
                    if (!("erro" in dados)) {
                        $("#street").val(dados.logradouro.toUpperCase());
                        $("#district").val(dados.bairro.toUpperCase());
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

		$(this).trigger('keyup');
    });

</script>
@stop
