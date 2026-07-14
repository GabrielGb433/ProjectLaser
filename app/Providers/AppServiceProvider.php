<?php

namespace App\Providers;

use App\Models\ConfiguracaoSite;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Illuminate\View\View as ViewInstance;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->scoped('site.configuracao', fn (): ?ConfiguracaoSite => ConfiguracaoSite::query()->first());
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        View::composer(['layouts.site', 'pages.*', 'components.site.logo'], function (ViewInstance $view): void {
            $view->with('configuracaoSite', app('site.configuracao'));
        });
    }
}
