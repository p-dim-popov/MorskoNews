{{-- Validation summary --}}
@include('components.validation-summary', ['errors' => $errors])

{{-- Form --}}
<form action="{{$action}}" method="POST" class="form bg-white p-6 my-10 relative">
    @csrf
    @method($method ?? 'POST')
    <h3 class="text-2xl text-gray-900 font-semibold">{{$header}}</h3>
    <input type="text" name="title" id="title" placeholder="Title..." class="border p-2  w-full my-1.5"
           value="{{old('title') ?? $article->title ?? ''}}">
    <textarea name="content" id="content" cols="10" rows="5" placeholder="Tell us the story..."
              class="border p-2 my-1.5 w-full"
    >{{old('content') ?? $article->content ?? ''}}</textarea>
    <div>
        <div class="flex flex-col">
            <div>Categories</div>
            <div class="flex flex-col md:flex-row justify-between">
                <script>
                    window.addEventListener('DOMContentLoaded', () => {
                        window.categorySearch = _.debounce(() => {
                            const categoryInput = document.getElementById('category-input');
                            if (!categoryInput) return;
                            alert(`implement suggestions: ${categoryInput.value}`);
                        }, 500);
                    });
                </script>
                <input
                    type="text"
                    placeholder="Categories..."
                    class="border p-2 md:w-2/3 w-full my-1.5"
                    id="category-input"
                    oninput="window.categorySearch()"
                    onkeydown="if(event.keyCode == 13) { event.preventDefault(); }"
                >
                <script>
                    window.categoryTagTemplate = `@include('category.tag', ['name' => '__NAME__'])`;
                </script>
                <button type="button"
                        class="bg-green-600 hover:bg-green-500 text-white font-semibold p-2 md:w-1/4 my-1.5 w-full"
                        onclick="(function() {
                            const categoriesDiv = document.getElementById('categories');
                            const categoryInput = document.getElementById('category-input');

                            const categories = categoryInput.value.split(/[\s,]+/).filter(x => !!x);
                            categories.forEach(cat => {
                                if (document.getElementById(`cat-${cat}`)) return;
                                categoriesDiv.innerHTML += window.categoryTagTemplate.replaceAll('__NAME__', cat);
                                categoryInput.value = '';
                            })
                        })()"
                >
                    Add
                </button>
            </div>
        </div>
        <div class="border border-black flex flex-row flex-wrap my-1.5" id="categories">
            @if(isset($article) && empty(old('categories')))
                @foreach($article->categories as $category)
                    @include('category.tag', ['name' => $category->name])
                @endforeach
            @else
                @for($i = 0; $i < count(old('categories') ?? []); $i++)
                    @include('category.tag', ['name' => old('categories.'.$i)])
                @endfor
            @endif
        </div>
    </div>
    <div class="flex flex-col md:flex-row justify-evenly">
        <button
            type="submit"
            class="w-full md:w-1/2 mt-6 bg-blue-600 hover:bg-blue-500 text-white font-semibold p-3"
        >{{$submit}}</button>
        <a
            class="w-full md:w-1/2 mt-6 bg-red-600 hover:bg-red-500 text-white font-semibold p-3 text-center"
            href="{{isset($article) ? route('articles.show', ['article' => $article]) : route('articles.index')}}"
        >Cancel</a>
    </div>
</form>
