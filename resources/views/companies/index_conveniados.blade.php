@extends('layouts.main')

@section('title', '')

@section('css')
@parent

@stop

@section('content')

<style>
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
    
   .gallery-item{
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
</style>

<!-- Off-Canvas Wrapper-->
<div class="offcanvas-wrapper">
    <!-- Page Title-->
    <div class="page-title">
      <div class="container">
        <div class="column">
          <h1>Estabelecimentos Conveniados</h1>
        </div>
        <div class="column">
          <ul class="breadcrumbs">
            <li><a href="{{route('index')}}">Home</a>
            </li>
            <li class="separator">&nbsp;</li>
            <li>Estabelecimentos</li>
          </ul>
        </div>
      </div>
    </div>
<!-- Page Content-->
<section class="container padding-top-1x "><!--padding-bottom-3x-->
			
			<div class="row">
				<div class="col"><!--col-lg-9 col-md-8 order-md-2-->
					<!--<hr class="margin-bottom-1x">-->
					<div class=""><!--gallery-wrapper-->
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
															<img src="{{asset($empresa->capa)}}" alt="Product" style="width:200px; height:100px;">
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
                                        					<i class="icon-star {{$empresa->stars[0]}} {{$empresa->halfStars[0]}}" > </i>
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
						<center>{{ $empresas->links()}}</center>
							Total de Registros: {{ $empresas != null ? $empresas->total() : 0}}
    							
					</div>
				</div>
			</div>
		</section>


@stop

@section('js')
@parent

<script>
    $(document).ready(function () {

        $("#deduction").click(function () {
            $.ajax({
                method:"POST",
                data:{
                    id: {{ Request::route('id') }},
                    deduction_min: $("#deduction_min").val(),
                    deduction_max: $("#deduction_max").val(),
                    "_token": "{{ csrf_token() }}"
                },
                url:"/companies/por-desconto",
                dataType:"html",
                beforeSend:function(){
                    $("#empresas").html('<div class="row"><div class="col-sm-12 text-center"><div class="iziToast">\n' +
                        '                  <div class="iziToast-body"><strong>CARREGANDO...</strong>\n' +
                        '                    <p>Aguarde enquanto estamos fazendo a busca pelos descontos</p>\n' +
                        '                  </div>\n' +
                        '                  <button class="iziToast-close"></button>\n' +
                        '                </div></div></div>');
                },
                success:function(o){
                    $("#empresas").html(o);
                }
            });
        });

        $('.filtro_cidade').click(function () {
            var city = [];
            $('input[name^="cidades_filter"]').each(function() {
                if($(this).is(':checked')){
                    city.push($(this).val());
                }
            });

            $.ajax({
                method:"POST",
                data:{
                    id: {{ Request::route('id') }},
                    cidades: city,
                    "_token": "{{ csrf_token() }}"
                },
                url:"/companies/por-cidade",
                dataType:"html",
                beforeSend:function(){
                    $("#empresas").html('<div class="row"><div class="col-sm-12 text-center"><div class="iziToast">\n' +
                        '                  <div class="iziToast-body"><strong>CARREGANDO...</strong>\n' +
                        '                    <p>Aguarde enquanto estamos fazendo a busca pelas cidades</p>\n' +
                        '                  </div>\n' +
                        '                  <button class="iziToast-close"></button>\n' +
                        '                </div></div></div>');
                },
                success:function(o){
                    $("#empresas").html(o);
                }
            });
        });
    });
</script>

@stop
