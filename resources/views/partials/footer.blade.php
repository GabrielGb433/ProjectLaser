@php
    $whatsappUrl = $configuracaoSite?->whatsapp_url;
    $instagramUrl = $configuracaoSite?->instagram_url;
@endphp

<footer class="site-footer" id="rodape">
    <div class="site-container footer-grid">
        <div class="footer-brand">
            <a href="{{ route('home') }}#inicio" aria-label="{{ $configuracaoSite?->nome_site ?: 'Crie e Corte' }} — início">
                <x-site.logo />
            </a>
            <p>Precisão, cuidado e acabamento para transformar cada ideia em uma peça única.</p>
        </div>

        <div class="footer-column">
            <span class="footer-label">Navegação</span>
            <a href="{{ route('home') }}#inicio">Início</a>
            <a href="{{ route('home') }}#sobre">Sobre</a>
            <a href="{{ route('fotos.index') }}">Fotos</a>
            <a href="{{ route('home') }}#orcamentos">Orçamentos</a>
        </div>

        <div class="footer-column" id="contato">
            <span class="footer-label">Contato</span>
            @if ($whatsappUrl)
                <a href="{{ $whatsappUrl }}" target="_blank" rel="noopener noreferrer">Solicitar orçamento</a>
            @endif
            @if (filled($configuracaoSite?->email))
                <a href="mailto:{{ $configuracaoSite->email }}">{{ $configuracaoSite->email }}</a>
            @endif
            <a href="{{ route('fotos.index') }}">Conhecer trabalhos</a>
            <span>Atendimento personalizado</span>
        </div>

        <div class="footer-column">
            <span class="footer-label">Acompanhe</span>
            <div class="social-links footer-socials" aria-label="Redes sociais">
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
    </div>

    <div class="site-container footer-bottom">
        <p>© {{ now()->year }} {{ $configuracaoSite?->nome_site ?: 'Crie e Corte' }}. Todos os direitos reservados.</p>
        <a href="{{ route('home') }}#inicio">Voltar ao topo <x-site.icon name="arrow-up" /></a>
    </div>
</footer>
