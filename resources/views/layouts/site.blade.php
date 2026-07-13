<!DOCTYPE html>
<html lang="pt-BR">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="theme-color" content="#111111">
        <meta name="description" content="Projetos personalizados com corte e gravação a laser, feitos com precisão e acabamento profissional.">

        <title>@yield('title', 'Laser Catálogo — Precisão em cada detalhe')</title>

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body>
        <a class="skip-link" href="#conteudo">Ir para o conteúdo</a>

        @include('partials.header')

        <main id="conteudo">
            @yield('content')
        </main>

        @include('partials.footer')
    </body>
</html>
