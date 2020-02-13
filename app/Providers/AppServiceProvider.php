<?php

namespace App\Providers;

use App\Models\Post;
use App\Observers\PostObserver;
use Illuminate\Database\Events\QueryExecuted;
use Illuminate\Support\Facades\DB;
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
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Post::observe(PostObserver::class);
        //Permet de voir les requetes sql sur la console de commandes
        if($this->app->environment() === 'local')
        {
            DB::listen(function(QueryExecuted $query){
                file_put_contents('php://stdout', "\e[34m{$query->sql}\t\e[37m".json_encode($query->bindings)."\t\e[32m{$query->time}ms\e[0m\n");
            });
        }
    }
}
