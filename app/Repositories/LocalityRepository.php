<?php


namespace App\Repositories;

use App\Repositories\Contracts\LocalityRepositoryInterface;

use Illuminate\Support\Facades\DB;

class LocalityRepository implements LocalityRepositoryInterface
{
    public function getUf()
    {
        $estados = DB::table('estados')->whereIn('regiao',[1,2])->get();
        return $estados;
    }

    public function getCidade($request)
    {
        $dados = $request->all();

        $cidades = DB::table('cidades')
                    ->join('estados', 'estados.uf', '=', 'cidades.uf')
                    ->select('cidades.*')
                    ->where('estados.id','=',$dados['uf'])
                    ->get();
        return $cidades;
    }

    public function getEstados()
    {
        $estados = DB::table('estados')->get();
        return $estados;
    }
    
    public function getCidadesByCodigoUf($codigo)
    {
        $cidades = DB::table('cidades')
        ->join('estados', 'estados.uf', '=', 'cidades.uf')
        ->select('cidades.nome', 'cidade.codigo')
        ->where('estados.codigo_uf','=',$codigo)
        ->get();
        return $cidades;
    }
    public static function getEstadoByCodigoUf($codigo)
    {
        $cidades = DB::table('cidades')
        ->join('estados', 'estados.uf', '=', 'cidades.uf')
        ->select('estados.uf')
        ->where('estados.codigo_uf','=',$codigo)
        ->first();
        return $cidades;
    }
    
    public function getAllCyties()
    {
        $cidades = DB::table('cidades')
        ->join('estados', 'estados.uf', '=', 'cidades.uf')
        ->select('cidades.*')
        ->paginate();
        
        return $cidades;
    }
}
