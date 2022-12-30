<div class="col-lg-4">
    <aside class="user-info-wrapper">
      <div class="user-cover" style="background-image: url(img/account/user-cover-img.jpg);">
        <div class="info-label" data-toggle="tooltip" title="Você tem R$ 300,00 em bônus para gastar">R$ 0,00</div>
      </div>
        <div class="user-info">
            <div class="user-avatar">
                @if(Request::route()->getName()=='users_profile')
                    <a data-toggle="modal" data-target="#modalCentered" id="edit-avatar" class="edit-avatar" href="#"></a>
                @endif
                <img src="{{ (auth()->user()->avatar) ? url('storage/public/avatars/'.auth()->user()->avatar) : asset('img/account/user-ava.png')}}" alt="User"></div>
            <div class="user-data">
                <h4>{{ Auth::user()->name }} {{ Auth::user()->sobrenome }}</h4><span>{{auth()->user()->matricula}}</span>
            </div>
        </div>
    </aside>
    <nav class="list-group">
        <a class="list-group-item @if(Route::currentRouteName() == 'companies_admin_index') active @endif" href="{{route('companies_admin_index')}}">
            <i class="icon-bag"></i>Bem-vindo
        </a>
        <a class="list-group-item @if(Route::currentRouteName() == 'companies_admin_check_customers_code') active @endif" href="{{route('companies_admin_check_customers_code')}}">
            <i class="icon-bag"></i>Checar código
        </a>
        <a class="list-group-item @if(Route::currentRouteName() == 'companies_admin_customers_list') active @endif" href="{{route('companies_admin_customers_list')}}">
            <i class="icon-bag"></i>Lista de clientes autorizados
        </a>
        <a class="list-group-item @if(Route::currentRouteName() == 'companies_admin_multben_used_payments') active @endif" href="{{route('companies_admin_multben_used_payments')}}">
            <i class="icon-bag"></i>Lista de pagamentos utilizados
        </a>
        </nav>
  </div>
