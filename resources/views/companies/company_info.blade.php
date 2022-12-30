@extends('layouts.main')

@section('title', '')

@section('css')
@parent
<style>
        .custom-file-label::after{content:"Procurar"}
        
/*         .product-thumbnails button{ */
/*             float:left; */
/*             display:inline-block; */
/*             width: 12em; */
/*             height: 13em; */
/*         } */
        
        .product-thumbnails img{
            height: 10em;
            width: 10em;
        } 
        .owl-stage-outer img{
            max-height: 22em;
            max-width: 36em;
        }
        
        .sp-buttons .btn.btn-favorite {
            width: 36px;
            padding: 0;
            padding-left: 1px;
            border-radius: 50%;
        }
        
        .sp-buttons .btn.btn-favorite.active {
            color: #ff5252;
        }
        .rating-stars>i.half-star {
           color: #ffb74f;
           content: '\f089';
           width: 0.5em;
           overflow: hidden;
        }
        
</style>
@stop

@section('content')

<!-- Default Modal-->
<div class="modal" id="modalSuccess" tabindex="-1" role="dialog">
    <!-- Page Content-->
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
        <button type="button" class="close close-success" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        	<div class="modal-body">
				<h3 class="card-title">Solicitação Enviada com Sucesso!</h3>
				<p class="card-text">Seu pedido foi feito e será processado o mais rápido possível.</p>
				<!--  <p class="card-text">Anote o número do seu pedido, que é <span class="text-medium">34VB5540K83</span></p>-->
				<p class="card-text">Você receberá um e-mail em breve com a confirmação do seu resgate.</p>
			</div>
		</div>
		</div>
    </div>
</div>

<div class="modal fade" id="modalDefault" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Quanto de crédito você deseja utilizar?</h4>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        </div>
        <div class="modal-body">
            <form class="form-horizontal" role="form">
            	@if(App\User::possuiCreditoBonus() == 0)
            		<?php 
            		  $semSaldo = true;
            		  $mensagem = 'Saldo insuficiente para solicitação de bônus';
            		?>
            	@elseif(!Auth::user()->ativoEmAlgumPlano())
            		<?php 
            		  $semSaldo = true;
            		  $mensagem = 'É necessário estar ativo em algum de nossos planos para utilizar o bônus.';
            		?>
            	@else 
            		<?php 
            		  $semSaldo = false;
            		?>
            	@endif
            	
            	@if($semSaldo)
             		<div class="alert-danger fade show text-center margin-bottom-1x">
                		<span class="alert-close" data-dismiss="alert"></span>
                		{{ $mensagem }}
                	</div>
             	@endif
                 <p class="error text-center alert-danger hidden"></p>
                <div class="form-group row">
                    <label class="col-4 col-form-label" for="text-input">VALOR (R$):</label>
                    <div class="col-8">
                    @if($semSaldo)
                      <input class="form-control" type="text" id="credito" disabled>
                    @else
                      <input class="form-control" type="text" id="credito" name="credito">
                      <input id="empresa_cnpj" name="empresa_cnpj" hidden>
                    @endif
                    </div>
                 </div><span class="text-xs text-muted">
                <label class="col-form-label" for="text-input">Saldo de bônus:</label>
            	<span class="text-xs text-muted credit-value">R$ {{ App\UserBonus::where('user_id',Auth::user() ? Auth::user()->id : null)->first() ? number_format(App\UserBonus::where('user_id',Auth::user()->id)->first()->valor,2) : '0,00'}}</span>
        	</form>
        </div>
        <div class="modal-footer">
          <button class="btn btn-outline-secondary btn-sm" type="button" data-dismiss="modal">Fechar</button>
          @if($semSaldo)
          	<button class="btn btn-primary btn-sm" type="button" disabled>Confirmar utilização dos créditos</button>
      	  @else
          	<button class="btn btn-primary btn-sm" type="submit" id="confirmarCredito">Confirmar utilização dos créditos</button>
          @endif
        </div>
      </div>
    </div>
</div>

<!-- Off-Canvas Wrapper-->
<div class="offcanvas-wrapper">
    <!-- Page Title-->
    <div class="page-title">
      <div class="container">
        <div class="column">
          <h1>Empresas</h1>
        </div>
        <div class="column">
          <ul class="breadcrumbs">
            <li><a href="{{route('index')}}">Home</a>
            </li>
            <li class="separator">&nbsp;</li>
            <li>Empresas</li>
          </ul>
        </div>
      </div>
    </div>

    <!-- Page Content-->
    <div class="container padding-bottom-3x mb-1">
		<p class="success text-center alert-danger "></p>
        <div class="row">
          <!-- Poduct Gallery-->
          <div class="col-md-6">
            <div class="product-gallery"><span class="product-badge text-danger">{{ $empresa->desconto }}% de desconto</span>
              @if($videoEmbed)
              <div class="gallery-wrapper">
                <div class="gallery-item video-btn text-center"><a href="#" data-toggle="tooltip" data-type="video" data-video="&lt;div class=&quot;wrapper&quot;&gt;&lt;div class=&quot;video-wrapper&quot;&gt;&lt;iframe class=&quot;pswp__video&quot; width=&quot;960&quot; height=&quot;640&quot; src=&quot;//www.youtube.com/embed/{{$videoEmbed}}?rel=0&quot; frameborder=&quot;0&quot; allowfullscreen&gt;&lt;/iframe&gt;&lt;/div&gt;&lt;/div&gt;" title="Watch video"></a></div>
              </div>
              @endif
              <div class="product-carousel owl-carousel gallery-wrapper">
              	@foreach($uploads as $image) 
                <div class="gallery-item" data-hash="{{$image->id}}">
                <a href="{{asset('storage/images/'.$image->filename)}}" data-size="1000x667">
                <img src="{{asset('storage/images/'.$image->filename)}}" alt="Product"></a></div>
 				@endforeach
              </div>
              <ul class="product-thumbnails">
              	 @foreach($uploads as $image) 
                    <li class="{{ $image->main == true ? 'active' : ''}}">
                    	<a href="#{{$image->id}}"><img src="{{asset('storage/images/'.$image->filename)}}" alt="Product"></a>
                    </li>
                 @endforeach
              </ul>
            </div>
          </div>
          <div class="pswp" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="pswp__bg"></div>
            <div class="pswp__scroll-wrap">
                <div class="pswp__container">
                    <div class="pswp__item"></div>
                    <div class="pswp__item"></div>
                    <div class="pswp__item"></div>
                </div>
                <div class="pswp__ui pswp__ui--hidden">
                    <div class="pswp__top-bar">
                        <div class="pswp__counter"></div>
                        <button class="pswp__button pswp__button--close"></button>
                        <button class="pswp__button pswp__button--share"></button>
                        <button class="pswp__button pswp__button--fs"></button>
                        <button class="pswp__button pswp__button--zoom"></button>
                        <div class="pswp__preloader">
                            <div class="pswp__preloader__icn">
                                <div class="pswp__preloader__cut">
                                    <div class="pswp__preloader__donut"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="pswp__share-modal pswp__share-modal--hidden pswp__single-tap">
                        <div class="pswp__share-tooltip"></div>
                    </div>
                    <button class="pswp__button pswp__button--arrow--left"></button>
                    <button class="pswp__button pswp__button--arrow--right"></button>
                    <div class="pswp__caption">
                        <div class="pswp__caption__center"></div>
                    </div>
                </div>
            </div>
        </div>
          <!-- Product Info-->
          <div class="col-md-6">
  			@if (session('success'))
            	<div class="alert alert-success alert-dismissible fade show text-center margin-bottom-1x fade-out">
            	<span class="alert-close" data-dismiss="alert"></span>
            	<i class="icon-help"></i>&nbsp;&nbsp;<strong>Sucesso:</strong> {{session('success')}}</div>
            @elseif (session('warning'))
            	<div class="alert alert-warning alert-dismissible fade show text-center margin-bottom-1x fade-out">
            	<span class="alert-close" data-dismiss="alert"></span><i class="icon-help"></i>&nbsp;&nbsp;
            	<strong>Aviso:</strong> {{session('warning')}}</div>
            @endif
            <div class="padding-top-2x mt-2 hidden-md-up"></div>
				<div class="rating-stars">
					<i class="icon-star {{$stars[0]}} {{$halfStars[0]}}" > </i>
					<i class="icon-star {{$stars[1]}} {{$halfStars[1]}}"></i>
					<i class="icon-star {{$stars[2]}} {{$halfStars[2]}}"></i>
					<i class="icon-star {{$stars[3]}} {{$halfStars[3]}}"></i>
					<i class="icon-star {{$stars[4]}} {{$halfStars[4]}}"></i>
				</div>
				<span class="text-muted align-middle">&nbsp;&nbsp;{{$ratingScore}} | {{$ratingReviews}} reviews de clientes</span>
            <h2 class="padding-top-1x text-normal">{{ $empresa->razao_social }}</h2>
                {{-- <span class="h2 d-block">
                    <del class="text-muted text-normal">R$100,00</del>&nbsp; R$28,00
                </span> --}}

             <p>{{ $empresa->desconto == null ? "" : $empresa->desconto."% DE DESCONTO"}} <br>
             Aberto de {{ \Illuminate\Support\Str::limit($empresa->hora_abertura, 5, $end='') }} até {{ \Illuminate\Support\Str::limit($empresa->hora_fechamento, 5, $end='') }}<br>

              @php $dias = json_decode($empresa->dias_funcionamento); @endphp


                  @foreach($dias as $key => $value)
                      @if($value == 1)
                          {{$key}},
                      @endif
                  @endforeach
                 <br>
                 <span class="text-medium">Categoria:&nbsp;</span>

                 @foreach($categorias as $categoria)
                     <a class="navi-link" href="{{route("companies_index",$categoria->id)}}">{{ $categoria->nome }}</a>,
                 @endforeach
              </p>

              <p>
              Bairro: {{ $empresa->bairro }}<br>
              Endereço: {{ $empresa->endereco }}<br>
              Telefone: {{ $empresa->telefone }}
              </p>



            <hr class="mb-3">
            <div class="d-flex flex-wrap justify-content-between">
              <div class="entry-share mt-2 mb-2"><span class="text-muted">Compartilhe:</span>
                <div class="share-links">
                @if (!empty($empresa->facebook))
                <a class="social-button shape-circle sb-facebook" href="{{ $empresa->facebook }}" target="_blanck" data-toggle="tooltip" data-placement="top" title="Facebook">
                <i class="socicon-facebook"></i></a>
                @endif
                @if (!empty($empresa->instagram))
                <a class="social-button shape-circle sb-instagram" href="{{ $empresa->instagram }}" target="_blanck" data-toggle="tooltip" data-placement="top" title="instagram">
                <i class="socicon-instagram"></i></a>
                @endif
                @if (!empty($empresa->youtube))
                <a class="social-button shape-circle sb-youtube" href="{{ $empresa->youtube }}" target="_blanck" data-toggle="tooltip" data-placement="top" title="youtube">
                <i class="socicon-youtube"></i></a>
                @endif
                @if (!empty($empresa->tiktok))
                <a class="social-button shape-circle sb-tiktok" href="{{ $empresa->tiktok }}" target="_blanck" data-toggle="tooltip" data-placement="top" title="tiktok">
                <i class="socicon-triplej"></i></a>
                @endif

              </div>
              @if(auth()->user())
              <div class="sp-buttons mt-2 mb-2">
                @if($favorite)
                <a class="btn btn-outline-primary btn-sm btn-favorite active" href="{{route('user_favorite', ['empresa' => $empresa->id, 'create' => 0])}}" data-toggle="tooltip" title="Excluir dos Favoritos"><i class="icon-heart"></i></a>
                @else
                <a class="btn btn-outline-primary btn-sm btn-favorite" href="{{route('user_favorite', ['empresa' => $empresa->id, 'create' => 1])}}" data-toggle="tooltip" title="Favoritar"><i class="icon-heart"></i></a>
                @endif
                
                <button class="btn btn-primary create-modal" data-empresa_cnpj={{ $empresa->cnpj }} >
                    <i class="icon-bag"></i> Usar Créditos
                </button>
              </div>
              @endif
            </div>
          </div>
        </div>
        <!-- Product Tabs-->
<!--    <div class="row padding-top-3x mb-3">
          <div class="col-lg-10 offset-lg-1">
            <ul class="nav nav-tabs" role="tablist">
              <li class="nav-item"><a class="nav-link active" href="#description" data-toggle="tab" role="tab">Descrição</a></li>
              <li class="nav-item"><a class="nav-link" href="#reviews" data-toggle="tab" role="tab">Comentários (3)</a></li>
            </ul>
            <div class="tab-content">
              <div class="tab-pane fade show active" id="description" role="tabpanel">
                  <p>{{ $empresa->descricao_servico }}</p>
              </div>
              <div class="tab-pane fade" id="reviews" role="tabpanel">
                <!-- Review-->
<!--                 <div class="comment"> -->
<!--                   <div class="comment-author-ava"><img src="{{asset('unishop/img/reviews/01.jpg')}}" alt="Review author"></div> -->
<!--                   <div class="comment-body"> -->
<!--                     <div class="comment-header d-flex flex-wrap justify-content-between"> -->
<!--                       <h4 class="comment-title">Average quality for the price</h4> -->
<!--                       <div class="mb-2"> -->
<!--                           <div class="rating-stars"><i class="icon-star filled"></i><i class="icon-star filled"></i><i class="icon-star filled"></i><i class="icon-star"></i><i class="icon-star"></i> -->
<!--                           </div> -->
<!--                       </div> -->
<!--                     </div> -->
<!--                     <p class="comment-text">At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga.</p> -->
<!--                     <div class="comment-footer"><span class="comment-meta">Francis Burton</span></div> -->
<!--                   </div> -->
<!--                 </div> -->
                <!-- Review-->
<!--                 <div class="comment"> -->
<!--                   <div class="comment-author-ava"><img src="{{asset('unishop/img/reviews/02.jpg')}}" alt="Review author"></div> -->
<!--                   <div class="comment-body"> -->
<!--                     <div class="comment-header d-flex flex-wrap justify-content-between"> -->
<!--                       <h4 class="comment-title">My husband love his new...</h4> -->
<!--                       <div class="mb-2"> -->
<!--                           <div class="rating-stars"><i class="icon-star filled"></i><i class="icon-star filled"></i><i class="icon-star filled"></i><i class="icon-star filled"></i><i class="icon-star filled"></i> -->
<!--                           </div> -->
<!--                       </div> -->
<!--                     </div> -->
<!--                     <p class="comment-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p> -->
<!--                     <div class="comment-footer"><span class="comment-meta">Maggie Scott</span></div> -->
<!--                   </div> -->
<!--                 </div> -->
                <!-- Review-->
<!--                 <div class="comment"> -->
<!--                   <div class="comment-author-ava"><img src="{{asset('unishop/img/reviews/03.jpg')}}" alt="Review author"></div> -->
<!--                   <div class="comment-body"> -->
<!--                     <div class="comment-header d-flex flex-wrap justify-content-between"> -->
<!--                       <h4 class="comment-title">Soft, comfortable, quite durable...</h4> -->
<!--                       <div class="mb-2"> -->
<!--                           <div class="rating-stars"><i class="icon-star filled"></i><i class="icon-star filled"></i><i class="icon-star filled"></i><i class="icon-star filled"></i><i class="icon-star"></i> -->
<!--                           </div> -->
<!--                       </div> -->
<!--                     </div> -->
<!--                     <p class="comment-text">Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt.</p> -->
<!--                     <div class="comment-footer"><span class="comment-meta">Jacob Hammond</span></div> -->
<!--                   </div> -->
<!--                 </div> -->
                <!-- Review Form-->
<!--                 <h5 class="mb-30 padding-top-1x">Deixar um Comentário</h5> -->
<!--                 <form class="row" method="post"> -->
                  <!--<div class="col-sm-6">
                    <div class="form-group">
                      <label for="review_name">Seu Nome</label>
                      <input class="form-control form-control-rounded" type="text" id="review_name" required>
                    </div>
                  </div>
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label for="review_email">Seu Email</label>
                      <input class="form-control form-control-rounded" type="email" id="review_email" required>
                    </div>
                  </div>
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label for="review_subject">Assunto</label>
                      <input class="form-control form-control-rounded" type="text" id="review_subject" required>
                    </div>
                  </div>-->
<!--                   <div class="col-12"> -->
<!--                     <div class="form-group"> -->
<!--                       <label for="review_rating">Classificação</label> -->
<!--                       <select class="form-control form-control-rounded" id="review_rating"> -->
<!--                         <option>5 Estrelas</option> -->
<!--                         <option>4 Estrelas</option> -->
<!--                         <option>3 Estrelas</option> -->
<!--                         <option>2 Estrelas</option> -->
<!--                         <option>1 Estrela</option> -->
<!--                       </select> -->
<!--                     </div> -->
<!--                   </div> -->
<!--                   <div class="col-12"> -->
<!--                     <div class="form-group"> -->
<!--                       <label for="review_text">Comentário </label> -->
<!--                       <textarea class="form-control form-control-rounded" id="review_text" rows="8" required></textarea> -->
<!--                     </div> -->
<!--                   </div> -->
<!--                   <div class="col-12 text-right"> -->
<!--                     <button class="btn btn-outline-primary" type="submit">Enviar Comentário</button> -->
<!--                   </div> -->
<!--                 </form> -->
<!--               </div> -->
<!--             </div> -->
<!--           </div> -->
<!--         </div> -->
      </div>


@stop

@section('js')
@parent
<script src="https://igorescobar.github.io/jQuery-Mask-Plugin/js/jquery.mask.min.js"></script>
<script type="text/javascript">

  //before Modal actions
  $(document).on('click','.close-success', function() {
  	setTimeout(function() 
          {
             location.reload();
          }, 0001);  
  });
  
  //before Modal actions
  $(document).on('click','.create-modal', function() {
  	$('#empresa_cnpj').val($(this).data('empresa_cnpj'));
    $('#modalDefault').modal('show');
  });
  
  //Modal actions
  $("#confirmarCredito").click(function() {
    $.ajax({
      type: 'POST',
      url: '/users/bonus-solicitation-company',
      data: {
        '_token': $('input[name=_token]').val(),
        'valor': $('input[name=credito]').val(),
        'empresa_cnpj': $('input[name=empresa_cnpj]').val()
      },
      error: function (data) {
       $.each(data.responseJSON.errors, function(key,value) {
         $('.error').text(value);
       }); 
      },
      success: function(data){
          $('.error').remove();
          $('#modalDefault').each(function(){$(this).modal('hide');});
          $('#modalSuccess').modal('show');
      },
    });
    
    $('#credito').val('');
  });
  
   $(document).ready(function () {
        $('#credito').mask('#.##0,00', {reverse: true});
   });
</script>

@stop
