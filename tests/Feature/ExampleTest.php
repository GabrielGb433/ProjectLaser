<?php

use App\Models\Banner;
use App\Models\Categoria;
use App\Models\Produto;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

test('a página pública inicial é exibida com sucesso', function () {
    $response = $this->get('/');

    $response
        ->assertOk()
        ->assertSee('Precisão em cada detalhe.')
        ->assertSee('Nossos serviços');
});

test('o carrossel exibe somente banners ativos', function () {
    Banner::query()->create([
        'titulo' => 'Banner principal',
        'imagem' => 'banners/banner-principal.jpg',
        'ativo' => true,
        'ordem' => 1,
    ]);

    Banner::query()->create([
        'titulo' => 'Banner inativo',
        'imagem' => 'banners/banner-inativo.jpg',
        'ativo' => false,
        'ordem' => 2,
    ]);

    $this->get('/')
        ->assertOk()
        ->assertSee('storage/banners/banner-principal.jpg')
        ->assertDontSee('storage/banners/banner-inativo.jpg');
});

test('a galeria pode ser filtrada por categoria e nome do produto', function () {
    $mdf = Categoria::query()->create([
        'nome' => 'MDF',
        'slug' => 'mdf',
        'ativo' => true,
        'ordem' => 1,
    ]);

    $acrilico = Categoria::query()->create([
        'nome' => 'Acrílico',
        'slug' => 'acrilico',
        'ativo' => true,
        'ordem' => 2,
    ]);

    Produto::query()->create([
        'categoria_id' => $mdf->id,
        'nome' => 'Placa decorativa',
        'slug' => 'placa-decorativa',
        'imagem_principal' => 'produtos/placa-mdf.jpg',
        'ativo' => true,
    ]);

    Produto::query()->create([
        'categoria_id' => $acrilico->id,
        'nome' => 'Display de mesa',
        'slug' => 'display-de-mesa',
        'imagem_principal' => 'produtos/display-acrilico.jpg',
        'ativo' => true,
    ]);

    $this->get(route('fotos.index', ['categoria' => 'mdf']))
        ->assertOk()
        ->assertSee('storage/produtos/placa-mdf.jpg')
        ->assertDontSee('storage/produtos/display-acrilico.jpg');

    $this->get(route('fotos.index', ['busca' => 'Display']))
        ->assertOk()
        ->assertSee('storage/produtos/display-acrilico.jpg')
        ->assertDontSee('storage/produtos/placa-mdf.jpg');

    $this->get(route('home'))
        ->assertSee(route('fotos.index', ['categoria' => 'mdf']), false);
});
