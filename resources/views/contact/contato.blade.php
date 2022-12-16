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
				<h1>Contato</h1>
			</div>
			<div class="column">
				<ul class="breadcrumbs">
					<li><a href="{{route('index')}}">Home</a></li>
					<li class="separator">&nbsp;</li>
					<li>Contato</li>
				</ul>
			</div>
		</div>
    </div>
    <!-- Page Content-->
    <div class="container padding-bottom-3x mb-2">
		<div class="row justify-content-center">
			@include('alerts.messages')
			<!-- Content-->
			<div class="col-lg-9 col-md-8">
				<h3 class="padding-top-2x">Dúvidas? Entre em contato conosco!</h3>
				<p class="text-muted mb-30">Você pode usar o seguinte formulário para nos contactar. Responderemos o quanto antes.</p>
				<form class="row" action="{{route('contact.send')}}" method="post">
					{{ csrf_field() }} <!-- token do formulario -->
					<div class="col-sm-6">
						<div class="form-group">
							<label for="contact_name">Nome</label>
							<input class="form-control form-control-rounded" id="contact_name" type="text" name="name" required>
						</div>
					</div>
					<div class="col-sm-6">
						<div class="form-group">
							<label for="contact_email">E-mail</label>
							<input class="form-control form-control-rounded" id="contact_email" type="email" name="email" required>
						</div>
					</div>
					<div class="col-sm-12">
						<div class="form-group">
							<label for="contact_subject">Assunto</label>
							<input class="form-control form-control-rounded" id="contact_subject" type="text" name="subject" placeholder="" required>
						</div>
					</div>
					<div class="col-12">
						<div class="form-group">
							<label for="contact_question">Mensagem </label>
							<textarea class="form-control form-control-rounded" rows="8" id="contact_question" placeholder="Escreva sua mensagem aqui..." name="question" required></textarea>
						</div>
					</div>
					<div class="col-12">
						<div class="g-recaptcha" data-sitekey="6LfuZucUAAAAAJ7IqDWCJcYOpNzJKoaVPTFGT8ls">
						</div>
					</div>
					<div class="col-12 text-left">
						<button class="btn btn-primary btn-rounded" type="submit">Enviar mensagem</button>
					</div>
				</form>
			</div>
        </div>
    </div>
</div>

@stop

@section('js')
    @parent

@stop

