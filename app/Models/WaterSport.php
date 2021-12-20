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

    public function getSisa($day)
    {
        return $this->limit -  $this->cart()->where('status', 'payment-verifed')->whereDay('tanggal', $day)->count();
    }
}
