<form method="POST" action="{{$action}}" class="p-0 m-0">
    @csrf
    @method('DELETE')
    <button type="button" class="outline-none p-0 m-0" onclick="(function (button) {
        window.confirm({
            onConfirm: () => button.closest('form').submit(),
            content: '{{$textContent ?? 'This action cannot be undone!'}}',
            confirmText: '{{$confirmText ?? 'Delete'}}',
        });
    })(this)">
        @include('icons.delete', ['class' => 'block h-6 w-auto fill-current text-red-600'])
    </button>
</form>
