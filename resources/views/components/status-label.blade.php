@props(['status'])

@php
    $color = match ($status) {
        \App\IdeaStatus::PENDING => 'bg-yellow-500/10 text-yellow-400',
        \App\IdeaStatus::IN_PROGRESS => 'bg-blue-500/10 text-blue-400',
        \App\IdeaStatus::COMPLETED => 'bg-green-500/10 text-green-400',
    };
@endphp

<span class="inline-block rounded-full px-3 py-1 text-xs font-medium {{ $color }}">
    {{ $status->label() }}
</span>