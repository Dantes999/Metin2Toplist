<?php

namespace App\Http\Middleware;

use App\Models\BlockIps;
use Closure;
use Illuminate\Http\Request;

class BlockIpMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        $blockIps = BlockIps::all()->pluck('ip')->toArray();
        if (in_array($request->ip(), $blockIps)) {
            abort(403, "You are restricted to access the site.");
        }
        return $next($request);
    }
}
