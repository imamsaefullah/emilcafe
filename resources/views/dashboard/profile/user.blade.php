@extends('layouts.layout')

@section('content')
    <div class="pc-content">
        <div class="max-w-7xl mx-auto bg-white p-6 rounded-lg shadow-md mt-10">
            <h2 class="text-2xl font-bold text-gray-800 mb-6 border-b pb-2">👥 Daftar Pengguna (Admin & Staff)</h2>

            <div class="overflow-x-auto">
                <table class="min-w-full border border-gray-300 divide-y divide-gray-200 text-base">
                    <thead class="bg-gray-100 text-base font-semibold text-gray-700 text-left">
                    <tr>
                        <th class="px-6 py-4">#</th>
                        <th class="px-6 py-4">Foto</th>
                        <th class="px-6 py-4">Nama</th>
                        <th class="px-6 py-4">Username</th>
                        <th class="px-6 py-4">Email</th>
                        <th class="px-6 py-4">Role</th>
                        <th class="px-6 py-4 text-center">Aksi</th>
                    </tr>
                    </thead>
                    <tbody class="text-base text-gray-800 divide-y divide-gray-100">
                    @forelse ($superadmin as $user)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4">{{ $loop->iteration }}</td>
                            <td class="px-6 py-4">
                                @if ($user->profile_photo)
                                    <img src="{{ asset('storage/profile/' . $user->profile_photo) }}"
                                         class="w-12 h-12 rounded-full object-cover border">
                                @else
                                    <div class="w-12 h-12 rounded-full bg-gray-200 flex items-center justify-center text-gray-600 text-base font-bold">
                                        {{ strtoupper(substr($user->name, 0, 1)) }}
                                    </div>
                                @endif
                            </td>
                            <td class="px-6 py-4">{{ $user->name }}</td>
                            <td class="px-6 py-4">{{ $user->username ?? '-' }}</td>
                            <td class="px-6 py-4">{{ $user->email }}</td>
                            <td class="px-6 py-4 capitalize">{{ $user->role }}</td>
                            <td class="px-6 py-4 text-center whitespace-nowrap space-x-2">
                                <a href="{{ route('profile.edit', $user->id) }}"
                                   class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded text-sm">Edit</a>
                                <form action="{{ route('profile.update', $user->id) }}" method="POST" class="inline" onsubmit="return confirm('Yakin ingin menghapus user ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                            class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded text-sm">
                                        Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-6 py-6 text-center text-gray-500">Tidak ada pengguna admin atau staff.</td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
