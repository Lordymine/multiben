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
				<h1>Dúvidas Frequentes - Assinante</h1>
			</div>
			<div class="column">
				<ul class="breadcrumbs">
					<li><a href="{{route('index')}}">Home</a></li>
					<li class="separator">&nbsp;</li>
					<li><a href="{{route('faq')}}">FAQ</a></li>
					<li class="separator">&nbsp;</li>
					<li>FAQ Assinante</li>
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
							<h6><a class="collapsed" href="#collapse1" data-toggle="collapse">Por que devo criar uma conta Multben?</a></h6>
						</div>
						<div class="collapse" id="collapse1" data-parent="#accordion" role="tabpanel">
							<div class="card-body">
								<p>Ao criar uma conta, além de ter acesso a todas as informações da plataforma, você ainda ganha 7 dias grátis para usufruir de todos os benefícios da Multben.</p>
							</div>
						</div>
					</div>
					<div class="card">
						<div class="card-header" role="tab">
							<h6><a class="collapsed" href="#collapse2" data-toggle="collapse">Como criar conta?</a></h6>
						</div>
						<div class="collapse" id="collapse2" data-parent="#accordion" role="tabpanel">
							<div class="card-body">
								<p>Siga os passos abaixo:</p>
								<p>Clique no menu no canto esquerdo da página</p>
								<p>1.	Na área de VISITANTE, clique em LOGIN/CADASTRE-SE;</p>
								<p>2.	Em CRIAR CONTA, informe os dados solicitados. Se você foi indicado por alguém, é imprescindível informar o código de indicação;</p>
								<p>3.	Clique em SALVAR;</p>
								<p>4.	Pronto, você acaba de criar sua conta na MULTBEN.</p>
							</div>
						</div>
					</div>
					<div class="card">
						<div class="card-header" role="tab">
							<h6><a class="collapsed" href="#collapse3" data-toggle="collapse">Como me tornar um assinante?</a></h6>
						</div>
						<div class="collapse" id="collapse3" data-parent="#accordion" role="tabpanel">
							<div class="card-body">
								<p>Siga os passos abaixo:</p>
								<p>1.	Clique no botão PLANOS na área principal;</p>
								<p>2.	Escolha o plano mais adequado ao seu perfil;</p>
								<p>3.	Clique em ASSINAR;</p>
								<p>4.	Preencha seus dados;</p>
								<p>5.	Escolha a forma de pagamento.</p>
							</div>
						</div>
					</div>
					<div class="card">
						<div class="card-header" role="tab">
							<h6><a class="collapsed" href="#collapse4" data-toggle="collapse">O que é renovação automática?</a></h6>
						</div>
						<div class="collapse" id="collapse4" data-parent="#accordion" role="tabpanel">
							<div class="card-body">É quando a plataforma identifica o pagamento da assinatura mensal e ativa o ID para o próximo período.</div>
						</div>
					</div>
					<div class="card">
						<div class="card-header" role="tab">
							<h6><a class="collapsed" href="#collapse5" data-toggle="collapse">Como alterar senha?</a></h6>
						</div>
						<div class="collapse" id="collapse5" data-parent="#accordion" role="tabpanel">
							<div class="card-body">
								<p>1.	Acessar a plataforma;</p>
								<p>2.	Clicar em “Entrar”;</p>
								<p>3.	Agora é só clicar em “esqueceu a senha?”;</p>
								<p>4.	Será enviado um segundo link para o seu e-mail com instruções para troca de senha em até 5 minutos;</p>
								<p>5.	Clique em “mudar minha senha”;</p>
								<p>6.	A senha tem que ter no mínimo 8 e no máximo de 16 caracteres, tendo pelo menos uma letra, um número e um caractere especial;</p>
								<p>7.	A senha não pode ser a mesma utilizada anteriormente;</p>
								<p>8.	O link tem a validade de duas horas, caso você não consiga redefinir a senha nesse período, é necessário que refaça o procedimento.</p>
							</div>
						</div>
					</div>
					<div class="card">
						<div class="card-header" role="tab">
							<h6><a class="collapsed" href="#collapse6" data-toggle="collapse">Quantos dependentes posso incluir no plano FAM?</a></h6>
						</div>
						<div class="collapse" id="collapse6" data-parent="#accordion" role="tabpanel">
							<div class="card-body">Titular mais 3 dependentes.</div>
						</div>
					</div>
					<div class="card">
						<div class="card-header" role="tab">
							<h6><a class="collapsed" href="#collapse7" data-toggle="collapse">Quem pode ser dependente no plano FAM?</a></h6>
						</div>
						<div class="collapse" id="collapse7" data-parent="#accordion" role="tabpanel">
							<div class="card-body">Cônjuge e filhos.</div>
						</div>
					</div>
					<div class="card">
						<div class="card-header" role="tab">
							<h6><a class="collapsed" href="#collapse8" data-toggle="collapse">No Plano FAM, como faço pra incluir dependentes?</a></h6>
						</div>
						<div class="collapse" id="collapse8" data-parent="#accordion" role="tabpanel">
							<div class="card-body">Basta preencher os dados na área de cadastro.</div>
						</div>
					</div>
					<div class="card">
						<div class="card-header" role="tab">
							<h6><a class="collapsed" href="#collapse9" data-toggle="collapse">É obrigatório apresentar documento de identidade na hora do atendimento para obter o desconto?</a></h6>
						</div>
						<div class="collapse" id="collapse9" data-parent="#accordion" role="tabpanel">
							<div class="card-body">Sim, para segurança do parceiro, da plataforma e do assinante.</div>
						</div>
					</div>
					<div class="card">
						<div class="card-header" role="tab">
							<h6><a class="collapsed" href="#collapse10" data-toggle="collapse">Como utilizo os descontos nos parceiros?</a></h6>
						</div>
						<div class="collapse" id="collapse10" data-parent="#accordion" role="tabpanel">
							<div class="card-body">Basta informar seu código ID e apresentar seu documento de identidade no início do atendimento. O parceiro checará se esse cadastro está ativo e você pagará o serviço com o desconto pré-estabelecido pelo parceiro na plataforma.</div>
						</div>
					</div>
					<div class="card">
						<div class="card-header" role="tab">
							<h6><a class="collapsed" href="#collapse11" data-toggle="collapse">Onde busco informaçõe dos serviços prestados pelos parceiros</a></h6>
						</div>
						<div class="collapse" id="collapse11" data-parent="#accordion" role="tabpanel">
							<div class="card-body">Diretamente com o prestador de serviço.</div>
						</div>
					</div>
					<div class="card">
						<div class="card-header" role="tab">
							<h6><a class="collapsed" href="#collapse12" data-toggle="collapse">Existe um limite de utilização dos serviços?</a></h6>
						</div>
						<div class="collapse" id="collapse12" data-parent="#accordion" role="tabpanel">
							<div class="card-body">Não. Basta estar ATIVO e você pode usar os serviços em todos os parceiros cadastrados de forma ilimitada com o benefício de descontos exclusivos.</div>
						</div>
					</div>
					<div class="card">
						<div class="card-header" role="tab">
							<h6><a class="collapsed" href="#collapse13" data-toggle="collapse">É preciso agendar para ser atendido em um parceiro?</a></h6>
						</div>
						<div class="collapse" id="collapse13" data-parent="#accordion" role="tabpanel">
							<div class="card-body">Cada parceiro tem seu critério próprio. Consulte informações na área restrita desse prestador.</div>
						</div>
					</div>
					<div class="card">
						<div class="card-header" role="tab">
							<h6><a class="collapsed" href="#collapse14" data-toggle="collapse">Posso utilizar os benefícios em outros estados?</a></h6>
						</div>
						<div class="collapse" id="collapse14" data-parent="#accordion" role="tabpanel">
							<div class="card-body">Sim, pode utilizar os benefícios em toda a rede credenciada.</div>
						</div>
					</div>
					<div class="card">
						<div class="card-header" role="tab">
							<h6><a class="collapsed" href="#collapse15" data-toggle="collapse">Como faço para indicar um amigo?</a></h6>
						</div>
						<div class="collapse" id="collapse15" data-parent="#accordion" role="tabpanel">
							<div class="card-body">Clicar no botão “compartilhar” e preencher o whatsapp/e-mail da pessoa e informar na mensagem o seu código de usuário MULTBEN.</div>
						</div>
					</div>
					<div class="card">
						<div class="card-header" role="tab">
							<h6><a class="collapsed" href="#collapse16" data-toggle="collapse">O que é Multben?</a></h6>
						</div>
						<div class="collapse" id="collapse16" data-parent="#accordion" role="tabpanel">
							<div class="card-body">Quando você indica amigos para a MULTBEN e esses amigos se ativam, você ganha bônus para usar em qualquer serviço da rede credenciada.</div>
						</div>
					</div>
					<div class="card">
						<div class="card-header" role="tab">
							<h6><a class="collapsed" href="#collapse17" data-toggle="collapse">Por quanto tempo recebo bônus por indicação?</a></h6>
						</div>
						<div class="collapse" id="collapse17" data-parent="#accordion" role="tabpanel">
							<div class="card-body">O Multben é recorrente, todos os meses que seu indicado se ativar, você receberá bônus. Leia atentamente o <strong>“TERMOS E CONDIÇÕES DO ASSIANTE” – “INDIQUE E GANHE” E “RESGATE E UTILIZAÇÃO DE BÔNUS”</strong>.</div>
						</div>
					</div>
					<div class="card">
						<div class="card-header" role="tab">
							<h6><a class="collapsed" href="#collapse18" data-toggle="collapse">Como faço para utilizar meu MULTIBÔNUS?</a></h6>
						</div>
						<div class="collapse" id="collapse18" data-parent="#accordion" role="tabpanel">
							<div class="card-body">
								<p>1.	Na área de resgate de  bônus, informe á MULTBEN o valor que deseja utilizar e o parceiro para o qual quer transferir o valor com antecedência de 72h, neste prazo a MULTBEN fará a operação de repasse e a geração de um voucher eletrônico.</p>
								<p>2.	Para utilizar seu Multben junto ao parceiro, basta informar no atendimento que tem um voucher de bônus e apresentar documento de identificação pessoal com foto.</p>
							</div>
						</div>
					</div>
					<div class="card">
						<div class="card-header" role="tab">
							<h6><a class="collapsed" href="#collapse19" data-toggle="collapse">Posso cancelar o pedido de transferência de Multben?</a></h6>
						</div>
						<div class="collapse" id="collapse19" data-parent="#accordion" role="tabpanel">
							<div class="card-body">A responsabilidade dessa solicitação é do assinante, não havendo possibilidade de cancelamento deste pedido.</div>
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

