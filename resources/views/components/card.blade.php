@props([
    'title' => null,
    'footer' => null,
    'rounded' => 'rounded-xl',
    'bg' => 'bg-white',
    'padding' => 'p-6',
])

<div {{ $attributes->merge(['class' => 'card border border-gray-300 shadow mb-6 $bg $rounded']) }}>
    @if (!empty($title))
        <div class="card-header px-6 py-4 border-b border-gray-300 text-lg font-semibold">
            {{ $title }}
        </div>
    @endif

    <div class="card-body p-6">
        {{ $slot }}
    </div>

    @if (!empty($footer))
        <div class="card-footer px-6 py-4 border-t border-gray-300 bg-gray-50">
            {{ $footer }}
        </div>
    @endif
</div>
