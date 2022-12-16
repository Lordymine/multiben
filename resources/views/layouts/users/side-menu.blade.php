	<div class="col-lg-4">
		<aside class="user-info-wrapper">
			<div class="user-cover" style="background-image: url(img/account/user-cover-img.jpg);">
				<div class="info-label" data-toggle="tooltip" title="Valor em bônus para gastar">R$ {{App\UserBonus::where('user_id',Auth::user()->id)->first() ? number_format(App\UserBonus::where('user_id',Auth::user()->id)->first()->valor,2) : '0,00'}}</div>
			</div>
			<div class="user-info">
				<div class="user-avatar">
					@if(Request::route()->getName()=='users_profile')
					<a data-toggle="modal" data-target="#modalCentered" id="edit-avatar" class="edit-avatar" href="#"></a>
					@endif
					<img src="{{ (auth()->user()->avatar) ? url('storage/avatars/'.auth()->user()->avatar) : asset('img/account/user-ava.png')}}" alt="User">
				</div>
				<div class="user-data">
					<h4>{{ Auth::user()->name }} {{ Auth::user()->sobrenome }}</h4><span>{{auth()->user()->matricula}}</span>
				</div>
			</div>
		</aside>
		<nav class="list-group">
			<a class="list-group-item @if(Route::currentRouteName() == 'users_profile') active @endif" href="{{route('users_profile')}}">
				<i class="icon-head"></i>Perfil
			</a>
<!-- 			<a class="list-group-item @if(Route::currentRouteName() == 'user_create_company' or Route::currentRouteName() == 'user_create_companies') active @endif" href="{{route('user_create_companies')}}"> -->
<!-- 				<i class="icon-briefcase"></i>Empresas -->
<!-- 			</a> -->
			<a class="list-group-item @if(Route::currentRouteName() == 'user_bonus' or Route::currentRouteName() == 'filter_location') active @endif" href="{{route('user_bonus')}}">
				<i class="icon-archive"></i>Solicitações de Bônus
			</a>
			<a class="list-group-item @if(Route::currentRouteName() == 'user_referrals') active @endif" href="{{route('user_referrals')}}">
				<i class="icon-tag"></i>Indicações
			</a>
			<a class="list-group-item @if(Route::currentRouteName() == 'user_payments') active @endif" href="{{route('user_payments')}}">
				<i class="icon-bag"></i>Pagamentos
			</a>
			<a class="list-group-item @if(Route::currentRouteName() == 'users_truckplan') active @endif" href="{{route('users_truckplan')}}">
				<i class="icon-head"></i>Assinatura
			</a>
<!-- 			<a class="list-group-item @if(Route::currentRouteName() == 'user_business_partner') active @endif" href="{{route('user_business_partner')}}"> -->
<!-- 				<i class="icon-heart"></i>Sócios -->
<!-- 			</a> -->
        </nav>
	</div>
	<!--
	<div class="modal fade" id="modalCentered" tabindex="-1" role="dialog">
		<div class="modal-dialog modal-dialog-centered" role="document">
			<div class="modal-content">
				<form method="post" enctype="multipart/form-data"action="{{ route('alter_avatar') }}">
					@csrf
					<div class="modal-header">
						<h4 class="modal-title">Alterar imagem de perfil</h4>
						<button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					</div>
					<div class="modal-body">
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label for="account-ln">NOVA IMAGEM DE PERFIL</label>
									<div class="custom-file">
										<input class="custom-file-input" type="file" name="avatar" id="avatar">
										<label class="custom-file-label" for="logo">Ecolha uma logo...</label>
										<p class="text-muted">Imagens nos formatos: jpg, png, jpeg e gif</p>
									</div>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<div class="user-avatar">
										<div class="user-avatar"><img style="display: none" id="img-logo" alt="User"></div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="modal-footer">
						<button class="btn btn-outline-secondary btn-sm" type="button" data-dismiss="modal">Fechar</button>
						<button class="btn btn-primary btn-sm" type="submit">Salvar</button>
					</div>
				</form>
			</div>
		</div>
	</div>-->