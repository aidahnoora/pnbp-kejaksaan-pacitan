<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class InputanBidang extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_inputan_bidang';
    protected $fillable = [
        'bidang_id',
        'ntpn',
        'jumlah',
        'tgl_setor',
        'uraian',
    ];

    public function bidang(): BelongsTo
    {
        return $this->belongsTo(Bidang::class, 'bidang_id', 'id_bidang');
    }
}
