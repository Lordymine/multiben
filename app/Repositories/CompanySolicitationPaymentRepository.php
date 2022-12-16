<?php
namespace app\Repositories;
use App\UserSolicitacaoBonus;
use App\Empresa;
use App\CompanySolicitationPayment;
use App\Repositories\Contracts\CompanySolicitationPaymentRepositoryInterface;
use Validator;
use Keygen\Keygen;

class CompanySolicitationPaymentRepository implements CompanySolicitationPaymentRepositoryInterface
{
    
    public function validateStore($request)
    {
        return Validator::make($request->all(), [
            'filename.*' => 'image|mimes:jpg,png,jpeg,gif,pdf|max:2048',
        ]);
    }
    
    public function store($request)
    {
        $data = $request->all();
        $solicitacaoId =  preg_replace('/[^0-9]/', '', decrypt($request->all()['solicitacaoId']));
        $solicitation = UserSolicitacaoBonus::where('id', $solicitacaoId)->first();
        $empresa = Empresa::where('id', $solicitation->empresa_id)->first();
        $nameFile = null;
        
        if ($request->hasFile('filename')) {
            foreach ($request->file('filename') as $image)
            {
                $unique = Keygen::numeric(10)->generate();;
                $name = $unique.'-'.$empresa->cnpj.'-'.$solicitacaoId.'-'.date('HisYmd');
                
                $extension = $image->extension();
                
                $nameFile = "{$name}.{$extension}";

                try {
                    $image->move('storage/comprovantes', $nameFile, 'public');
                } catch (Exception $e) {
                    return false;
                }
            }
            $data['empresa_id'] = $solicitation->empresa_id;
            $data['solicitacao_id'] = $solicitation->id;
            $data['filename'] = $nameFile;
            
            $companySolicitation = CompanySolicitationPayment::where('empresa_id', $empresa->id)->where('solicitacao_id', $solicitation->id)->first();
            if($companySolicitation != null){
                $companySolicitation->delete();
                CompanySolicitationPayment::create($data);
            }else{
                CompanySolicitationPayment::create($data);
            }
            return true;
        }
     
        return false;
    }
    
}

