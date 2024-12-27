<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class BaDenda extends Model
{
    use HasFactory;
    protected $primaryKey = 'id_ba_denda';
    protected $table = 'ba_denda';
    protected $guarded = [];

    // relasi first
    public function detailBaDenda(): HasMany
    {
        return $this->hasMany(DetailBaDenda::class, 'ba_denda_id', 'id_ba_denda');
    }
    // relasi end
}
