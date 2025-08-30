@extends('layouts.home')

@section('content')
    <div class="flex min-h-screen items-center justify-center bg-gradient-to-br from-green-50 to-white px-4">
        <div class="w-full max-w-md bg-white shadow-lg rounded-xl overflow-hidden">
            <div class="text-center py-6 border-b">
                <h1 class="text-3xl font-bold text-green-600">MyApp</h1>
            </div>

            <div class="px-6 py-8">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-xl font-semibold text-gray-800">Login</h3>
                    <a href="{{ route('profile.signup') }}" class="text-sm text-blue-600 hover:underline">Don't have an account?</a>
                </div>

                <form action="{{ route('login.proses') }}" method="POST" class="space-y-4">
                    @csrf

                    <!-- Email -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Email Address</label>
                        <input type="email" name="email" required placeholder="you@example.com"
                               class="w-full border border-gray-300 rounded px-4 py-2 text-sm
                                      focus:outline-none focus:border-green-500 focus:ring-1 focus:ring-green-500" />
                    </div>

                    <!-- Password -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                        <input type="password" name="password" required placeholder="••••••••"
                               class="w-full border border-gray-300 rounded px-4 py-2 text-sm
                                      focus:outline-none focus:border-green-500 focus:ring-1 focus:ring-green-500" />
                    </div>

                    <!-- Remember Me -->
                    <div class="flex justify-between items-center text-sm">
                        <label class="flex items-center">
                            <input type="checkbox" name="remember" class="mr-2 border-gray-300 rounded text-green-600 focus:ring-green-500">
                            Remember me
                        </label>
                        <a href="#" class="text-blue-600 hover:underline">Forgot password?</a>
                    </div>

                    <!-- Submit -->
                    <div>
                        <button type="submit"
                                class="w-full bg-green-600 hover:bg-green-700 text-white font-semibold py-2 rounded shadow">
                            Login
                        </button>
                    </div>
                </form>

                <!-- Separator -->
                <div class="text-center text-sm text-gray-500 my-4">
                    <span>Or login with</span>
                </div>

                <!-- Social Buttons -->
                <div class="grid grid-cols-3 gap-4">
                    <button type="button" disabled
                            class="flex items-center justify-center gap-2 bg-gray-100 text-gray-500 px-4 py-2 rounded-md text-sm shadow-sm">
                        <img src="{{ asset('assets/images/authentication/google.svg') }}" alt="Google" class="w-5 h-5">
                        <span class="hidden sm:inline">Google</span>
                    </button>
                    <button type="button" disabled
                            class="flex items-center justify-center gap-2 bg-gray-100 text-gray-500 px-4 py-2 rounded-md text-sm shadow-sm">
                        <img src="{{ asset('assets/images/authentication/twitter.svg') }}" alt="Twitter" class="w-5 h-5">
                        <span class="hidden sm:inline">Twitter</span>
                    </button>
                    <button type="button" disabled
                            class="flex items-center justify-center gap-2 bg-gray-100 text-gray-500 px-4 py-2 rounded-md text-sm shadow-sm">
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
    @if (session('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: '{{ session('success') }}',
                confirmButtonColor: '#22c55e'
            });
        </script>
    @endif

    @if ($errors->any())
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Oops!',
                html: `{!! implode('<br>', $errors->all()) !!}`,
                confirmButtonColor: '#22c55e'
            });
        </script>
    @endif

    @if (session('error'))
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Login Gagal',
                text: '{{ session('error') }}',
                confirmButtonColor: '#22c55e'
            });
        </script>
    @endif
@endpush
