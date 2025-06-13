<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    protected $fillable = [
        'nama_kopi',
        'harga',
        'deskripsi',
        'foto',
    ];

    // Relasi dengan Order (jika diperlukan)
    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}