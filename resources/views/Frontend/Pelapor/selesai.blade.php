@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-green-50 to-emerald-100 flex items-center justify-center p-4">
    <div class="max-w-md w-full">
        <!-- Success Card -->
        <div class="bg-white rounded-2xl shadow-xl p-8 text-center transform transition-all duration-300 hover:scale-105">
            <!-- Success Icon -->
            <div class="mb-6">
                <div class="mx-auto w-16 h-16 bg-green-100 rounded-full flex items-center justify-center">
                    <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                </div>
            </div>
            
            <!-- Success Message -->
            <div class="mb-8">
                <h1 class="text-2xl font-bold text-gray-900 mb-2">Laporan Berhasil Dikirim!</h1>
                <p class="text-gray-600 leading-relaxed">
                    Terima kasih atas laporan Anda. Tim kami akan segera menindaklanjuti dan memberikan tanggapan secepatnya.
                </p>
            </div>
            
            <!-- Info Cards -->
            <div class="grid grid-cols-1 gap-4 mb-8">
                <div class="bg-blue-50 rounded-lg p-4">
                    <div class="flex items-center text-blue-700">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <span class="text-sm font-medium">Estimasi Tanggapan: 1-3 Hari Kerja</span>
                    </div>
                </div>
                
                <div class="bg-yellow-50 rounded-lg p-4">
                    <div class="flex items-center text-yellow-700">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                        </svg>
                        <span class="text-sm font-medium">Notifikasi akan dikirim via email</span>
                    </div>
                </div>
            </div>
            
            <!-- Action Buttons -->
            <div class="space-y-3">
                <a href="{{ url('/') }}" 
                   class="w-full bg-green-600 hover:bg-green-700 text-white font-medium py-3 px-6 rounded-lg transition-colors duration-200 inline-block">
                    Kembali ke Beranda
                </a>
                
                <a href="{{ url('/lapor') }}" 
                   class="w-full bg-gray-100 hover:bg-gray-200 text-gray-700 font-medium py-3 px-6 rounded-lg transition-colors duration-200 inline-block">
                    Buat Laporan Baru
                </a>
            </div>
        </div>
        
        <!-- Additional Info -->
        <div class="mt-6 text-center">
            <p class="text-gray-500 text-sm">
                Butuh bantuan? 
                <a href="{{ url('/kontak') }}" class="text-green-600 hover:text-green-700 font-medium">
                    Hubungi Kami
                </a>
            </p>
        </div>
    </div>
</div>

<!-- Optional: Add some animation styles -->
<style>
    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
    
    .animate-fade-in-up {
        animation: fadeInUp 0.6s ease-out;
    }
</style>

<script>
    // Add animation class when page loads
    document.addEventListener('DOMContentLoaded', function() {
        document.querySelector('.bg-white').classList.add('animate-fade-in-up');
    });
</script>
@show 