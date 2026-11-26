<x-layout.layout title="Sign In">

    <div class="max-w-sm mx-auto py-16">

        <h1 class="text-2xl font-bold text-center mb-8">
            Sign In
        </h1>

        <x-form.form action="/login">

            <x-form.field name="email" label="Email">
                <input class="input" id="email" name="email"
                       type="email" value="{{ old('email') }}" required>
            </x-form.field>

            <x-form.field name="password" label="Password">
                <input class="input" id="password" name="password"
                       type="password" required>
            </x-form.field>

            <button type="submit" class="btn btn-primary w-full">
                Sign In
            </button>

        </x-form.form>

    </div>

</x-layout.layout>