@php
    $nomeSite = $configuracaoSite?->nome_site ?: 'Crie e Corte';
    $logoUrl = filled($configuracaoSite?->logo)
        ? asset('storage/'.ltrim($configuracaoSite->logo, '/'))
        : null;
@endphp

<span {{ $attributes->class(['brand-lockup']) }}>
    @if ($logoUrl)
        <img class="brand-logo" src="{{ $logoUrl }}" alt="{{ $nomeSite }}">
    @else
        <span class="brand-mark" aria-hidden="true">
            <svg viewBox="0 0 40 40" fill="none">
                <path d="M10 9v22h20" />
                <path d="m24 8 2.1 5.9L32 16l-5.9 2.1L24 24l-2.1-5.9L16 16l5.9-2.1L24 8Z" />
            </svg>
        </span>
    @endif
    <span class="brand-name">{{ $nomeSite }}</span>
</span>
