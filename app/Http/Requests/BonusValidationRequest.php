<?php

namespace App\Http\Requests;

use App\Rules\BonusSolicitationRule;
use App\Rules\SaldoBonusSolicitationRule;
use App\Rules\UsuarioPlanoAtivoRule;
use Illuminate\Foundation\Http\FormRequest;

class BonusValidationRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'valor' => [
                'required',
                new SaldoBonusSolicitationRule(),
                new BonusSolicitationRule(),
                new UsuarioPlanoAtivoRule()
            ],
            'empresa_cnpj' => [
                'required',     
            ],
        ];
    }
}
