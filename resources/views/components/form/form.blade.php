@props(['action'])

<form action="{{ $action }}" method="POST" class="space-y-5">
    @csrf

    {{ $slot }}
</form>