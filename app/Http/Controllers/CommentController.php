<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Http\Requests\{StoreCommentRequest, UpdateCommentRequest};
use App\Models\{Article, Comment};
use Illuminate\Http\RedirectResponse;

class CommentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('user_is_creator')->only([
            'edit',
            'update',
            'destroy',
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Article $article
     * @param StoreCommentRequest $request
     * @return RedirectResponse
     */
    public function store(Article $article, StoreCommentRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        $article->comments()
            ->create([
                'content' => $validated['content'],
                'user_id' => \auth()->id(),
            ]);

        return redirect()->route('articles.show', ['article' => $article]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Article $article
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit(Article $article) {
        return view('article.pages.show', ['article' => $article]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Article $article
     * @param Comment $comment
     * @param UpdateCommentRequest $request
     * @return RedirectResponse
     */
    public function update(Article $article, Comment $comment, UpdateCommentRequest $request): RedirectResponse
    {
        $validated = $request->validated();
        $comment->content = $validated['content'];
        $comment->save();
        return redirect()->route('articles.show', ['article' => $article]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Article $article
     * @param Comment $comment
     * @return RedirectResponse
     * @throws \Exception
     */
    public function destroy(Article $article, Comment $comment): RedirectResponse
    {
        $comment->delete();
        return redirect()->route('articles.show', ['article' => $article]);
    }
}
