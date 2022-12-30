<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use Illuminate\Support\Facades\URL;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            'App\Repositories\Contracts\UsersRepositoryInterface',
            'App\Repositories\UsersRepository'
        );

        $this->app->bind(
            'App\Repositories\Contracts\SociosRepositoryInterface',
            'App\Repositories\SociosRepository'
        );

        $this->app->bind(
            'App\Repositories\Contracts\EmpresasRepositoryInterface',
            'App\Repositories\EmpresasRepository'
        );

        $this->app->bind(
            'App\Repositories\Contracts\PagseguroRepositoryInterface',
            'App\Repositories\PagseguroRepository'
        );

        $this->app->bind(
            'App\Repositories\Contracts\CategoriesRepositoryInterface',
            'App\Repositories\CategoriesRepository'
        );

        $this->app->bind(
            'App\Repositories\Contracts\LocalityRepositoryInterface',
            'App\Repositories\LocalityRepository'
        );

        $this->app->bind(
            'App\Repositories\Contracts\UserBonusRepositoryInterface',
            'App\Repositories\UserBonusRepository'
        );

        $this->app->bind(
            'App\Repositories\Contracts\UserSolicitacaoBonusRepositoryInterface',
            'App\Repositories\UserSolicitacaoBonusRepository'
        );
        
        $this->app->bind(
            'App\Repositories\Contracts\CompanySolicitationPaymentRepositoryInterface',
            'App\Repositories\CompanySolicitationPaymentRepository'
        );
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
       if(config('app.env')==='production'){
            URL::forceScheme('https');
        }
    }
}
