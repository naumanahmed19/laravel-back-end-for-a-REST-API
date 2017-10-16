<?php

namespace App\Http\Middleware;

use Closure;

class MustBeOwner
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next , $resourceName)
    {

        $resourceId = $request->route()->parameter($resourceName)->id;

        //$model = \DB::table(str_plural($resourceName))->find($resourceId);
        $model = \DB::table(str_plural($resourceName))->whereToken($resourceId);

        if ($model->token == $request->token) {
            dd('gpp');
            return $next($request);
        }

        abort(404, 'Unauthorized action.');

    }

}
