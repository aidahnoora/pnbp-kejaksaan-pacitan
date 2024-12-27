<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DetailBaDenda extends Model
{
    use HasFactory;
    protected $primaryKey = 'id_detail_ba_denda';
    protected $table = 'detail_ba_denda';
    protected $guarded = [];


    // relasi first
    public function baDenda(): BelongsTo
    {
        return $this->belongsTo(BaDenda::class, 'ba_denda_id', 'id_ba_denda');
    }
    // relasi end
}
