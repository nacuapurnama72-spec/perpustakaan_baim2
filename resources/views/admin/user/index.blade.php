<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Kelola Data Anggota (User & Admin)') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                
                {{-- Header Judul & Tombol Tambah --}}
                <div class="flex justify-between items-center mb-6 pb-4 border-b border-gray-200">
                    <div>
                        <h3 class="text-lg font-bold text-gray-800">Daftar Anggota</h3>
                        <p class="text-sm text-gray-500">Kelola data pengguna sistem perpustakaan</p>
                    </div>

                    <a href="{{ route('admin.user.create') }}" 
                       style="background-color: #059669; color: #ffffff; padding: 8px 16px; border-radius: 6px; font-weight: 600; text-decoration: none; display: inline-block;">
                        + Tambah Anggota
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

                {{-- Tabel Data Anggota --}}
                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left text-gray-600 border border-gray-300">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-100 border-b border-gray-300">
                            <tr>
                                <th class="px-4 py-3 border-r text-center" style="width: 60px;">No</th>
                                <th class="px-4 py-3 border-r">Nama</th>
                                <th class="px-4 py-3 border-r">Email</th>
                                <th class="px-4 py-3 border-r text-center">Role</th>
                                <th class="px-4 py-3 text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($users as $index => $usr)
                            <tr class="bg-white border-b hover:bg-gray-50">
                                <td class="px-4 py-3 border-r text-center font-semibold text-gray-700">{{ $index + 1 }}</td>
                                <td class="px-4 py-3 border-r font-medium text-gray-900">{{ $usr->name }}</td>
                                <td class="px-4 py-3 border-r">{{ $usr->email }}</td>
                                <td class="px-4 py-3 border-r text-center">
                                    @if($usr->role === 'admin')
                                        <span style="background-color: #f3e8ff; color: #6b21a8; padding: 4px 10px; border-radius: 9999px; font-size: 12px; font-weight: 600; display: inline-block;">
                                            Admin
                                        </span>
                                    @else
                                        <span style="background-color: #dbeafe; color: #1e40af; padding: 4px 10px; border-radius: 9999px; font-size: 12px; font-weight: 600; display: inline-block;">
                                            User
                                        </span>
                                    @endif
                                </td>
                                <td class="px-4 py-3 text-center">
                                    <div style="display: flex; justify-content: center; align-items: center; gap: 8px;">
                                        {{-- Tombol Edit --}}
                                        <a href="{{ route('admin.user.edit', $usr->id) }}" 
                                           style="background-color: #f59e0b; color: #ffffff; padding: 6px 12px; border-radius: 4px; font-size: 12px; font-weight: 600; text-decoration: none; display: inline-block;">
                                            Edit
                                        </a>

                                        {{-- Tombol Hapus --}}
                                        <form action="{{ route('admin.user.destroy', $usr->id) }}" method="POST" style="display: inline;" onsubmit="return confirm('Yakin hapus anggota ini?')">
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