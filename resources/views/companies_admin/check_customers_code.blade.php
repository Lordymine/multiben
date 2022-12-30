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
					<h1>Minha empresa</h1>
				</div>
				<div class="column">
					<ul class="breadcrumbs">
						<li><a href="{{route('index')}}">Home</a></li>
						<li class="separator">&nbsp;</li>
						<li>Minha empresa</li>
					</ul>
				</div>
			</div>
		</div>
		<!-- Page Content-->
		<div class="container padding-bottom-3x mb-2">
			<div class="row">
				@include('layouts.companies_admin.side-menu')
				<div class="col-lg-8">
					@if(session('success'))
						<div class="alert alert-success alert-dismissible fade show text-center margin-bottom-1x"><span class="alert-close" data-dismiss="alert"></span><i class="icon-help"></i>&nbsp;&nbsp;<strong>Successo:</strong> {{session('success')}}</div>
					@endif
					@if(session('error'))
						<div class="alert alert-danger alert-dismissible fade show text-center margin-bottom-1x"><span class="alert-close" data-dismiss="alert"></span><i class="icon-help"></i>&nbsp;&nbsp;<strong>Erro:</strong> {{session('error')}}</div>
					@endif
					<div class="padding-top-2x mt-2 hidden-lg-up"></div>
					<h6 class="text-muted text-normal text-uppercase">Área administrativa das empresas</h6>
					<hr class="margin-bottom-1x">
					<div class="row align-items-center">
						<div class="col-md-6">
							<div class="form-group">
								<label for="account-fn">CÓDIGO DO CLIENTE</label>
								<input class="form-control" type="text" id="mb_code" name="customer_code" placeholder="Digite aqui o código do cliente" required>
							</div>
						</div>
						<div class="col-md-6" id='customer_status'></div>
							<div class="col-12">
								<hr class="mt-2 mb-3">
								<div class="d-flex flex-wrap justify-content-between align-items-center">
								<button class="btn btn-primary margin-right-none" id='btn-query' type="button">Consultar</button>
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
        $(document).ready(function () {
            $('#btn-query').click(function () {

                $.ajax({
                    method:"POST",
                    data:{
                        codigo: $("#mb_code").val(),
                        "_token": "{{ csrf_token() }}"
                    },
                    url:"/empresas_admin/pesquisar-codigo",
                    dataType:"html",
                    beforeSend:function(){
                        $("#customer_status").html('<div class="row"><div class="col-sm-12 text-center"><div class="iziToast">\n' +
                            '                  <div class="iziToast-body"><strong>CARREGANDO...</strong>\n' +
                            '                    <p>Aguarde enquanto pesquisamos pelo código: '+$("#customer_code").val()+'</p>\n' +
                            '                  </div>\n' +
                            '                  <button class="iziToast-close"></button>\n' +
                            '                </div></div></div>');
                    },
                    success:function(o){
                        $("#customer_status").html(o);
                    }
                });
            });
        });
    </script>

@stop
