@extends('layouts.blank')

@section('title', 'Login - SATGAS PPKS')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-green-50/50 via-white to-green-50/50 flex items-center justify-center px-4">
    <div class="w-full max-w-md">
        <div class="bg-white rounded-2xl shadow-xl border border-green-100 p-8">
            <!-- Logo dan Header -->
            <div class="text-center mb-8">
                <div class="flex justify-center mb-4">
                    <img src="{{ asset('image/satgas-logo.png') }}" alt="SATGAS PPKS Logo" class="h-8 md:h-10 lg:h-12 w-auto object-contain">
                </div>
                <h2 class="text-2xl font-bold text-green-500 mb-2">Selamat Datang</h2>
                <p class="text-gray-500 text-sm">Masuk ke akun Anda</p>
            </div>

            <!-- Error Messages -->
            @if ($errors->any())
                <div class="bg-red-50 border-l-4 border-red-400 p-4 mb-6 rounded">
                    <div class="text-red-700 text-sm">
                        @foreach ($errors->all() as $error)
                            <p>{{ $error }}</p>
                        @endforeach
                    </div>
                </div>
            @endif

            @if (session('error'))
                <div class="bg-red-50 border-l-4 border-red-400 p-4 mb-6 rounded">
                    <p class="text-red-700 text-sm">{{ session('error') }}</p>
                </div>
            @endif

            <!-- Login Form -->
            <form method="POST" action="{{ route('login.submit') }}" class="space-y-6">
                @csrf
                
                <!-- Email Field -->
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207" />
                            </svg>
                        </div>
                        <input 
                            type="email" 
                            id="email" 
                            name="email" 
                            value="{{ old('email') }}"
                            placeholder="Masukkan email Anda"
                            class="block w-full pl-10 pr-3 py-3 border border-gray-300 rounded-lg bg-gray-50 focus:bg-white focus:ring-2 focus:ring-green-500 focus:border-green-500 transition-all duration-200 @error('email') border-red-300 @enderror"
                            required
                            autofocus
                        >
                    </div>
                    @error('email')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Password Field -->
                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700 mb-2">Password</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                            </svg>
                        </div>
                        <input 
                            type="password" 
                            id="password" 
                            name="password" 
                            placeholder="Masukkan password Anda"
                            class="block w-full pl-10 pr-3 py-3 border border-gray-300 rounded-lg bg-gray-50 focus:bg-white focus:ring-2 focus:ring-green-500 focus:border-green-500 transition-all duration-200 @error('password') border-red-300 @enderror"
                            required
                        >
                    </div>
                    @error('password')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Remember Me -->
                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <input 
                            id="remember" 
                            name="remember" 
                            type="checkbox" 
                            class="h-4 w-4 text-green-600 focus:ring-green-500 border-gray-300 rounded"
                            {{ old('remember') ? 'checked' : '' }}
                        >
                        <label for="remember" class="ml-2 block text-sm text-gray-700">
                            Ingat saya
                        </label>
                    </div>

                    <div class="text-sm">
                        @if(Route::has('password.request'))
                            <a href="{{ route('password.request') }}" class="text-green-600 hover:text-green-500 transition-colors duration-200">
                                Lupa password?
                            </a>
                        @else
                            <a href="#" class="text-green-600 hover:text-green-500 transition-colors duration-200">
                                Lupa password?
                            </a>
                        @endif
                    </div>
                </div>

                <!-- Submit Button -->
                <div>
                    <button 
                        type="submit" 
                        class="w-full flex justify-center py-3 px-4 border border-transparent rounded-lg shadow-sm text-sm font-medium text-white bg-gradient-to-r from-green-500 to-green-600 hover:from-green-600 hover:to-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transform hover:-translate-y-0.5 transition-all duration-200"
                    >
                        Masuk
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection