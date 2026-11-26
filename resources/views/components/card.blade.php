<div {{ $attributes->merge([
    'class' => 'bg-card border border-border rounded-xl p-6'
]) }}>
    {{ $slot }}
</div>