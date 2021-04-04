@php
    if (isset($comment)) {
        $hashId = 'comment-'.$comment->id;
    }
@endphp

@if(request()->routeIs('articles.comments.edit') && (int) request()->route()->parameter('comment') === $comment->id)
    @include('comment.editable', [
        'action' => route('articles.comments.update', ['article' => $comment->article, 'comment' => $comment]),
        'method' => 'PUT',
        'submit' => 'Save',
        'comment' => $comment,
    ])
@else
    <div
        class="flex flex-col md:flex-row justify-between bg-white shadow-sm p-7 mx-5 relative lg:max-w-4xl sm:p-4 rounded-lg lg:ml-20 m-3 shadow"
        id="{{$hashId}}"
    >
        <div class="sm:pt-0 pl-6">
            <pre class="text-left">{{$comment->content}}</pre>
            by <a href="#" class="underline inline-block pt-2">{{$comment->user->email}}</a>
        </div>
        <div class="pl-6 lg:pl-0 mt-3 flex flex-row justify-end">
            <div class="flex flex-row items-center space-x-1.5">
                @if(auth()->id() === $comment->user->id)
                    @include('components.delete-button', [
                        'action' => route('articles.comments.destroy', ['article' => $comment->article, 'comment' => $comment]),
                    ])
                    @include('components.edit-button', [
                        'href' => route('articles.comments.edit', ['article' => $comment->article, 'comment' => $comment])
                    ])
                @endif
                @include('components.share-button', ['dataSource' => route('articles.show', ['article' => $comment->article]).'#'.$hashId])
            </div>

        </div>
    </div>
@endif

