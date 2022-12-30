<?php

namespace App\Rules;
use Auth;
use App\UserBonus;
use Illuminate\Contracts\Validation\Rule;

class SaldoBonusSolicitationRule implements Rule
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
        $bonus = UserBonus::where('user_id', Auth::user()->id)->get();
        return !$bonus->isEmpty();
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Você ainda não possui Saldo de Bônus.';
    }
}
