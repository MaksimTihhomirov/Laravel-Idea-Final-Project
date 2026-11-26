<x-layout.layout title="Register">

    <div class="max-w-sm mx-auto py-16">

        <h1 class="text-2xl font-bold text-center">
            Register an account
        </h1>

        <p class="text-muted-foreground text-center mb-8">
            Start tracking your ideas today.
        </p>

        <x-form.form action="/register">

            <x-form.field name="name" label="Name">
                <input class="input" id="name" name="name"
                       value="{{ old('name') }}" required>
            </x-form.field>

            <x-form.field name="email" label="Email">
                <input class="input" id="email" name="email"
                       type="email" value="{{ old('email') }}" required>
            </x-form.field>

            <x-form.field name="password" label="Password">
                <input class="input" id="password" name="password"
                       type="password" required>
            </x-form.field>

            <button type="submit" id="register-button"
                    class="btn btn-primary w-full">
                Create Account
            </button>

        </x-form.form>

    </div>

</x-layout.layout>