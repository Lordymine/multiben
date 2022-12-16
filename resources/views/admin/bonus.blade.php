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

    .page-item > a:hover {
        border-color: #e1e7ec;
        background-color: #f5f5f5;
    }
    
    .page-item.active {
        border-color: #e1e7ec;
        background-color: #f5f5f5;
        border-radius: 50%;
        
    }
    
    .table td 
    {
        text-align: center; 
        vertical-align: middle;
        padding: .35rem;
    }
    .table th 
    {
        text-align: center; 
        vertical-align: middle;
        padding: .35rem;
    }
    
    tbody tr.selected td {
        background: none repeat scroll 0 0 #ffa;
        color: #000000;
    }
</style>
    <div class="modal" id="modalComprovante" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Selecione o Comprovante que deseja anexar</h4>
              <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
			<form action="{{route('bonus_solicitation_company_payment')}}"  method="POST" enctype="multipart/form-data" >
				@csrf
                <div class="modal-body">
                	<div class="custom-file col-md-12">
    						<input id="solicitacaoId" name="solicitacaoId" hidden> 
                            <input type="file" name="filename[]" class="custom-file-input" id="fileUpload" required>
                            <label class="custom-file-label" id="filename-label" for="images">Selecionar Comprovante..</label>
                            <p class="text-muted">Imagens nos formatos: jpg, png, jpeg e gif</p>
                     </div>
    			</div>
    			<div class="modal-footer">
          			<button class="btn btn-outline-secondary btn-sm" type="button" data-dismiss="modal">Fechar</button>
                    <button class="btn btn-primary btn-sm" type="submit" id="confirmaComprovante">Anexar</a>
          		</div>
            </form>
    		</div>
    		</div>
        </div>
        </div>
    </div>
	<!-- Off-Canvas Wrapper-->
	<div class="offcanvas-wrapper">
		<!-- Page Title-->
		<div class="page-title">
			<div class="container">
				<div class="column">
					<h1>Solicitação de Bônus</h1>
				</div>
				<div class="column">
					<ul class="breadcrumbs">
						<li><a href="{{route('index')}}">Home</a></li>
						<li class="separator">&nbsp;</li>
						<li><a href="{{route('admin.users.index')}}">Conta</a></li>
						<li class="separator">&nbsp;</li>
						<li>Solicitação de Bônus</li>
					</ul>
				</div>
			</div>
		</div>
		<!-- Page Content-->
		<div class="container padding-bottom-3x mb-2">
    			<div class="row">
    				@include('layouts.admin.side-menu')
    				<div class="col-lg-8">
            			@if(Session::has('success'))
                        	<div class="alert alert-success alert-dismissible fade show text-center margin-bottom-1x">
                        		<span class="alert-close" data-dismiss="alert"></span>
                        		<i class="icon-help"></i>&nbsp;&nbsp;<strong>Sucesso: </strong> 
                        		{{ Session::get('success') }}
                        	</div>
                        @elseif(Session::has('error'))
            				<div
            					class="alert alert-danger alert-dismissible fade show text-center margin-bottom-1x">
            					<span class="alert-close" data-dismiss="alert"></span><i
            						class="icon-help"></i>&nbsp;&nbsp;<strong>Erro:</strong>
            					{{session('error')}}
            				</div>
            			@endif
						<form action="{{route('bonus-gerar-voucher')}}">
        					@csrf
    						<div class="col-md-12">
        						<h6 class="text-muted text-normal text-uppercase">Solicitações de Bônus</h6>
        						<div class="table-responsive">
        							<table class="table table-striped">
        								<thead>
        									<tr>
        										<th></th>
        										<th>#</th>
                                                <th>Voucher</th>
                                                <th>Status</th>
                                                <th>Estabelecimento</th>
                                                <th>Valor</th>
                                                <th>Usuário</th>
                                                <th>Data da Solicitação</th>
                                                <th>Comprovante</th>
        									</tr>
        								</thead>
        								<tbody>
        								@if($solicitacoes != null)
                                        @foreach($solicitacoes as $solicitacao)
        									<tr>
                								@if($solicitacao->status != null && ($solicitacao->status == 'Pendente' ||  $solicitacao->status == 'Aprovado') && $solicitacao->empresa_id != null)
                								<td scope="row"><input type="radio" class="radio-option" id="data{{encrypt($solicitacao->id)}}" name="data" value="{{encrypt($solicitacao->id)}}"></option></td>
                								@else
                								<th></th>
                								@endif
                                                <td scope="row">{{ $loop->iteration + $solicitacoes->firstItem() - 1 }}</td>
                                                @if($solicitacao->voucher != null)
                                                <td>{{  $solicitacao->voucher }}</td>
                                                @else
                								<td></td>
                								@endif
                                                <td>{{  $solicitacao->status }}</td>
                                                <td>{{  $solicitacao->empresa->razao_social }}</td>
                                                <td>{{  $solicitacao->valor == null ? '0,00' : number_format($solicitacao->valor,2) }}</td>
                                                <td>{{  $solicitacao->user->name }} {{$solicitacao->user->sobrenome}}</td>
                                                <td>{{  date('d/m/Y H:i', strtotime($solicitacao->created_at)) }}</td>
                                                @if($solicitacao->solicitationPayment != null)
                                                <td>
                                                <div data-toggle="tooltip" title="Download do Arquivo">
                                                    <a href="{{route('download_comprovante', encrypt($solicitacao->id))}}" target="_blank" >
	                                                <img src="{{asset('unishop/img/pdf-icon.png')}}" style="width: 25px;">
    	                                            </a>
        										</div>
                                                </td>
                                                @else
                                                <td></td>
                                                @endif
        									</tr>
                                        @endforeach
                                        @endif
        								</tbody>
        							</table>
    								<center>{{ $solicitacoes != null ? $solicitacoes->links() : ''}}</center>
										Total de Registros: {{ $solicitacoes != null ? $solicitacoes->total() : 0}}
    							</div>
    						</div>
    						<div class="col-lg-10">
        						<center>
            						<div data-toggle="tooltip" style="float: left;" title="Selecione uma solicitação acima e clique aqui para gerar o voucher">
                                   		<button class="btn btn-primary btn-sm buttons" id="voucher" type="submit" disabled>Gerar Voucher</button>
            						</div>
            						<div data-toggle="tooltip" style="float: left;" title="Selecione uma solicitação acima e clique aqui para anexar o comprovante">
                						<a class="btn btn-primary btn-sm create-modal buttons" disabled>Anexar Comprovante</a>
            						</div>
                                </center>
        					</div>
    					</form>
    				</div>
    			</div>
		</div>
	</div>

@stop

@section('js')
    @parent
    
<script>
	$(".radio-option").click(function () {
		$solicitacaoId = document.getElementById('solicitacaoId');
		$solicitacaoId.value = $(this).val();
		$("#voucher").removeAttr("disabled");
		$(".buttons").removeAttr("disabled");
		$(this).closest('tr').addClass("selected").siblings().removeClass("selected");
		
	});
	
    //before Modal actions
    $(document).on('click','.create-modal', function() {
        $('#modalComprovante').modal('show');
    });
	
	$(function() {
        // Multiple images preview with JavaScript
        var multiImgPreview = function(input, imgPreviewPlaceholder) {
			var label = document.getElementById("filename-label");            	
            
            if (input.files) {
                var filesAmount = input.files.length;
                $('.temp_image4').remove();
                for (i = 0; i < filesAmount; i++) {
                    var reader = new FileReader();
                    label.textContent = input.files[i].name;
                    reader.readAsDataURL(input.files[i]);
                }
            }
        };
        $('#fileUpload').on('change', function() {
            multiImgPreview(this, 'ul.product-thumbnails');
        });
    });
    
</script>
@stop

