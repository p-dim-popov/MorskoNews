@extends('layouts.app')

@section('content')
    <div class="max-w-4xl flex flex-col m-auto">
        {{-- Create section --}}
        @include('article.editable', [
                'action' => route('articles.store'),
                'header' => 'Create new article',
                'submit' => 'Create',
            ])
    </div>
@endsection
