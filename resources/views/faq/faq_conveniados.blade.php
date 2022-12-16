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
				<h1>Dúvidas Frequentes - Conveniados</h1>
			</div>
			<div class="column">
				<ul class="breadcrumbs">
					<li><a href="{{route('index')}}">Home</a></li>
					<li class="separator">&nbsp;</li>
					<li><a href="{{route('faq')}}">FAQ</a></li>
					<li class="separator">&nbsp;</li>
					<li>FAQ Conveniados</li>
				</ul>
			</div>
		</div>
    </div>
    <!-- Page Content-->
    <div class="container padding-bottom-3x mb-2">
		<div class="row">          
			<div class="col-lg-12">
				<div class="accordion" id="accordion" role="tablist">
					<div class="card">
						<div class="card-header" role="tab">
							<h6><a class="collapsed" href="#collapse1" data-toggle="collapse">O que é um conveniado Multben?</a></h6>
						</div>
						<div class="collapse" id="collapse1" data-parent="#accordion" role="tabpanel">
							<div class="card-body">
								<p>É uma empresa que está vinculada à MULTBEN para atender todos os seus assinantes ativos na utilização de seus Multben.</p>
							</div>
						</div>
					</div>
					<div class="card">
						<div class="card-header" role="tab">
							<h6><a class="collapsed" href="#collapse2" data-toggle="collapse">Vantagens de ser um conveniado Multben</a></h6>
						</div>
						<div class="collapse" id="collapse2" data-parent="#accordion" role="tabpanel">
							<div class="card-body">
								<p>Como o próprio nome da plataforma já declara, ser um conveniado Multben promove a empresa que se associa, inúmeros benefícios:</p>
								<p>• Recebimento antecipado</p>
								<p>• Divulgação no portal da plataforma</p>
								<p>• Fazer parte de uma grande rede de usuários que buscam um serviço de qualidade</p>
								<p>• Possibilidade de aumento no volume de clientes, e consequentemente aumento no faturamento</p>
								<p>• Fidelização de clientes, através do uso do Multben que é utilizado pelos assinantes dentro da rede credenciada</p>
							</div>
						</div>
					</div>
					<div class="card">
						<div class="card-header" role="tab">
							<h6><a class="collapsed" href="#collapse3" data-toggle="collapse">O que é Multben?</a></h6>
						</div>
						<div class="collapse" id="collapse3" data-parent="#accordion" role="tabpanel">
							<div class="card-body">
								<p>Quando o assinante indica amigos para a MULTBEN e esses amigos se ativam, ele ganha bônus que são transformados em dinheiro, para usar em qualquer serviço da rede credenciada. Todas as ativações mensais geram bônus de forma recorrente.</p>
							</div>
						</div>
					</div>
					<div class="card">
						<div class="card-header" role="tab">
							<h6><a class="collapsed" href="#collapse4" data-toggle="collapse">Como se tornar um coveniado Multben?</a></h6>
						</div>
						<div class="collapse" id="collapse4" data-parent="#accordion" role="tabpanel">
							<div class="card-body">Acesse o link “CONTATO” no rodapé deste portal e envie um e-mail com o ASSUNTO: QUERO SER CONVENIADO e nossa equipe retornará em seguida.</div>
						</div>
					</div>
					<div class="card">
						<div class="card-header" role="tab">
							<h6><a class="collapsed" href="#collapse5" data-toggle="collapse">O coveniado tem algum custo?</a></h6>
						</div>
						<div class="collapse" id="collapse5" data-parent="#accordion" role="tabpanel">
							<div class="card-body">
								<p>NÃO.</p>
							</div>
						</div>
					</div>
					<div class="card">
						<div class="card-header" role="tab">
							<h6><a class="collapsed" href="#collapse6" data-toggle="collapse">Recebimento de Multben</a></h6>
						</div>
						<div class="collapse" id="collapse6" data-parent="#accordion" role="tabpanel">
							<div class="card-body">O assinante solicita á MULTBEN que deseja utilizar um valor específico de seu Multben e indica o CONVENIADO credenciado. Neste momento a MULTBEN efetua o repasse do valor ANTECIPADO para o CONVENIADO e envia o comprovante de transferência no prazo de 72h e libera um voucher eletrônico.</div>
						</div>
					</div>
					<div class="card">
						<div class="card-header" role="tab">
							<h6><a class="collapsed" href="#collapse7" data-toggle="collapse">Atendimento ao assinante com Multben</a></h6>
						</div>
						<div class="collapse" id="collapse7" data-parent="#accordion" role="tabpanel">
							<div class="card-body">O assinante apresenta seu voucher ao responsável pela liberação do serviço ou produtos e recebe deste uma autorização para efetivar sua aquisição. O padrão de autorização interna de compra/serviço, bem como a pessoa ou setor responsável por esta liberação é determinado por cada Conveniado.</div>
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

@stop

