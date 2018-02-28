<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use App\Categorie;
use App\Observers\CategorieObserver;
use App\Album;
use App\Observers\AlbumObserver;
use App\Photo;
use App\Observers\PhotoObserver;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
         Photo::observe(PhotoObserver::class);
         Album::observe(AlbumObserver::class);
         Categorie::observe(CategorieObserver::class);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
