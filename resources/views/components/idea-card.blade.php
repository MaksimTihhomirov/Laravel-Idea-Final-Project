@props(['idea'])

<a href="{{ route('ideas.show', $idea) }}">

    <x-card class="h-full hover:border-primary transition-colors">

        @if($idea->image_path)
            <img src="{{ asset('storage/' . $idea->image_path) }}"
                 alt="{{ $idea->title }}"
                 class="w-full h-48 object-cover rounded-lg mb-5">
        @endif

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

</a>