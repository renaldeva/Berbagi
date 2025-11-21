<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Item extends Model
{
    use HasFactory;
    protected $table = 'items';
    protected $fillable = [
        'nama_barang','kategori','kondisi','deskripsi','foto','status','id_donatur'
    ];

    public function donatur() { return $this->belongsTo(User::class, 'id_donatur'); }
    public function requests() { return $this->hasMany(RequestDonation::class, 'item_id'); }
}
