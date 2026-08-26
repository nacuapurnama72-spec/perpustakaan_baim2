<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tambah Buku Baru') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <form action="{{ route('admin.buku.store') }}" method="POST">
                    @csrf

                    <div class="mb-4">
                        <label class="block font-medium text-sm text-gray-700 mb-1">Kode Buku</label>
                        <input type="text" name="kode_buku" class="border-gray-300 rounded-md shadow-sm w-full" placeholder="Contoh: BK-003" required>
                    </div>

                    <div class="mb-4">
                        <label class="block font-medium text-sm text-gray-700 mb-1">Judul Buku</label>
                        <input type="text" name="judul" class="border-gray-300 rounded-md shadow-sm w-full" required>
                    </div>

                    <div class="mb-4">
                        <label class="block font-medium text-sm text-gray-700 mb-1">Pengarang</label>
                        <input type="text" name="pengarang" class="border-gray-300 rounded-md shadow-sm w-full" required>
                    </div>

                    <div class="mb-4">
                        <label class="block font-medium text-sm text-gray-700 mb-1">Penerbit</label>
                        <input type="text" name="penerbit" class="border-gray-300 rounded-md shadow-sm w-full" required>
                    </div>

                    <div class="mb-6">
                        <label class="block font-medium text-sm text-gray-700 mb-1">Stok</label>
                        <input type="number" name="stok" class="border-gray-300 rounded-md shadow-sm w-full" min="0" required>
                    </div>

                    <!-- Tombol Aksi -->
                    <div class="flex justify-between items-center pt-4 border-t border-gray-100">
                        <a href="{{ route('admin.buku.index') }}" 
                           style="background-color: #e5e7eb; color: #374151; padding: 8px 16px; border-radius: 6px; text-decoration: none; font-weight: 600;">
                            Batal
                        </a>
                        <button type="submit" 
                                style="background-color: #2563eb; color: #ffffff; padding: 8px 20px; border-radius: 6px; border: none; font-weight: bold; cursor: pointer;">
                            Simpan Buku
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>