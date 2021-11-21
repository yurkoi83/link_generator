<?php

namespace App\Http\Middleware;

use App\Helpers\UrlHelper;
use Closure;

class Clearance
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
        $link = \App\Link::where('token', $request->path())->first();
        if($link) {
            if(UrlHelper::maxVisitDetect($link) || UrlHelper::expire($link)) {
                abort(404);
            }

            $link->update(['total_visit' => $link->total_visit++]);
            return redirect()->route('index');
        } else {
            abort(404);
        }


        return $next($request);
    }


}
