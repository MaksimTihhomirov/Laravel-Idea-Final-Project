@props(['idea'])

<x-card>

    <h3 class="text-xl font-semibold text-foreground">
        {{ $idea->title }}
    </h3>

    <span class="inline-block mt-3 rounded-full bg-yellow-500/10
                 text-yellow-400 px-3 py-1 text-xs font-medium">
        {{ $idea->status->label() }}
    </span>

    <p class="mt-5 line-clamp-3 text-muted-foreground">
        {{ $idea->description }}
    </p>

    <p class="mt-4 text-sm text-muted-foreground">
        {{ $idea->created_at->diffForHumans() }}
    </p>

</x-card>