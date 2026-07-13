<header class="site-header" data-header>
    <div class="site-container header-inner">
        <a class="header-brand" href="{{ route('home') }}#inicio" aria-label="Laser Catálogo — início">
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
                <a href="{{ route('home') }}#orcamentos" aria-label="Instagram">
                    <x-site.icon name="instagram" />
                </a>
                <a href="https://wa.me/51984410896" target="_blank" rel="noopener noreferrer" aria-label="WhatsApp">
                    <x-site.icon name="whatsapp" />
                </a>
            </div>

            <a class="button button-small button-accent header-contact" href="https://wa.me/51984410896" target="_blank" rel="noopener noreferrer">
                Entrar em contato
                <x-site.icon name="arrow-up-right" />
            </a>

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

        <a class="button button-accent" href="https://wa.me/51984410896" target="_blank" rel="noopener noreferrer">
            Entrar em contato
            <x-site.icon name="arrow-up-right" />
        </a>

        <div class="social-links mobile-socials" aria-label="Redes sociais">
            <a href="{{ route('home') }}#orcamentos" aria-label="Instagram">
                <x-site.icon name="instagram" />
            </a>
            <a href="https://wa.me/51984410896" target="_blank" rel="noopener noreferrer" aria-label="WhatsApp">
                <x-site.icon name="whatsapp" />
            </a>
        </div>
    </div>
</header>
