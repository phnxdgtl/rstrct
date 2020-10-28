<?php

namespace Phnxdgtl\Rstrct;

use Illuminate\Support\ServiceProvider;
use Illuminate\Contracts\Http\Kernel;
use Phnxdgtl\Rstrct\Http\Middleware\Rstrct;

class RstrctServiceProvider extends ServiceProvider
{
    public function register()
    {
    }

    public function boot()
    {
        $kernel = $this->app->make(Kernel::class);
        $kernel->pushMiddleware(Rstrct::class);
    }
}