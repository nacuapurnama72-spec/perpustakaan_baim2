<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Daftar Buku') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                
                {{-- Header Judul & Tombol Tambah --}}
                <div class="flex justify-between items-center mb-6 pb-4 border-b border-gray-200">
                    <div>
                        <h3 class="text-lg font-bold text-gray-800">Koleksi Buku</h3>
                        <p class="text-sm text-gray-500">Kelola daftar buku perpustakaan yang tersedia</p>
                    </div>

                    @if(auth()->user()->role === 'admin')
                        <a href="{{ route('admin.buku.create') }}" 
                           style="background-color: #2563eb; color: #ffffff; padding: 8px 16px; border-radius: 6px; font-weight: 600; text-decoration: none; display: inline-block;">
                            + Tambah Buku
                        </a>
                    @endif
                </div>

                {{-- Tabel Data Buku --}}
                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left text-gray-600 border border-gray-300">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-100 border-b border-gray-300">
                            <tr>
                                <th class="px-4 py-3 border-r">Kode Buku</th>
                                <th class="px-4 py-3 border-r">Judul</th>
                                <th class="px-4 py-3 border-r">Pengarang</th>
                                <th class="px-4 py-3 border-r">Penerbit</th>
                                <th class="px-4 py-3 border-r text-center">Stok</th>
                                @if(auth()->user()->role === 'admin')
                                    <th class="px-4 py-3 text-center">Aksi</th>
                                @endif
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($bukus as $buku)
                            <tr class="bg-white border-b hover:bg-gray-50">
                                <td class="px-4 py-3 border-r font-mono text-xs font-semibold text-gray-700">{{ $buku->kode_buku }}</td>
                                <td class="px-4 py-3 border-r font-medium text-gray-900">{{ $buku->judul }}</td>
                                <td class="px-4 py-3 border-r">{{ $buku->pengarang }}</td>
                                <td class="px-4 py-3 border-r">{{ $buku->penerbit }}</td>
                                <td class="px-4 py-3 border-r text-center font-semibold">{{ $buku->stok }}</td>

                                @if(auth()->user()->role === 'admin')
                                <td class="px-4 py-3 text-center">
                                    <div style="display: flex; justify-content: center; align-items: center; gap: 8px;">
                                        {{-- Tombol Edit (Kuning/Orange) --}}
                                        <a href="{{ route('admin.buku.edit', $buku->id) }}" 
                                           style="background-color: #f59e0b; color: #ffffff; padding: 6px 12px; border-radius: 4px; font-size: 12px; font-weight: 600; text-decoration: none; display: inline-block;">
                                            Edit
                                        </a>

                                        {{-- Tombol Hapus (Merah) --}}
                                        <form action="{{ route('admin.buku.destroy', $buku->id) }}" method="POST" style="display: inline;" onsubmit="return confirm('Yakin hapus buku ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" 
                                                    style="background-color: #e11d48; color: #ffffff; padding: 6px 12px; border-radius: 4px; font-size: 12px; font-weight: 600; border: none; cursor: pointer;">
                                                Hapus
                                            </button>
                                        </form>
                                    </div>
                                </td>
                                @endif
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>