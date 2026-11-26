<form method="POST" action="{{ route('ideas.store') }}" class="space-y-6">

    @csrf

    <x-form.field name="title" label="Title">

        <input
            type="text"
            id="title"
            name="title"
            class="input"
            placeholder="Enter an idea for your title"
            value="{{ old('title') }}"
            required
        >

    </x-form.field>

    <fieldset class="space-y-3"
              x-data="{ status: @js(old('status', 'pending')) }">

        <legend class="text-sm font-medium">Status</legend>

        <input type="hidden" name="status" :value="status">

        <div class="grid grid-cols-3 gap-3">

            @foreach(\App\IdeaStatus::cases() as $item)

            <button
    type="button"
    data-test="button-status-{{ $item->value }}"
    @click="status = @js($item->value)"
    :class="status === @js($item->value) ? 'btn-primary' : 'btn-secondary'"
    class="btn"
>
    {{ $item->label() }}
</button>
            @endforeach

        </div>

        @error('status')
            <p class="text-red-400">{{ $message }}</p>
        @enderror

    </fieldset>

    <x-form.field name="description" label="Description">

        <textarea
            id="description"
            name="description"
            class="textarea"
            placeholder="Describe your idea..."
        >{{ old('description') }}</textarea>

    </x-form.field>

    <button type="submit" class="btn btn-primary w-full">
        Create Idea
    </button>

</form>