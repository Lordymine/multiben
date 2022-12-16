@extends('layouts.main')

@section('title', '')

@section('css')
@parent

@stop

@section('content')

<style>
    .page-item {
        display: inline-block;
        width: 36px;
        height: 36px;
        font-size: 14px;
        font-weight: 500;
        line-height: 34px;
        text-align: center;
    }

    .page-item > a {
        display: block;
        width: 36px;
        height: 36px;
        transition: all .3s;
        border: 1px solid transparent;
        border-radius: 50%;
        color: #606975;
        line-height: 34px;
        text-decoration: none;
    }
    
    .page-item.active {
        border-color: #e1e7ec;
        background-color: #f5f5f5;
        border-radius: 50%;
        
    }

    .page-item > a:hover {
        border-color: #e1e7ec;
        background-color: #f5f5f5;
    }
</style>

<!-- Off-Canvas Wrapper-->
<div class="offcanvas-wrapper">
    <!-- Page Title-->
    <div class="page-title">
      <div class="container">
        <div class="column">
          <h1>Estabelecimentos - (Categoria que está)</h1>
        </div>
        <div class="column">
          <ul class="breadcrumbs">
            <li><a href="{{route('index')}}">Home</a>
            </li>
            <li class="separator">&nbsp;</li>
            <li>Estabelecimentos</li>
          </ul>
        </div>
      </div>
    </div>
<!-- Page Content-->
<div class="container padding-bottom-3x mb-1">
    <div class="row">

        @include('layouts.filters_sidebar')

        <!-- Products-->
        <div class="col-xl-9 col-lg-8 order-lg-2">
            <!-- Products Grid-->
            <div class="isotope-grid cols-3 mb-2">
                <div class="gutter-sizer"></div>
                <div class="grid-sizer"></div>

                @foreach($empresas as $empresa)
                <div class="grid-item">
                    <div class="card margin-bottom-1x">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-4 my-auto">
                                    <a class="product-thumb" href="shop-single.html">
                                        <img src="{{asset($empresa->capa())}}" alt="Empresa Logo"></a>
                                </div>
                                <div class="col-md-8">
                                    <p class="card-text">
                                        <h6><a href="{{route('companies_info')}}">{{ $empresa->razao_social }}</a></h6>
                                        {{ $empresa->desconto }}% DE DESCONTO <br>
                                        Aberto de {{ \Illuminate\Support\Str::limit($empresa->hora_abertura, 5, $end='') }} até {{ \Illuminate\Support\Str::limit($empresa->hora_fechamento, 5, $end='') }}
                                    </p>
                                    <span class="text-muted">Avaliação: 4.7</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach;



            </div>
            <!-- Pagination-->

            {{ $empresas->links() }}


        </div>
    </div>
</div>


@stop

@section('js')
@parent

@stop
