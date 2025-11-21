<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Agreement extends Model
{
    use HasFactory;
    protected $table = 'agreements';
    protected $fillable = ['request_id','tanggal','waktu','lokasi','status'];

    public function requestDonation() { return $this->belongsTo(RequestDonation::class, 'request_id'); }
}
