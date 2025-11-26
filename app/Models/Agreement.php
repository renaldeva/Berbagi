<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Agreement extends Model
{
    protected $fillable = [
        'request_id',
        'catatan',
    ];

    public function request()
    {
        return $this->belongsTo(Request::class);
    }
}
