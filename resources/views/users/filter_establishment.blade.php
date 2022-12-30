@extends('layouts.main')

@section('title', '')

@section('css')
@parent

@stop

@section('content')
<style>
    /*.radio-image label .card a{
        visibility: hidden;
    }
    .radio-image label input[type="radio"]{
        cursor:pointer;
        border:4px solid #EEE;
        border-radius:15px;
        padding:10px;
    }
    .radio-image label input[type="radio"]:checked + img{
        border:4px solid #0da9ef;
    }*/
    label {
        width: 100%;
        cursor:pointer;
    }
    #delimiteCaractere{
        max-width: 9ch;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
        color:#3e3e3e;
        font-size: 1rem;
        font-weight: bold;
        width: 10em;
        display: block;
        height: 21px;
         text-transform:capitalize; 
    }
    .card-input-element+.card {
        cursor:pointer;
        border:4px solid #EEE;
        border-radius:15px;
        padding:10px;
    }
    .card-input-element+.card:hover{
        cursor: pointer;
    }
    .card-input-element:checked+.card {
        border: 2px solid var(--primary);
        -webkit-transition: border .3s;
        -o-transition: border .3s;
        transition: border .3s;
    }
    .card-input-element:checked+.card::after {
        color: #AFB8EA;
    }
    
    .page-item {
        display: inline-block;
        width: 36px;
        height: 36px;
        font-size: 14px;
        font-weight: 500;
        line-height: 34px;
        text-align: center;
    }

    .page-item > a {
        display: block;
        width: 36px;
        height: 36px;
        transition: all .3s;
        border: 1px solid transparent;
        border-radius: 50%;
        color: #606975;
        line-height: 34px;
        text-decoration: none;
    }

    .page-item > a:hover {
        border-color: #e1e7ec;
        background-color: #f5f5f5;
    }
    
    .page-item.active {
        border-color: #e1e7ec;
        background-color: #f5f5f5;
        border-radius: 50%;
        
    }
    
    .rating-stars{
        font-size: 11px;
    }
    .rating-stars>i.half-star {
        color: #ffb74f;
        content: '\f089';
        width: 0.5em;
        overflow: hidden;
    }
    
    @media (min-width: 320px) and (max-width: 1199px) {
		.grid-item {
           width: 27em;
           height: 12em;
        }
        .grid-item .card {
            width: 25em;
            height: 12em;
        }
    	.gallery-item p.card-text {
            height: 7em;
            margin-bottom: 10px;
        }
	}
	@media (min-width: 1200px) {
		.grid-item {
            width: 21em;
            height: 15em;
        }
        .grid-item .card {
            width: 20em;
            height: 15em;
        }
    	.gallery-item p.card-text {
            height: 10em;
            margin-bottom: 10px;
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
        <div class="row justify-content-center">
			<!-- Checkout Adress-->
			<div class="col-xl-9 col-lg-8">
				<div class="checkout-steps">
					<a>4. Bônus</a>
					<a class="active"><span class="angle"></span>3. Estabelecimento</a>
					<a class="completed"><span class="angle"></span><span class="step-indicator icon-circle-check"></span> 2. Segmento</a>
					<a class="completed" ><span class="angle"></span><span class="step-indicator icon-circle-check"></span> 1. Localização</a>
				</div>
				<h4>Selecione o estabelecimento</h4>
				<hr class="padding-bottom-1x">
				<div class="row">
                    <div class="col-12 margin-bottom-1x">
                        <form class="input-group form-group form_filter" type="get" action="">
                            <span class="input-group-btn">
							<button type="submit"><i class="icon-search"></i></button></span>
							<input class="form-control" type="text" name="search" placeholder="Pesquisar">
						</form>
					</div>
				</div>
				@if($semEmpresa)
            	<div class="justify-content-center">
					<div class="alert alert-warning">
						<p class="card-text">Não foram encontrados estabelecimentos para os filtros selecionados.</p>
					</div>
				</div>
				@endif
                <form class="price-range-slider" type="get" action="{{route('resgate-bonus-filtrar')}}">
                    @csrf
                    <input type="hidden" name="step" value="3">
                    @if($categorias != null)
                        @foreach($categorias as $categoria)
                        <input type="hidden" name="categorias" value="{{ $categoria }}">
                        @endforeach
                    @endif
                    
                    <div class="row">
                    @if($empresas != null)
                    	@foreach($empresas as $empresa)
                    	<!-- card-template -->
                        <div class="col-md-4 col-sm-6">
                            <div class="gallery-item radio-image grid-item">
                                <!-- card-template -->
                                <label for="{{ $empresa != null ? $empresa->cnpj : 'radio' }}">
                                    <input required="true" class="card-input-element d-none" required="true" type="radio" name="empresa" id="{{ $empresa != null ? $empresa->cnpj : 'radio' }}" value="{{ $empresa != null ? $empresa->cnpj : '0' }}"/>
                                    <div class="card card-input margin-bottom-1x " style="box-shadow: 0px 1px 4px rgba(0, 0, 0, 0.05);">
                                        <!--<a href="#" style="text-decoration: none;" class="selectEmpresa" name="" id="">-->
                                            <div class="card-body" style="padding: 10px; height: auto; flex: 1 1 auto;">
                                                <div class="row">
                                                    <div class="col-5 my-auto">
                                                        <span class="product-thumb">
                                                            <img src="../img/parceiros/parceiro1.png" alt="Product" style="width:200px; height:100px;">
                                                        </span>
                                                    </div>
                                                    <div class="col-7 my-auto">
                                                        <p class="card-text">
                                                            <span class="card-text" id="delimiteCaractere">{{ $empresa->nome_fantasia }}</span><br>
                                                            <span class="card-text" style="color:#606975;">Bairro: {{ $empresa->bairro }}</span><br>
                                                            <span class="text-muted">Atualizada em {{ \Carbon\Carbon::parse($empresa->updated_at)->format('d  M')}}</span>
                                                        </p>
                                                        <div class="rating-stars card-text">
                                        					<i class="icon-star {{$empresa->stars[0]}} {{$empresa->halfStars[0]}}" > </i>
                                        					<i class="icon-star {{$empresa->stars[1]}} {{$empresa->halfStars[1]}}"></i>
                                        					<i class="icon-star {{$empresa->stars[2]}} {{$empresa->halfStars[2]}}"></i>
                                        					<i class="icon-star {{$empresa->stars[3]}} {{$empresa->halfStars[3]}}"></i>
                                        					<i class="icon-star {{$empresa->stars[4]}} {{$empresa->halfStars[4]}}"></i>
                                            				<span class="text-muted align-middle">&nbsp;&nbsp; {{$empresa->rating}}</span>
                                        				</div>
                                                    </div>
                                                </div>
                                            </div>
                                        <!--</a>-->
                                    </div>
                                </label>
                                <!-- ./end-card-template -->
                            </div>
                        </div>
						<!-- ./end-card-template -->
                    	@endforeach
					@endif
					</div>
                        <center>{{ $empresas->links() }}</center>
                        Total de Registros: {{ $empresas->total() }}
                    <div class="checkout-footer">
                        <div class="column"><a class="btn btn-outline-secondary" href="javascript:history.back()"><i class="icon-arrow-left"></i><span class="hidden-xs-down">&nbsp;Voltar</span></a></div>
                    	@if($semEmpresa)
                        <div class="column">
                        	<div class="info-label btn btn-primary" data-toggle="tooltip" title="É necessário ter um estabelecimento selecionado para continuar">
                            	<span class="hidden-xs-down">Continuar</span><i class="icon-arrow-right"></i>
                            </div>
                        </div>
                    	@else
                        <div class="column">
                            <button class="btn btn-primary" type="search" id="deduction">
                                <span class="hidden-xs-down">Continuar</span><i class="icon-arrow-right"></i>
                            </button>
                        </div>
                        @endif
                    </div>
                    <!--row-->
                </form>


			</div>
        </div>
    </div>

@stop

@section('js')
@parent
<script type="text/javascript">
    jQuery(document).ready(function (){
        $('.selectEmpresa').click(function (){
            document.getElementById($(this).attr('name')).checked = true;
        });

        montarFiltro()
    })

    function montarFiltro() {
        var params = window.location.search.substring(1).split('&');
        //Passar por todos os parametros
        for(var i=0; i<params.length; i++) {
            //Dividir os parametros chave e valor
            var param = params[i].split('=');

            
            if(param[0] == 'search'){
                $('form.form_filter input[name=search]').val(param[1]);
            }else{
                var $input = $('<input type="hidden"  >').appendTo($('form.form_filter')).val(param[1]);
                $input.attr('name',(param[0]).toString());
            }
        }
    }
</script>


@stop
