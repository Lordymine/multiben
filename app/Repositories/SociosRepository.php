<?php
namespace App\Repositories;

use App\Repositories\Contracts\SociosRepositoryInterface;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

use App\User;
use App\Socio;

use Auth;

class SociosRepository implements SociosRepositoryInterface
{
    
    public function addBusinessPartner($request)
    {
        $data = $request->all();

        $data['name'] = preg_replace('/[^0-9]/', '', $data['name']);

        if(User::where('matricula', $data['name'])->count() == 0){
            return false;
        }else{
            
            $convite_enviado =  Socio::where('user_id', Auth::user()->id)
                                ->where('socio_matricula',$data['name'])
                                ->where('aceito','S')
                                ->count();

            if($convite_enviado == 0){

                $data = [
                    'user_id' => Auth::user()->id, 
                    'socio_matricula' => $data['name'],
                    'aceito' => 'S',
                    'created_at' => date('Y-m-d')
                ];

                Socio::insert($data);
            }
            
        }

        return true;

    }


    public function getBusinessPartner()
    {
        $socios = DB::table('socios')
                    ->join('users', 'matricula', '=', 'socios.socio_matricula')
                    ->where('user_id',Auth::user()->id)
                    ->where('aceito','S')
                    ->select('users.*', 'socios.user_id', 'socios.socio_matricula', 'socios.aceito', 'socios.id')
                    ->get();
        
        return $socios;
    }

    public function removeBusinessPartner($id)
    {

        $id = preg_replace('/[^0-9]/', '', decrypt($id));

        $socio =  Socio::where('id', $id)
                ->where('user_id',Auth::user()->id)
                ->count();
        
        if($socio > 0){

            $data = ['aceito' => 'N'];

            Socio::where('id', $id)->where('user_id',Auth::user()->id)->update($data);

        }else{
            return false;
        }

        return true;

    }

}
