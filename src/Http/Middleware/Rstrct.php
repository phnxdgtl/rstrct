<?php

namespace Phnxdgtl\Rstrct\Http\Middleware;

use Closure;

class Rstrct
{
    public function handle($request, Closure $next)
    {
        /**
         * Load the username and password from .env, if set
         */
        
        $user     = env('RSTRCT_USER', false);
        $password = env('RSTRCT_PASSWORD', false);

        if (current($request->segments()) == 'ctrl-client') {
            /**
             * If we're trying to query the new CTRL Client, allow the request regardless
             * (We already have token authentication for these requests anyway)
             **/
            return $next($request);
        } else if (!$user || !$password) {
            /**
             * If we don't have a username and password, proceed as normal
             */
            return $next($request);
        } else if ($request->getUser() == $user && $request->getPassword() == $password) {
            /**
             * Otherwise, check that we've entered the username and password via Basic Authentication
             */
            return $next($request);
        }  else {
            /**
             * Otherwise, refuse access
             */
            $headers = array('WWW-Authenticate' => 'Basic');
            return response('Invalid credentials.', 401, $headers);
        }
    }
}