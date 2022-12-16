<?php

namespace App\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * The path to the "home" route for your application.
     *
     * This is used by Laravel authentication to redirect users after login.
     *
     * @var string
     */
    public const HOME = '/home';

    /**
     * The controller namespace for the application.
     *
     * When present, controller route declarations will automatically be prefixed with this namespace.
     *
     * @var string|null
     */
    // protected $namespace = 'App\\Http\\Controllers';

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */
    public function boot()
    {
        $this->configureRateLimiting();

        $this->routes(function () {
            Route::prefix('api')
                ->middleware('api')
                ->namespace($this->namespace)
                ->group(base_path('routes/api.php'));

            Route::middleware('web')
                ->namespace($this->namespace)
                ->group(base_path('routes/web.php'));

            Route::prefix('auth')
                ->middleware('api')
                ->namespace($this->namespace)
                ->group(base_path('routes/auth_api.php'));

            Route::prefix('verification')
                ->middleware('api')
                ->namespace($this->namespace)
                ->group(base_path('routes/verification_api.php'));

            Route::prefix('member_api')
                ->middleware('api')
                ->namespace($this->namespace)
                ->group(base_path('routes/member_api.php'));

            Route::prefix('proposal_api')
                ->middleware('api')
                ->namespace($this->namespace)
                ->group(base_path('routes/proposal_api.php'));
            
            Route::prefix('proposal_konten_api')
                ->middleware('api')
                ->namespace($this->namespace)
                ->group(base_path('routes/proposal_konten_api.php'));

            Route::prefix('juri_api')
                ->middleware('api')
                ->namespace($this->namespace)
                ->group(base_path('routes/juri_api.php'));
                
            Route::prefix('penilaian_juri_api')
                ->middleware('api')
                ->namespace($this->namespace)
                ->group(base_path('routes/penilaian_juri_api.php'));
                
            Route::prefix('mentor_api')
                ->middleware('api')
                ->namespace($this->namespace)
                ->group(base_path('routes/mentor_api.php'));

            Route::prefix('coworking_api')
                ->middleware('api')
                ->namespace($this->namespace)
                ->group(base_path('routes/workspace_api.php'));
            
            Route::prefix('file_api')
                ->middleware('api')
                ->namespace($this->namespace)
                ->group(base_path('routes/file_api.php'));

            Route::prefix('addalatsewa_api')
                ->middleware('api')
                ->namespace($this->namespace)
                ->group(base_path('routes/addalatsewa_api.php'));

            Route::prefix('profiletalent_api')
                ->middleware('api')
                ->namespace($this->namespace)
                ->group(base_path('routes/profiletalent_api.php'));

            Route::prefix('usersewaalat_api')
                ->middleware('api')
                ->namespace($this->namespace)
                ->group(base_path('routes/usersewaalat_api.php'));
        });
    }
    
    /**
     * Configure the rate limiters for the application.
     *
     * @return void
     */
    protected function configureRateLimiting()
    {
        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(60)->by(optional($request->user())->id ?: $request->ip());
        });
    }
}
