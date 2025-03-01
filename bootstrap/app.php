<?php

use App\Http\Middleware\PreventBackHistory;
use App\Http\Middleware\RoleManager;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Support\Facades\Route;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        // web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
        
        using: function () {
            // Route::middleware('api')
            //     ->prefix('api')
            //     ->group(base_path('routes/api.php'));
    
            Route::middleware('web')
                ->group(base_path('routes/web.php'));
    
            Route::middleware('web')
                ->group(base_path('routes/admin.php'));
    
            Route::middleware('web')
                ->group(base_path('routes/seller.php'));
    
            Route::middleware('web')
                ->group(base_path('routes/client.php'));
        },
    )
    ->withMiddleware(function (Middleware $middleware) {      
        $middleware->alias([
            'rolemanager' => RoleManager::class,
            'preventbackhistory' => PreventBackHistory::class
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
