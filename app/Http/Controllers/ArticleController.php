<?php

namespace App\Http\Controllers;

use App\Http\Requests\{StoreArticleRequest, UpdateArticleRequest};
use App\Models\{Article, Category, User};
use Illuminate\{Database\Eloquent\Builder, Http, Contracts, Support\Str};

class ArticleController extends Controller
{
    public const ARTICLES_PER_PAGE = 5;

    public function __construct()
    {
        $this->middleware('auth')->except([
            'index',
            'show',
            'search',
        ]);
        $this->middleware('role:'.User::ROLES['ADMIN'])->only([
            'create',
            'store'
        ]);
        $this->middleware('user_is_creator')->only([
            'edit',
            'update',
            'delete',
        ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return Contracts\Foundation\Application|Contracts\View\Factory|Contracts\View\View|Http\Response
     */
    public function index()
    {
        return view('article.pages.list', [
            'articles' => Article::query()
                ->orderByDesc('created_at')
                ->paginate(self::ARTICLES_PER_PAGE)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Contracts\Foundation\Application|Contracts\View\Factory|Contracts\View\View|Http\Response
     */
    public function create()
    {
        return view('article.pages.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreArticleRequest $request
     * @return Http\RedirectResponse
     */
    public function store(StoreArticleRequest $request): Http\RedirectResponse
    {
        $validatedData = $request->validated();

        $article = $request->user()->articles()
            ->create([
                'title' => $validatedData['title'],
                'content' => $validatedData['content']
            ]);

        $categories = collect($validatedData['categories'])
            ->map(fn($name) => Category::query()->firstOrCreate(['name' => $name]));

        $article->categories()->saveMany($categories);

        return redirect()->route('articles.show', ['article' => $article]);
    }

    /**
     * Display the specified resource.
     *
     * @param Article $article
     * @return Contracts\Foundation\Application|Contracts\View\Factory|Contracts\View\View|Http\Response
     */
    public function show(Article $article)
    {
        return view('article.pages.show', ['article' => $article]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Article $article
     * @return Contracts\Foundation\Application|Contracts\View\Factory|Contracts\View\View|Http\Response
     */
    public function edit(Article $article) {
        return view('article.pages.edit', ['article' => $article]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateArticleRequest $request
     * @param Article $article
     * @return Http\RedirectResponse
     */
    public function update(UpdateArticleRequest $request, Article $article): Http\RedirectResponse
    {
        $validated = $request->validated();
        $categories = collect($validated['categories'])
            ->map(fn($name) => Category::query()->firstOrCreate(['name' => $name]));

        $newCategoryNames = $categories->pluck('name');
        $article->categories()->detach($article->categories()->get()->filter(fn ($x) => !$newCategoryNames->contains($x->name)));

        $oldCategoryNames = $article->categories()->pluck('name');
        $article->categories()->saveMany($categories->filter(fn ($x) => !$oldCategoryNames->contains($x->name)));

        $article->title = $validated['title'];
        $article->content = $validated['content'];
        $article->save();

        return redirect()->route('articles.show', ['article' => $article]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Article $article
     * @return Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy(Article $article): Http\RedirectResponse
    {
        $article->comments()->delete();
        $article->categories()->detach($article->categories()->get());
        $article->delete();
        return redirect()->route('articles.index');
    }

    public function search(string $slug) {
        if (empty($slug)) {
            return redirect('articles.index');
        }

        $articles = collect(preg_split('/[\s,]+/', Str::lower($slug)))
            ->reduce(
                fn(Builder $query, string $keyword) => $query
                    ->where('title', 'like', '%'.$keyword.'%')
                    ->orWhereHas('categories', fn(Builder $query0) => $query0
                        ->where('name', 'like', '%'.$keyword.'%')),
                Article::query())
            ->paginate(self::ARTICLES_PER_PAGE);
        return view('article.pages.search', ['articles' => $articles, 'slug' => $slug]);
    }
}
