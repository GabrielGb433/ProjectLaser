<!DOCTYPE html>
<html lang="pt-BR">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="theme-color" content="#111111">
        <meta name="description" content="Projetos personalizados com corte e gravação a laser, feitos com precisão e acabamento profissional.">
        <link rel="icon" type="image/png" href="{{ asset('brand/logo-mark.png') }}">
        <link rel="apple-touch-icon" href="{{ asset('brand/logo-mark.png') }}">

        <title>@yield('title', ($configuracaoSite?->nome_site ?: 'Crie e Corte').' - Precisão em cada detalhe')</title>

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body>
        <a class="skip-link" href="#conteudo">Ir para o conteúdo</a>

        @include('partials.header')

        <main id="conteudo">
            @yield('content')
        </main>

        @include('partials.footer')

        <div class="gallery-viewer" data-gallery-viewer aria-hidden="true">
            <button class="gallery-viewer-backdrop" type="button" data-gallery-close tabindex="-1" aria-label="Fechar visualização"></button>
            <div class="gallery-viewer-dialog" role="dialog" aria-modal="true" aria-labelledby="gallery-viewer-title">
                <button class="gallery-viewer-close" type="button" data-gallery-close aria-label="Fechar visualização">&times;</button>
                <div class="gallery-viewer-media">
                    <img src="" alt="" data-gallery-image>
                </div>
                <div class="gallery-viewer-info">
                    <div>
                        <span data-gallery-category></span>
                        <strong id="gallery-viewer-title" data-gallery-title></strong>
                    </div>
                    <span class="gallery-viewer-count" data-gallery-count></span>
                </div>
                <button class="gallery-viewer-nav gallery-viewer-prev" type="button" data-gallery-prev aria-label="Foto anterior">
                    <x-site.icon name="chevron-left" />
                </button>
                <button class="gallery-viewer-nav gallery-viewer-next" type="button" data-gallery-next aria-label="Próxima foto">
                    <x-site.icon name="chevron-right" />
                </button>
            </div>
        </div>
    </body>
</html>
