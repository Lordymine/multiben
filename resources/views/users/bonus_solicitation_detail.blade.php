<div class="modal-dialog" role="document">
  <div class="modal-content">
    <div class="modal-header">
      <h4 class="modal-title">Dados da Solicitação</h4>
      <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    </div>
        <div class="modal-body col-md-12">
        	<div class="col-md-12">
			<div class="form-group">
				<label for="account-fn">NOME DO SOLICITANTE:</label>
				<input class="form-control" type="text" id="nome_solicitante" value="{{ $solicitacao->user->name }} {{$solicitacao->user->sobrenome }}" name="nome_solicitante" readonly>
			</div>
			</div>
			<div class="col-md-12">
			<div class="form-group">
				<label for="account-fn">CPF DO SOLICITANTE:</label>
				<input class="form-control" type="text" id="cpf_solicitante" value="{{ $solicitacao->user->cpf }}" name="cpf_solicitante" readonly>
			</div>
			</div>
			<div class="col-md-12">
			<div class="form-group">
				<label for="account-fn">NÚMERO DO VOUCHER:</label>
				<input class="form-control" type="text" id="numero_voucher"  value="{{ $solicitacao->voucher }}" name="numero_voucher" readonly>
			</div>
			</div>
			<div class="col-md-12">
			<div class="form-group">
				<label for="account-fn">STATUS DA SOLICITAÇÃO:</label>
				<input class="form-control" type="text" id="status_solicitacao" value="{{ $solicitacao->status }}" name="status_solicitacao" readonly>
			</div>
			</div>
			<div class="col-md-12">
			<div class="form-group">
				<label for="account-fn">DATA DA SOLICITAÇÃO:</label>
				<input class="form-control" type="text" id="data_solicitacao" value="{{ date('d/m/Y H:i', strtotime($solicitacao->created_at)) }}" name="data_solicitacao" readonly>
			</div>
			</div>
			<div class="col-md-12">
			<div class="form-group">
				<label for="account-fn">COMPROVANTE DE PAGAMENTO:</label>
				 @if($solicitacao->solicitationPayment != null)
                <div data-toggle="tooltip" title="Download do Arquivo">
                    <a href="{{route('download_comprovante', encrypt($solicitacao->id))}}" target="_blank" >
                    <img src="{{asset('unishop/img/pdf-icon.png')}}" style="width: 30px;">
                    </a>
				</div>
                @endif
			</div>
			</div>
		</div>
		<div class="modal-footer">
  			<button class="btn btn-outline-secondary btn-sm" type="button" data-dismiss="modal">Fechar</button>
  		</div>
	</div>
	</div>
</div>
</div>
