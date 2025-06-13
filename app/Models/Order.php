<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'user_id',
        'menu_id',
        'nama',
        'jumlah',
        'alamat',
        'nomor_wa',
        'status',
        'waktu_pesan',
    ];

    // Relasi dengan User (jika diperlukan)
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relasi dengan Menu
    public function menu()
    {
        return $this->belongsTo(Menu::class);
    }
}