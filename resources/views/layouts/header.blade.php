<!-- Navbar-->
    <!-- Remove "navbar-sticky" class to make navigation bar scrollable with the page.-->
    <header class="navbar navbar-sticky">
        <!-- Search-->

        <form class="site-search" method="get">
            <div class="row" id="result-search"></div>
          <input type="text" id="site_search" name="site_search" placeholder="PESQUISAR">
          <div class="search-tools"><span class="clear-search">SAIR</span><span class="close-search"><i class="icon-cross"></i></span></div>
        </form>
        <div class="site-branding">
          <div class="inner">
            <!-- Off-Canvas Toggle (#shop-categories)--><a class="offcanvas-toggle cats-toggle" href="#shop-categories" data-toggle="offcanvas"></a>
            <!-- Off-Canvas Toggle (#mobile-menu)--><a class="offcanvas-toggle menu-toggle" href="#mobile-menu" data-toggle="offcanvas"></a>
            <!-- Site Logo--><a class="site-logo" href="{{route('index')}}"><img src="{{asset('img/logo/logo-multben2.png')}}" alt="Multben"></a>
          </div>
        </div>
        <!-- Main Navigation-->
        <nav class="site-menu">
          <ul>
            <li><a href="{{route('index')}}"><span>HOME</span></a></li>
            <li><a href="{{route('about_us')}}"><span>QUEM SOMOS</span></a></li>
            <li><a href="{{route('how_works')}}"><span>COMO FUNCIONA</span></a></li>
            <li><a href="{{route('users_profile')}}"><span>SEJA ASSINANTE</span></a></li>
            <li><a href="{{route('users_profile_partner')}}"><span>SEJA PARCEIRO</span></a></li>
            <li><a href="{{route('subscriber_become')}}"><span>PLANOS</span></a></li>
            {{-- <li><a href="{{route('users_profile')}}"><span>Minha Conta</span></a></li> --}}
          </ul>
        </nav>

        <!-- Toolbar-->
        <div class="toolbar">
          <div class="inner">
            <div class="tools">
                <div class="account"><a href="{{route('login')}}"></a><i class="icon-head"></i>
                @guest
                    <ul class="toolbar-dropdown">
                        <li><a href="{{route('login')}}"> <i class="icon-unlock"></i>Login/Cadastre-se</a></li>
                    </ul>
                @else
                    <ul class="toolbar-dropdown">
                        <li class="sub-menu-user">
                            <div class="user-ava"><img src="{{ (auth()->user()->avatar) ? url('storage/avatars/'.auth()->user()->avatar) : asset('img/account/user-ava.png')}}" alt="{{Auth::user()->name}}">
                            </div>
                            <div class="user-info">
                            <h6 class="user-name">{{Auth::user()->name}}</h6><span class="text-xs text-muted">R$ {{ App\UserBonus::where('user_id',Auth::user()->id)->first() ? number_format(App\UserBonus::where('user_id',Auth::user()->id)->first()->valor,2) : '0,00'}}</span>
                            </div>
                        </li>
                        <li><a href="{{route('users_profile')}}">Perfil</a></li>
<!--                         <li><a href="{{route('user_create_companies')}}">Minhas Empresas</a></li> -->
						<li><a href="{{route('user_bonus')}}">Solicitações de Bônus</a></li>
                        <li><a href="{{route('user_referrals')}}">Indicações</a></li>
                      	@if(Auth::user()->cnpj == null)
                        <li><a href="{{route('user_payments')}}">Pagamentos</a></li>
                        <li><a href="{{route('users_plan')}}">Assinatura</a></li>
<!--                         <li><a href="{{route('user_business_partner')}}">Sócios</a></li> -->
                        @endif
                        <li class="sub-menu-separator"></li>
                        <li><a href="{{ route('logout') }}" onclick="event.preventDefault();
                                          document.getElementById('logout-form').submit();"> <i class="icon-unlock"></i>Logout</a></li>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </ul>
                @endguest
              </div>
              <div class="search"><i class="icon-search"></i></div>
              {{--
              <div class="cart"><a href="cart.html"></a><i class="icon-bag"></i><span class="count">3</span><span class="subtotal">$289.68</span>
                <div class="toolbar-dropdown">
                  <div class="dropdown-product-item"><span class="dropdown-product-remove"><i class="icon-cross"></i></span><a class="dropdown-product-thumb" href="shop-single.html"><img src="{{asset('unishop/img/cart-dropdown/01.jpg')}}" alt="Product"></a>
                    <div class="dropdown-product-info"><a class="dropdown-product-title" href="shop-single.html">Unionbay Park</a><span class="dropdown-product-details">1 x $43.90</span></div>
                  </div>
                  <div class="dropdown-product-item"><span class="dropdown-product-remove"><i class="icon-cross"></i></span><a class="dropdown-product-thumb" href="shop-single.html"><img src="{{asset('unishop/img/cart-dropdown/02.jpg')}}" alt="Product"></a>
                    <div class="dropdown-product-info"><a class="dropdown-product-title" href="shop-single.html">Daily Fabric Cap</a><span class="dropdown-product-details">2 x $24.89</span></div>
                  </div>
                  <div class="dropdown-product-item"><span class="dropdown-product-remove"><i class="icon-cross"></i></span><a class="dropdown-product-thumb" href="shop-single.html"><img src="{{asset('unishop/img/cart-dropdown/03.jpg')}}" alt="Product"></a>
                    <div class="dropdown-product-info"><a class="dropdown-product-title" href="shop-single.html">Haan Crossbody</a><span class="dropdown-product-details">1 x $200.00</span></div>
                  </div>
                  <div class="toolbar-dropdown-group">
                    <div class="column"><span class="text-lg">Total:</span></div>
                    <div class="column text-right"><span class="text-lg text-medium">$289.68&nbsp;</span></div>
                  </div>
                  <div class="toolbar-dropdown-group">
                    <div class="column"><a class="btn btn-sm btn-block btn-secondary" href="cart.html">View Cart</a></div>
                    <div class="column"><a class="btn btn-sm btn-block btn-success" href="checkout-address.html">Checkout</a></div>
                  </div>
                </div>
              </div>
              --}}
            </div>
          </div>
        </div>

      </header>
