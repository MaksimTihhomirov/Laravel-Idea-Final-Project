<x-layout.layout :title="$idea->title">

    <div class="max-w-4xl mx-auto">

        <div class="flex justify-between items-center mb-6">

            <a href="{{ route('ideas.index') }}"
               class="text-muted-foreground">
                ← Back to Ideas
            </a>

            <div class="flex gap-3">

 <button
    x-data
    type="button"
    data-test="edit-idea-button"
    @click="$dispatch('open-modal', 'edit-idea')"
    class="btn btn-secondary"
>
    Edit Idea
</button>

                <form method="POST"
                      action="{{ route('ideas.destroy', $idea) }}"
                      onsubmit="return confirm('Delete this idea?')">

                    @csrf
                    @method('DELETE')

                    <button class="btn btn-secondary text-red-400">
                        Delete
                    </button>

                </form>

            </div>

        </div>

        @if($idea->image_path)
    <img src="{{ asset('storage/' . $idea->image_path) }}"
         alt="{{ $idea->title }}"
         class="w-full max-h-96 object-cover rounded-xl mb-6">
@endif

        <h1 class="text-4xl font-bold">{{ $idea->title }}</h1>
        

        <div class="flex items-center gap-3 mt-4">

            <x-status-label :status="$idea->status" />

            <span class="text-muted-foreground text-sm">
                {{ $idea->created_at->diffForHumans() }}
            </span>

        </div>

@if($idea->description)
    <x-card class="mt-6">
        <div class="prose prose-invert max-w-none">
            {!! $idea->formatted_description !!}
        </div>
    </x-card>
@endif

        @if($idea->steps->isNotEmpty())

            <h2 class="text-xl font-bold mt-8 mb-4">
                Actionable Steps
            </h2>

            <div class="space-y-3">

                @foreach($idea->steps as $step)

                    <x-card>

                        <form method="POST"
                              action="{{ route('steps.update', $step) }}"
                              class="flex items-center gap-3">

                            @csrf
                            @method('PATCH')

                            <input type="checkbox"
                                   aria-label="Mark step as completed"
                                   @checked($step->completed)
                                   onchange="this.form.submit()">

                            <span class="{{ $step->completed ? 'line-through text-muted-foreground' : '' }}">
                                {{ $step->description }}
                            </span>

                        </form>

                    </x-card>

                @endforeach

            </div>

        @endif

        @if(count($idea->links ?? []))

            <h2 class="text-xl font-bold mt-8 mb-4">Links</h2>

            <div class="space-y-3">

                @foreach($idea->links as $link)
                    <x-card class="break-all">
                        {{ $link }}
                    </x-card>
                @endforeach

            </div>

        @endif

    </div>
<x-modal name="edit-idea" title="Edit Idea" :show="$errors->any()">
    <x-idea-form :idea="$idea" />
</x-modal>

</x-layout.layout>