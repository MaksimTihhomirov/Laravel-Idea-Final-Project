@props(['idea' => null])

@props(['idea' => null])

<form method="POST"
      action="{{ $idea ? route('ideas.update', $idea) : route('ideas.store') }}"
      enctype="multipart/form-data"
      class="space-y-6">

    @csrf

    @if($idea)
        @method('PATCH')
    @endif

    <x-form.field name="title" label="Title">

        <input type="text" id="title" name="title"
               class="input"
               placeholder="Enter an idea for your title"
               value="{{ old('title', $idea?->title) }}"
               required>

    </x-form.field>

    <fieldset class="space-y-3"
              x-data="{ status: @js(old('status', $idea?->status->value ?? 'pending')) }">

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

        <textarea id="description"
                  name="description"
                  class="textarea"
                  placeholder="Describe your idea...">{{ old('description', $idea?->description) }}</textarea>

    </x-form.field>

    <x-form.field name="image" label="Featured Image">

        @if($idea?->image_path)

            <img src="{{ asset('storage/' . $idea->image_path) }}"
                 alt="{{ $idea->title }}"
                 class="w-full h-48 object-cover rounded-lg">

                 <label class="flex items-center gap-2 mt-3">
    <input type="checkbox" name="remove_image" value="1">
    Remove Image

</label>

        @endif

        <input type="file"
               id="image"
               name="image"
               accept="image/jpeg,image/png,image/webp"
               class="input">

    </x-form.field>

    <fieldset
        x-data="{ steps: @js(old('steps', $idea?->steps->pluck('description')->all() ?? [])), newStep: '' }"
        class="space-y-3"
    >

        <legend class="text-sm font-medium">
            Actionable Steps
        </legend>

        <template x-for="(step, index) in steps" :key="index">

            <div class="flex gap-2">

                <input type="text" name="steps[]"
                       x-model="steps[index]" class="input" required>

                <button type="button"
                        @click="steps.splice(index, 1)"
                        class="btn btn-secondary">
                    ×
                </button>

            </div>

        </template>

        <div class="flex gap-2">

            <input type="text"
                   id="new-step"
                   x-model="newStep"
                   class="input"
                   placeholder="Add a step...">

            <button type="button"
                    @click="steps.push(newStep.trim()); newStep = ''"
                    :disabled="!newStep.trim()"
                    class="btn btn-secondary">
                +
            </button>

        </div>

        @error('steps.*')
            <p class="text-red-400">{{ $message }}</p>
        @enderror

    </fieldset>

    <fieldset
        x-data="{ links: @js(old('links', $idea?->links ?? [])), newLink: '' }"
        class="space-y-3"
    >

        <legend class="text-sm font-medium">Links</legend>

        <template x-for="(link, index) in links" :key="index">

            <div class="flex gap-2">

                <input type="url" name="links[]"
                       x-model="links[index]" class="input" required>

                <button type="button"
                        @click="links.splice(index, 1)"
                        class="btn btn-secondary">
                    ×
                </button>

            </div>

        </template>

        <div class="flex gap-2">

            <input type="url" id="new-link"
                   x-model="newLink"
                   placeholder="https://example.com"
                   class="input">

            <button type="button"
                    @click="links.push(newLink.trim()); newLink = ''"
                    :disabled="!newLink.trim()"
                    class="btn btn-secondary"
                    aria-label="Add a new link">
                +
            </button>

        </div>

        @error('links.*')
            <p class="text-red-400">{{ $message }}</p>
        @enderror

    </fieldset>

    <div class="flex justify-end gap-3">

        <button type="button"
                @click="show = false"
                class="btn btn-secondary">
            Cancel
        </button>

     <button type="submit" class="btn btn-primary">
    {{ $idea ? 'Save Changes' : 'Create Idea' }}
</button>
    </div>

</form>