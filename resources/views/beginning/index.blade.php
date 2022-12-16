@extends('layouts.main')

@section('title', '')

@section('css')
@parent

@stop

@section('content')
<style>
	.gallery-item {
		width: 27em;
		height: 12em;
	}

	.gallery-item .card {
		width: 25em;
		height: 12em;
	}

	.gallery-item p.card-text {
		height: 7em;
		margin-bottom: 10px;
	}

	.rating-stars>i.half-star {
		color: #ffb74f;
		content: '\f089';
		width: 0.5em;
		overflow: hidden;
	}

	#delimiteCaractere {
		max-width: 9ch;
		overflow: hidden;
		text-overflow: ellipsis;
		white-space: nowrap;
		color: #3e3e3e;
		font-size: 1rem;
		font-weight: bold;
		width: 10em;
		display: block;
		height: 21px;
		text-transform: capitalize;
	}

	#indicacaoModal .modal-content .texto {
		font-size: 18px;
		color: #000;
	}

	#indicacaoModal .modal-content .texto a {
		color: inherit;
	}

	#indicacaoModal .link-group-compartilhar .btn {
		border: solid 1px #d7d7d7;
	}

	#indicacaoModal .modal-content ul li {
		width: 100%;
	}

	#mobile-menu {
		z-index: 99;
	}

	@media (max-width: 767pc) {
		#indicacaoModal {
			padding: 0 !important;
			height: 100vh;
		}
	}
</style>
<!-- Modal do Vídeo -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-body">
				<video id="video">
					<source src="video/apresentacao-multben.mp4" type="video/mp4">
				</video>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-warning btn-sm" onclick="closeModal();" data-dismiss="modal">Fechar</button>
			</div>
		</div>
	</div>
</div>

<!-- Off-Canvas Wrapper-->
<div class="offcanvas-wrapper" style="min-height: 0;">
	<!-- Banner -->
	<section class="fw-section" style="background-image: url({{asset('img/banner/banner.jpeg')}}); height:550px;">
		<!--<span class="overlay" style="background-color: #374250; opacity: .55;"></span>-->
		<div class="container text-center" style="padding-top:420px">
			<!--  padding-top-4x padding-bottom-4x -->
			<button type="button" class="btn btn-primary" id="openModal" onclick="openModal();"><span style="color:white"><i class="icon-play" style="vertical-align:inherit;"></i> Quero assistir o vídeo</span></button>
			<a class="btn btn-primary" href="{{route('subscriber_become')}}"><span style="color:white">Planos</span></a>
		</div>
	</section>
	<!-- script para executar e pausar o video no modal -->
	<script>
		//Close modal ou esc ou out
		$("body").click(function() {
			if ($("#myModal").is(":visible")) {
				closeModal();
			}
		});
		$(document).keydown(function(event) {
			if (event.keyCode == 27) {
				closeModal();
			}
		});

		function openModal() {
			var vid = document.getElementById("video");
			$("#myModal").modal({
				show: true
			});
			vid.play();
		}

		function closeModal() {
			var vid = document.getElementById("video");
			$("#myModal").modal({
				show: false
			});
			vid.pause();
			vid.load();
		}
	</script>

	<!-- CARROSEL DE SERVIÇOS -->
	<section class=" padding-top-3x padding-bottom-3x">
		<h3 class="text-center mb-30">SEGMENTOS</h3>
		<div class="owl-carousel" data-owl-carousel="{ &quot;nav&quot;: false, &quot;dots&quot;: false, &quot;loop&quot;: true, &quot;autoplay&quot;: true, &quot;autoplayTimeout&quot;: 4000, &quot;responsive&quot;: {&quot;0&quot;:{&quot;items&quot;:3}, &quot;470&quot;:{&quot;items&quot;:3},&quot;630&quot;:{&quot;items&quot;:4},&quot;991&quot;:{&quot;items&quot;:5},&quot;1200&quot;:{&quot;items&quot;:7}} }">
			@foreach($categories as $category)
			<a href='{{route("companies_index",$category->id)}}'><img class="d-block w-110 opacity-75 m-auto" src="{{asset('img/ico/'.$category->image)}}" alt="{{$category->name}}"></a>
			@endforeach
		</div>
	</section>

	<section id="indicacao">
		<div class="row" style="background: #f5f5f5;">
			<div class="container text-center">
				<a class="a1" href="#indicacao2" data-toggle="modal" data-target="#indicacaoModal">
					<img src="./img/indicacao_1.png" style="width: 100%;max-width: 900px;">
				</a>
			</div>
		</div>
	</section>

	<section class=" padding-top-1x ">
		<!--padding-bottom-3x-->
		<div class="container">
			<!-- Shop Toolbar-->
			<div class="shop-toolbar padding-bottom-1x mb-2">
				<div class="column">
					<div class="shop-sorting">
						<label for="sorting">Ordenar por:</label>
						<select class="form-control" id="sorting">
							<option value="Favoritos">Favoritos</option>
							<option value="Bairros">Bairros</option>
						</select>
						<span class="text-muted">Mostrando:&nbsp;</span><span>1 - {{ $categories->count() }} itens</span>
					</div>
				</div>
			</div>

			<div class="row">
				<div class="col">
					<!--col-lg-9 col-md-8 order-md-2-->
					<h6 class="text-muted text-normal text-uppercase">Os Destaques da Multben</h6>
					<!--<hr class="margin-bottom-1x">-->
					<div id="sorting-result">
						<!--gallery-wrapper-->
						<div class="row">
							@foreach($empresas as $empresa)
							<div class="col-md-4 col-sm-6">
								<div class="gallery-item">
									<!-- card-template -->
									<div class="card margin-bottom-1x" style="box-shadow: 0px 1px 4px rgba(0, 0, 0, 0.05);">
										<a href="{{ route('companies_info',encrypt($empresa->id))  }}" style="text-decoration: none;">
											<div class="card-body" style="padding: 20px; height: auto; flex: 1 1 auto;">
												<div class="row">
													<div class="col-5 my-auto">
														<span class="product-thumb">
															<img src="{{asset($empresa->capa())}}" alt="{{ $empresa->nome_fantasia }}" style="width:200px; height:100px;">
														</span>
													</div>
													<!--
														<div class="col-1 my-auto">
														<div style="height: 90px; width: 1px; box-sizing: border-box; background-color: #80808012; border-radius: 10px;"></div>
														</div>-->
													<div class="col-7 my-auto">
														<p class="card-text">
															<span class="card-text" style="color:#404040;font-size: 1rem;font-weight: bold;white-space: nowrap;width: 10em;overflow: hidden;text-overflow: ellipsis;display: inline-block;text-transform:capitalize;">{{ $empresa->nome_fantasia }}</span><br>
															<span class="card-text" style="color:#606975;">Bairro: {{ $empresa->bairro }}</span><br>
															<span class="text-muted">Atualizada em {{ \Carbon\Carbon::parse($empresa->updated_at)->format('d  M')}}</span>
														</p>
														<div class="rating-stars">
															<i class="icon-star {{$empresa->stars[0]}} {{$empresa->halfStars[0]}}"> </i>
															<i class="icon-star {{$empresa->stars[1]}} {{$empresa->halfStars[1]}}"></i>
															<i class="icon-star {{$empresa->stars[2]}} {{$empresa->halfStars[2]}}"></i>
															<i class="icon-star {{$empresa->stars[3]}} {{$empresa->halfStars[3]}}"></i>
															<i class="icon-star {{$empresa->stars[4]}} {{$empresa->halfStars[4]}}"></i>
														</div>
														<span class="text-muted align-middle">&nbsp;&nbsp; {{$empresa->rating}}</span>
													</div>
												</div>
											</div>
										</a>
									</div>
									<!-- ./end-card-template -->
								</div>
							</div>
							@endforeach
						</div>
					</div>
					<div class="text-right">
						<a href="{{ route('companies_info_all') }}" id="ver_companies" class="btn btn-primary btn-sm">ver todos</a>
					</div>
				</div>
			</div>
		</div>
	</section>

	<section class=" padding-top-3x padding-bottom-3x">
		<!--bg-faded-->
		<div class="container">
			<h3 class="text-center mb-30 pb-2">CONVENIADOS</h3>
			<div class="owl-carousel" data-owl-carousel="{ &quot;nav&quot;: false, &quot;dots&quot;: false, &quot;loop&quot;: true, &quot;autoplay&quot;: true, &quot;autoplayTimeout&quot;: 4000, &quot;responsive&quot;: {&quot;0&quot;:{&quot;items&quot;:2}, &quot;470&quot;:{&quot;items&quot;:3},&quot;630&quot;:{&quot;items&quot;:4},&quot;991&quot;:{&quot;items&quot;:5},&quot;1200&quot;:{&quot;items&quot;:6}} }">
				@foreach($conveniados as $conveniado)
				@if(!empty($conveniado->logo))
				<a href="{{ route('companies_info',encrypt($conveniado->id))  }}" style="text-decoration: none;">
					<img class="d-block opacity-75 m-auto" style="box-shadow: 1px 1px 1px 1px;width: 170px;color: #e9e7e7b0;border: 1px solid;" src="{{asset('storage/logos/'.$conveniado->logo)}}" alt="{{ $conveniado->nome_fantasia }}">
				</a>
				@endif
				@endforeach
			</div>
			<div class="text-right">
				<a href="{{route('companies-partner')}}" class="btn btn-primary btn-sm">ver todos</a>
			</div>
		</div>
	</section>
</div>

<div id="indicacaoModal" class="modal" tabindex="-1" role="dialog">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-body">
				<div class="row">
					<div class="container">
						<div class="">
							<img src="./img/indicacao_2.jpg" style="width: 100%;max-width: 900px;">
						</div>
						<div class="">
							<div class="texto">
								<p>Ao indicar um amigo para ser um assinante da <strong>MULTBEN </strong>voc&ecirc; passar&aacute; a ganhar <strong>MULTB&Ocirc;NUS </strong>por indica&ccedil;&atilde;o direta e indireta. - Para mais informa&ccedil;&otilde;es v&aacute; na op&ccedil;&atilde;o <a href="termos-e-condicoes-de-uso"><strong>TERMOS E CONDI&Ccedil;&Otilde;ES DO ASSINANTE</strong></a>.</p>
							</div>
							<br> 
							<br>
							<div class="css-10o0z96">
								<ul class="list-inline link-group-compartilhar" data-url="{{route('token_convite',[$matricula])}}">
									<li>
										<button target="_blank" class="btn btn-block text-left btn-whatsapp">
											<span class="css-1q6nxsv">
												<svg width="42" height="42" viewBox="0 0 42 42" xmlns="http://www.w3.org/2000/svg" class="css-1u6cz6t">
													<g fill-rule="nonzero" fill="none">
														<path d="M9 33l1.655-6C9.58 25.138 9 23.069 9 20.917 9 14.38 14.38 9 20.959 9S33 14.38 33 20.917C33 27.455 27.538 33 20.959 33c-2.07 0-4.056-.662-5.835-1.655L9 33z" fill="#EDEDED"></path>
														<path d="M15.455 29.193l.373.207c1.53.952 3.31 1.531 5.172 1.531 5.42 0 9.931-4.51 9.931-10.014 0-5.503-4.51-9.848-9.972-9.848s-9.89 4.386-9.89 9.848c0 1.904.538 3.766 1.531 5.338l.248.373-.951 3.475 3.558-.91z" fill="#55CD6C"></path>
														<path d="M17.772 15.372l-.786-.041c-.248 0-.496.083-.662.248-.372.331-.993.952-1.158 1.78-.29 1.241.165 2.73 1.241 4.22 1.076 1.49 3.145 3.89 6.786 4.924 1.159.331 2.07.125 2.814-.33.58-.373.952-.952 1.076-1.573l.124-.58a.416.416 0 00-.207-.454l-2.607-1.2a.395.395 0 00-.496.124l-1.035 1.324c-.083.083-.207.124-.33.083-.704-.249-3.063-1.242-4.346-3.725-.041-.124-.041-.248.042-.33l.993-1.118c.083-.124.124-.29.083-.414l-1.2-2.69a.36.36 0 00-.332-.248" fill="#FEFEFE"></path>
													</g>
												</svg>
											</span>
											<span>WhatsApp</span>
										</button>
									</li>
									<li>
										<button target="_blank" class="btn btn-block text-left btn-facebook">
											<span >
												<svg width="42" height="42" viewBox="0 0 42 42" xmlns="http://www.w3.org/2000/svg" class="css-1u6cz6t">
													<g>
														<rect fill="none" width="42" height="42" rx="3"></rect>
														<path d="M31.676 9H10.325C9.593 9 9 9.593 9 10.325v21.351c0 .732.593 1.325 1.325 1.325H21.82v-9.294h-3.128v-3.622h3.128v-2.672c0-3.1 1.893-4.788 4.66-4.788.933-.003 1.866.045 2.794.143v3.237h-1.918c-1.503 0-1.798.715-1.798 1.764v2.313h3.586l-.467 3.622H25.56v9.297h6.115c.732 0 1.325-.593 1.325-1.325V10.325C33 9.593 32.407 9 31.676 9z" fill="#415b91"></path>
													</g>
												</svg>
											</span>
											<span >Facebook</span>
										</button>
									</li>
								</ul>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>



@stop

@section('js')
@parent

<script>
	$(document).ready(function() {
		$("#sorting").change(function() {
			$.ajax({
				method: "POST",
				data: {
					sorting: $(this).val(),
					"_token": "{{ csrf_token() }}"
				},
				url: "/filtrar-home",
				dataType: "html",
				beforeSend: function() {
					$("#sorting-result").html('BUSCANDO...');
				},
				success: function(o) {
					$("#sorting-result").html(o);
				}
			});
		});

		$(".link-group-compartilhar .btn-whatsapp").click(function() {
			var url = $(".link-group-compartilhar").data('url');
			MyPopUpWin('https://api.whatsapp.com/send?text='+url);
		});
		
		$(".link-group-compartilhar .btn-facebook").click(function() {
			var url = $(".link-group-compartilhar").data('url');
			MyPopUpWin("https://www.facebook.com/sharer/sharer.php?u=" + encodeURIComponent(url));
		});
	});

	function MyPopUpWin(url, width = 600, height = 400) {
		var leftPosition, topPosition;
		//Allow for borders.
		width = (width > window.screen.width) ? window.screen.width : width;
		height = (height > window.screen.height) ? window.screen.height : height;

		leftPosition = (window.screen.width / 2) - ((width / 2) + 10);
		topPosition = (window.screen.height / 2) - ((height / 2) + 50);
		//Allow for title and status bars.
		
		//Open the window.
		window.open(url, "Window2",
		"status=no,title=no, toolbar=no, menubar=no, scrollbars=no, location=no, directories=no,"+
		"resizable=yes, height=" + height + ",width=" + width + ",left=" + leftPosition + 
		",top=" + topPosition + ",screenX=" + leftPosition + ",screenY=" + topPosition );
	}

		
</script>

@stop