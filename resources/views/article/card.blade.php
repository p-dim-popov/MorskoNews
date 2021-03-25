<!-- Article card -->
@php
    $isList = request()->routeIs('articles.index', 'articles.search')
@endphp

<div class="flex justify-center items-center">
    <input id="{{$article->id}}" value="{{$article->id}}" hidden disabled>
    <div class="m-5 bg-white border-1 border-gray-300 p-5 rounded-lg tracking-wide shadow-md w-full">
        <div class="flex">
            <div class="flex flex-col ml-5 w-full">
                <div class="flex flex-row justify-between text-xl font-semibold mb-2">
                    <a href="{{route('articles.show', ['article' => $article])}}">
                        {{$article->title}}
                    </a>
                    <div class="flex flex-row items-center space-x-1.5">
                        @if(auth()->id() === $article->user->id)
                            @include('components.delete-button', ['action' => route('articles.destroy', ['article' => $article])])
                            @include('components.edit-button', ['href' => route('articles.edit', ['article' => $article])])
                        @endif
                        @include('components.share-button', ['dataSource' => route('articles.show', ['article' => $article])])
                    </div>
                </div>
                @if($isList)
                    <p class="text-gray-800 mt-2">{{\Illuminate\Support\Str::limit($article->content, 500, '...')}}</p>
                @else
                    <p class="text-gray-800 mt-2">{{$article->content}}</p>
                @endif
                <div class="flex flex-col w-full md:flex-row items-center">
                    <div class="font-bold italic">Categories:</div>
                    <div class="flex flex-row items-center">
                        @foreach($isList ? $article->categories->take(3) : $article->categories as $category)
                            @include('category.tag', ['name' => $category->name])
                        @endforeach
                        @if($isList)
                            <div>...</div>
                        @endif
                    </div>
                </div>
                <div class="flex flex-col md:flex-row justify-between items-center mt-5">
                    <div class="flex justify-center">
                        <p class="font-bold italic">By: </p>
                        <p class="ml-3">{{$article->user->email}}</p>
                    </div>
                    <div class="flex flex-col lg:flex-row justify-end">
                        <div class="pr-0 md:pr-3">
                            <span class="font-bold italic">Created at: </span>
                            <span class="utc-to-local">{{$article->created_at}}</span>
                        </div>
                        <div>
                            <span class="font-bold italic">Last update: </span>
                            <span class="utc-to-local">{{$article->updated_at}}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
