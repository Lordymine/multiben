<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Auth;
use Illuminate\Validation\Rule;
use App\User;

class UpdateUserRequest extends FormRequest
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

    public function validationData()
    {
        $data = $this->all();

        if(isset($this['cpf']) ){
            $data['cpf'] = str_replace("-","",str_replace(".", "", $data['cpf']));

        }else if(isset($this['cnpj'])){
            $data['cnpj'] = $this['cnpj'] = str_replace("-","",str_replace("/","",str_replace(".","", $data['cnpj'])));
        }

        return $data;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        if(isset($this['cpf']) ){
            return [
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,'.Auth::user()->id],
                'cpf' => ['required', 'string', 'min:11', 'unique:users,cpf,'.Auth::user()->id]
            ];
        }else if(isset($this['cnpj'])){
            return [
                'razao_social' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,'.Auth::user()->id],
                'cnpj' => ['required', 'min:14', 'unique:users,cnpj,'.Auth::user()->id],
            ];
        }
    }
}
