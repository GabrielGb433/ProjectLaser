<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use App\Models\Categoria;
use App\Models\Produto;
use App\Support\CatalogoGaleria;
use Illuminate\Contracts\View\View;

class HomeController extends Controller
{
    public function __construct(private readonly CatalogoGaleria $catalogoGaleria) {}

    public function __invoke(): View
    {
        $categorias = Categoria::query()
            ->where('ativo', true)
            ->with([
                'produtos' => fn ($query) => $query
                    ->where('ativo', true)
                    ->orderByDesc('destaque')
                    ->orderBy('ordem'),
            ])
            ->orderBy('ordem')
            ->orderBy('nome')
            ->get();

        $produtos = Produto::query()
            ->where('ativo', true)
            ->with([
                'categoria:id,nome,slug',
                'fotos' => fn ($query) => $query
                    ->where('ativo', true)
                    ->orderBy('ordem'),
            ])
            ->orderByDesc('destaque')
            ->orderBy('ordem')
            ->orderByDesc('created_at')
            ->get();

        $midias = $this->catalogoGaleria->dosProdutos($produtos);

        $slides = Banner::query()
            ->where('ativo', true)
            ->orderBy('ordem')
            ->orderByDesc('created_at')
            ->get()
            ->filter(fn (Banner $banner): bool => filled($banner->imagem))
            ->map(fn (Banner $banner): array => [
                'imagem' => $banner->imagem,
                'titulo' => $banner->titulo ?: 'Banner em destaque',
                'descricao' => $banner->subtitulo,
                'categoria' => $banner->subtitulo ?: 'Destaque',
                'link' => $banner->link,
            ])
            ->values();

        return view('pages.home', [
            'categorias' => $categorias,
            'produtos' => $produtos,
            'slides' => $slides,
            'galeria' => $midias->take(3),
        ]);
    }
}
