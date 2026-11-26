@props(['name', 'label'])

<div class="space-y-2">
    <label for="{{ $name }}" class="text-sm font-medium">
        {{ $label }}
    </label>

    {{ $slot }}

    @error($name)
        <p class="text-red-400 text-sm">{{ $message }}</p>
    @enderror
</div>