@extends('layouts.site')

@section('title', 'Fotos — Laser Catálogo')

@section('content')
    @php
        $categoriaAtual = $categorias->firstWhere('slug', $categoriaSelecionada);
    @endphp

    <section class="gallery-page-hero">
        <div class="site-container">
            <nav class="breadcrumbs reveal" data-reveal aria-label="Navegação estrutural">
                <a href="{{ route('home') }}">Início</a>
                <span>/</span>
                <span>Fotos</span>
            </nav>

            <div class="gallery-page-heading reveal" data-reveal>
                <span class="eyebrow eyebrow-light">Nosso catálogo</span>
                <h1>Galeria de projetos.</h1>
                <p>Explore os trabalhos por categoria ou encontre um projeto pelo nome.</p>
            </div>
        </div>
    </section>

    <section class="photos-catalog">
        <div class="site-container">
            <div class="catalog-toolbar reveal" data-reveal>
                <form class="catalog-search" action="{{ route('fotos.index') }}" method="GET" role="search">
                    @if ($categoriaSelecionada !== '')
                        <input type="hidden" name="categoria" value="{{ $categoriaSelecionada }}">
                    @endif

                    <label class="visually-hidden" for="catalog-search">Buscar pelo nome</label>
                    <x-site.icon name="search" />
                    <input
                        id="catalog-search"
                        type="search"
                        name="busca"
                        value="{{ $busca }}"
                        placeholder="Buscar pelo nome..."
                        maxlength="100"
                    >
                    <button type="submit">Buscar</button>
                </form>

                @if ($categoriaSelecionada !== '' || $busca !== '')
                    <a class="clear-filters" href="{{ route('fotos.index') }}">Limpar filtros</a>
                @endif
            </div>

            <div class="category-filters reveal" data-reveal aria-label="Filtrar por categoria">
                <a
                    class="category-filter {{ $categoriaSelecionada === '' ? 'is-active' : '' }}"
                    href="{{ route('fotos.index', array_filter(['busca' => $busca])) }}"
                >
                    Todas
                </a>

                @foreach ($categorias as $categoria)
                    <a
                        class="category-filter {{ $categoriaSelecionada === $categoria->slug ? 'is-active' : '' }}"
                        href="{{ route('fotos.index', array_filter(['categoria' => $categoria->slug, 'busca' => $busca])) }}"
                    >
                        {{ $categoria->nome }}
                        <span>{{ $categoria->produtos_count }}</span>
                    </a>
                @endforeach
            </div>

            <div class="catalog-results-header reveal" data-reveal>
                <div>
                    <span>{{ $categoriaAtual?->nome ?: 'Todos os projetos' }}</span>
                    @if ($busca !== '')
                        <small>Resultados para “{{ $busca }}”</small>
                    @endif
                </div>
                <strong>{{ $fotos->count() }} {{ $fotos->count() === 1 ? 'foto' : 'fotos' }}</strong>
            </div>

            @if ($fotos->isNotEmpty())
                <div class="gallery-grid gallery-page-grid">
                    @foreach ($fotos as $foto)
                        <figure class="gallery-item gallery-item-{{ ($loop->index % 5) + 1 }} reveal" data-reveal>
                            <img src="{{ asset('storage/'.ltrim($foto['imagem'], '/')) }}" alt="{{ $foto['titulo'] }}" loading="lazy">
                            <figcaption>
                                <span>{{ $foto['categoria'] ?: 'Projeto personalizado' }}</span>
                                <strong>{{ $foto['titulo'] }}</strong>
                            </figcaption>
                        </figure>
                    @endforeach
                </div>
            @else
                <div class="empty-state catalog-empty reveal" data-reveal>
                    <span>Nenhuma foto encontrada</span>
                    <p>Tente buscar outro nome ou selecionar uma categoria diferente.</p>
                    <a class="button button-outline" href="{{ route('fotos.index') }}">Ver todas as fotos</a>
                </div>
            @endif
        </div>
    </section>
@endsection
