@php
    $hashId = 'sign-up-or-sign-in';
@endphp

<div
    class="flex flex-col md:flex-row justify-between bg-white shadow-sm p-7 mx-5 relative lg:max-w-4xl sm:p-4 rounded-lg lg:ml-20 m-3 shadow"
    id="{{$hashId}}"
>
    <div class="sm:pt-0 pl-6">
        <h4 class="text-gray text-l font-bold text-center">
            {{$disclaimer}}
        </h4>
        <div class="flex flex-col md:flex-row md:justify-between justify-center">
            <a href="{{route('login')}}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Sign in</a>
            <div class="text-center">or</div>
            <a href="{{route('register')}}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Sign up</a>
        </div>
    </div>
</div>
