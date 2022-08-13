<?php

namespace App\Http\Middleware;

use Closure;

class CanUpgradeToCompany
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (auth()->check()) { // todo site: is it ok $balance is in provider?
            $balance = cache()->remember('balance_values'.auth()->id(), 300, function() {
                return \App\Http\Controllers\site\MainController::getBalance();
            });
        } else
            $balance = 0;


        if (auth()->user()->type_usage === 'company')
            abort(403);

        if ($balance !== 0)
            abort(403);

        return $next($request);
    }
}
