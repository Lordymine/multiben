<footer class="site-footer">
    <div class="container">
        <div class="row">
        </div>
        <div class="row">
            <div class="col-lg-3 col-md-6">
                <a class="site-logo" href="{{route('index')}}"><img src="{{asset('img/logo/logo-multben2.png')}}"
                        alt="Unishop" style="margin: -30px 0px 20px -10px;"></a>
            </div>
            <div class="col-lg-3 col-md-6">
                <section class="widget widget-links widget-light-skin">
                    <h3 class="widget-title">Quero saber mais</h3>
                    <ul>
                        <li><a href="{{route('how_works')}}">Como funciona</a></li>
                        <!-- 							<li><a href="#">Serviços</a></li> -->
                        <!-- 							<li><a href="#">Rede Credenciada</a></li> -->
                        <li><a href="{{route('faq')}}">Dúvidas Frequentes</a></li>
                    </ul><br>
                    <a class="social-button shape-circle sb-facebook sb-light-skin"
                        href="https://www.facebook.com/mult.ben" target="_blank"><i class="socicon-facebook"></i></a>
                    <a class="social-button shape-circle sb-instagram sb-light-skin"
                        href="https://instagram.com/mulltben?igshid=iu3dnynxtcxz" target="_blank"><i
                            class="socicon-instagram"></i></a>
                    <a class="social-button shape-circle sb-linkedin sb-light-skin" href="#" target="_blank"><i
                            class="socicon-linkedin"></i></a>
                </section>
            </div>
            <div class="col-lg-3 col-md-6 footer-app hide" style="display: none;">
                <section class="widget widget-light-skin ">
                    <h3 class="widget-title">Nosso App</h3>
                    <a class="market-button apple-button mb-light-skin" href="#"><span class="mb-subtitle">Download
                            no</span><span class="mb-title">App Store</span></a>
                    <a class="market-button google-button mb-light-skin" href="#"><span class="mb-subtitle">Download
                            no</span><span class="mb-title">Google Play</span></a>
                    <a class="market-button windows-button mb-light-skin" href="#"><span class="mb-subtitle">Download
                            no</span><span class="mb-title">Windows Store</span></a>
                </section>
            </div>
            <div class="col-lg-3 col-md-6">
                <section class="widget widget-links widget-light-skin">
                    <h3 class="widget-title">Privacidade</h3>
                    <ul>
                        <li><a href="{{route('terms_conditions')}}">Termos e Condições de Uso</a></li>
                        <li><a href="{{route('privacy_policy')}}">Política de Privacidade</a></li>
                    </ul>
                </section>
            </div>
            <div class="col-lg-3 col-md-6">
                <section class="widget widget-links widget-light-skin">
                    <h3 class="widget-title">Canais de atendimento</h3>
                    <ul>
                        <li><a class="navi-link-light" href="mailto:suporte@multben.com.br"
                                target="_blank">suporte@multben.com.br</a></li>
                        <!-- 					<li><a href="#">Chat</a></li> -->
                        <li><a class="navi-link-light" href="{{route('contact')}}" title="Fale conosco!">Contato</a>
                        </li>
                    </ul>
                </section>
            </div>
        </div>
        <hr class="hr-light mt-2 margin-bottom-2x">
        <div class="row">
            <div class="col-md-7 padding-bottom-1x">
                <div class="margin-bottom-1x">
                    <img src="{{asset('unishop/img/logo-iugu-branca.png')}}" style="width: 130px;pad"
                        alt="Payment Methods">
                    <img src="{{asset('unishop/img/boleto.png')}}" style="width: 130px; margin-left:40px;"
                        alt="Payment Methods">
                </div>
            </div>
        </div>
        <p class="footer-copyright">© Todos os direitos reservados. Feito com &nbsp;<i
                class="icon-heart text-danger"></i>&nbsp; pela Multben</p>
    </div>
</footer>
