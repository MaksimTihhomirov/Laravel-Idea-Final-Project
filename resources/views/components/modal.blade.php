@props(['name', 'title', 'show' => false])

<div
    x-data="{ show: @js($show), name: @js($name) }"
    x-show="show"
    @open-modal.window="if ($event.detail === name) show = true"
    @keydown.escape.window="show = false"
    @click.self="show = false"
    x-transition
    style="display: none;"
    role="dialog"
    aria-modal="true"
    aria-label="{{ $title }}"
    class="fixed inset-0 z-50 flex items-center justify-center bg-black/50 backdrop-blur-sm p-4"
>

    <x-card class="w-full max-w-2xl max-h-[80vh] overflow-auto shadow-xl">

        <div class="flex justify-between items-center mb-6">

            <h2 class="text-2xl font-bold">{{ $title }}</h2>

            <button type="button" @click="show = false"
                    class="text-2xl cursor-pointer" aria-label="Close">
                ×
            </button>

        </div>

        {{ $slot }}

    </x-card>

</div>