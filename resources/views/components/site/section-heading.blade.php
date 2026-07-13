@props([
    'eyebrow',
    'title',
    'description' => null,
    'align' => 'left',
])

<div {{ $attributes->class(['section-heading', 'section-heading-center' => $align === 'center']) }}>
    <span class="eyebrow">{{ $eyebrow }}</span>
    <h2>{{ $title }}</h2>
    @if ($description)
        <p>{{ $description }}</p>
    @endif
</div>
