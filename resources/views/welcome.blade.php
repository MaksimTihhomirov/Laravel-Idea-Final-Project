<x-layout.layout>

    <div class="text-center py-24">

        <h1 class="text-5xl font-bold mb-4">
            Bring your ideas to life.
        </h1>

        <p class="text-muted-foreground mb-8">
            Organize your ideas and track your progress.
        </p>

        @guest
            <a href="/register" class="btn btn-primary">
                Get Started
            </a>
        @endguest

        @auth
            <h2 class="text-2xl">
                Welcome, {{ auth()->user()->name }}!
            </h2>
        @endauth

    </div>

</x-layout.layout>