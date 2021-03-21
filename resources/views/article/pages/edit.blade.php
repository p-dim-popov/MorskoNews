@extends('layouts.app')

@section('content')
    <div class="max-w-4xl flex flex-col m-auto">
        {{-- Edit section --}}
        @include('article.editable', [
                'action' => route('articles.update', ['article' => $article]),
                'method' => 'PATCH',
                'header' => 'Edit article',
                'submit' => 'Save',
                'article' => $article
            ])
    </div>
@endsection
