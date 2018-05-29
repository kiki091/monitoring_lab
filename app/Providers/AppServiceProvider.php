<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('App\Repositories\Contracts\MasterKategori', 'App\Repositories\Implementation\MasterKategori');
        $this->app->bind('App\Repositories\Contracts\MasterDokter', 'App\Repositories\Implementation\MasterDokter');
        $this->app->bind('App\Repositories\Contracts\MasterPerusahaan', 'App\Repositories\Implementation\MasterPerusahaan');
        $this->app->bind('App\Repositories\Contracts\KarantinaTumbuhan', 'App\Repositories\Implementation\KarantinaTumbuhan');
        $this->app->bind('App\Repositories\Contracts\SampleTumbuhan', 'App\Repositories\Implementation\SampleTumbuhan');
        $this->app->bind('App\Repositories\Contracts\MasterUpt', 'App\Repositories\Implementation\MasterUpt');
        $this->app->bind('App\Repositories\Contracts\MasterLaboraorium', 'App\Repositories\Implementation\MasterLaboraorium');
        $this->app->bind('App\Repositories\Contracts\DaftarDaerah', 'App\Repositories\Implementation\DaftarDaerah');
        $this->app->bind('App\Repositories\Contracts\MasterKegiatan', 'App\Repositories\Implementation\MasterKegiatan');
        $this->app->bind('App\Repositories\Contracts\TargetPengujian', 'App\Repositories\Implementation\TargetPengujian');
        $this->app->bind('App\Repositories\Contracts\MetodePengujian', 'App\Repositories\Implementation\MetodePengujian');
        $this->app->bind('App\Repositories\Contracts\DaftarPengujian', 'App\Repositories\Implementation\DaftarPengujian');
        $this->app->bind('App\Repositories\Contracts\KelompokPengujian', 'App\Repositories\Implementation\KelompokPengujian');
        $this->app->bind('App\Repositories\Contracts\Penugasan', 'App\Repositories\Implementation\Penugasan');
        $this->app->bind('App\Repositories\Contracts\HasilLaboratorium', 'App\Repositories\Implementation\HasilLaboratorium');
        $this->app->bind('App\Repositories\Contracts\Korfug', 'App\Repositories\Implementation\Korfug');
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return array(
            'App\Repositories\Contracts\MasterKategori',
            'App\Repositories\Contracts\MasterDokter',
            'App\Repositories\Contracts\MasterPerusahaan',
            'App\Repositories\Contracts\KarantinaTumbuhan',
            'App\Repositories\Contracts\SampleTumbuhan',
            'App\Repositories\Contracts\MasterUpt',
            'App\Repositories\Contracts\MasterLaboraorium',
            'App\Repositories\Contracts\DaftarDaerah',
            'App\Repositories\Contracts\MasterKegiatan',
            'App\Repositories\Contracts\TargetPengujian',
            'App\Repositories\Contracts\MetodePengujian',
            'App\Repositories\Contracts\DaftarPengujian',
            'App\Repositories\Contracts\KelompokPengujian',
            'App\Repositories\Contracts\Penugasan',
            'App\Repositories\Contracts\HasilLaboratorium',
            'App\Repositories\Contracts\Korfug',
        );
    }
}
