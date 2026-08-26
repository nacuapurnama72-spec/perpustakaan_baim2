<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Katalog & Peminjaman Buku Perpustakaan') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <!-- Notifikasi Pesan -->
            @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg shadow-sm">
                    {{ session('success') }}
                </div>
            @endif
            @if(session('error'))
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg shadow-sm">
                    {{ session('error') }}
                </div>
            @endif

            <!-- Bagian 1: Daftar Katalog Buku Tersedia -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 border border-gray-100">
                <h3 class="text-lg font-bold text-gray-800 mb-4 flex items-center gap-2">
                    📚 <span>Daftar Katalog Buku Tersedia</span>
                </h3>
                
                <div class="overflow-x-auto">
                    <table class="w-full border-collapse border border-gray-200">
                        <thead>
                            <tr class="bg-gray-100 text-gray-700 text-sm">
                                <th class="border border-gray-300 px-4 py-2">Kode</th>
                                <th class="border border-gray-300 px-4 py-2 text-left">Judul Buku</th>
                                <th class="border border-gray-300 px-4 py-2 text-left">Pengarang</th>
                                <th class="border border-gray-300 px-4 py-2 text-left">Penerbit</th>
                                <th class="border border-gray-300 px-4 py-2 text-center">Stok</th>
                                <th class="border border-gray-300 px-4 py-2 text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="text-sm">
                            @forelse($bukus as $buku)
                            <tr class="hover:bg-gray-50 transition">
                                <td class="border border-gray-200 px-4 py-2 text-center font-semibold text-gray-700">{{ $buku->kode_buku }}</td>
                                <td class="border border-gray-200 px-4 py-2 font-medium text-gray-900">{{ $buku->judul }}</td>
                                <td class="border border-gray-200 px-4 py-2 text-gray-600">{{ $buku->pengarang }}</td>
                                <td class="border border-gray-200 px-4 py-2 text-gray-600">{{ $buku->penerbit }}</td>
                                <td class="border border-gray-200 px-4 py-2 text-center font-bold text-gray-700">{{ $buku->stok }}</td>
                                <td class="border border-gray-200 px-4 py-2 text-center">
                                    <form action="{{ route('user.pinjam') }}" method="POST" class="inline-block">
                                        @csrf
                                        <input type="hidden" name="buku_id" value="{{ $buku->id }}">
                                        <input type="hidden" name="tanggal_kembali" value="{{ date('Y-m-d', strtotime('+7 days')) }}">
                                        <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-4 py-1.5 rounded-md shadow-sm transition-all text-xs">
                                            Pinjam
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6" class="border border-gray-200 p-4 text-center text-gray-500">Semua stok buku sedang kosong atau habis dipinjam.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Bagian 2: Riwayat Peminjaman Saya -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 border border-gray-100">
                <h3 class="text-lg font-bold text-gray-800 mb-4 flex items-center gap-2">
                    📖 <span>Riwayat Peminjaman Buku Saya</span>
                </h3>
                
                <div class="overflow-x-auto">
                    <table class="w-full border-collapse border border-gray-200">
                        <thead>
                            <tr class="bg-gray-100 text-gray-700 text-sm">
                                <th class="border border-gray-300 px-4 py-2 text-center">No</th>
                                <th class="border border-gray-300 px-4 py-2 text-left">Judul Buku</th>
                                <th class="border border-gray-300 px-4 py-2 text-center">Tanggal Pinjam</th>
                                <th class="border border-gray-300 px-4 py-2 text-center">Batas Pengembalian</th>
                                <th class="border border-gray-300 px-4 py-2 text-center">Status</th>
                                <th class="border border-gray-300 px-4 py-2 text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="text-sm">
                            @forelse($riwayat as $index => $r)
                            <tr class="hover:bg-gray-50 transition">
                                <td class="border border-gray-200 px-4 py-2 text-center text-gray-600">{{ $index + 1 }}</td>
                                <td class="border border-gray-200 px-4 py-2 font-medium text-gray-900">{{ $r->buku->judul }}</td>
                                <td class="border border-gray-200 px-4 py-2 text-center text-gray-600">{{ $r->tanggal_pinjam }}</td>
                                <td class="border border-gray-200 px-4 py-2 text-center text-gray-600">{{ $r->tanggal_kembali }}</td>
                                <td class="border border-gray-200 px-4 py-2 text-center">
                                    @if($r->status === 'dipinjam')
                                        <span class="inline-block bg-amber-100 text-amber-800 border border-amber-300 px-3 py-0.5 rounded-full text-xs font-semibold shadow-sm">
                                            Dipinjam
                                        </span>
                                    @else
                                        <span class="inline-block bg-green-100 text-green-800 border border-green-300 px-3 py-0.5 rounded-full text-xs font-semibold shadow-sm">
                                            Dikembalikan
                                        </span>
                                    @endif
                                </td>
                                <td class="border border-gray-200 px-4 py-2 text-center">
                                    @if($r->status === 'dipinjam')
                                        <form action="{{ route('user.kembali', $r->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Yakin ingin mengembalikan buku ini?')">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white font-semibold px-3 py-1.5 rounded-md shadow-sm transition-all text-xs">
                                                Kembalikan
                                            </button>
                                        </form>
                                    @else
                                        <span class="text-gray-400 font-medium text-xs">Selesai</span>
                                    @endif
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6" class="border border-gray-200 p-4 text-center text-gray-500">Belum ada riwayat peminjaman buku.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>