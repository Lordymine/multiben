@extends('layouts.main_convite')

@section('title', '')

@section('css')
@parent

@stop

@section('content')
<style>
    body {
        font-size: 16px;
    }

    .btn {
        letter-spacing: 0.2em;
        font-size: 18px;
        padding: 0px 40px;
    }
</style>
<!-- Off-Canvas Wrapper-->
<div style="min-height: 0;">
    <!-- Banner -->
    <section class=" padding-top-3x padding-bottom-3x">
        <!--bg-faded-->
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-6">
                    <h3 class="text-center">Você foi convidado por alguem que confia na Multben</h3>
    
                    <div>
                        <p>
                            Além de fazer parte da plataforma que te proporciona descontos exclusivos, você também pode receber bônus ilimitados para usar em serviços a sua escolha.
                        </p>
    
                        @if($matricula)
                        <p class="codigo_indicacao" data-matricula="{{$matricula}}"> Cód de indicação: {{$matricula}}</p>
                        @endif
                    </div>
    
                    <div class="text-center">
                        <p>Receba seus descontos</p>
                        <a href="{{route('login')}}" class="btn btn-primary btn-sm">AGORA</a>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-6">
                    <img src="{{asset('img/indicacao_3.png')}}" style="width: 100%;max-width: 900px;">
                </div>
            </div>
        </div>
    </section>
</div>



@stop

@section('js')
@parent

<script>
    $(window).ready(function() {
        sessionStorage.setItem('meta', 'indicacao');
        $('.codigo_indicacao').each(function () {
            var codigo_indicacao = $(this).data('matricula')+'';
            codigo_indicacao = codigo_indicacao.replace(/\D/g, '');
            sessionStorage.setItem('codigo_indicacao', codigo_indicacao);
        })
    });
</script>

@stop