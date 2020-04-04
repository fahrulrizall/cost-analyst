<?php

namespace App\Providers;

use App\Fg;
use App\Mac;
use App\Packaging;
use App\Pt;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * This namespace is applied to your controller routes.
     *
     * In addition, it is set as the URL generator's root namespace.
     *
     * @var string
     */
    protected $namespace = 'App\Http\Controllers';

    /**
     * The path to the "home" route for your application.
     *
     * @var string
     */
    public const HOME = '/home';

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */
    public function boot()
    {
        Route::bind('pt', function ($slug) {

            $episode = Pt::where('pt_name', $slug);
        
            // if (request()->route()->hasParameter('anime')) {
            //     $episode->whereHas('anime', function ($q) {
            //         $q->where('slug', request()->route('anime'));
            //     });
            // }
            return $episode->firstOrFail();
        });

        Route::bind('id', function ($slug) {
            $episode = Pt::where('id', $slug);
            return $episode->firstOrFail();
        });

        Route::bind('plantfgs', function ($slug) {
            $episode = Fg::where('plant', $slug);
            return $episode->firstOrFail();
        });

        Route::bind('plantmacs', function ($slug) {
            $episode = Mac::where('plant', $slug);
            return $episode->firstOrFail();
        });

        Route::bind('plantpts', function ($slug) {
            $episode = Pt::where('plant', $slug);
            return $episode->firstOrFail();
        });

        Route::bind('plantpackagings', function ($slug) {
            $episode = Packaging::where('plant', $slug);
            return $episode->firstOrFail();
        });

        // Route::bind('plantpackagings', function ($slug) {
        //     $episode = Packaging::where('plant', $slug);
        //     return $episode->firstOrFail();
        // });

        parent::boot();
    }

    /**
     * Define the routes for the application.
     *
     * @return void
     */
    public function map()
    {
        $this->mapApiRoutes();

        $this->mapWebRoutes();

        //
    }

    /**
     * Define the "web" routes for the application.
     *
     * These routes all receive session state, CSRF protection, etc.
     *
     * @return void
     */
    protected function mapWebRoutes()
    {
        Route::middleware('web')
             ->namespace($this->namespace)
             ->group(base_path('routes/web.php'));
    }

    /**
     * Define the "api" routes for the application.
     *
     * These routes are typically stateless.
     *
     * @return void
     */
    protected function mapApiRoutes()
    {
        Route::prefix('api')
             ->middleware('api')
             ->namespace($this->namespace)
             ->group(base_path('routes/api.php'));
    }
}
