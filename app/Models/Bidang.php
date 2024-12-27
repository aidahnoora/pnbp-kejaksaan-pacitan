<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bidang extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_bidang';
    protected $fillable = [
        'nama_bidang',
        'alias'
    ];

    public function inputan_bidang()
    {
        return $this->hasMany(InputanBidang::class, 'id_inputan_bidang', 'bidang_id');
    }
}
