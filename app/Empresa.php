<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\EmpresaRating;

class Empresa extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $fillable = [
        'razao_social','nome_fantasia', 'cnpj', 'endereco','numero_endereco','bairro','cidade','uf','cep','telefone',
        'user_email','user_id','servico','desconto','dias_funcionamento','hora_abertura','hora_fechamento',
        'descricao_servico','logo','perimetro','password','complemento','id_categoria_empresas','video','responsavel',
        'facebook', 'instagram', 'youtube', 'tiktok'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'user_id'
    ];

    public $rating;
    public $stars;
    public $halfStars;

    public function solicitacao()
    {
        return $this->hasMany('App\UserSolicitacaoBonus');
    }

    // Declarando o relacionamento Um para Um do Usuário feito por Rafael
    public function users()
    {
        return $this->hasOne('App\User', 'id', 'user_id');
    }

    public function getEmpresaRatings()
    {
        return EmpresaRating::where('empresa_id', $this->id)->get();
    }

    public function calculateRatingScore()
    {
        $empresaRating = $this->getEmpresaRatings();
        $score = 0;
        $rating = 0;

        if ($empresaRating != null && ! $empresaRating->isEmpty()) {
            foreach ($empresaRating as $er) {
                $score = $score + $er->rating;
            }
            $rating = $score / $empresaRating->count();
        }

        return $rating;
    }

    public function calculateStarRatingScore($ratingScore)
    {
        $stars = [
            '0',
            '0',
            '0',
            '0',
            '0'
        ];
        $scoreInt = floor($ratingScore);
        $scoreFraction = $ratingScore - $scoreInt;
        $score = $scoreInt;

        if ($ratingScore != null) {
            // adiciona quais estrelas estão preenchidas e quais serão preenchidas pela metade
            while ($score > 0) {
                $stars[$score - 1] = 'filled';
                $score--;
            }
        }

        return $stars;
    }

    public function calculateHalfStarRatingScore($ratingScore)
    {
        $scoreInt = floor($ratingScore);
        $scoreFraction = $ratingScore - $scoreInt;
        $score = $scoreInt;

        $halfStars = [
            '0',
            '0',
            '0',
            '0',
            '0'
        ];

        if ($ratingScore != null && $scoreFraction != 0) {
            $halfStars[$scoreInt] = 'half-star';
        }
        return $halfStars;
    }

    public function capa()
    {
        $src = 'storage/logos/' . $this->logo;
        if (!file_exists(__DIR__ . '/../public/' . $src) || empty($this->logo)) {
            $src = 'img/logo/logo.jpeg';
        }

        return $src;
    }
}
