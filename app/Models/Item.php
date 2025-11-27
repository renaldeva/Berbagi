<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $fillable = [
        'nama_barang',
        'deskripsi',
        'kondisi',
        'category_id',
        'foto',
        'status',
        'user_id',
    ];    

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function category()
    {
    return $this->belongsTo(Category::class, 'category_id');
    }
   
}
