@extends('layouts.app')

@section('content')
    <div class="max-w-4xl flex flex-col m-auto">
        <h4 class="text-2xl pt-1.5">Search results for: {{$slug}}</h4>
        @each('article.card', $articles, 'article')
    </div>
    {{ $articles->onEachSide(1)->links() }}
@endsection
