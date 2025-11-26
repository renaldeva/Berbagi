<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Request extends Model 
{
    protected $table = 'requests';

    protected $fillable = [
        'item_id',
        'user_id',
        'pesan',
        'status'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
