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
				<div class="checkout-steps">
					<a>4. Bônus</a>
					<a><span class="angle"></span>3. Estabelecimento</a>
					<a><span class="angle"></span>2. Segmento</a>
					<a class="active"><span class="angle"></span>1. Localização</a>
				</div>
				<h4>Selecione o estado e município para filtrar o bônus</h4>
				<hr class="padding-bottom-1x">
				<form class="price-range-slider" type="get" action="{{route('resgate-bonus-filtrar')}}">
					<div class="row">
                        @csrf
                        <input type="hidden" name="step" value="1">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="checkout-country">Estado</label>
                                <select class="form-control" name="estado" id="estado" required="true">
                                    <option value="" selected="false">Selecione o estado...</option>
                                    @if($estados != null)
                                        @foreach($estados as $estado)
    {{--                                    <option value="{{ $estado->uf }}" @if($selectedEstado == $estado->uf) selected @endif >--}}
                                            <option value="{{ $estado->uf }}"> {{ $estado->uf }} - {{ $estado->nome }}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="checkout-country">Município</label>
                                <select class="form-control" name="cidade" id="cidade" disabled="true">
                                    <option disabled>Selecione o município...</option>
                                </select>
                            </div>
                        </div>
                        <div class="checkout-footer">
                            <div class="column">
                                <a class="btn btn-outline-secondary" href="{{route('user_bonus')}}"><i class="icon-arrow-left"></i>
                                    <span class="hidden-xs-down">&nbsp;Voltar para o Menu
                                    </span>
                                </a>
                            </div>
                            <div class="column">
                                <button class="btn btn-primary" type="search" id="deduction">
                                    <span class="hidden-xs-down">Continuar</span><i class="icon-arrow-right"></i>
                                </button>
                            </div>
{{--                            <div class="column"><a class="btn btn-primary" href="{{route('resgate-bonus-filtrar')}}"><span class="hidden-xs-down">Continuar&nbsp;</span><i class="icon-arrow-right"></i></a></div>--}}
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
    jQuery(document).ready(function (){
        if(document.getElementById("estado").value  != ''){
            carregaCidade();
        }
        jQuery('select[name="estado"]').on('change', function () {
            carregaCidade();
        });

        function carregaCidade(){
            var stateId =  document.getElementById("estado").value;
            if(stateId){
                jQuery.ajax({
                    url: '/users/getCitys/' + stateId,
                    type: "GET",
                    dataType: "json",
                    success: function (data)
                    {
                        jQuery('select[name="cidade"]').empty();
                        document.getElementById("cidade").disabled = false;
                        jQuery('select[name="cidade"]').append('<option value="" selected="false">Selecione a cidade...</option>');
                        jQuery.each(data, function(key,value){
                            $('select[name="cidade"]').append('<option value="'+ key + '">'+ value + '</option>');
                        });
                    }
                });
            }
            else {
                $('select[name="cidade"]').empty();
            }
        }
    });

</script>


@stop
