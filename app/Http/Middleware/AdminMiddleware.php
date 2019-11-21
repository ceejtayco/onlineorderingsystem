<?php

namespace App\Http\Middleware;
use App\User;
use Closure;
use Illuminate\Contracts\Auth\Guard;
class AdminMiddleware
{

    protected $auth;

    public function __construct(Guard $auth) {
        $this->auth = $auth;
    }
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */

    public function handle($request, Closure $next)
    {
        if($this->auth->getUser()->type != 0) {
            abort(403, 'Unauthorized action.');
        }
        return $next($request);
    }
}
