<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard Admin') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            
            {{-- Kartu Selamat Datang --}}
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6" style="border-left: 4px solid #6366f1;">
                <h3 class="text-lg font-bold text-gray-800">
                    Selamat datang, {{ auth()->user()->name }}! 👋
                </h3>
                <p class="text-gray-600 text-sm mt-1">
                    Anda login sebagai <span style="color: #9333ea; font-weight: 600;">Admin</span>. Anda memiliki akses penuh untuk mengelola sistem perpustakaan.
                </p>
            </div>

            {{-- Kartu Navigasi Cepat (Grid 3 Kolom) --}}
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                
                <!-- Card Kelola Buku -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 flex items-center justify-between" style="border-left: 4px solid #2563eb;">
                    <div>
                        <h4 class="font-bold text-gray-800 text-base">Kelola Data Buku</h4>
                        <p class="text-xs text-gray-500 mt-1">Koleksi buku perpustakaan.</p>
                    </div>
                    <a href="{{ route('admin.buku.index') }}" 
                       style="background-color: #2563eb; color: #ffffff; padding: 8px 16px; border-radius: 6px; font-size: 12px; font-weight: 600; text-decoration: none; display: inline-block;">
                        Kelola &rarr;
                    </a>
                </div>

                <!-- Card Kelola Anggota / User -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 flex items-center justify-between" style="border-left: 4px solid #059669;">
                    <div>
                        <h4 class="font-bold text-gray-800 text-base">Kelola Data Anggota</h4>
                        <p class="text-xs text-gray-500 mt-1">Kelola akun (Siswa & Admin).</p>
                    </div>
                    <a href="{{ route('admin.user.index') }}" 
                       style="background-color: #059669; color: #ffffff; padding: 8px 16px; border-radius: 6px; font-size: 12px; font-weight: 600; text-decoration: none; display: inline-block;">
                        Kelola &rarr;
                    </a>
                </div>

                <!-- Card Transaksi Peminjaman -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 flex items-center justify-between" style="border-left: 4px solid #f59e0b;">
                    <div>
                        <h4 class="font-bold text-gray-800 text-base">Peminjaman Buku</h4>
                        <p class="text-xs text-gray-500 mt-1">Catat pinjam & kembali.</p>
                    </div>
                    <a href="{{ route('admin.peminjaman.index') }}" 
                       style="background-color: #f59e0b; color: #ffffff; padding: 8px 16px; border-radius: 6px; font-size: 12px; font-weight: 600; text-decoration: none; display: inline-block;">
                        Kelola &rarr;
                    </a>
                </div>

            </div>

        </div>
    </div>
</x-app-layout>