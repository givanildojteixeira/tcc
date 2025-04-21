<?php

namespace App\Providers;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Schema::defaultStringLength(191);

        Blade::if('acessoAssistente', function () {
            return in_array(auth()->user()->level, ['Assistente','Gerente', 'Diretor', 'admin']);
        });


        Blade::if('acessoGerente', function () {
            return in_array(auth()->user()->level, ['Gerente', 'Diretor', 'admin']);
        });

        Blade::if('acessoDiretor', function () {
            return in_array(auth()->user()->level, ['Diretor', 'admin']);
        });

        Blade::if('acessoAdmin', function () {
            return auth()->user()->level === 'admin';
        });
    }

}
