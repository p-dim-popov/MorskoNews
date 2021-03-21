@include('article.card', ['article' => $article])
<div class="text-2xl font-bold pl-3">
    Comments
</div>
@each('comment.item', $article->comments, 'comment')
@if(\Illuminate\Support\Facades\Auth::user())
    {{-- TODO: comment box --}}
@else
    @include('components.sign-in-or-sign-up', ['disclaimer' => 'To be able to comment you should'])
@endif
