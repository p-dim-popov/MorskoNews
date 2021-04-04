@include('article.card', ['article' => $article])
<div class="text-2xl font-bold pl-3">
    Comments
</div>
@each('comment.item', $article->comments, 'comment')
@if(\Illuminate\Support\Facades\Auth::user() && !request()->routeIs('articles.comments.edit'))
    @include('comment.editable', [
        'action' => route('articles.comments.store', ['article' => $article]),
        'submit' => 'Comment',
    ])
@elseif (!\Illuminate\Support\Facades\Auth::user())
    @include('components.sign-in-or-sign-up', ['disclaimer' => 'To be able to comment you should'])
@endif
