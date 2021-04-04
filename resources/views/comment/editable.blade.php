@php
    $hashId = isset($comment) ? $comment->id : 'comments.create';
@endphp

<div
    class="flex flex-col justify-between bg-white shadow-sm p-7 mx-5 relative lg:max-w-4xl sm:p-4 rounded-lg lg:ml-20 m-3 shadow"
    id="{{$hashId}}"
>
    <div class="sm:pt-0 pl-6">
        @include('components.validation-summary', ['errors' => $errors])

        <form action="{{$action}}" method="POST" class="form bg-white relative">
            @csrf
            @method($method ?? 'POST')
            <textarea name="content" rows="3" placeholder="Tell us what you think..."
                      class="p-2 w-full border-none"
            >{{old('content') ?? $comment->content ?? ''}}</textarea>
            <div class="flex flex-col md:flex-row justify-evenly">
                <button
                    type="submit"
                    class="w-full md:w-1/2 mt-3 bg-blue-600 hover:bg-blue-500 text-white font-semibold p-3"
                >{{$submit}}</button>
                @if(isset($comment))
                    <a
                        class="w-full md:w-1/2 mt-3 bg-red-600 hover:bg-red-500 text-white font-semibold p-3 text-center"
                        href="{{route('articles.show', ['article' => $comment->article])}}"
                    >Cancel</a>
                @endif
            </div>
        </form>
    </div>
</div>
