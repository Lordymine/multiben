<div class="col-lg-4">
    <aside class="user-info-wrapper">
      <div class="user-cover" style="background-image: url(img/account/user-cover-img.jpg);">
			<div class="info-label" data-toggle="tooltip" title="Valor em bônus para gastar">R$ {{App\UserBonus::where('user_id',Auth::user()->id)->first() ? number_format(App\UserBonus::where('user_id',Auth::user()->id)->first()->valor,2) : '0,00'}}</div>
      </div>
      <div class="user-info">
        <div class="user-avatar"><a class="edit-avatar" href="#"></a><img src="{{asset('img/account/user-ava.png')}}" alt="User"></div>
        <div class="user-data">
        <h4>{{$admin->name}} {{$admin->sobrenome}}</h4><span>{{$admin->matricula}}</span>
        </div>
      </div>
    </aside>
    <nav class="list-group">
		<a class="list-group-item @if(Route::currentRouteName() == 'admin') active @endif" href='{{route("admin")}}'>
            <i class="icon-head"></i>Usuários
        </a>
        <a class="list-group-item @if(Route::currentRouteName() == 'admin.companies.index') active @endif" href='{{route("admin.companies.index")}}'>
             <i class="icon-briefcase"></i>Empresas
        </a>
		<a class="list-group-item @if(Route::currentRouteName() == 'admin.payments.index') active @endif" href='{{route("admin.payments.index")}}'>
             <i class="icon-inbox"></i>Pagamentos Recebidos
        </a>
		<a class="list-group-item @if(Route::currentRouteName() == 'admin.bonus.index') active @endif" href='{{route("admin.bonus.index")}}'>
             <i class="icon-shuffle"></i>Solicitação de Bônus
    	</a>
		<a class="list-group-item @if(Route::currentRouteName() == 'admin.dashboard.index') active @endif" href='{{route("admin.dashboard.index")}}'>
             <i class="icon-bar-graph-2"></i>Dashboard
        </a>
        <a class="list-group-item @if(Route::currentRouteName() == 'admin.services.index') active @endif" href='{{route("admin.services.index")}}'>
            <i class="icon-stack"></i>Serviços
        </a>
<!-- 		<a class="list-group-item @if(Route::currentRouteName() == 'admin.partner.index') active @endif" href='{{route("admin.partner.index")}}'> -->
<!--             <i class="icon-heart"></i>Sócios -->
<!--         </a> -->
		<a class="list-group-item @if(Route::currentRouteName() == 'admin.financial.index') active @endif" href='{{route("admin.financial.index")}}'>
            <i class="icon-archive"></i>Financeiro
		</a>
        <a class="list-group-item @if(Route::currentRouteName() == 'admin.referrals.index') active @endif" href='{{route("admin.referrals.index")}}'>
            <i class="icon-tag"></i>Indicações
        </a>
        <a class="list-group-item @if(Route::currentRouteName() == 'admin.marketing.index') active @endif" href='{{route("admin.marketing.index")}}'>
            <i class="icon-tag"></i>Ações de Marketing
        </a>
        </nav>
  </div>
