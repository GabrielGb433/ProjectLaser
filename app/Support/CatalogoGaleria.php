<?php

namespace App\Support;

use App\Models\Produto;
use Illuminate\Support\Collection;

class CatalogoGaleria
{
    public function dosProdutos(Collection $produtos): Collection
    {
        return $produtos
            ->flatMap(fn (Produto $produto): Collection => $this->doProduto($produto))
            ->filter(fn (array $midia): bool => filled($midia['imagem']))
            ->unique('imagem')
            ->values();
    }

    private function doProduto(Produto $produto): Collection
    {
        $dadosComuns = [
            'produto' => $produto->nome,
            'produto_slug' => $produto->slug,
            'descricao' => $produto->descricao_curta,
            'categoria' => $produto->categoria?->nome,
            'categoria_slug' => $produto->categoria?->slug,
        ];

        $imagemPrincipal = filled($produto->imagem_principal)
            ? collect([[
                ...$dadosComuns,
                'imagem' => $produto->imagem_principal,
                'titulo' => $produto->nome,
            ]])
            : collect();

        $fotos = $produto->fotos->map(fn ($foto): array => [
            ...$dadosComuns,
            'imagem' => $foto->imagem,
            'titulo' => $foto->legenda ?: $produto->nome,
        ]);

        return $imagemPrincipal->concat($fotos);
    }
}
