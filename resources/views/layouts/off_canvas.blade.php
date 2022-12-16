<!-- Off-Canvas Desktop Menu-->
	<div class="offcanvas-container" id="shop-categories">
		<a class="account-link" href="{{route('users_profile')}}">
			@guest
            <div class="user-ava"><img src="{{asset('img/account/user-ava.png')}}" alt="Visitante">
            </div>
            <div class="user-info">
                <h6 class="user-name">Visitante</h6>
            </div>
			@else
            <div class="user-ava"><img src="{{ (auth()->user()->avatar) ? url('storage/avatars/'.auth()->user()->avatar) : asset('img/account/user-ava.png')}}" alt="{{Auth::user()->name}}">
            </div>
            <div class="user-info">
                <h6 class="user-name">{{Auth::user()->name}}</h6><span class="text-sm text-white opacity-60">R$ {{App\UserBonus::where('user_id',Auth::user()->id)->first() ? number_format(App\UserBonus::where('user_id',Auth::user()->id)->first()->valor,2) : '0,00'}}</span>
            </div>
			@endguest
		</a>
		<nav class="offcanvas-menu">
			<ul class="menu">
				@guest
				<li><a href="{{route('login')}}"><span>LOGIN / CADASTRE-SE</span></a></li>
				@endguest
				<li class=""><span><a href="{{route('index')}}"><span>Home</span></a><span class="sub-menu-toggle"></span></span></li>
				<li><a href="{{route('about_us')}}"><span>QUEM SOMOS</span></a></li>
				<li><a href="{{route('how_works')}}"><span>COMO FUNCIONA</span></a></li>
				<li><a href="{{route('subscriber_become')}}"><span>SEJA ASSINANTE</span></a></li>
				<li><a href="{{route('users_profile_partner')}}"><span>SEJA PARCEIRO</span></a></li>
				<li><a href="{{route('subscriber_become')}}"><span>PLANOS</span></a></li>
				@auth
				<li><a href="{{route('user_bonus')}}">BÔNUS</a></li>
				<li class="has-children active"><span><a href="#">Minha Área</a><span class="sub-menu-toggle"></span></span>
				<ul class="offcanvas-submenu">
					<li><a href="{{route('users_profile')}}">Perfil</a></li>
<!-- 					<li><a href="{{route('user_create_companies')}}">Minhas Empresas</a></li> -->
					<li><a href="{{route('user_bonus')}}">Solicitações de Bônus</a></li>
					<li><a href="{{route('user_referrals')}}">Indicações</a></li>
					@if(Auth::user()->cnpj == null)
					<li><a href="{{route('user_payments')}}">Pagamentos</a></li>
					<li><a href="{{route('users_plan')}}">Assinatura</a></li>
<!-- 					<li><a href="{{route('user_business_partner')}}">Sócios</a></li> -->
					@endif
					<li class="sub-menu-separator"></li>
					<li><a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="icon-unlock"></i> Logout</a></li>
					<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
						@csrf
					</form>
				</ul>
			</li>
			@endauth
		</nav>
	</div>