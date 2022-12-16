<?php

namespace App\Rules;
use Auth;
use App\UserBonus;
use Illuminate\Contracts\Validation\Rule;

class BonusSolicitationRule implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
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
        $valorSolicitado = $this->tofloat($value);
        
        $bonus = UserBonus::where('user_id', Auth::user()->id)->get();
        if($bonus->isEmpty()){
            return false;
        }
        $userBonus = $bonus[0];
        
        $limiteValor = $this->tofloat($userBonus['valor']);
        $diferenca = $limiteValor - $valorSolicitado;
        
        return $diferenca >= $this->tofloat(0);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'O valor R$ não pode ser maior do que o seu Saldo de Bônus.';
    }
    
    public function tofloat($num) {
        $dotPos = strrpos($num, '.');
        $commaPos = strrpos($num, ',');
        $sep = (($dotPos > $commaPos) && $dotPos) ? $dotPos :
        ((($commaPos > $dotPos) && $commaPos) ? $commaPos : false);
        
        if (!$sep) {
            return floatval(preg_replace("/[^0-9]/", "", $num));
        }
        
        return floatval(
            preg_replace("/[^0-9]/", "", substr($num, 0, $sep)) . '.' .
            preg_replace("/[^0-9]/", "", substr($num, $sep+1, strlen($num)))
            );
    }
}
