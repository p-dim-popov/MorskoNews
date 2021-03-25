@php
    $id = 'cat-'.($name ?? (new DateTime())->format('v'));
    $isEdit = request()->routeIs('articles.create', 'articles.edit')
@endphp

<div
    class="text-xs inline-flex items-center font-bold leading-sm uppercase px-3 py-1 bg-blue-200 text-blue-700 rounded-full m-2 {{!$isEdit ? 'cursor-pointer' : ''}}"
    {{$isEdit ? 'id='.$id.'' : 'onclick=window.location.href=`/articles/search/'.$name.'`'}}
>
    @if($isEdit)
        <input type="text" name="categories[]" value="{{$name}}" hidden>
    @endif
    <div class="px-1.5">
        {{$name}}
    </div>
    @if($isEdit)
        <button type="button" class="bg-red-600 rounded text-white px-1.5" onclick="document.getElementById('{{$id}}').remove()">
            ˣ
        </button>
    @endif
</div>
