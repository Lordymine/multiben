<?php

namespace App\Rules;
use Auth;
use App\User;
use Illuminate\Contracts\Validation\Rule;

class UsuarioPlanoAtivoRule implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function isEmpty__construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $user = User::where('id', Auth::user()->id)->first();
        
        return $user->ativoEmAlgumPlano();
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'É necessário estar ativo em algum de nossos planos para utilizar o bônus.';
    }
}
