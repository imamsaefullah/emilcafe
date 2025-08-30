@extends('layouts.layout')

@section('content')
    <div class="pc-content">
        <div class="max-w-3xl mx-auto bg-white p-6 rounded-lg shadow-md mt-20">
            <h2 class="text-2xl font-semibold text-gray-800 mb-6 border-b pb-2">👤 Profil Pengguna</h2>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-medium text-gray-600 mb-1">Nama Lengkap</label>
                    <div class="px-4 py-2 bg-gray-50 rounded border">{{ $user->name }}</div>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-600 mb-1">Email</label>
                    <div class="px-4 py-2 bg-gray-50 rounded border">{{ $user->email }}</div>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-600 mb-1">Username</label>
                    <div class="px-4 py-2 bg-gray-50 rounded border">{{ $user->username ?? '-' }}</div>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-600 mb-1">Role</label>
                    <div class="px-4 py-2 bg-gray-50 rounded border capitalize">{{ $user->role ?? 'user' }}</div>
                </div>

                <div class="md:col-span-2 mt-6 flex justify-end">
                    <a href="{{ route('profile.edit', $user->id) }}"
                       class="inline-flex items-center gap-2 px-5 py-2 bg-green-600 text-white text-sm font-medium rounded hover:bg-green-700 transition">
                        ✏️ Edit Profil
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection


@push('scripts')
    @if (session('success'))
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil!',
                    text: @json(session('success')),
                    confirmButtonColor: '#16a34a'
                });
            });
        </script>
    @endif
@endpush
