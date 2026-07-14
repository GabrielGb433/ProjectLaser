<?php

namespace App\Models;

use Database\Factories\ConfiguracaoSiteFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class ConfiguracaoSite extends Model
{
    /** @use HasFactory<ConfiguracaoSiteFactory> */
    use HasFactory;

    protected $fillable = [
        'nome_site',
        'logo',
        'whatsapp',
        'email',
        'instagram',
        'texto_quem_somos',
    ];

    public function getWhatsappUrlAttribute(): ?string
    {
        $numero = preg_replace('/\D+/', '', (string) $this->whatsapp);

        if ($numero === '') {
            return null;
        }

        if (! Str::startsWith($numero, '55')) {
            $numero = '55'.$numero;
        }

        return "https://wa.me/{$numero}";
    }

    public function getInstagramUrlAttribute(): ?string
    {
        $instagram = trim((string) $this->instagram);

        if ($instagram === '') {
            return null;
        }

        if (Str::startsWith($instagram, ['http://', 'https://'])) {
            return $instagram;
        }

        return 'https://instagram.com/'.ltrim($instagram, '@/');
    }
}
