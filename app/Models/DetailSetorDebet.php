<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DetailSetorDebet extends Model
{
    use HasFactory;
    protected $primaryKey = 'id_detail_setor_debet';
    protected $table = 'detail_setor_debet';
    protected $guarded = [];

    // relasi first
    public function setorDebet(): BelongsTo
    {
        return $this->belongsTo(SetorDebet::class, 'setor_debet_id', 'id_setor_debet');
    }
    // relasi end
}
