<?php

namespace App\Http\Middleware;

use App\Models\Article;
use Closure;
use Illuminate\Http\{Request, Response};

class UserIsCreator
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if ($request->user()->id !== Article::query()->findOrFail($request->article->id ?? $request->article)->user->id) {
            abort(Response::HTTP_FORBIDDEN);
        }

        return $next($request);
    }
}
