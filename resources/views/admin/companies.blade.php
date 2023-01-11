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

        .page-item>a {
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

        .page-item>a:hover {
            border-color: #e1e7ec;
            background-color: #f5f5f5;
        }

        .page-item.active {
            border-color: #e1e7ec;
            background-color: #f5f5f5;
            border-radius: 50%;

        }
    </style>
    <!-- Off-Canvas Wrapper-->
    <div class="offcanvas-wrapper">
        <!-- Page Title-->
        <div class="page-title">
            <div class="container">
                <div class="column">
                    <h1>Empresas</h1>
                </div>
                <div class="column">
                    <ul class="breadcrumbs">
                        <li><a href="{{ route('index') }}">Home</a></li>
                        <li class="separator">&nbsp;</li>
                        <li><a href="{{ route('admin.users.index') }}">Conta</a></li>
                        <li class="separator">&nbsp;</li>
                        <li>Empresas</li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- Page Content-->
        <div class="container padding-bottom-3x mb-2">
            <div class="row">
                @include('layouts.admin.side-menu')
                <div class="col-lg-8">
                    <div class="col-md-12">
                        <h6 class="text-muted text-normal text-uppercase">Lista de empresas cadastradas no sistema</h6>
                        <div class="col-md-12">
                            <div class="col-md-6"></div>
                            <!--CSS in line inserido nesta div--->
                            <div class="col-md-6" style="padding: 20px;">
                                <div class="form-group">
                                    <!--Inserido controle de Parceiros e Conveniados sem acesso aos dados-->
                                    <form action="{{ route('admin.companies.index') }}" method="GET">
                                        <label for="categoria_empresas">Parceiros | Conveniados</label>
                                        <select class="form-control" name="categoria_empresas" id="id_categoria_empresa">
                                            <option value="">Selecione a Opção</option>
                                            <option value="Parceiros">Parceiros</option>
                                            <option value="Conveniados">Conveniados</option>
                                        </select>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <!-- Inserindo email -->
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Razão Social</th>
                                        <th>CNPJ</th>
                                        <th>Telefone</th>
                                        <th>E-mail</th>
                                        <th>Responsável</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @foreach ($companies as $company)
                                        <tr>
                                            <th scope="row">{{ $loop->iteration + $companies->firstItem() - 1 }}</th>
                                            <td>{{ $company->razao_social }}</td>
                                            <td>{{ $company->cnpj }}</td>
                                            <td>{{ $company->telefone }}</td>
                                            <td>{{ $company->users->email }}</td>
                                            <td>{{ $company->responsavel }}</td>
                                        </tr>
                                    @endforeach

                                </tbody>
                            </table>
                        </div>
                        <center>{{ $companies != null ? $companies->links() : '' }}</center>
                        Total de Registros: {{ $companies != null ? $companies->total() : 0 }}
                    </div>
                </div>
            </div>
        </div>
    </div>

@stop

@section('js')
    @parent

@stop
