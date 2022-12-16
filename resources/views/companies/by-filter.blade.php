<div class="gutter-sizer"></div>
<div class="grid-sizer"></div>

@if($empresas[0])

@foreach($empresas as $empresa)
    <div class="grid-item">
        <div class="card margin-bottom-1x">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4 my-auto">
                        <a class="product-thumb" href="{{ route('companies_info',encrypt($empresa->empresas_id)) }}"><img src="{{asset($empresa->capa())}}" alt="Empresa Logo"></a>
                    </div>
                    <div class="col-md-8">
                        <p class="card-text">
                        <h6>{{ $empresa->razao_social }}</h6>
                        {{ $empresa->desconto }}% DE DESCONTO <br>
                        Aberto de {{ \Illuminate\Support\Str::limit($empresa->hora_abertura, 5, $end='') }} até {{ \Illuminate\Support\Str::limit($empresa->hora_fechamento, 5, $end='') }}
                        </p>
                        <span class="text-muted">Avaliação: 4.7</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endforeach

@else

    <div class="alert alert-danger alert-dismissible fade show text-center margin-bottom-1x">
        <span class="alert-close" data-dismiss="alert"></span><i class="icon-ban"></i>&nbsp;&nbsp;
        <strong>Sem resultado:</strong> Infelizmente não existe empresas nestas condições.</div>

@endif
