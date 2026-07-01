@extends('layouts.blank')

@section('title', 'Login - SATGAS PPKS')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-green-50/50 via-white to-green-50/50 flex items-center justify-center">
    <div class="flex w-full max-w-6xl h-screen lg:h-[600px] shadow-2xl rounded-2xl overflow-hidden bg-white">
        <!-- Left Side Login Form -->
        <div class="w-full lg:w-1/2 flex items-center justify-center p-8">
            <div class="w-full max-w-md">
                <!-- Logo dan Header -->
                <div class="text-center mb-8">
                    <div class="flex justify-center mb-6">
                        <img src="{{ asset('image/satgas-logo.png') }}" alt="SATGAS PPKS Logo" class="h-16 w-auto object-contain">
                    </div>
                    <h2 class="text-2xl font-bold text-gray-800 mb-2">Welcome to Admin SATGAS PPKPT</h2>
                    <p class="text-gray-500 text-sm">Login with your Google account</p>
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
                        <input 
                            type="email" 
                            id="email" 
                            name="email" 
                            value="{{ old('email') }}"
                            placeholder="name@example.com"
                            class="block w-full px-4 py-3 border border-gray-300 rounded-lg bg-white focus:ring-2 focus:ring-green-500 focus:border-green-500 transition-all duration-200 @error('email') border-red-300 @enderror"
                            required
                            autofocus
                        >
                        @error('email')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Password Field -->
                    <div>
                        <label for="password" class="block text-sm font-medium text-gray-700 mb-2">Password</label>
                        <div class="relative">
                            <input 
                                type="password" 
                                id="password" 
                                name="password" 
                                placeholder="Enter your password"
                                class="block w-full px-4 py-3 pr-12 border border-gray-300 rounded-lg bg-white focus:ring-2 focus:ring-green-500 focus:border-green-500 transition-all duration-200 @error('password') border-red-300 @enderror"
                                required
                            >
                            <button 
                                type="button" 
                                class="absolute inset-y-0 right-0 pr-3 flex items-center"
                                onclick="togglePassword()"
                            >
                                <svg id="eye-icon" class="h-5 w-5 text-gray-400 hover:text-gray-600 transition-colors duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                </svg>
                                <svg id="eye-off-icon" class="h-5 w-5 text-gray-400 hover:text-gray-600 transition-colors duration-200 hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.878 9.878L3 3m6.878 6.878L21 21" />
                                </svg>
                            </button>
                        </div>
                        @error('password')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Remember Me and Forgot Password -->
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
                    <div class="pt-4">
                        <button 
                            type="submit" 
                            class="w-full flex justify-center py-3 px-4 border border-transparent rounded-lg shadow-sm text-sm font-medium text-white bg-yellow-800 hover:bg-green-900 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-800 transition-all duration-200"
                        >
                            Sign In
                        </button>
                    </div>
                </form>
            </div>
        </div>
        
        <!-- Right Side Image - Full Frame -->
        <div class="hidden lg:block lg:w-1/2 relative">
            <img src="{{ asset('image/gedung-unujogja.jpg') }}" alt="SATGAS Background" class="w-full h-full object-cover">
            <div class="absolute inset-0 bg-black bg-opacity-20 flex flex-col justify-between p-8">
                <div class="text-white">
                    <h3 class="text-bg font-medium mb-4">SATGAS PPKPT UNU YOGYAKARTA</h3>
                </div>
                <div class="text-white">
                    <p class="text-lg leading-relaxed mb-4">
                        "SATGAS PPKPT Universitas Nahdlatul Ulama Yogyakarta merupakan lembaga garda terdepan dalam pencegahan dan penanganan kekerasan seksual.."
                    </p>
                    <p class="text-sm opacity-90">SATGAS ADMIN</p>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function togglePassword() {
    const passwordInput = document.getElementById('password');
    const eyeIcon = document.getElementById('eye-icon');
    const eyeOffIcon = document.getElementById('eye-off-icon');
    
    if (passwordInput.type === 'password') {
        passwordInput.type = 'text';
        eyeIcon.classList.add('hidden');
        eyeOffIcon.classList.remove('hidden');
    } else {
        passwordInput.type = 'password';
        eyeIcon.classList.remove('hidden');
        eyeOffIcon.classList.add('hidden');
    }
}
</script>
@endsection