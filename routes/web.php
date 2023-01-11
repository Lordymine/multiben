<?php

use App\CategoriaEmpresa;
use App\Http\Controllers\WorksController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Correções de convenções (PSR-12)

Route::get('/', 'HomeController@index')->name('index');
Route::get('/', 'HomeController@index')->name('index');
Route::post('/get-cidades', 'LocalityController@getCidadesHtml');
Route::get('/companies-partner', 'CompaniesController@indexPartner')->name('companies-partner');
Route::get('/companies', 'CompaniesController@companyInfoAll')->name('companies_info_all');
Route::get('/convite/{token?}', 'HomeController@convite')->name('token_convite');

// 20 - Área de Administraćão da empresa
// 20.1 - Tela para Visualizar Usuários na plataforma
Route::get('/admin', 'AdminController@users')->middleware(['auth', 'checkprivileges'])->name('admin');
Route::get('/admin/users', 'AdminController@listUsers')->middleware(['auth', 'checkprivileges'])->name('admin.users.index');
Route::get('/admin/users/create', 'AdminController@createUser')->middleware(['auth', 'checkprivileges'])->name('admin.users.create');
Route::post('/admin/users/store', 'AdminController@storeUser')->middleware(['auth', 'checkprivileges'])->name('admin.users.store');
Route::get('/admin/users/{user}', 'AdminController@showUser')->middleware(['auth', 'checkprivileges'])->name('admin.users.show');
Route::get('/admin/users/edit/{user}', 'AdminController@updateUser')->middleware(['auth', 'checkprivileges'])->name('admin.users.edit');
Route::post('/admin/users/update/{user}', 'AdminController@updateUser')->middleware(['auth', 'checkprivileges'])->name('admin.users.update');
Route::post('/admin/users/{user}', 'AdminController@deleteUser')->middleware(['auth', 'checkprivileges'])->name('admin.users.delete');
Route::post('/admin/send-marketing-mail', 'AdminController@sendMarketingMail')->middleware(['auth', 'checkprivileges'])->name('admin.send.marketing.mail');
// 20. 2 - Tela para Visualizar Empresa na plataforma
Route::get('/admin/companies', 'AdminController@companies')->middleware(['auth', 'checkprivileges'])->name('admin.companies.index');
// 20.3 - Tela atribuir bônus por indicaćão
Route::get('/admin/bonus', 'AdminController@bonus')->middleware(['auth', 'checkprivileges'])->name('admin.bonus.index');
//20.7 - Tela para visualizar quanto de dinheiro tem e uma lista detalhada de tudo o que está entrando de dinheiro
Route::get('/admin/payments', 'AdminController@payments')->middleware(['auth', 'checkprivileges'])->name('admin.payments.index');
// 20.4 - Tela de dashboard dos dados que estão ativos
Route::get('/admin/dashboard', 'AdminController@dashboard')->middleware(['auth', 'checkprivileges'])->name('admin.dashboard.index');
// 20.5 - Tela para visualizar todos os servićos cadastrados na plataforma
Route::get('/admin/services', 'AdminController@services')->middleware(['auth', 'checkprivileges'])->name('admin.services.index');
// 20.6 - Tela para visualizar os sócios da empresa
Route::get('/admin/partner', 'AdminController@partner')->middleware(['auth', 'checkprivileges'])->name('admin.partner.index');
// 20.7 - Tela para visualizar quanto de dinheiro tem e uma lista detalhada de tudo o que está entrando de dinheiro
Route::get('/admin/financial', 'AdminController@financial')->middleware(['auth', 'checkprivileges'])->name('admin.financial.index');
// 20.8 - Tela para visualizar todas as indicaćões feitas no sistema
Route::get('/admin/referrals', 'AdminController@referrals')->middleware(['auth', 'checkprivileges'])->name('admin.referrals.index');
Route::get('/admin/marketing', 'AdminController@marketing')->middleware(['auth', 'checkprivileges'])->name('admin.marketing.index');

Route::get('/empresa/acesso', 'EmpresasController@acesso')->name('empresa.acesso');

Route::group(['prefix' => 'users'], function () {

//     Route::get('/profile', function () {
//         return view('users.profile');
//     })->name('users_profile')->middleware('auth');
    Route::get('/profile', 'UsersController@profile')->name('users_profile');
    Route::get('/profile_partner', 'UsersController@profile')->name('users_profile_partner');
    Route::get('/truckplan', 'UsersController@truckplan')->name('users_truckplan');
    Route::get('/plan', 'UsersController@plan')->name('users_plan');
    Route::post('/alter_plano', 'UsersController@alterPlano')->name('alter_plano');
    Route::post('/invitation-token-email', 'UsersController@sendinvitationTokenEmail')->name('invitation_token_email');

    Route::post('update', 'UsersController@update')->name('user_update');
    Route::get('create-company/{id?}', 'UsersController@createCompany')->name('user_create_company');
    Route::post('store-company', 'UsersController@storeCompany')->name('user_store_company');
    Route::post('bonus-solicitation-company-payment', 'UsersController@storeBonusPayment')->name('bonus_solicitation_company_payment');
    Route::get('download-comprovante/{id}', 'UsersController@downloadAsset')->name('download_comprovante');
    Route::post('update-company', 'UsersController@updateCompany')->name('user_update_company');
    Route::get('create-companies', 'UsersController@createCompanies')->name('user_create_companies');
    Route::get('business-partner', 'UsersController@businessPartner')->name('user_business_partner');
    Route::post('add-business-partner', 'UsersController@addBusinessPartner')->name('user_add_business_partner');
    Route::get('remove-business-partner/{id}', 'UsersController@removeBusinessPartner')->name('user_remove_business_partner');
    Route::get('payments', 'UsersController@Payments')->name('user_payments');
    Route::get('referrals', 'UsersController@Referrals')->name('user_referrals');
    Route::post('store-referrals', 'UsersController@storeReferrals')->name('user_store_referrals');
    Route::post('alter-avatar', 'UsersController@storeAvatar')->name('alter_avatar');
    Route::get('bonus', 'UsersController@Bonus')->name('user_bonus');
    Route::get('resgate-bonus-filtrar-localizacao', 'UsersController@filterLocation')->name('filter_location');
    Route::get('resgate-bonus-filtrar-segmento', 'UsersController@filterSegment')->name('filter_segment');
    Route::get('resgate-bonus-filtrar-estabelecimento/{id}', 'UsersController@filterEstablishment')->name('filter_establishment');
    Route::get('resgate-bonus-filtrar-estabelecimento', 'UsersController@getAllEstablishment')->name('filter_establishment');
    Route::get('resgate-bonus-filtrar-estabelecimento-category', 'UsersController@companyByCategorys')->name('filter_location_estabelecimento_category');
    Route::get('resgate-bonus-filtrar-bonus', 'UsersController@filterBonus')->name('filter_bonus');
    Route::get('resgate-realizado-com-sucesso', 'UsersController@checkoutComplete')->name('checkout_complete');
    Route::get('bonus-gerar-voucher', 'BonusController@gerarVoucher')->name('bonus-gerar-voucher');
    Route::get('bonus-concluir-voucher', 'BonusController@concluirVoucher')->name('bonus-concluir-voucher');
    Route::get('solicitation-detail/{solicitacaoId}', 'BonusController@findSolicitationDetail')->name('solicitation-detail');

    //favorite
    Route::get('user-favorite/{empresa}/{create}', 'UsersController@favorites')->name('user_favorite');

    //filtros do bonus
    Route::get('/getCitys/{uf}', 'LocalityController@getCidadeByUf')->name('getCidadeByUf');
    Route::get('filtro-bonus', 'UsersController@resgateBonusFiltrar')->name('resgate-bonus-filtrar');
    Route::post('bonus-solicitation', 'BonusController@bonusSolicitation')->name('bonus_solicitation');
    Route::post('bonus-solicitation-company', 'BonusController@bonusSolicitationCompany')->name('bonus_solicitation_company');
    Route::post('plano-solicitation', 'PlanoController@planoSolicitation')->name('plano_solicitation');

    //rating
    Route::post('rating-confirmation', 'UsersController@ratingConfirmation')->name('rating_confirmation');
    Route::get('company-rating', 'UsersController@rating')->name('company_rating');

/*     Route::post('plano-solicitation-confirmation', 'PlanoController@planoConfirmation')->name
        ('plano_solicitation_confirmation'); */

    //IUGU
//     Route::get('assinar-plano-passo-1','PlanoController@index');
//     Route::get('/assinatura-realizada-com-sucesso','SubscriberController@subscribe')->name('assinatura-realizada-com-sucesso');
    Route::post('finalizar-assinatura', 'SubscriberController@subscribe')->name('finalizar_assinatura');

//    Route::get('back-page-filter/{estado}/{cidade?}','UsersController@backPageFilter')->name('back_page_filter');
//    Route::get('back-page-filter-segment/{categories?}','UsersController@backPageFilterSegment')->name('back_page_filter_segment');
});

Route::group(['prefix' => 'categories'], function () {

    Route::get('/{id}', 'CategoriesController@index')->name('categories_index');
});

Route::group(['prefix' => 'companies'], function () {

    Route::get('/{id}', 'CompaniesController@index')->name('companies_index');
    Route::get('/info/{id}', 'CompaniesController@companyInfo')->name('companies_info');
    // Filtro para Parceiros e Conveniados
    //Route::get('/admin', 'AdminController@empresascategorias')->name('empresas_categorias');
    Route::post('/por-cidade', 'CompaniesController@companyByCity');
    Route::post('/por-desconto', 'CompaniesController@companyByDeduction');
});

Route::group(['prefix' => 'empresas_admin'], function () {

    Route::get('/', 'CompaniesAdminController@index')->name('companies_admin_index');
    Route::get('/confirma_codigo', 'CompaniesAdminController@checkCustomersCode')->name('companies_admin_check_customers_code');
    Route::post('/pesquisar-codigo', 'CompaniesAdminController@searchCustomersCode');
    Route::post('/salvar-codigo', 'CompaniesAdminController@storeCustomersCode')->name('companies_admin_store_customers_code');
    Route::get('/lista_clientes', 'CompaniesAdminController@customersList')->name('companies_admin_customers_list');
    Route::get('/lista_pagamentos_usados', 'CompaniesAdminController@multbenUsedPayments')->name('companies_admin_multben_used_payments');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('seja-assinante', 'SubscriberController@become')->name('subscriber_become');
Route::get('assinar-plano-passo-1', 'SubscriberController@personalData')->name('subscriber_personal_data');
Route::get('assinar-plano-passo-2', 'SubscriberController@addressData')->name('subscriber_address_data');
Route::get('assinar-plano-passo-3', 'SubscriberController@payment')->name('subscriber_payment');
Route::get('/assinar-plano/{price}/{description}', 'SubscriberController@reviewBecome')->name('assinar_plano');
Route::get('assinar-plano-passo-4', 'SubscriberController@review')->name('subscriber_review');
// Route::get('plano/{invoice}', 'SubscriberController@downloadInvoice')->name('subscriber_download_invoice');
// Route::get('assinatura-realizada-com-sucesso', 'SubscriberController@checkout')->name('subscriber_checkout_complete');
Route::get('/find-by-registratrion/{stateId}', [WorksController::class, 'searchUserRegistration']);

Route::get('contato', 'ContactController@contact')->name('contact');
Route::post('contact', 'ContactController@postContact')->name('contact.send');

Route::get('politica-de-privacidade', 'PrivacyController@privacyPolicy')->name('privacy_policy');

Route::get('termos-e-condicoes-de-uso', 'PrivacyController@termsConditions')->name('terms_conditions');

Route::get('quem-somos', 'AboutController@aboutUs')->name('about_us');

Route::get('como-funciona', 'WorksController@howItworks')->name('how_works');

Route::get('perguntas-frequentes', 'FaqController@Faq')->name('faq');
Route::get('perguntas-frequentes-assinante', 'FaqController@faqAssinante')->name('faq_assinante');
Route::get('perguntas-frequentes-parceiro', 'FaqController@faqParceiro')->name('faq_parceiro');
Route::get('perguntas-frequentes-conveniados', 'FaqController@faqConveniados')->name('faq_conveniados');

Route::post('pesquisar', 'HomeController@searchCategories')->name('pesquisar');
Route::post('filtrar-home', 'HomeController@sortingEmpresas')->name('filtrar-home');

Route::get('empresa', 'EmpresaAuthController@acesso')->name('empresa.acesso');
Route::post('empresa', 'EmpresaAuthController@autentica')->name('empresa.autentica');

// Route::post('plan-confirmation-iugu', 'PlanoController@planoConfirmationIugu')->name('plan-confirmation-iugu');
Route::post('plan-cancelation-iugu', 'IuguWebHookController@cancelSubscription');//teste para ver se funciona no servidor
Route::post('plan-confirmation-iugu', 'IuguWebHookController@changeSubscriptionStatus');//teste para ver se funciona no servidor
Route::post('webhook', '\Potelo\GuPayment\Http\Controllers\WebhookController@handleWebhook');

// forçando voltar p branch anterior

Auth::routes();
