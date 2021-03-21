@php
    if (isset($comment)) {
        $hashId = 'c-'.$comment->id;
    }
@endphp

<div
    class="flex flex-col md:flex-row justify-between bg-white shadow-sm p-7 mx-5 relative lg:max-w-4xl sm:p-4 rounded-lg lg:ml-20 m-3 shadow"
    id="{{$hashId}}"
>
    <div class="sm:pt-0 pl-6">
        <h2 class="text-gray text-l font-bold">
            {{$comment->content}}
        </h2>
        by <a href="#" class="underline inline-block pt-2">{{$comment->user->email}}</a>
    </div>
    <div class="pl-6 lg:pl-0 mt-3 flex flex-row justify-end">
        @include('components.share-button', ['dataSource' => route('articles.show', ['article' => $comment->article]).'#'.$hashId])
    </div>
</div>
