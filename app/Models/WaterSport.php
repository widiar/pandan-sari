<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WaterSport extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function cart()
    {
        return $this->hasMany(Cart::class, 'watersport_id', 'id');
    }

    public function getSisa($date)
    {
        $cek = $this->cart()->where('status', 'payment-verifed')->where('tanggal', $date)->get();
        $jumlah = 0;
        foreach($cek as $c){
            $jumlah += $c->jumlah;
        }
        return $this->limit - $jumlah;
    }
}
