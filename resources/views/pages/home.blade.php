@extends('layouts.site')

@section('content')
    <section class="hero" id="inicio" data-slider aria-label="Banners em destaque">
        <div class="hero-slides">
            @forelse ($slides as $slide)
                <article class="hero-slide {{ $loop->first ? 'is-active' : '' }}" data-slide aria-hidden="{{ $loop->first ? 'false' : 'true' }}">
                    <img
                        src="{{ asset('storage/'.ltrim($slide['imagem'], '/')) }}"
                        alt="{{ $slide['titulo'] }}"
                        fetchpriority="{{ $loop->first ? 'high' : 'auto' }}"
                    >
                    <div class="hero-overlay"></div>
                </article>
            @empty
                <article class="hero-slide hero-fallback is-active" data-slide aria-hidden="false"></article>
            @endforelse
        </div>

        <div class="site-container hero-content">
            <span class="hero-kicker reveal" data-reveal>Design que ganha forma</span>
            <h1 class="reveal" data-reveal>Precisão em cada detalhe.</h1>
            <p class="reveal" data-reveal>Projetos personalizados com acabamento cuidadoso e soluções pensadas para cada ideia.</p>
            <div class="hero-actions reveal" data-reveal>
                <a class="button button-accent" href="{{ route('fotos.index') }}">
                    Ver projetos
                    <x-site.icon name="arrow-down-right" />
                </a>
                <a class="text-link text-link-light" href="#sobre">
                    Conheça nosso trabalho
                    <x-site.icon name="arrow-right" />
                </a>
            </div>
        </div>

        <div class="site-container hero-footer">
            <div class="hero-caption" aria-live="polite">
                @if ($slides->isNotEmpty())
                    <span data-slide-category>{{ $slides->first()['categoria'] ?: 'Projeto em destaque' }}</span>
                    <strong data-slide-title>{{ $slides->first()['titulo'] }}</strong>
                @else
                    <span>Criação personalizada</span>
                    <strong>Seu projeto pode começar aqui</strong>
                @endif
            </div>

            @if ($slides->count() > 1)
                <div class="slider-controls">
                    <button type="button" aria-label="Projeto anterior" data-slide-prev>
                        <x-site.icon name="chevron-left" />
                    </button>
                    <div class="slider-dots" role="tablist" aria-label="Selecionar projeto">
                        @foreach ($slides as $slide)
                            <button
                                class="{{ $loop->first ? 'is-active' : '' }}"
                                type="button"
                                role="tab"
                                aria-label="Exibir projeto {{ $loop->iteration }}"
                                aria-selected="{{ $loop->first ? 'true' : 'false' }}"
                                data-category="{{ $slide['categoria'] ?: 'Projeto em destaque' }}"
                                data-slide-dot="{{ $loop->index }}"
                            ></button>
                        @endforeach
                    </div>
                    <button type="button" aria-label="Próximo projeto" data-slide-next>
                        <x-site.icon name="chevron-right" />
                    </button>
                </div>
            @endif
        </div>

        <a class="scroll-cue" href="#categorias" aria-label="Ir para categorias">
            <span></span>
            Explorar
        </a>
    </section>

    <section class="section categories-section" id="categorias">
        <div class="site-container">
            <div class="section-intro-row reveal" data-reveal>
                <x-site.section-heading
                    eyebrow="Categorias"
                    title="Possibilidades para cada projeto."
                    description="Explore nossas linhas de trabalho e encontre o ponto de partida para a sua próxima ideia."
                />
                <a class="text-link" href="{{ route('fotos.index') }}">Ver todas as categorias <x-site.icon name="arrow-right" /></a>
            </div>

            @if ($categorias->isNotEmpty())
                <div class="categories-grid">
                    @foreach ($categorias as $categoria)
                        <x-site.category-card :categoria="$categoria" />
                    @endforeach
                </div>
            @else
                <div class="empty-state reveal" data-reveal>
                    <span>Novidades em breve</span>
                    <p>Estamos preparando novas categorias para apresentar por aqui.</p>
                </div>
            @endif
        </div>
    </section>

    <section class="section about-section" id="sobre">
        <div class="site-container about-grid">
            <div class="about-statement reveal" data-reveal>
                <span class="eyebrow">Sobre nós</span>
                <h2>Ideias precisas.<br><em>Resultados singulares.</em></h2>
            </div>

            <div class="about-copy reveal" data-reveal>
                <p class="about-lead">Unimos tecnologia, atenção aos detalhes e um olhar cuidadoso para criar peças que comunicam, encantam e permanecem.</p>
                <p>Cada projeto é acompanhado de perto — da escolha do material ao acabamento — para entregar soluções funcionais, consistentes e feitas sob medida.</p>
                <a class="text-link" href="#orcamentos">Conte sua ideia <x-site.icon name="arrow-right" /></a>
            </div>
        </div>
    </section>

    <section class="section gallery-section" id="fotos">
        <div class="site-container">
            <div class="section-intro-row reveal" data-reveal>
                <x-site.section-heading
                    eyebrow="Projetos recentes"
                    title="Detalhes que falam por si."
                    description="Uma pequena seleção de trabalhos cadastrados em nosso catálogo."
                />
                <a class="button button-outline" href="{{ route('fotos.index') }}">
                    Ver todas
                    <x-site.icon name="arrow-right" />
                </a>
            </div>

            @if ($galeria->isNotEmpty())
                <div class="gallery-grid">
                    @foreach ($galeria as $foto)
                        <figure
                            class="gallery-item gallery-item-{{ ($loop->index % 5) + 1 }} reveal"
                            role="button"
                            tabindex="0"
                            aria-label="Ampliar foto: {{ $foto['titulo'] }}"
                            data-reveal
                            data-gallery-item
                            data-gallery-src="{{ asset('storage/'.ltrim($foto['imagem'], '/')) }}"
                            data-gallery-title="{{ $foto['titulo'] }}"
                            data-gallery-category="{{ $foto['categoria'] ?: 'Projeto personalizado' }}"
                        >
                            <img src="{{ asset('storage/'.ltrim($foto['imagem'], '/')) }}" alt="{{ $foto['titulo'] }}" loading="lazy">
                            <figcaption>
                                <span>{{ $foto['categoria'] ?: 'Projeto personalizado' }}</span>
                                <strong>{{ $foto['titulo'] }}</strong>
                            </figcaption>
                        </figure>
                    @endforeach
                </div>
            @else
                <div class="empty-state reveal" data-reveal>
                    <span>Galeria em construção</span>
                    <p>As imagens cadastradas nos produtos aparecerão automaticamente neste espaço.</p>
                </div>
            @endif
        </div>
    </section>

    <section class="section services-section" id="servicos">
        <div class="site-container">
            <x-site.section-heading
                class="reveal"
                data-reveal
                eyebrow="Nossos serviços"
                title="Do conceito ao acabamento."
                description="Soluções pensadas para transformar referências em resultados precisos e duráveis."
            />

            <div class="services-grid">
                <article class="service-card reveal" data-reveal>
                    <span class="service-number">01</span>
                    <span class="service-icon"><x-site.icon name="precision" /></span>
                    <h3>Corte de precisão</h3>
                    <p>Recortes limpos e consistentes para projetos personalizados em diferentes formatos.</p>
                </article>

                <article class="service-card reveal" data-reveal>
                    <span class="service-number">02</span>
                    <span class="service-icon"><x-site.icon name="layers" /></span>
                    <h3>Projetos sob medida</h3>
                    <p>Soluções desenvolvidas de acordo com a necessidade, escala e identidade de cada ideia.</p>
                </article>

                <article class="service-card reveal" data-reveal>
                    <span class="service-number">03</span>
                    <span class="service-icon"><x-site.icon name="spark" /></span>
                    <h3>Acabamento cuidadoso</h3>
                    <p>Atenção aos detalhes para entregar peças com visual profissional e presença marcante.</p>
                </article>
            </div>
        </div>
    </section>

    <section class="section quote-section" id="orcamentos">
        <div class="site-container">
            <div class="quote-card reveal" data-reveal>
                <div>
                    <span class="eyebrow eyebrow-light">Seu próximo projeto</span>
                    <h2>Tem uma ideia?<br>Vamos dar forma a ela.</h2>
                </div>
                <div class="quote-action">
                    <p>Conte o que você precisa e receba uma orientação personalizada para começar.</p>
                    <a class="button button-light" href="https://wa.me/5551985450905" target="_blank" rel="noopener noreferrer">
                        Solicitar orçamento
                        <x-site.icon name="arrow-up-right" />
                    </a>
                </div>
                <span class="quote-orbit" aria-hidden="true"></span>
            </div>
        </div>
    </section>
@endsection
