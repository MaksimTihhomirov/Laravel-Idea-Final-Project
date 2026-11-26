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
            What's the idea?
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
                No ideas at this time.
            </x-card>

        @endforelse

    </div>

    <x-modal name="create-idea" title="New Idea" :show="$errors->any()">
        <x-idea-form />
    </x-modal>

</x-layout.layout>