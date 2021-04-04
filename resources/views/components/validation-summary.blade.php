@if ($errors->any())
    <ul>
        @foreach ($errors->all() as $error)
            <li class="bg-red-100 border-l-4 border-red-300 rounded-md w-full px-6 py-4 my-1.5">
                {{ $error }}
            </li>
        @endforeach
    </ul>
@endif
