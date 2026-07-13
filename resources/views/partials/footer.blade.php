<footer class="site-footer" id="rodape">
    <div class="site-container footer-grid">
        <div class="footer-brand">
            <a href="{{ route('home') }}#inicio" aria-label="Laser Catálogo — início">
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
            <a href="{{ route('home') }}#orcamentos">Solicitar orçamento</a>
            <a href="{{ route('fotos.index') }}">Conhecer trabalhos</a>
            <span>Atendimento personalizado</span>
        </div>

        <div class="footer-column">
            <span class="footer-label">Acompanhe</span>
            <div class="social-links footer-socials" aria-label="Redes sociais">
                <a href="{{ route('home') }}#orcamentos" aria-label="Instagram">
                    <x-site.icon name="instagram" />
                </a>
                <a href="{{ route('home') }}#orcamentos" aria-label="WhatsApp">
                    <x-site.icon name="whatsapp" />
                </a>
            </div>
        </div>
    </div>

    <div class="site-container footer-bottom">
        <p>© {{ now()->year }} Laser Catálogo. Todos os direitos reservados.</p>
        <a href="{{ route('home') }}#inicio">Voltar ao topo <x-site.icon name="arrow-up" /></a>
    </div>
</footer>
