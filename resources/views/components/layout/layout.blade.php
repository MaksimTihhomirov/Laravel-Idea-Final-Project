@props(['title' => 'Idea'])

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>{{ $title }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-background text-foreground min-h-screen">

    <x-layout.nav />

    <main class="max-w-7xl mx-auto px-6 py-12">
        {{ $slot }}
    </main>

    @session('success')
        <div
            x-data="{ show: true }"
            x-init="setTimeout(() => show = false, 3000)"
            x-show="show"
            x-transition
            role="status"
            class="fixed bottom-4 right-4 bg-primary text-white px-4 py-3 rounded-lg shadow-lg"
        >
            {{ $value }}
        </div>
    @endsession

</body>
</html>