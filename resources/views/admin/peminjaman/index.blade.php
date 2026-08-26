<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Kelola Transaksi Peminjaman Buku') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                
                {{-- Header Judul & Tombol Tambah --}}
                <div class="flex justify-between items-center mb-6 pb-4 border-b border-gray-200">
                    <div>
                        <h3 class="text-lg font-bold text-gray-800">Transaksi Peminjaman</h3>
                        <p class="text-sm text-gray-500">Daftar transaksi peminjaman dan pengembalian buku</p>
                    </div>

                    <a href="{{ route('admin.peminjaman.create') }}" 
                       style="background-color: #059669; color: #ffffff; padding: 8px 16px; border-radius: 6px; font-weight: 600; text-decoration: none; display: inline-block;">
                        + Catat Peminjaman Baru
                    </a>
                </div>

                {{-- Notifikasi --}}
                @if(session('success'))
                    <div style="background-color: #d1fae5; color: #065f46; padding: 12px; border-radius: 6px; margin-bottom: 16px;">
                        {{ session('success') }}
                    </div>
                @endif

                @if(session('error'))
                    <div style="background-color: #fee2e2; color: #991b1b; padding: 12px; border-radius: 6px; margin-bottom: 16px;">
                        {{ session('error') }}
                    </div>
                @endif

                {{-- Tabel Data Peminjaman --}}
                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left text-gray-600 border border-gray-300">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-100 border-b border-gray-300">
                            <tr>
                                <th class="px-4 py-3 border-r text-center" style="width: 50px;">No</th>
                                <th class="px-4 py-3 border-r">Nama Peminjam</th>
                                <th class="px-4 py-3 border-r">Judul Buku</th>
                                <th class="px-4 py-3 border-r text-center">Tgl Pinjam</th>
                                <th class="px-4 py-3 border-r text-center">Tgl Kembali</th>
                                <th class="px-4 py-3 border-r text-center">Status</th>
                                <th class="px-4 py-3 text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($peminjamans as $index => $p)
                            <tr class="bg-white border-b hover:bg-gray-50">
                                <td class="px-4 py-3 border-r text-center font-semibold text-gray-700">{{ $index + 1 }}</td>
                                <td class="px-4 py-3 border-r font-medium text-gray-900">{{ $p->user->name }}</td>
                                <td class="px-4 py-3 border-r">{{ $p->buku->judul }}</td>
                                <td class="px-4 py-3 border-r text-center">{{ $p->tanggal_pinjam }}</td>
                                <td class="px-4 py-3 border-r text-center">{{ $p->tanggal_kembali }}</td>
                                <td class="px-4 py-3 border-r text-center">
                                    @if($p->status === 'dipinjam')
                                        <span style="background-color: #fef3c7; color: #b45309; padding: 4px 10px; border-radius: 9999px; font-size: 12px; font-weight: 600; display: inline-block;">
                                            Dipinjam
                                        </span>
                                    @else
                                        <span style="background-color: #d1fae5; color: #047857; padding: 4px 10px; border-radius: 9999px; font-size: 12px; font-weight: 600; display: inline-block;">
                                            Dikembalikan
                                        </span>
                                    @endif
                                </td>
                                <td class="px-4 py-3 text-center">
                                    <div style="display: flex; justify-content: center; align-items: center; gap: 8px;">
                                        @if($p->status === 'dipinjam')
                                        <form action="{{ route('admin.peminjaman.kembali', $p->id) }}" method="POST" style="display: inline;">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit" 
                                                    style="background-color: #2563eb; color: #ffffff; padding: 6px 12px; border-radius: 4px; font-size: 12px; font-weight: 600; border: none; cursor: pointer;">
                                                Kembalikan
                                            </button>
                                        </form>
                                        @endif

                                        <form action="{{ route('admin.peminjaman.destroy', $p->id) }}" method="POST" style="display: inline;" onsubmit="return confirm('Yakin hapus data transaksi ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" 
                                                    style="background-color: #e11d48; color: #ffffff; padding: 6px 12px; border-radius: 4px; font-size: 12px; font-weight: 600; border: none; cursor: pointer;">
                                                Hapus
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>