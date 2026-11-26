<x-layout.layout title="Ideas">

    <header class="mb-10">
        <h1 class="text-3xl font-bold">Ideas</h1>

        <p class="text-muted-foreground mt-2">
            Capture your thoughts. Make a plan.
        </p>
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

</x-layout.layout>