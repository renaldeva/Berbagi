<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tip extends Model
{
    protected $fillable = [
        'user_id',
        'jumlah',
        'pesan',
        'bukti_transfer', // tambahkan ini
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
