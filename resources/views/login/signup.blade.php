@extends('layouts.home')

@section('content')
    <div class="flex min-h-screen items-center justify-center bg-gradient-to-br from-green-50 to-white px-4">
        <div class="w-full max-w-md bg-white shadow-lg rounded-xl overflow-hidden">
            <div class="text-center py-6 border-b">
                <h1 class="text-3xl font-bold text-green-600">MyApp</h1>
            </div>

            <div class="px-6 py-8">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-xl font-semibold text-gray-800">Sign Up</h3>
                    <a href="{{ route('login') }}" class="text-sm text-blue-600 hover:underline">Already have an account?</a>
                </div>

                <form action="{{ route('profile.signupUser') }}" method="POST" class="space-y-4">
                    @csrf

                    <!-- Name -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Full Name</label>
                        <input type="text" name="name" required placeholder="Your name"
                               class="w-full border border-gray-300 rounded px-4 py-2 text-sm focus:outline-none focus:border-green-500 focus:ring-1 focus:ring-green-500" />
                    </div>

                    <!-- Email -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                        <input type="email" name="email" required placeholder="you@example.com"
                               class="w-full border border-gray-300 rounded px-4 py-2 text-sm focus:outline-none focus:border-green-500 focus:ring-1 focus:ring-green-500" />
                    </div>

                    <!-- Password -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                        <input type="password" name="password" required placeholder="••••••••"
                               class="w-full border border-gray-300 rounded px-4 py-2 text-sm focus:outline-none focus:border-green-500 focus:ring-1 focus:ring-green-500" />
                    </div>

                    <!-- Confirm Password -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Confirm Password</label>
                        <input type="password" name="password_confirmation" required placeholder="••••••••"
                               class="w-full border border-gray-300 rounded px-4 py-2 text-sm focus:outline-none focus:border-green-500 focus:ring-1 focus:ring-green-500" />
                    </div>

                    <!-- Submit -->
                    <div>
                        <button type="submit"
                                class="w-full bg-green-600 hover:bg-green-700 text-white font-semibold py-2 rounded shadow">
                            Sign Up
                        </button>
                    </div>
                </form>

                <!-- Separator -->
                <div class="text-center text-sm text-gray-500 my-4">
                    <span>Or sign up with</span>
                </div>

                <!-- Social Buttons -->
                <div class="grid grid-cols-3 gap-4">
                    <button type="button" disabled class="flex items-center justify-center gap-2 bg-gray-100 text-gray-500 px-4 py-2 rounded-md text-sm shadow-sm">
                        <img src="{{ asset('assets/images/authentication/google.svg') }}" alt="Google" class="w-5 h-5">
                        <span class="hidden sm:inline">Google</span>
                    </button>
                    <button type="button" disabled class="flex items-center justify-center gap-2 bg-gray-100 text-gray-500 px-4 py-2 rounded-md text-sm shadow-sm">
                        <img src="{{ asset('assets/images/authentication/twitter.svg') }}" alt="Twitter" class="w-5 h-5">
                        <span class="hidden sm:inline">Twitter</span>
                    </button>
                    <button type="button" disabled class="flex items-center justify-center gap-2 bg-gray-100 text-gray-500 px-4 py-2 rounded-md text-sm shadow-sm">
                        <img src="{{ asset('assets/images/authentication/facebook.svg') }}" alt="Facebook" class="w-5 h-5">
                        <span class="hidden sm:inline">Facebook</span>
                    </button>
                </div>
            </div>

            <!-- Footer -->
            <div class="bg-gray-100 py-4 text-center text-sm text-gray-500 border-t">
                &copy; {{ date('Y') }} MyApp. All rights reserved.
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    @if ($errors->any())
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Oops!',
                html: `{!! implode('<br>', $errors->all()) !!}`,
                confirmButtonColor: '#22c55e' // warna hijau
            });
        </script>
    @endif

    @if (session('error'))
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Error!',
                text: '{{ session('error') }}',
                confirmButtonColor: '#22c55e'
            });
        </script>
    @endif
@endpush
