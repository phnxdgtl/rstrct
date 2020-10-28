<?php

namespace Phnxdgtl\Rstrct\Http\Middleware;

use Closure;

class Test
{
    public function handle($request, Closure $next)
    {
        if ($request->has('title')) {
            $request->merge([
                'title' => ucfirst($request->title)
            ]);
        }

        return $next($request);
    }
}