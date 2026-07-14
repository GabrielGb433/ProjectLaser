@php
    $whatsappUrl = $configuracaoSite?->whatsapp_url;
    $instagramUrl = $configuracaoSite?->instagram_url;
@endphp

<header class="site-header" data-header>
    <div class="site-container header-inner">
        <a class="header-brand" href="{{ route('home') }}#inicio" aria-label="{{ $configuracaoSite?->nome_site ?: 'Crie e Corte' }} — início">
            <x-site.logo />
        </a>

        <nav class="desktop-nav" aria-label="Navegação principal">
            <a href="{{ route('home') }}#inicio">Início</a>
            <a href="{{ route('home') }}#sobre">Sobre</a>
            <a href="{{ route('fotos.index') }}">Fotos</a>
            <a href="{{ route('home') }}#orcamentos">Orçamentos</a>
        </nav>

        <div class="header-actions">
            <div class="social-links header-socials" aria-label="Redes sociais">
                @if ($instagramUrl)
                    <a href="{{ $instagramUrl }}" target="_blank" rel="noopener noreferrer" aria-label="Instagram">
                        <x-site.icon name="instagram" />
                    </a>
                @endif
                @if ($whatsappUrl)
                    <a href="{{ $whatsappUrl }}" target="_blank" rel="noopener noreferrer" aria-label="WhatsApp">
                        <x-site.icon name="whatsapp" />
                    </a>
                @endif
            </div>

            @if ($whatsappUrl)
                <a class="button button-small button-accent header-contact" href="{{ $whatsappUrl }}" target="_blank" rel="noopener noreferrer">
                    Entrar em contato
                    <x-site.icon name="arrow-up-right" />
                </a>
            @endif

            <button class="menu-toggle" type="button" aria-label="Abrir menu" aria-expanded="false" aria-controls="mobile-menu" data-menu-toggle>
                <span></span>
                <span></span>
            </button>
        </div>
    </div>

    <div class="mobile-menu" id="mobile-menu" data-mobile-menu>
        <nav aria-label="Navegação móvel">
            <a href="{{ route('home') }}#inicio">Início</a>
            <a href="{{ route('home') }}#sobre">Sobre</a>
            <a href="{{ route('fotos.index') }}">Fotos</a>
            <a href="{{ route('home') }}#orcamentos">Orçamentos</a>
        </nav>

        @if ($whatsappUrl)
            <a class="button button-accent" href="{{ $whatsappUrl }}" target="_blank" rel="noopener noreferrer">
                Entrar em contato
                <x-site.icon name="arrow-up-right" />
            </a>
        @endif

        <div class="social-links mobile-socials" aria-label="Redes sociais">
            @if ($instagramUrl)
                <a href="{{ $instagramUrl }}" target="_blank" rel="noopener noreferrer" aria-label="Instagram">
                    <x-site.icon name="instagram" />
                </a>
            @endif
            @if ($whatsappUrl)
                <a href="{{ $whatsappUrl }}" target="_blank" rel="noopener noreferrer" aria-label="WhatsApp">
                    <x-site.icon name="whatsapp" />
                </a>
            @endif
        </div>
    </div>
</header>
