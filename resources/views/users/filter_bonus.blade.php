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
				<h1>Resgatar Bônus</h1>
			</div>
			<div class="column">
				<ul class="breadcrumbs">
					<li><a href="{{route('user_bonus')}}">Bônus</a></li>
					<li class="separator">&nbsp;</li>
					<li>Resgate de Bônus</li>
				</ul>
			</div>
		</div>
	</div>
	<!-- Page Content-->
    <div class="container padding-bottom-3x mb-2">
        <div class="row  justify-content-center">
			<!-- Checkout Adress-->
            <div class="col-xl-9 col-lg-8">
                <form class="price-range-slider"  action="{{ route('bonus_solicitation') }}" method="POST">
                    <input type="hidden" name="empresa_cnpj" value="{{ $empresa->cnpj }}">
                    @csrf
                    <div class="checkout-steps">
                        <a class="active">4. Bônus</a>
                        <a class="completed"><span class="angle"></span><span class="step-indicator icon-circle-check"></span> 3. Estabelecimento</a>
                        <a class="completed"><span class="angle"></span><span class="step-indicator icon-circle-check"></span> 2. Segmento</a>
                        <a class="completed"><span class="angle"></span><span class="step-indicator icon-circle-check"></span> 1. Localização</a>
                    </div>
                    <h4>Resumo do Resgate do Bônus</h4>
                    <hr class="padding-bottom-1x">

                    @if($errors != null && count($errors) > 0)
						<div class="row">
							<div class="col-12">
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
                    <div class="row">
                        <div class="col-sm-6">
                            <h5>Localização:</h5>
                            <ul class="list-unstyled">
                                <li><span class="text-muted">Município:</span>{{ $empresa->nome_cidade }}</li>
                                <li><span class="text-muted">Estado:</span>{{ $empresa->estado_nome }}</li>
                                <li><span class="text-muted">Endereço:</span>{{ $empresa->endereco }}</li>
                            </ul>
                        </div>
                        <div class="col-sm-6">
                            <h5>Estabelecimento:</h5>
                            <ul class="list-unstyled">
                                <li><span class="text-muted">Segmento:</span>{{ $empresa->category_nome }}</li>
                                <li><span class="text-muted">Estabelecimento:</span>{{ $empresa->razao_social }}</li>
                            </ul>
                        </div>
                        <div class="col-sm-6">
                            <h5>Saldo de Bônus (R$): <span class="format-valor">{{ $saldo == null ? '0,00' : number_format($saldo->valor,2) }}</span></h5>
                            <div class="form-group row">
                                <label class="col-1 col-form-label" for="number-input">R$</label>
                                <div class="col-5">
                                    <input required="true" class="form-control format-valor" type="text" id="credito" name="valor" value="" />
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="checkout-footer">
{{--                        <div class="column"><a class="btn btn-outline-secondary" href="{{route('filter_segment')}}"><i class="icon-arrow-left"></i><span class="hidden-xs-down">&nbsp;Voltar</span></a></div>--}}
                        <div class="column"><a class="btn btn-outline-secondary" href="javascript:history.back()"><i class="icon-arrow-left"></i><span class="hidden-xs-down">&nbsp;Voltar</span></a></div>

                        <div class="column">
                            <button class="btn btn-primary" type="search" id="credito">
                                <span class="hidden-xs-down">Quero Resgatar</span><i class="icon-arrow-right"></i>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

@stop

@section('js')
@parent
<script src="https://igorescobar.github.io/jQuery-Mask-Plugin/js/jquery.mask.min.js"></script>
<script>
    $(document).ready(function () {
        $('.format-valor').mask('#.##0,00', {reverse: true});
    });
</script>


@stop
