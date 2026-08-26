<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Buku;
use App\Models\Peminjaman;
use Illuminate\Http\Request;

class KatalogController extends Controller
{
    public function index()
    {
        $bukus = Buku::where('stok', '>', 0)->get();
        $riwayat = Peminjaman::with('buku')
                    ->where('user_id', auth()->id())
                    ->latest()
                    ->get();

        // Mengarahkan ke file resources/views/dashboard.blade.php
        return view('dashboard', compact('bukus', 'riwayat'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'buku_id' => 'required|exists:bukus,id',
            'tanggal_kembali' => 'required|date|after:today',
        ]);

        $buku = Buku::findOrFail($request->buku_id);

        if ($buku->stok <= 0) {
            return back()->with('error', 'Maaf, stok buku ini sedang kosong.');
        }

        Peminjaman::create([
            'user_id' => auth()->id(),
            'buku_id' => $request->buku_id,
            'tanggal_pinjam' => date('Y-m-d'),
            'tanggal_kembali' => $request->tanggal_kembali,
            'status' => 'dipinjam',
        ]);

        $buku->decrement('stok');

        return redirect()->route('dashboard')->with('success', 'Berhasil meminjam buku. Silakan ambil buku di perpustakaan.');
    }

    public function kembali($id)
    {
        $peminjaman = Peminjaman::where('user_id', auth()->id())
                                ->where('id', $id)
                                ->firstOrFail();

        if ($peminjaman->status === 'dikembalikan') {
            return back()->with('error', 'Buku ini sudah dikembalikan.');
        }

        // Ubah status peminjaman menjadi dikembalikan
        $peminjaman->update([
            'status' => 'dikembalikan',
        ]);

        // Tambah stok buku kembali +1
        $peminjaman->buku()->increment('stok');

        return redirect()->route('dashboard')->with('success', 'Buku berhasil dikembalikan.');
    }
}