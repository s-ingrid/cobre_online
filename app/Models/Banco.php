<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Banco extends Model
{
    use HasFactory;

    protected $table = 'banco';
    protected $primaryKey = 'banco_id';

    protected $fillable = [
        'bco_numero',
        'bco_nome',
        'bco_ativo',
        'bco_arquivo',
        'excluido',
        'cadastrado',
    ];

    public $timestamps = false;
}
