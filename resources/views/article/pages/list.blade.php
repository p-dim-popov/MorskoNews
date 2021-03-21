@extends('layouts.app')

@section('content')
    <div class="max-w-4xl flex flex-col m-auto">
        @each('article.card', $articles, 'article')
    </div>
    {{ $articles->onEachSide(1)->links() }}
@endsection
