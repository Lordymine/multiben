@extends('layouts.main')

@section('title', '')

@section('css')
    @parent
@stop

@section('content')

<link rel="stylesheet" href="//netdna.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css">
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
    
    .table td 
    {
        text-align: center; 
        vertical-align: middle;
    }
    .table th 
    {
        text-align: center; 
        vertical-align: middle;
    }
       
    div.stars {
    	width: 270px;
    	display: inline-block;
    }
    
    input.star {
    	display: none;
    }
    
    label.star {
    	float: right;
    	padding: 10px;
    	font-size: 36px;
    	color: #444;
    	transition: all .2s;
    }
    
    input.star:checked ~ label.star:before {
    	content: '\f005';
    	color: #FD4;
    	transition: all .25s;
    }
    
    input.star-5:checked ~ label.star:before {
    	color: #FE7;
    	text-shadow: 0 0 20px #952;
    }
    
    input.star-1:checked ~ label.star:before {
    	color: #F62;
    }
    
    label.star:hover {
    	transform: rotate(-15deg) scale(1.3);
    }
    
    label.star:before {
    	content: '\f006';
    	font-family: FontAwesome;
    }
    
    .grid-item{
        border-bottom:1px solid #dee2e6
    }
    
    .rating-stars>i.half-star {
        color: #ffb74f;
        content: '\f089';
        width: 0.5em;
        overflow: hidden;
    }
</style>

<!-- Off-Canvas Wrapper-->
	<div class="offcanvas-wrapper">
		<!-- Page Title-->
		<div class="page-title">
			<div class="container">
				<div class="column">
					<h1>Perfil</h1>
				</div>
				<div class="column">
					<ul class="breadcrumbs">
						<li><a href="{{route('index')}}">Home</a></li>
						<li class="separator">&nbsp;</li>
						<li><a href="{{route('users_profile')}}">Conta</a></li>
						<li class="separator">&nbsp;</li>
						<li>Perfil</li>
					</ul>
				</div>
			</div>
		</div>
		<!-- Page Content-->
		<div class="container padding-bottom-3x mb-2">
			<div class="row">
				@include('layouts.users.side-menu')
				<div class="col-lg-8">
    				<h6 class="text-muted text-normal text-uppercase">Deixe uma avaliação</h6>
    				
    				<div class="grid-item">
                        <div class="card margin-bottom-1x" style="box-shadow: 0px 1px 4px rgba(0, 0, 0, 0.05);">
                            <div class="card-body" style="padding: 10px; height: auto; flex: 1 1 auto;">
                                <div class="row">
                                    <div class="col-5 my-auto">
                                        <img src="{{asset($empresa->capa())}}" alt="Empresa Logo" style="width:200px; height:100px;">
                                    </div>
                                    <div class="col-7 my-auto">
                                        <p class="card-text">
                                            <span class="card-text" id="delimiteCaractere">{{ $empresa->nome_fantasia }}</span><br>
                                            <span class="card-text" style="color:#606975;">Bairro: {{ $empresa->bairro }}</span><br>
                                            <span class="text-muted">Atualizada em {{ \Carbon\Carbon::parse($empresa->updated_at)->format('d  M')}} </span>
                                        </p>
                                        <div class="rating-stars">
                        					<i class="icon-star {{$stars[0]}} {{$halfStars[0]}}" > </i>
                        					<i class="icon-star {{$stars[1]}} {{$halfStars[1]}}"></i>
                        					<i class="icon-star {{$stars[2]}} {{$halfStars[2]}}"></i>
                        					<i class="icon-star {{$stars[3]}} {{$halfStars[3]}}"></i>
                        					<i class="icon-star {{$stars[4]}} {{$halfStars[4]}}"></i>
                        				</div>
                                        <span class="text-muted align-middle">&nbsp;&nbsp; {{$ratingScore}}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
            		<div class="card-body padding-top-2x text-center">
        				<h7 class="text-muted text-normal text-uppercase">Classificação geral</h7>
                		<form class="form-horizontal" role="form" method="POST" enctype="multipart/form-data" action="{{ route('rating_confirmation') }}" >
                			@csrf
                			<div class="stars">
                					<input class="star star-5" id="star-5" type="radio" name="star" />
                					<label class="star star-5" for="star-5"></label> 
                					<input class="star star-4" id="star-4" type="radio" name="star" /> 
                					<label class="star star-4" for="star-4"></label> 
                					<input class="star star-3" id="star-3" type="radio" name="star" /> 
                					<label class="star star-3" for="star-3"></label> 
                					<input class="star star-2 teste" id="star-2" type="radio" name="star" /> 
                					<label class="star star-2 teste" for="star-2"></label> 
                					<input class="star star-1" id="star-1" type="radio" name="star" /> 
                					<label class="star star-1" for="star-1"></label>
									<input name="ratings" id="ratings" value="{{$ratings}}" hidden>
                					<input id="empresa" name="empresa" value="{{$empresa->id}}" hidden>
                			</div>
                    		<div class="modal-footer">
                    			<a class="btn btn-outline-secondary" href="{{route('user_bonus')}}"><i class="icon-arrow-left"></i><span class="hidden-xs-down">&nbsp;Voltar</span></a>
                    		
                    			<button class="btn btn-primary" type="submit" id="confirmarCredito">Confirmar Avaliação</button>
                    		</div>
                		</form>
            		</div>
        		</div>
    		</div>
		</div>
	</div>
@stop

@section('js')
@parent
<script type="text/javascript">

  var rating = document.getElementById('ratings').value;
  if(rating == "1"){
  	document.getElementById('star-1').click();
  }
  if(rating == "2"){
  	document.getElementById('star-2').click();
  }
  if(rating == "3"){
  	document.getElementById('star-3').click();
  }
  if(rating == "4"){
  	document.getElementById('star-4').click();
  }
  if(rating == "5"){
  	document.getElementById('star-5').click();
  }
  
  
  function pushRatingValue(valor){
  	document.getElementById('ratings').value = valor;
  }
  
  $("#star-1").click(function() {
  	 pushRatingValue(1);
  });
  
  $("#star-2").click(function() {
  	pushRatingValue(2);
  });
  
  $("#star-3").click(function() {
  	pushRatingValue(3);
  });
  
  $("#star-4").click(function() {
  	pushRatingValue(4);
  });
  
  $("#star-5").click(function() {
  	pushRatingValue(5);
  });

</script>

@stop