<?php

namespace App\Http\Middleware;

use Closure;
use App\Item;
use Sentinel;

class ItemMiddleware
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
      if(Sentinel::inRole('admin')) return $next($request);
      $id = $request->route('item')->id;
      $item = Item::where('id_user', Sentinel::getUser()->id)->where('id', $id)->first();
      if($item) return $next($request);
      return redirect()->route('unauthorized');
    }
}
