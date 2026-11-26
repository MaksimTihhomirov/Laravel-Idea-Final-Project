<x-layout.layout title="Edit Profile">

    <div class="max-w-md mx-auto py-12">

        <h1 class="text-3xl font-bold text-center">
            Edit your account
        </h1>

        <p class="text-muted-foreground text-center mb-8">
            Need to make a tweak?
        </p>

        <form action="{{ route('profile.update') }}"
              method="POST" class="space-y-5">

            @csrf
            @method('PATCH')

            <x-form.field name="name" label="Name">
                <input type="text" id="name" name="name"
                       value="{{ old('name', $user->name) }}"
                       class="input" required>
            </x-form.field>

            <x-form.field name="email" label="Email">
                <input type="email" id="email" name="email"
                       value="{{ old('email', $user->email) }}"
                       class="input" required>
            </x-form.field>

            <x-form.field name="current_password" label="Current Password">
                <input type="password" id="current_password"
                       name="current_password" class="input" required>
            </x-form.field>

            <x-form.field name="password" label="New Password">
                <input type="password" id="password"
                       name="password" class="input"
                       placeholder="Leave blank to keep current password">
            </x-form.field>

            <button type="submit" class="btn btn-primary w-full">
                Update Account
            </button>

        </form>

    </div>

</x-layout.layout>