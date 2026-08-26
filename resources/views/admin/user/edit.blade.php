<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">{{ __('Edit Data Anggota') }}</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <form action="{{ route('admin.user.update', $user->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-4">
                        <label class="block font-medium text-sm text-gray-700">Nama Lengkap</label>
                        <input type="text" name="name" value="{{ $user->name }}" class="border-gray-300 rounded-md shadow-sm w-full" required>
                    </div>
                    <div class="mb-4">
                        <label class="block font-medium text-sm text-gray-700">Email</label>
                        <input type="email" name="email" value="{{ $user->email }}" class="border-gray-300 rounded-md shadow-sm w-full" required>
                    </div>
                    <div class="mb-4">
                        <label class="block font-medium text-sm text-gray-700">Password Baru <span class="text-xs text-gray-500">(Kosongkan jika tidak ingin mengubah password)</span></label>
                        <input type="password" name="password" class="border-gray-300 rounded-md shadow-sm w-full">
                    </div>
                    <div class="mb-4">
                        <label class="block font-medium text-sm text-gray-700">Role / Hak Akses</label>
                        <select name="role" class="border-gray-300 rounded-md shadow-sm w-full" required>
                            <option value="user" {{ $user->role === 'user' ? 'selected' : '' }}>User / Siswa</option>
                            <option value="admin" {{ $user->role === 'admin' ? 'selected' : '' }}>Admin</option>
                        </select>
                    </div>

                    {{-- Tombol Update & Batal --}}
                    <div style="margin-top: 24px; display: flex; align-items: center; gap: 12px;">
                        <button type="submit" 
                                style="background-color: #2563eb; color: #ffffff; padding: 8px 18px; border-radius: 6px; font-weight: 600; border: none; cursor: pointer;">
                            Update Anggota
                        </button>
                        <a href="{{ route('admin.user.index') }}" 
                           style="color: #4b5563; text-decoration: none; padding: 8px 12px; font-weight: 500;">
                            Batal
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>