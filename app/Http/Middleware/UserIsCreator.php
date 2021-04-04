<?php

namespace App\Http\Middleware;

use App\Models\Article;
use App\Models\Comment;
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
        if ($request->routeIs('articles.edit')) {
            if ($request->user()->id !== Article::query()->findOrFail($request->article->id ?? $request->article)->user->id) {
                abort(Response::HTTP_FORBIDDEN);
            }
        } else if ($request->routeIs('articles.comments.edit')) {
            if ($request->user()->id !== Comment::query()->findOrFail($request->comment->id ?? $request->comment)->user->id) {
                abort(Response::HTTP_FORBIDDEN);
            }
        }

        return $next($request);
    }
}
