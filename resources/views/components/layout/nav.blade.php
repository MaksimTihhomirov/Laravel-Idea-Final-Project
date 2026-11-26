<nav class="border-b border-border px-6">

    <div class="max-w-7xl mx-auto h-16 flex items-center justify-between">

        <a href="/" class="text-2xl font-bold">
            Idea.
        </a>

        <div class="flex items-center gap-4">

            @guest

                <a href="/login">Sign In</a>

                <a href="/register" class="btn btn-primary">
                    Register
                </a>

            @endguest

            @auth

                <a href="{{ route('profile.edit') }}"
                   class="hover:text-primary">
                    {{ auth()->user()->name }}
                </a>

                <form action="/logout" method="POST">

                    @csrf

                    <button class="btn btn-secondary">
                        Log Out
                    </button>

                </form>

            @endauth

        </div>

    </div>

</nav>