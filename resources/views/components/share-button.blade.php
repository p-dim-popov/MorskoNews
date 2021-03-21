<button
    class="outline-none"
    onclick="{
        navigator.clipboard.writeText(`{{$dataSource}}`);
        window.alert.success('Share link copied successfully!');
        }">
    @include('icons.share', ['class' => 'block h-6 w-auto fill-current text-gray-600'])
</button>
