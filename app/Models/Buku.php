<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Buku extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function peminjamans()
    {
        return $this->hasMany(Peminjaman::class);
    }

        public function index()
    {
        $bukus = Buku::where('stok', '>', 0)->get();
        $riwayat = Peminjaman::with('buku')
                    ->where('user_id', auth()->id())
                    ->latest()
                    ->get();

        // Arahkan ke view 'dashboard'
        return view('dashboard', compact('bukus', 'riwayat'));
    }

}