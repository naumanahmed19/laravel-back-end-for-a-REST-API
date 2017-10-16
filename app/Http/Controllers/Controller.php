<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Auth;
use View;
use App\Http\Utilities\Toast;
class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /*
   *  The authenticated user.protected
   *
   * @var \App\User|null
   */
    protected $user;

    protected $toast;

    public function __construct() {

        $this->middleware(function ($request, $next) {

            $this->user = Auth::user();

            View::share('signedIn', Auth::check());

            View::share('user', $this->user );

            return $next($request);
        });


    }

}
