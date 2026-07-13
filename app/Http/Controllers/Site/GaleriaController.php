<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\Categoria;
use App\Models\Produto;
use App\Support\CatalogoGaleria;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class GaleriaController extends Controller
{
    public function __construct(private readonly CatalogoGaleria $catalogoGaleria) {}

    public function __invoke(Request $request): View
    {
        $categoriaSelecionada = trim((string) $request->query('categoria'));
        $busca = trim((string) $request->query('busca'));

        $categorias = Categoria::query()
            ->where('ativo', true)
            ->withCount([
                'produtos' => fn (Builder $query) => $query->where('ativo', true),
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
            ->when(
                $categoriaSelecionada !== '',
                fn (Builder $query) => $query->whereHas(
                    'categoria',
                    fn (Builder $categoria) => $categoria
                        ->where('ativo', true)
                        ->where('slug', $categoriaSelecionada),
                ),
            )
            ->when($busca !== '', function (Builder $query) use ($busca): void {
                $query->where(function (Builder $query) use ($busca): void {
                    $query
                        ->where('nome', 'like', "%{$busca}%")
                        ->orWhere('descricao_curta', 'like', "%{$busca}%")
                        ->orWhereHas(
                            'categoria',
                            fn (Builder $categoria) => $categoria->where('nome', 'like', "%{$busca}%"),
                        );
                });
            })
            ->orderByDesc('destaque')
            ->orderBy('ordem')
            ->orderByDesc('created_at')
            ->get();

        return view('pages.fotos', [
            'categorias' => $categorias,
            'fotos' => $this->catalogoGaleria->dosProdutos($produtos),
            'categoriaSelecionada' => $categoriaSelecionada,
            'busca' => $busca,
        ]);
    }
}
