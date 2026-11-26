<x-layout.layout :title="$idea->title">

    <div class="max-w-4xl mx-auto">

        <div class="flex justify-between items-center mb-6">

            <a href="{{ route('ideas.index') }}"
               class="text-muted-foreground">
                ← Back to Ideas
            </a>

            <div class="flex gap-3">

                <button type="button" class="btn btn-secondary" disabled>
                    Edit Idea
                </button>

                <form method="POST"
                      action="{{ route('ideas.destroy', $idea) }}"
                      onsubmit="return confirm('Delete this idea?')">

                    @csrf
                    @method('DELETE')

                    <button type="submit"
                            class="btn btn-secondary text-red-400">
                        Delete
                    </button>

                </form>

            </div>

        </div>

        <h1 class="text-4xl font-bold">
            {{ $idea->title }}
        </h1>

        <div class="flex items-center gap-3 mt-4">

            <x-status-label :status="$idea->status" />

            <span class="text-muted-foreground text-sm">
                {{ $idea->created_at->diffForHumans() }}
            </span>

        </div>

        <x-card class="mt-6">
            <p class="whitespace-pre-wrap">{{ $idea->description }}</p>
        </x-card>

        @if(count($idea->links ?? []))

            <h2 class="text-xl font-bold mt-8 mb-4">
                Links
            </h2>

            <div class="space-y-3">

                @foreach($idea->links as $link)
                    <x-card class="break-all">
                        {{ $link }}
                    </x-card>
                @endforeach

            </div>

        @endif

    </div>

</x-layout.layout>