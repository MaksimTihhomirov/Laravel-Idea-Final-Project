@props(['idea'])

<x-card>

    <h3 class="text-xl font-semibold">
        {{ $idea->title }}
    </h3>

    <div class="mt-3">
        <x-status-label :status="$idea->status" />
    </div>

    <p class="mt-5 line-clamp-3 text-muted-foreground">
        {{ $idea->description }}
    </p>

    <p class="mt-4 text-sm text-muted-foreground">
        {{ $idea->created_at->diffForHumans() }}
    </p>

</x-card>