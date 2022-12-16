@if(Session::has('success'))
	<div class="alert alert-success alert-dismissible fade show text-center margin-bottom-1x">
		<span class="alert-close" data-dismiss="alert"></span>
		<i class="icon-help"></i>&nbsp;&nbsp;<strong>Sucesso: </strong> 
		{{ Session::get('success') }}
	</div>
@endif
@if(count($errors) > 0)
	<div class="alert alert-danger alert-dismissible fade show text-center margin-bottom-1x">
		<span class="alert-close" data-dismiss="alert"></span>
		<i class="icon-ban"></i>&nbsp;&nbsp;<strong>Erro:</strong> 
		<ul>
			@foreach($errors->all() as $error)
				<li>{{ $error }}</li>
			@endforeach
		</ul>
	</div>
@endif