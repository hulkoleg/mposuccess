<?php
/**
 * Created by PhpStorm.
 * User: NotPrometey
 * Date: 31.08.2015
 * Time: 12:51
 */

namespace Notprometey\Mposuccess\Http\Middleware;

use Closure;

class ProfileMiddleware{
    public function handle($request, Closure $next){
        return $next($request);
    }
}
