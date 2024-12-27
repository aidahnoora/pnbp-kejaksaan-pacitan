<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SetorDebet extends Model
{
    use HasFactory;
    protected $primaryKey = 'id_setor_debet';
    protected $table = 'setor_debet';
    protected $guarded = [];


    // relasi first
    public function detailSetorDebet(): HasMany
    {
        return $this->hasMany(DetailSetorDebet::class, 'setor_debet_id', 'id_setor_debet');
    }
    // relasi end
}
