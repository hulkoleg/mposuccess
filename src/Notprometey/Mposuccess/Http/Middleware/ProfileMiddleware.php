<?php
/**
 * Created by PhpStorm.
 * User: NotPrometey
 * Date: 31.08.2015
 * Time: 12:51
 */

namespace Notprometey\Mposuccess\Http\Middleware;

use Auth;
use Closure;
use Illuminate\Http\Request;
use Notprometey\Mposuccess\Models\User;


class ProfileMiddleware{
    public function handle(Request $request, Closure $next){
        if (Auth::check()){
            $user = User::find(Auth::user()->id);

            if($user->is('bad.user') || !$user->is('admin|moderator|user')) {
                abort('404');
            }
            return $next($request);
        }
        abort('404');
    }
}
