@extends('layouts.main')

@section('title', '')

@section('css')
@parent

@stop

@section('content')

<style>

@media (min-width: 320px) and (max-width: 1199px) {
td {
    display:block;
}
     
}
</style>
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
					<a class="active"><span class="angle"></span>2. Segmento</a>
					<a class="completed"><span class="angle"></span><span class="step-indicator icon-circle-check"></span> 1. Localização</a>
				</div>
				<h4>Selecione o tipo do segmento do estabelecimento</h4>
				<hr class="padding-bottom-1x">
                    <form class="price-range-slider" type="get" action="{{route('resgate-bonus-filtrar')}}">
                        @csrf
                        <input type="hidden" name="step" value="2">
                        <input type="hidden" name="estado" value="{{ $estado ?? '' }}">
                        <input type="hidden"  name="cidade" value="{{ $cidade ?? '' }}">                        
						<div class="form-group">
							<label for="account-ln">SERVIÇO / FORNECIMENTO</label><br>
								<table class="table table-borderless table-sm">
								@php
									$i = 1;
								@endphp
									<tr>
										@foreach($categorias as $categoria)
										<td>
											<div class="custom-control custom-checkbox custom-control-inline">
												<input class="custom-control-input filtro_categoria" name="categoria[]" type="checkbox" id="{{ $categoria->id }}" value="{{ $categoria->id }}">
                                    			<label class="custom-control-label" for="{{ $categoria->id }}">{{ $categoria->nome }}</label>
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
                        <div class="checkout-footer">
                            <div class="column"><a class="btn btn-outline-secondary" href="javascript:history.back()"><i class="icon-arrow-left"></i><span class="hidden-xs-down">&nbsp;Voltar</span></a></div>
                            {{--<div class="column"><a class="btn btn-outline-secondary" href="{{route('back_page_filter',['estado' => $estado ?? '', 'cidade' => $cidade])}}"><i class="icon-arrow-left"></i><span class="hidden-xs-down">&nbsp;Voltar</span></a></div>--}}
                            {{--<div class="column"><a class="btn btn-outline-secondary" href="{{route('filter_location')}}"><i class="icon-arrow-left"></i><span class="hidden-xs-down">&nbsp;Voltar</span></a></div>--}}
                            <div class="column">
                                <button class="btn btn-primary" type="search" id="deduction">
                                    <span class="hidden-xs-down">Continuar</span><i class="icon-arrow-right"></i>
                                </button>
                            </div>
                             {{--<div class="column"><a class="btn btn-primary search" id="filter"  href="{{route('filter_location_estabelecimento_category')}}"><span id="search" name="search" class="hidden-xs-down">Continuar&nbsp;</span><i class="icon-arrow-right"></i></a></div>--}}
                        </div>
                    </form>
            </div>
        </div>
    </div>

@stop

@section('js')
@parent
<script type="text/javascript">
    jQuery(document).ready(function (){

    })
</script>


@stop
