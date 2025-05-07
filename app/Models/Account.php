<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Account extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'nama_akun']; // Jangan lupa untuk menambahkan properti $fillable

    // Relasi ke User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relasi ke Transaction
    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }

}

