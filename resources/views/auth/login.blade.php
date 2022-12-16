@extends('layouts.main')

@section('title', '')

@section('css')
@parent
<style>
/* Chrome, Safari, Edge, Opera */
input::-webkit-outer-spin-button,
input::-webkit-inner-spin-button {
    -webkit-appearance: none;
    margin: 0;
}

/* Firefox */
input[type=number] {
    -moz-appearance: textfield;
}

@media (min-width: 320px) and (max-width: 1199px) {
    .view-mobile {
        display: block;
    }
}

@media (min-width: 1200px) {
    .view-mobile {
        display: none;
    }
}
</style>
@stop

@section('content')

<div class="offcanvas-wrapper">
    <!-- Page Title-->
    <div class="page-title">
        <div class="container">
            <div class="column">
                <h1>Entrar / Criar Conta</h1>
            </div>
            <div class="column">
                <ul class="breadcrumbs">
                    <li>
                        <a href="{{route('index')}}">Início</a>
                    </li>
                    <li class="separator">&nbsp;</li>
                    <li>
                        <a href="#">Conta</a>
                    </li>
                    <li class="separator">&nbsp;</li>
                    <li>Entrar / Criar Conta</li>
                </ul>
            </div>
        </div>
    </div>
    <!-- Page Content-->
    <div class="container padding-bottom-3x mb-2" >
        @if($aviso ?? '')
        <div class="alert alert-primary" style="margin-bottom: 20px" role="alert">
            <strong>{{ $aviso ?? '' }}</strong>
        </div>
        @endif
        @error('cpf')
        <div class="view-mobile alert alert-danger">{{ $message }}</div>
        @enderror
        @error('password')
        <div class="view-mobile alert alert-danger">{{ $message }}</div>
        @enderror
        <div class="row">
            <div class="col-md-6">
                <form class="login-box" method="POST" action="{{ route('login') }}">
                    @csrf
                    <h4 class="margin-bottom-1x">Entre com seus dados</h4>
                    <div class="form-group input-group">
                        <input class="form-control @error('email') is-invalid @enderror" type="email"
                            placeholder="Email" name="email" id="email" autocomplete="email" required
                            value="{{ old('email') }}">
                        <span class="input-group-addon"><i class="icon-mail"></i></span>
                        @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-group input-group">
                        <input class="form-control @error('Password') is-invalid @enderror" id="password"
                            name="password" type="password" placeholder="Senha" name='password'
                            autocomplete="current-password" required><span class="input-group-addon"><i
                                class="icon-lock"></i></span>
                        @error('Password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <p><input type="button" id="showPassword" value="Mostrar" class="btn-primary" /></p>
                    <div class="d-flex flex-wrap justify-content-between padding-bottom-1x">
                        <div class="custom-control custom-checkbox">
                            <input class="custom-control-input" type="checkbox" id="remember_me" name="remember"
                                checked>
                            <label class="custom-control-label" for="remember_me">Lembrar Acesso</label>
                        </div>
                        <a class="navi-link" href="password/reset">Recuperar Acesso ?</a>
                    </div>
                    <div class="text-center text-sm-right">
                        <button class="btn btn-primary margin-bottom-none" type="submit">Entrar</button>
                    </div>
                </form>
            </div>
            <div class="col-md-6" id="cadastro">
                <div class="padding-top-3x hidden-md-up"></div>
                <h3 class="margin-bottom-1x">Cadastro</h3>
                <form class="row" method="POST" action="{{ route('register') }}" autocomplete="off">
                    @csrf
                    <div class="col-md-12">
                        <div class="form-group text-center">
                            <label>Em qual perfil você se encaixa?</label><br>
                            <div class="custom-control custom-radio custom-control-inline">
                                <input class="custom-control-input" type="radio" id="pessoa_fisica" name="selectRadio"
                                    value="1" onclick="javascript:cpfOrCnpjCheck(1);" checked>
                                <label class="custom-control-label" for="pessoa_fisica">Usuário</label>
                            </div>
                            <div class="custom-control custom-radio custom-control-inline">
                                <input class="custom-control-input" type="radio" id="pessoa_juridica" name="selectRadio"
                                    value="2" onclick="javascript:cpfOrCnpjCheck(2);">
                                <label class="custom-control-label" for="pessoa_juridica">Parceiro</label>
                            </div>
                        </div>
                    </div>
                </form>
                <div class="padding-top-1x hidden-md-up"></div>
                <h3 class="margin-bottom-1x">Criar Conta </h3>
                <p>O registro leva menos de um minuto, mas oferece controle total sobre seus pedidos.</p>
                <div id="form_pessoa_fisica">
                    <form class="row form-registro" method="POST" action="{{ route('register') }}" autocomplete="off">
                        @csrf
                        <div class="col-md-12">
                            <div class="form-group text-center">
                                <label for="account-ln">Você possui código de indicação?</label><br>
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input class="custom-control-input" type="radio" id="sim_possui_codigo"
                                        name="selectRadio" value="1" onclick="javascript:yesnoCheck();" checked>
                                    <label class="custom-control-label" for="sim_possui_codigo">Sim</label>
                                </div>
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input class="custom-control-input" type="radio" id="nao_possui_codigo"
                                        name="selectRadio" value="2" onclick="javascript:yesnoCheck();">
                                    <label class="custom-control-label" for="nao_possui_codigo">Não</label>
                                </div>
                            </div>
                        </div>

                        <div id="codigo_folder" class="col-sm-6">
                            <div class="form-group">
                                <label for="reg-fn">Código do Indicador</label>
                                <input class="form-control" type="number" maxlength="20" id="matricula_user_convite" value="{{ old('matricula_user_convite') }}"
                                    name="matricula_user_convite" placeholder="Insira o codigo de indicação" onblur="searchUserRegistration()">
                            </div>
                        </div>
                        <div id="socio_folder" class="col-sm-6">
                            <div class="form-group">
                                <label for="reg-fn">Nome do Indicador</label>
                                <input class="form-control" type="text" readonly id="socio_nome" name="socio_nome" value="{{ old('socio_nome') }}"
                                    autocomplete="off">
                                <label style="color: red" for="reg-fn" id="errorInIndicationCode"></label>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="reg-fn">Nome</label>
                                <input class="form-control @error('name') is-invalid @enderror" type="text" id="name"
                                    name='name' value="{{ old('name') }}" autocomplete="name" required>
                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="reg-fn">Sobrenome</label>
                                <input class="form-control @error('sobrenome') is-invalid @enderror" type="text"
                                    id="sobrenome" name="sobrenome" placeholder="Sobrenome" required
                                    value="{{ old('sobrenome') }}">
                                @error('sobrenome')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="account-ln">CPF</label>
                                @error('cpf')
                                <input class="form-control @error('cpf') is-invalid @enderror" type="text" id="cpf"
                                    placeholder="###.###.###-##" name="cpf" autofocus
                                    onkeyup="mascara('###.###.###-##',this,event,true)" maxlength="14" required
                                    value="{{ old('cpf') }}">
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @else
                                <input class="form-control @error('cpf') is-invalid @enderror" type="text" id="cpf"
                                    placeholder="###.###.###-##" name="cpf"
                                    onkeyup="mascara('###.###.###-##',this,event,true)" maxlength="14" required
                                    value="{{ old('cpf') }}">
                                @enderror
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="reg-email">E-mail</label>
                                <input class="form-control @error('email') is-invalid @enderror" type="email"
                                    name="email" id="email" placeholder="exemplo@exemplo.com" required
                                    value="{{ old('email') }}">
                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="reg-phone">Telefone</label>
                                <input class="form-control @error('telefone') is-invalid @enderror" type="tel"
                                    id="telefone" name='telefone' placeholder="(00)00000-0000"
                                    onkeyup="mascara('(##) #####-####',this,event,true)" maxlength="15"
                                    value="{{ old('telefone') }}">
                                @error('telefone')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-sm-6"></div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="reg-pass">Senha</label>
                                <input class="form-control @error('password') is-invalid @enderror" type="password"
                                    name="password" id="password2" placeholder="Senha" required
                                    value="{{ old('password') }}">
                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="reg-pass-confirm">Confirmar Senha</label>
                                <input class="form-control" type="password" name="password_confirmation"
                                    id="password_confirmation" placeholder="Confirmar Senha" required>
                            </div>
                        </div>
                        <div class="col-12 text-center text-sm-right" style="margin-bottom: 20px;">
                            <input type="button" id="showPassword2" style="margin-right: 6px;" value="Mostrar"
                                class="btn-primary" />
                        </div>
                        <div class="col-12 text-center text-sm-right">
                            <button class="btn btn-primary margin-bottom-none" type="submit" data-toggle="modal"
                                data-target="#modalDefault">Salvar</button>
                        </div>

                        <input type="text" id="cnpj_hidden" name="cnpj" hidden>
                    </form>
                </div>
                <div id="form_pessoa_juridica">
                    <form class="row form-registro" method="POST" action="{{ route('register') }}" autocomplete="off">
                        @csrf
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="reg-fn">Razão Social</label>
                                <input class="form-control @error('name') is-invalid @enderror" type="text" id="name"
                                    name="name" value="{{ old('name') }}" autocomplete="name" required>
                                @error('name')
                                <span class="invalid-feedback" id="error_razaoS" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6" id="cnpj_area">
                            <div class="form-group">
                                <label for="account-ln">CNPJ</label>
                                @error('cnpj')
                                <input class="form-control @error('cnpj') is-invalid @enderror" type="text" id="cnpj"
                                    name="cnpj" placeholder="00.000.000/0000-00"
                                    onkeyup="mascara('##.###.###/####-##',this,event,true)" maxlength="18"
                                    value="{{ old('cnpj') }}">
                                <span class="invalid-feedback" id="error_cnpj" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @else
                                <input class="form-control @error('cnpj') is-invalid @enderror" type="text" id="cnpj"
                                    name="cnpj" placeholder="00.000.000/0000-00"
                                    onkeyup="mascara('##.###.###/####-##',this,event,true)" maxlength="18"
                                    value="{{ old('cnpj') }}">
                                @enderror
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="reg-fn">Nome do Responsável</label>
                                <input class="form-control @error('responsavel') is-invalid @enderror" type="text"
                                    id="responsavel" name="responsavel" value="{{ old('responsavel') }}"
                                    autocomplete="responsavel" required>
                                @error('responsavel')
                                <span class="invalid-feedback" id="error_responsavel" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="reg-email">E-mail</label>
                                <input class="form-control @error('email') is-invalid @enderror" type="email"
                                    name="email" id="email" placeholder="exemplo@exemplo.com" value="{{ old('email') }}"
                                    required>
                                @error('email')
                                <span class="invalid-feedback" id="error_email" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="reg-phone">Telefone</label>
                                <input class="form-control @error('telefone') is-invalid @enderror" type="tel"
                                    id="telefone" name="telefone" placeholder="(00)00000-0000"
                                    onkeyup="mascara('(##) #####-####',this,event,true)" value="{{ old('telefone') }}"
                                    maxlength="15">
                                @error('telefone')
                                <span class="invalid-feedback" id="error_telefone" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-sm-6">
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="reg-pass">Senha</label>
                                <input class="form-control @error('password') is-invalid @enderror" type="password"
                                    name="password" id="password3" value="{{ old('password') }}" placeholder="Senha"
                                    required>
                                @error('password')
                                <span class="invalid-feedback" id="error_password" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <p><input type="button" id="showPassword3" value="Mostrar" class="btn-primary" /></p>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="reg-pass-confirm">Confirmar Senha</label>
                                <input class="form-control" type="password" name="password_confirmation"
                                    id="password_confirmation2" placeholder="Confirmar Senha" required>
                            </div>
                        </div>
                        <div class="col-12 text-center text-sm-right">
                            <button class="btn btn-primary margin-bottom-none" type="submit" data-toggle="modal"
                                data-target="#modalDefault">Salvar</button>
                        </div>

                        <input type="text" id="cpf" name="cpf" hidden>
                        <input type="number" id="matricula_user_convite" name="matricula_user_convite" value="" hidden>
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

//Verifica se ve de um 'seja parceiro
function validareCameFromPartner() {
    const queryString = window.location.search;
    const urlParams = new URLSearchParams(queryString);
    if (urlParams.has('partner')) {
        const partner = urlParams.get('partner');
        if (partner == 'S') {
            //CLICAR
            document.getElementById('pessoa_fisica').setAttribute("disabled","disabled");
            document.getElementById('pessoa_juridica').click();
        }
    }
}

//matricula de indicaçao
var registration = new URLSearchParams(window.location.search).get('m');
if (registration != null) {
    document.getElementById("matricula_user_convite").value = registration;
    searchUserRegistration();
}

$('#matricula_user_convite').on('blue, change', function() {
    if ($(this).val() != registration) {
        registration = $(this).val();
        searchUserRegistration();
    }
    document.getElementById("socio_nome").value = null;
});

if(sessionStorage.getItem('meta') == 'indicacao'){
    setTimeout(() => {
        var topp = $('#cadastro').offset().top - 70;
        $(window).scrollTop(topp).trigger('scroll');
    }, 300);

    if(sessionStorage.getItem('codigo_indicacao')){
        setTimeout(() => {
            var codigo_indicacao = sessionStorage.getItem('codigo_indicacao');
            $('#matricula_user_convite').val(codigo_indicacao);
            $('#matricula_user_convite').trigger('change');
        }, 500);
    }
}


//validação do radiobutton de sim ou nao
function yesnoCheck() {
    if (document.getElementById('sim_possui_codigo').checked) {
        document.getElementById('socio_folder').style.display = 'block';
        document.getElementById('codigo_folder').style.display = 'block';
        document.getElementById('matricula_user_convite').value = '';
        document.getElementById('socio_nome').value = '';
    } else {
        document.getElementById('matricula_user_convite').value = '';
        document.getElementById('socio_nome').value = '';
        registration = "";

        document.getElementById('socio_folder').style.display = 'none';
        document.getElementById('codigo_folder').style.display = 'none';
    }
}

//validação do radiobutton de sim ou nao
function cpfOrCnpjCheck(vl) {
    localStorage.setItem('tipopessoa', vl);

    if (vl == 1) {
        document.getElementById('form_pessoa_fisica').style.display = 'block';
        document.getElementById('form_pessoa_juridica').style.display = 'none';
        document.getElementById('cnpj').value = null;

    } else {
        document.getElementById('form_pessoa_fisica').style.display = 'none';
        document.getElementById('form_pessoa_juridica').style.display = 'block';
        document.getElementById('cpf').value = null;
    }
}
//busca nome do indicador pelo código, caso exista
function searchUserRegistration() {
    var stateId = document.getElementById("matricula_user_convite").value;
    if (stateId) {
        jQuery.ajax({
            url: '/find-by-registratrion/' + stateId,
            type: "GET",
            dataType: "json",
            success: function(data) {
                document.getElementById("errorInIndicationCode").innerHTML = "";
                document.getElementById("socio_nome").value = data;
            },
            error: function(data) {
                document.getElementById("errorInIndicationCode").innerHTML = data.responseJSON;
            }
        });
    }
}

// ações do botão de mostrar e esconder senha
$(document).ready(function() {
    validateErrorOnArea();
    validareCameFromPartner();

    // Click event of the showPassword button
    $('#showPassword').on('click', function() {

        // Get the password field
        var passwordField = $('#password');

        // Get the current type of the password field will be password or text
        var passwordFieldType = passwordField.attr('type');

        // Check to see if the type is a password field
        if (passwordFieldType == 'password') {
            // Change the password field to text
            passwordField.attr('type', 'text');

            // Change the Text on the show password button to Hide
            $(this).val('Esconder');
        } else {
            // If the password field type is not a password field then set it to password
            passwordField.attr('type', 'password');

            // Change the value of the show password button to Show
            $(this).val('Mostrar');
        }
    });


    function validateErrorOnArea() {
        $error1 = document.getElementById('error_cnpj');
        $error2 = document.getElementById('error_email');
        $error3 = document.getElementById('error_password');
        $error4 = document.getElementById('error_telefone');
        $error5 = document.getElementById('error_razaoS');

        var tp = 1;
        if ($error1 != null || $error2 != null || $error3 != null || $error4 != null || $error5 != null) {
            tp = localStorage.getItem('tipopessoa');

            if (document.getElementById('nao_possui_codigo').checked) {
                document.getElementById('nao_possui_codigo').checked = true;
            }
        }
        $('.custom-control-input[value=' + tp + ']').prop('checked', true);
        cpfOrCnpjCheck(tp);
        //       	else{
        //       		document.getElementById('pessoa_fisica').checked = true;
        //       		document.getElementById('form_pessoa_fisica').style.display = 'block';
        //         	document.getElementById('form_pessoa_juridica').style.display = 'none';
        //       	}
    }

    // Click event of the showPassword button
    $('#showPassword2').on('click', function() {

        // Get the password field
        var passwordField = $('#password2');
        var passwordFieldConfirm = $('#password_confirmation');

        // Get the current type of the password field will be password or text
        var passwordFieldType = passwordField.attr('type');
        var passwordFieldConfirmType = passwordFieldConfirm.attr('type');

        // Check to see if the type is a password field
        if (passwordFieldType == 'password' && passwordFieldConfirmType == 'password') {
            // Change the password field to text
            passwordField.attr('type', 'text');
            passwordFieldConfirm.attr('type', 'text');

            // Change the Text on the show password button to Hide
            $(this).val('Esconder');
        } else {
            // If the password field type is not a password field then set it to password
            passwordField.attr('type', 'password');
            passwordFieldConfirm.attr('type', 'password');

            // Change the value of the show password button to Show
            $(this).val('Mostrar');
        }
    });
    // Click event of the showPassword button
    $('#showPassword3').on('click', function() {

        // Get the password field
        var passwordField = $('#password3');
        var passwordFieldConfirm = $('#password_confirmation2');

        // Get the current type of the password field will be password or text
        var passwordFieldType = passwordField.attr('type');
        var passwordFieldConfirmType = passwordFieldConfirm.attr('type');

        // Check to see if the type is a password field
        if (passwordFieldType == 'password') {
            // Change the password field to text
            passwordField.attr('type', 'text');
            passwordFieldConfirm.attr('type', 'text');

            // Change the Text on the show password button to Hide
            $(this).val('Esconder');
        } else {
            // If the password field type is not a password field then set it to password
            passwordField.attr('type', 'password');
            passwordFieldConfirm.attr('type', 'password');

            // Change the value of the show password button to Show
            $(this).val('Mostrar');
        }
    });
});
</script>
@stop
