<x-layout.layout title="Ideas">

    <header class="mb-10">

        <h1 class="text-3xl font-bold">
            Ideas
        </h1>

        <p class="text-muted-foreground mt-2">
            Capture your thoughts. Make a plan.
        </p>

    </header>

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