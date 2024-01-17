<?php

namespace App\Providers;

use App\Repositories\Eloquent\ProdutorRepository\ProdutorRepository;
use App\Repositories\Eloquent\PropriedadeRepository;
use Core\Domain\Repository\IProdutorRepository;
use Core\Domain\Repository\IPropriedadeRepository;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(
            IProdutorRepository::class,
            ProdutorRepository::class
        );
        $this->app->singleton(
            IPropriedadeRepository::class,
            PropriedadeRepository::class
        );
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
