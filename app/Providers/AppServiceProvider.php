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
        $this->app->bind('App\Repositories\Contracts\Daerah', 'App\Repositories\Implementation\Daerah');
        $this->app->bind('App\Repositories\Contracts\Jabatan', 'App\Repositories\Implementation\Jabatan');
        $this->app->bind('App\Repositories\Contracts\KelompokMetodePengujian', 'App\Repositories\Implementation\KelompokMetodePengujian');
        $this->app->bind('App\Repositories\Contracts\Laboratorium', 'App\Repositories\Implementation\Laboratorium');
        $this->app->bind('App\Repositories\Contracts\TargetPengujian', 'App\Repositories\Implementation\TargetPengujian');
        $this->app->bind('App\Repositories\Contracts\MetodePengujian', 'App\Repositories\Implementation\MetodePengujian');
        $this->app->bind('App\Repositories\Contracts\Pegawai', 'App\Repositories\Implementation\Pegawai');
        $this->app->bind('App\Repositories\Contracts\KodeHs', 'App\Repositories\Implementation\KodeHs');
        $this->app->bind('App\Repositories\Contracts\KelompokSample', 'App\Repositories\Implementation\KelompokSample');
        $this->app->bind('App\Repositories\Contracts\Satuan', 'App\Repositories\Implementation\Satuan');
        $this->app->bind('App\Repositories\Contracts\Upt', 'App\Repositories\Implementation\Upt');
        $this->app->bind('App\Repositories\Contracts\TargetUjiGolongan', 'App\Repositories\Implementation\TargetUjiGolongan');
        $this->app->bind('App\Repositories\Contracts\TargetPest', 'App\Repositories\Implementation\TargetPest');
        $this->app->bind('App\Repositories\Contracts\JenisPengujian', 'App\Repositories\Implementation\JenisPengujian');
        $this->app->bind('App\Repositories\Contracts\Perusahaan', 'App\Repositories\Implementation\Perusahaan');
        $this->app->bind('App\Repositories\Contracts\Negara', 'App\Repositories\Implementation\Negara');
        $this->app->bind('App\Repositories\Contracts\MediaTranspor', 'App\Repositories\Implementation\MediaTranspor');
        $this->app->bind('App\Repositories\Contracts\Kegiatan', 'App\Repositories\Implementation\Kegiatan');
        $this->app->bind('App\Repositories\Contracts\DokterHewan', 'App\Repositories\Implementation\DokterHewan');
        $this->app->bind('App\Repositories\Contracts\Kategori', 'App\Repositories\Implementation\Kategori');
        $this->app->bind('App\Repositories\Contracts\Sample', 'App\Repositories\Implementation\Sample');
        $this->app->bind('App\Repositories\Contracts\Permohonan', 'App\Repositories\Implementation\Permohonan');
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return array(
            'App\Repositories\Contracts\Daerah',
            'App\Repositories\Contracts\Jabatan',
            'App\Repositories\Contracts\KelompokMetodePengujian',
            'App\Repositories\Contracts\Laboratorium',
            'App\Repositories\Contracts\TargetPengujian',
            'App\Repositories\Contracts\MetodePengujian',
            'App\Repositories\Contracts\Pegawai',
            'App\Repositories\Contracts\KodeHs',
            'App\Repositories\Contracts\KelompokSample',
            'App\Repositories\Contracts\Satuan',
            'App\Repositories\Contracts\Upt',
            'App\Repositories\Contracts\TargetUjiGolongan',
            'App\Repositories\Contracts\TargetPest',
            'App\Repositories\Contracts\JenisPengujian',
            'App\Repositories\Contracts\Perusahaan',
            'App\Repositories\Contracts\Negara',
            'App\Repositories\Contracts\MediaTranspor',
            'App\Repositories\Contracts\Kegiatan',
            'App\Repositories\Contracts\DokterHewan',
            'App\Repositories\Contracts\Kategori',
            'App\Repositories\Contracts\Sample',
            'App\Repositories\Contracts\Permohonan',
        );
    }
}
