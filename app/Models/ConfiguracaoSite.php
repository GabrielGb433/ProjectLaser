<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ConfiguracaoSite extends Model
{
    /** @use HasFactory<\Database\Factories\ConfiguracaoSiteFactory> */
    use HasFactory;

    protected $fillable = [
        'nome_site',
        'logo',
        'whatsapp',
        'email',
        'instagram',
        'texto_quem_somos',
    ];
}
