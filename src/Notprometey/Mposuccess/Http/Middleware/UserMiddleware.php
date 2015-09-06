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
use Notprometey\Mposuccess\Models\User;

class UserMiddleware{
    public function handle($request, Closure $next){
        $user = User::find(Auth::user()->id);

        if (!Auth::check() || !$user->is('admin|moderator|user|bad.user')) {
            abort('404');
        }
        return $next($request);
    }
}
