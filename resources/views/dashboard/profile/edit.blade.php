@extends('layouts.layout')

@section('content')
    <div class="pc-content">
        <div class="max-w-3xl mx-auto bg-white p-6 rounded-lg shadow-md mt-3">
            <h2 class="text-2xl font-semibold text-gray-800 mb-6 border-b pb-2">✏️ Edit Profil Pengguna</h2>

            <form action="{{ route('profile.update', $user->id) }}" method="POST" enctype="multipart/form-data" class="grid grid-cols-1 md:grid-cols-2 gap-6">
                @csrf
                @method('PUT')

                {{-- Nama --}}
                <div class="col-span-1 space-y-2">
                    <label class="block text-sm font-medium text-gray-700">Nama Lengkap</label>
                    <input type="text" name="name" value="{{ old('name', $user->name) }}"
                           class="w-full border border-gray-300 rounded px-3 py-2 shadow-sm focus:ring focus:ring-blue-200">
                </div>

                {{-- Email --}}
                <div class="col-span-1 space-y-2">
                    <label class="block text-sm font-medium text-gray-700">Email</label>
                    <input type="email" name="email" value="{{ old('email', $user->email) }}"
                           class="w-full border border-gray-300 rounded px-3 py-2 shadow-sm focus:ring focus:ring-blue-200">
                </div>

                {{-- Username --}}
                <div class="col-span-1 space-y-2">
                    <label class="block text-sm font-medium text-gray-700">Username</label>
                    <input type="text" name="username" value="{{ old('username', $user->username) }}"
                           class="w-full border border-gray-300 rounded px-3 py-2 shadow-sm focus:ring focus:ring-blue-200">
                </div>

                {{-- Role --}}
                <div class="col-span-1 space-y-2">
                    <label class="block text-sm font-medium text-gray-700">Role</label>
                    <select name="role"
                            class="w-full border border-gray-300 rounded px-3 py-2 shadow-sm">
                        <option value="superadmin" @selected($user->role === 'superadmin')>Super Admin</option>
                        <option value="admin" @selected($user->role === 'admin')>Admin</option>
                        <option value="staff" @selected($user->role === 'staff')>Staff</option>
                    </select>
                </div>

                {{-- Foto Profil --}}
                <div class="col-span-1 space-y-2">
                    <label class="block text-sm font-medium text-gray-700">Foto Profil</label>
                    <div class="flex items-center gap-4">
                        <img id="preview" src="{{ $user->profile_photo ? asset('storage/profile/' . $user->profile_photo) : '' }}"
                             class="w-20 h-20 object-cover rounded border" alt="Preview">
                        <input type="file" name="profile_photo" onchange="previewImage(event)"
                               class="text-sm text-gray-700">
                    </div>
                </div>

                {{-- Tombol --}}
                <div class="md:col-span-2 pt-4 flex justify-between">
                    <a href="{{ route('superadmin') }}"
                       class="text-sm text-gray-600 hover:underline">← Kembali</a>
                    <button type="submit"
                            class="px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700">
                        Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>

    {{-- Preview JS --}}
    <script>
        function previewImage(event) {
            const reader = new FileReader();
            const imgPreview = document.getElementById('preview');

            reader.onload = function () {
                imgPreview.src = reader.result;
            }

            reader.readAsDataURL(event.target.files[0]);
        }
    </script>
@endsection
