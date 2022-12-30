@extends('layouts.main') @section('title', '') @section('css') @parent

@stop @section('content')
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
					<li>Convite</li>
				</ul>
			</div>
		</div>
	</div>
	<div
		class="alert alert-danger alert-dismissible fade show text-center margin-bottom-1x">
		<span class="alert-close" data-dismiss="alert"></span> <i
			class="icon-ban"></i>&nbsp;&nbsp;<strong>Erro:</strong>
			{{$message}}
	</div>
</div>

@stop

@section('js')
    @parent

@stop

	