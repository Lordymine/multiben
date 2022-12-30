@extends('layouts.main')

@section('title', '')

@section('css')
    @parent

@stop

@section('content')
 <!-- Off-Canvas Wrapper-->
 <div class="offcanvas-wrapper">
	<!-- Page Title-->
    <div class="page-title">
		<div class="container">
			<div class="column">
				<h1>Como Funciona</h1>
			</div>
			<div class="column">
				<ul class="breadcrumbs">
					<li><a href="{{route('index')}}">Home</a></li>
					<li class="separator">&nbsp;</li>
					<li>Como Funciona</li>
				</ul>
			</div>
		</div>
    </div>
    <!-- Page Content-->
    <div class="container padding-bottom-3x mb-2">
		<div class="row justify-content-center">
			<!-- Content-->
			<div class="col-lg-10">
				<h2 class="padding-top-2x">Como Funciona</h2>
				<p class="lead text-justify">É tudo muito simples, vamos te contar com detalhes:</p>
				<p class="lead text-justify">Dentro da plataforma, existe uma rede de empresas parceiras que disponibilizaram seus produtos ou serviços com preços especiais, através de descontos exclusivos para assinantes MULTBEN.</p>
				<p class="lead text-justify">Você, na condição de assinante pode <strong>utilizar os serviços de forma ilimitada</strong> em toda a rede credenciada. Para utilizar seu benefício, basta informar ao estabelecimento que é um assinante Multben e receber o desconto no ato do pagamento.</p>
				<p class="lead text-justify">Para ser um assinante, basta se cadastrar, escolher o plano de assinatura que mais se encaixa no seu perfil e <strong>utilizar todos os multi benefícios da plataforma.</strong></p>
				<p class="lead text-justify">AH!!!! E ainda tem mais</p>
				<p class="lead text-justify">Além da enorme economia que você terá, pois vai realizar todos os serviços que já utiliza, sendo que a um custo muito menor, você ainda pode compartilhar essa oportunidade e <strong>ganhar bônus quando indicar amigos</strong>. Seus bônus se transformam em dinheiro, que serão utilizados dentro da rede credenciada.</p>
				<p class="lead text-justify">No futuro, pessoas do mundo inteiro se unirão para compartilhar oportunidades e aqui na Multben, você já é o futuro.</p>
			</div>
        </div>
    </div>
</div>

@stop

@section('js')
    @parent

@stop

