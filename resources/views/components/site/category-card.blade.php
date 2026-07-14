@props(['categoria'])

@php
    $imagem = $categoria->imagem ?: $categoria->produtos->first()?->imagem_principal;
    $quantidade = $categoria->produtos->count();
@endphp

<a class="category-card reveal" href="{{ route('fotos.index', ['categoria' => $categoria->slug]) }}" data-reveal>
    <span class="category-content">
        <strong>{{ $categoria->nome }}</strong>
        <span>{{ $quantidade }} {{ $quantidade === 1 ? 'projeto' : 'projetos' }}</span>
    </span>

    <span class="category-media">
        @if ($imagem)
            <img src="{{ asset('storage/'.ltrim($imagem, '/')) }}" alt="{{ $categoria->nome }}" loading="lazy">
        @else
            <span class="category-placeholder" aria-hidden="true">{{ mb_substr(trim($categoria->nome), 0, 1) }}</span>
        @endif
        <span class="category-arrow"><x-site.icon name="arrow-up-right" /></span>
    </span>
</a>
