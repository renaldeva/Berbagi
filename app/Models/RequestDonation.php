<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class RequestDonation extends Model
{
    use HasFactory;
    protected $table = 'requests';
    protected $fillable = ['item_id','id_penerima','pesan','status'];

    public function item() { return $this->belongsTo(Item::class, 'item_id'); }
    public function penerima() { return $this->belongsTo(User::class, 'id_penerima'); }
    public function agreement() { return $this->hasOne(Agreement::class, 'request_id'); }
}
