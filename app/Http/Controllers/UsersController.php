<?php

namespace App\Http\Controllers;

use App\Repositories\Contracts\UserSolicitacaoBonusRepositoryInterface;
use App\Repositories\LocalityRepository;
use Illuminate\Http\Request;
use Validator;
use App\Repositories\Contracts\UsersRepositoryInterface;
use App\Repositories\Contracts\SociosRepositoryInterface;
use App\Repositories\Contracts\EmpresasRepositoryInterface;
use App\Repositories\Contracts\CategoriesRepositoryInterface;
use App\Repositories\Contracts\LocalityRepositoryInterface;
use App\Repositories\Contracts\UserBonusRepositoryInterface;
use App\Repositories\Contracts\CompanySolicitationPaymentRepositoryInterface;
use App\Empresa;
use App\Subscriptions;
use App\SubscriptionGroup;
use App\UserSolicitacaoBonus;
use App\UserSubscriptionToken;
use App\CompanyMultipleUpload;
use App\Favorite;
use App\EmpresaRating;
use App\CompanySolicitationPayment;
use Auth;
use Session;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\UpdateUserRequest;
use App\User;
use Notification;
use App\Notifications\InvitationSubscriptionConfirmation;

class UsersController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function favorites($empresa, $create, Request $request)
    {
        $userId = Auth::user()->id;
        if ($create == '1') {
            $favorite = new Favorite();
            $favorite->user_id = $userId;
            $favorite->empresa_id = $empresa;
            $favorite->save();
            return back()->with('success', 'Empresa Favoritada!');
        } else if ($create == '0') {
            $favorite = Favorite::where('empresa_id', $empresa)->where('user_id', $userId)->first();
            if ($favorite != null) {
                $favorite->delete();
            }
            return back()->with('warning', 'Empresa Removida da lista de Favoritos!');
        }
    }

    public function profile(EmpresasRepositoryInterface $empresa_repository, LocalityRepositoryInterface $locality_repository, CategoriesRepositoryInterface $categories_repository)
    {
        $user = Auth::user();

        if ($user->cpf != null) {

            return view('users.profile');
        } else if ($user->cnpj != null) {
            $user = Auth::user();
            $empresa = Empresa::where('user_id', $user->id)->first();
            $categories = $empresa != null ? $empresa_repository->getCompanyCategories($empresa->id) : null;
            $uploads = $empresa != null ? CompanyMultipleUpload::where('empresa_id', $empresa->id)->get() : [];

            return view('users.profile_company', [
                'user' => $user,
                'count_empresa' => $empresa,
                'empresa' => $empresa,
                'empresa_categories' => $categories,
                'categories' => $categories_repository->getCategories(),
                'ufs' => $locality_repository->getUf(),
                'uploads' => $uploads,
            ]);
        }
    }



    public function truckplan()
    {
        $user = Auth::user();
        $subscription = Subscriptions::where('user_id', $user->id)->orderBy('created_at', 'DESC')->first();
        $mensagem = null;
        $mensalidade = null;
        $date = null;
        $invoices = [];
        $url = null;
        $fatura = null;
        $mainMember = false;
        $token = null;

        if ($subscription != null) {
            //             $invoices = $user->invoices();
            $fatura = $user->getInvoiceStatus();
            $token = UserSubscriptionToken::where('subscription_id', $subscription->id)->where('status', 'Ativo')->first();

            if ($token != null && $token->subscription->user_id == Auth::user()->id) {
                $mainMember = true;
            }
            if ($fatura == null) {
                $mensagem = 'Você ainda não está ativo em nenhum de nossos planos.';
                $subscription = new Subscriptions;
            } else if ($fatura == 'pending') {
                $mensagem = 'Você possuiu uma fatura pendente conosco.';
                $date = date("d/m/Y", strtotime($subscription->created_at));
                $mensalidade = $this->buscarValorPlano($subscription->iugu_plan);
                $url = $user->processUrlPayment();
            } else if ($fatura == 'paid') {
                $date = date("d/m/Y", strtotime($subscription->created_at));
                $mensalidade = $this->buscarValorPlano($subscription->iugu_plan);
            } else if ($fatura == 'expired') {
                $mensagem = 'Sua fatura expirou, gere uma nova clicando no botão abaixo.';
            }
        }
        else {
            return View('subscriber.become', ['activePlan' => null, 'message' => ""]);
        }

        return view('users.truck_subscription', [
            'subscription' => $subscription,
            'mensagem' => $mensagem,
            'mensalidade' => $mensalidade,
            'creation_date' => $date,
            'invoices' => $invoices,
            'url' => $url,
            'fatura' => $fatura,
            'token' => $token != null ? $token->token_acesso : null,
            'mainMember' => $mainMember
        ]);
    }

    public function plan()
    {
        $user = Auth::user();
        $subscription = Subscriptions::where('user_id', $user->id)->orderBy('created_at', 'DESC')->first();
        $mensagem = null;
        $mensalidade = null;
        $date = null;
        $invoices = [];
        $url = null;
        $fatura = null;
        $mainMember = false;
        $token = null;

        if ($subscription == null) {
            $subscriptionGroup = SubscriptionGroup::where('member_user_id', $user->id)->where('status', 'Ativo')->with(['userSubscriptionToken'])->first();
            if ($subscriptionGroup != null) {
                $subscriptionToken = UserSubscriptionToken::where('id', $subscriptionGroup->user_subscription_token_id)->with(['subscription'])->first();

                $subscription = Subscriptions::where('user_id', $subscriptionToken->subscription->user_id)->orderBy('created_at', 'DESC')->first();
                $user = User::find($subscriptionToken->subscription->user_id);
            }
        }
        if ($subscription != null) {
            //             $invoices = $user->invoices();
            $fatura = $user->getInvoiceStatus();
            $token = UserSubscriptionToken::where('subscription_id', $subscription->id)->where('status', 'Ativo')->first();

            if ($token != null && $token->subscription->user_id == Auth::user()->id) {
                $mainMember = true;
            }
            if ($fatura == null) {
                $mensagem = 'Você ainda não está ativo em nenhum de nossos planos.';
                $subscription = new Subscriptions;
            } else if ($fatura == 'pending') {
                $mensagem = 'Você possuiu uma fatura pendente conosco.';
                $date = date("d/m/Y", strtotime($subscription->created_at));
                $mensalidade = $this->buscarValorPlano($subscription->iugu_plan);
                $url = $user->processUrlPayment();
            } else if ($fatura == 'paid') {
                $date = date("d/m/Y", strtotime($subscription->created_at));
                $mensalidade = $this->buscarValorPlano($subscription->iugu_plan);
            } else if ($fatura == 'expired') {
                $mensagem = 'Sua fatura expirou, gere uma nova clicando no botão abaixo.';
                $subscription = new Subscriptions;
            }
        } else {
            $subscription = new Subscriptions;
            $mensagem = 'Você ainda não está ativo em nenhum de nossos planos.';
        }
        return view('users.subscription', [
            'subscription' => $subscription,
            'mensagem' => $mensagem,
            'mensalidade' => $mensalidade,
            'creation_date' => $date,
            'invoices' => $invoices,
            'url' => $url,
            'fatura' => $fatura,
            'token' => $token != null ? $token->token_acesso : null,
            'mainMember' => $mainMember
        ]);
    }

    public function buscarValorPlano($plano)
    {
        switch ($plano) {
            case 'IND':
                return '17,00';
                break;
            case 'FAM':
                return '37,00';
                break;
            case 'PRO':
                return '89,00';
                break;
            default:
                '';
        }
    }

    public function update(UpdateUserRequest $request, UsersRepositoryInterface $users_repository)
    {
        $users_repository->update($request);

        return back()->with('success', 'Seu dados foram atualizados com sucesso na nossa base de dados');
    }

    //     public function createCompanies(EmpresasRepositoryInterface $empresa_repository,CategoriesRepositoryInterface $categories_repository,LocalityRepositoryInterface $locality_repository)
    //     {
    //         if($empresa_repository->getCountCompanies())
    //             return view('users.my_companies', ['empresas' => $empresa_repository->getCompanies(),'categories' => $categories_repository->getCategories()]);
    //         else
    //             return view('users.my_company', ['count_empresa' => 0,'empresa' => null,'categories' => $categories_repository->getCategories(),'ufs' => $locality_repository->getUf()]);
    //     }

    public function createCompany($id = 0, EmpresasRepositoryInterface $empresa_repository, CategoriesRepositoryInterface $categories_repository, LocalityRepositoryInterface $locality_repository)
    {
        return view('users.my_company', [
            'count_empresa' => $id,
            'empresa' => $empresa_repository->getCompany($id),
            'empresa_categories' => $empresa_repository->getCompanyCategories($id),
            'categories' => $categories_repository->getCategories(),
            'ufs' => $locality_repository->getUf()
        ]);
    }

    public function storeCompany(UpdateUserRequest $request, EmpresasRepositoryInterface $empresa_repository, UsersRepositoryInterface $user_repository)
    {
        $data = $request->all();
        $cnpj = str_replace("-", "", str_replace("/", "", str_replace(".", "", $data['cnpj'])));

        if(isset($data['id'])) {
            $empresa = Empresa::where('cnpj', $cnpj)->where('id', '!=', $data['id'])->first();
            if($empresa != null) {
                $validator = $empresa_repository->validateStoreCompany($request);
                if ($validator) {
                    return redirect()->back()->withInput()->withErrors($validator);
                }
            }
            return $this->updateCompany($request, $empresa_repository, $user_repository, $cnpj);
        }

        $validator = $empresa_repository->validateStoreCompany($request);

        if ($validator) {
            return redirect()->back()->withInput()->withErrors($validator);
        }

        if ($empresa_repository->storeCompany($request)) {
            return redirect()->route('users_profile')
                ->with('success', 'Empresa cadastrada com sucesso!');
        } else {
            return back()->with('error', 'Não foi possivel cadastrar a empresa');
        }
    }

    public function updateCompany(Request $request, EmpresasRepositoryInterface $empresa_repository, UsersRepositoryInterface $user_repository, string $cnpj)
    {
        $validator = $empresa_repository->validateUpdateCompany($request);

        if ($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator);
        }

        $empresa = $empresa_repository->updateCompany($request);
        if ($empresa != null && $user_repository->updateLegalUser($cnpj, $empresa->user_id, $request)) {
            return redirect()->route('users_profile')
                ->with('success', 'Empresa atualizada com sucesso!');
        } else {
            return back()->with('error', 'Não foi possivel atualizar a empresa');
        }
    }

    public function businessPartner(SociosRepositoryInterface $socios_repository)
    {
        return view('users.business_partner', ['socios' => $socios_repository->getBusinessPartner()]);
    }

    public function addBusinessPartner(Request $request, SociosRepositoryInterface $socios_repository)
    {

        if ($socios_repository->addBusinessPartner($request)) {
            return back()->with('success', 'Sócio adicionado com sucesso');
        } else {
            return back()->with('error', 'Não foi possivel enviar o convite, verifique se você digitou um código valido');
        }
    }

    public function removeBusinessPartner($id, SociosRepositoryInterface $socios_repository)
    {

        if ($socios_repository->removeBusinessPartner($id)) {
            return back()->with('success', 'Sócio removido com sucesso');
        } else {
            return back()->with('error', 'Não foi possivel remover o sócio');
        }
    }

    public function Payments(UsersRepositoryInterface $users_repository)
    {
        return view('users.payments', ['pagamentos' => $users_repository->Payments()]);
    }

    public function Referrals(UsersRepositoryInterface $users_repository)
    {
        $user = Auth::user();

        if ($user->cnpj != null) {
            return view('users.referrals_company', ['convidados' => $users_repository->Referrals()]);
        }
        return view('users.referrals', ['convidados' => $users_repository->Referrals()]);
    }

    public function Bonus(UserSolicitacaoBonusRepositoryInterface $repository)
    {
        $user = Auth::user();

        if ($user->cnpj != null) {
            $empresa = Empresa::where('cnpj', $user->cnpj)->first();
            return view('users.bonus_company', [
                'empresa' => $empresa != null ? $empresa : new Empresa(),
                'solicitacoes' =>  $empresa != null ? $repository->getByUserCompany($empresa->id) : null
            ]);
        } else {
            return view('users.bonus', [
                'empresa' => null,
                'solicitacoes' => $repository->getAllByUser()
            ]);
        }
    }
    public function filterLocation(LocalityRepository $locality_repository)
    {
        return view('users.filter_location', [
            'selectedEstado' => '',
            'estados' => $locality_repository->getEstados()
        ]);
    }
    public function filterSegment(CategoriesRepositoryInterface $categories_repository)
    {
        return view('users.filter_segment', [
            'categorias' => $categories_repository->getCategories()
        ]);
    }
    public function filterEstablishment($id, EmpresasRepositoryInterface $empresa_repository)
    {
        return view('users.filter_establishment', [
            'empresas' => $empresa_repository->getCompaniesbyCategoryRatings($id)
        ]);
    }
    public function companyByCategorys(Request $request, EmpresasRepositoryInterface $empresa_repository)
    {
        return view('users.filter_establishment', [
            'empresas' => $empresa_repository->getAllCompanies()
        ]);
    }

    public function resgateBonusFiltrar(Request  $request, UserBonusRepositoryInterface $Userbonus_repository, CategoriesRepositoryInterface $categories_repository, EmpresasRepositoryInterface $empresa_repository)
    {
        if ($request->step == "1") {
            return view('users.filter_segment', [
                'categorias' => $categories_repository->getCategories(),
                'estado'   =>  $request->estado,
                'cidade'   =>  $request->cidade
            ]);
        } else if ($request->step == "2") {
            $empresas = $empresa_repository->getCompaniesbyUfCityAndCategory($request);
            return view('users.filter_establishment', [
                'empresas' => $empresas->withQueryString(),
                'categorias' => $request->categoria,
                'semEmpresa' => $empresas->count() == 0,
            ]);
        } else if ($request->step == "3") {
            $empresaSelec = $empresa_repository->getCompanyByCnpj($request->empresa);
            $userBonus = $Userbonus_repository->getByUser();

            return view('users.filter_bonus', [
                'empresa' => $empresaSelec,
                'saldo'   => $userBonus
            ]);
        } else {
            echo $request->cidade;
        }
    }

    public function getAllEstablishment(EmpresasRepositoryInterface $empresa_repository)
    {
        return view('users.filter_establishment', ['empresas' => $empresa_repository->getAllCompanies()]);
    }
    public function filterBonus()
    {
        return view('users.filter_bonus');
    }
    public function checkoutComplete()
    {
        return view('users.checkout_complete');
    }

    #	public function Bonus(UsersRepositoryInterface $users_repository)
    #    {
    #        return view('users.bonus', ['bonus' => $users_repository->Bonus()]);
    #    }

    public function StoreReferrals(Request $request, UsersRepositoryInterface $users_repository)
    {
        if ($users_repository->StoreReferrals($request))
            return back()->with('success', 'O convite foi enviado');
        else
            return back()->with('error', 'Não foi possivel enviar o convite');
    }

    //    public function backPageFilter($estado, $cidade, LocalityRepositoryInterface $locality_repository){
    //        $selectedEstado = $estado;
    //        $estados = $locality_repository->getEstados();
    //        $selectedCidade = $cidade;
    //        return view('users.filter_location', compact('selectedEstado','estados', 'selectedCidade'));
    //    }
    //
    //    public function backPageFilterSegment($categories, CategoriesRepositoryInterface $categories_repository){
    //        return view('users.filter_segment', [
    //            'categorias' => $categories_repository->getCategories(),
    //            'selected'  =>  $categories
    //        ]);
    //    }

    public function storeAvatar(Request $request, UsersRepositoryInterface $users_repository)
    {
        if ($users_repository->storeAvatar($request)) {
            if (Auth::user()->cpf != null) {
                return redirect()->route('users_profile')
                    ->with('success', 'Imagem de perfil atualizada com sucesso!');
            } else if (Auth::user()->cnpj != null) {
                return redirect()->route('users_profile')
                    ->with('success', 'Imagem de perfil atualizada com sucesso!');
            }
        } else {
            return back()->with('error', 'Não foi atualizar a imagem de perfil!');
        }
    }

    public function ratingConfirmation(Request $request)
    {
        $data = $request->all();

        $finalRating = 0;

        if (isset($data['ratings'])) {
            $finalRating = $data['ratings'];
        } else {
            //finaliza sem salvar
            return redirect()->route('user_bonus');
        }

        $empresa = $data['empresa'];
        $userId = Auth::user()->id;
        $empresaRatingOrigin = EmpresaRating::where('empresa_id', $empresa)->where('user_id', $userId)->first();

        if ($empresaRatingOrigin != null) {
            $empresaRatingOrigin->rating = $finalRating;
            $empresaRatingOrigin->save();
        } else {
            $empresaRating = new EmpresaRating();
            $empresaRating->user_id = $userId;
            $empresaRating->empresa_id = $empresa;
            $empresaRating->rating = $finalRating;
            $empresaRating->save();
        }

        return redirect()->route('user_bonus')->with('success', 'Avaliação enviada. Obrigado!');
    }

    public function rating(Request $request)
    {
        $empresaId = preg_replace('/[^0-9]/', '', decrypt($request->all()['data']));

        $empresaRating = EmpresaRating::where('empresa_id', intval($empresaId))
            ->where('user_id', Auth::user()->id)->first();

        $ratings = 0;
        if ($empresaRating != null) {
            $ratings = $empresaRating->rating;
        }

        $empresa = Empresa::where('id', intval($empresaId))->first();
        $ratingScore = $empresa->calculateRatingScore();
        $stars = $empresa->calculateStarRatingScore($ratingScore);
        $halfStars = $empresa->calculateHalfStarRatingScore($ratingScore);

        return view('users.rating', [
            'ratings' => $ratings,
            'empresa' => $empresa,
            'halfStars' => $halfStars,
            'stars' => $stars,
            'ratingScore' => $ratingScore,
        ]);
    }

    public function storeBonusPayment(Request $request, CompanySolicitationPaymentRepositoryInterface $repository)
    {
        $created = $repository->store($request);
        $solicitacoes = UserSolicitacaoBonus::with(['user', 'empresa', 'solicitationPayment'])->paginate(5);

        if ($created) {
            Session::flash('success', 'Comprovante anexado com sucesso!');
        } else {
            Session::flash('error', 'Houve um erro ao tentar anexar o comprovante, tente novamente em alguns instantes.');
        }

        return redirect()->route('admin.bonus.index')->with(['solicitacoes' => $solicitacoes, 'admin' => Auth::user()]);
    }

    public function downloadAsset($id)
    {
        $solicId = preg_replace('/[^0-9]/', '', decrypt($id));
        $asset = CompanySolicitationPayment::where('solicitacao_id', $solicId)->first();
        //         $assetPath = Storage::disk('s3')->url('comprovantes/'.$asset->filename);
        //         $contents = Storage::url('comprovantes/0021302021030119187205000156603c338a1f665-19187205000156-93-00213020210301.png');
        //         $exists = Storage::disk('s3')->exists('comprovantes/');

        //         header("Cache-Control: public");
        //         header("Content-Description: File Transfer");
        //         header("Content-Disposition: attachment; filename=" . basename($assetPath));
        //         header("Content-Type: " . 'image');

        return response()->download(public_path('storage/comprovantes/' . $asset->filename));
        //         return readfile($assetPath);
    }

    public function sendinvitationTokenEmail(Request $request)
    {
        //enviar email para usuario principal com link
        $request['nome'] = Auth::user()->name;
        $request['sobrenome'] = Auth::user()->sobrenome;

        Notification::route('mail', $request['email'])->notify(new InvitationSubscriptionConfirmation($request));
    }

    public function alterPlano(Request $request)
    {
        $user = Auth::user();
        $subscription = Subscriptions::where('user_id', $user->id)->orderBy('created_at', 'DESC')->first();

        $request['name'] = $request->iugu_plan;
        $subscription->update($request->all());

        return redirect()->route('users_truckplan');
    }
}
