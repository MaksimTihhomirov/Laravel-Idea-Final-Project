<x-layout.layout title="Ideas">

    <header class="mb-10">

        <h1 class="text-3xl font-bold">Ideas</h1>

        <p class="text-muted-foreground mt-2">
            Capture your thoughts. Make a plan.
        </p>

        <button
            x-data
            @click="$dispatch('open-modal', 'create-idea')"
            type="button"
            class="w-full mt-8 h-32 bg-card border border-border rounded-xl text-left px-6 hover:border-primary cursor-pointer"
        >
            <span class="text-xl text-muted-foreground">
                What's the idea?
            </span>
        </button>

    </header>

    <div class="flex flex-wrap gap-3 mb-8">

        <a href="/ideas"
           class="btn {{ !$status ? 'btn-primary' : 'btn-secondary' }}">
            All ({{ $statusCounts['all'] }})
        </a>

        @foreach(\App\IdeaStatus::cases() as $item)

            <a href="/ideas?status={{ $item->value }}"
               class="btn {{ $status === $item->value ? 'btn-primary' : 'btn-secondary' }}">

                {{ $item->label() }}
                ({{ $statusCounts[$item->value] }})

            </a>

        @endforeach

    </div>

    <div class="grid md:grid-cols-2 gap-6">

        @forelse($ideas as $idea)

            <x-idea-card :idea="$idea" />

        @empty

            <x-card>
                <p class="text-muted-foreground">
                    No ideas at this time.
                </p>
            </x-card>

        @endforelse

    </div>

    <!-- Modal -->

    <div
        x-data="{ show: false, name: 'create-idea' }"
        x-show="show"
        @open-modal.window="if ($event.detail === name) show = true"
        @keydown.escape.window="show = false"
        @click.self="show = false"
        x-transition
        style="display: none;"
        class="fixed inset-0 z-50 flex items-center justify-center bg-black/50 backdrop-blur-sm p-4"
        role="dialog"
        aria-modal="true"
        aria-label="Create new idea"
    >

        <x-card class="w-full max-w-lg">

            <div class="flex items-center justify-between mb-6">

                <h2 class="text-2xl font-bold">
                    Create a new idea
                </h2>

                <button
                    type="button"
                    @click="show = false"
                    class="text-2xl cursor-pointer"
                    aria-label="Close"
                >
                    ×
                </button>

            </div>

            <p class="text-muted-foreground">
                Your next great idea starts here.
            </p>

        </x-card>

    </div>

</x-layout.layout>