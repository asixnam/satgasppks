@extends('Frontend.Home.home')

@section('content')

<div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- Header Section -->
        <div class="text-center mb-12 bg-gradient-to-r from-purple-600 to-indigo-600 rounded-2xl p-8 text-white shadow-xl">
            <h1 class="text-4xl md:text-5xl font-bold mb-4">Edukasi</h1>
            <p class="text-lg md:text-xl opacity-90 max-w-3xl mx-auto">
                Informasi terkini seputar isu kekerasan seksual, pencegahan, dan dukungan untuk korban.
            </p>
        </div>

        <!-- Image Section -->
        <div class="text-center mb-12">
            <img src="https://images.unsplash.com/photo-1582213782179-e0d53f98f2ca?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2070&q=80" 
                 alt="Support and Protection Against Sexual Violence" 
                 class="w-full h-80 object-cover rounded-2xl shadow-2xl hover:scale-105 transition-transform duration-300">
        </div>

        <!-- Main Content Section -->
        <div class="bg-white rounded-2xl shadow-xl p-8 md:p-12 mb-8">
            <h3 class="text-3xl font-bold text-gray-800 mb-6 border-b-4 border-purple-500 pb-3">
                Mengenali Tanda-tanda Bentuk Kekerasan Seksual
            </h3>
            
            <div class="space-y-6 text-gray-700">
                <p class="text-lg leading-relaxed">
                    Mengenali tanda-tanda kekerasan seksual adalah langkah awal yang penting dalam upaya perlindungan diri dan orang lain. Kekerasan seksual tidak selalu berbentuk kekerasan fisik—ia bisa hadir dalam bentuk komentar yang melecehkan, tatapan yang membuat tidak nyaman, sentuhan tanpa izin, pemaksaan dalam hubungan, hingga eksploitasi secara verbal atau digital. Banyak korban tidak menyadari atau ragu menyebutnya sebagai kekerasan karena dibungkus dalam tekanan psikologis atau relasi kuasa.
                </p>

                <p class="text-lg leading-relaxed">
                    Agar lebih waspada, penting untuk mengenali dan merespons tanda-tanda awal kekerasan seksual. Bentuk-bentuk kekerasan seksual dapat berupa pelecehan verbal, pelecehan fisik, eksploitasi, pemaksaan, dan kekerasan seksual dalam bentuk digital atau cyber.
                </p>

                <!-- Tips Section -->
                <div class="bg-gradient-to-r from-blue-50 to-purple-50 rounded-xl p-6 border-l-4 border-purple-500 mt-8">
                    <h4 class="text-xl font-semibold text-purple-700 mb-4 flex items-center">
                        <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"></path>
                        </svg>
                        Tips Mengenali dan Merespons Tanda-tanda Kekerasan Seksual:
                    </h4>
                    
                    <ul class="space-y-3">
                        <li class="flex items-start">
                            <span class="text-green-500 font-bold text-xl mr-3 mt-1">✓</span>
                            <span class="text-gray-700 leading-relaxed">Dengarkan instingmu — jika merasa tidak nyaman, itu sudah cukup sebagai tanda peringatan</span>
                        </li>
                        <li class="flex items-start">
                            <span class="text-green-500 font-bold text-xl mr-3 mt-1">✓</span>
                            <span class="text-gray-700 leading-relaxed">Perhatikan perubahan perilaku yang tidak wajar pada diri sendiri atau orang lain</span>
                        </li>
                        <li class="flex items-start">
                            <span class="text-green-500 font-bold text-xl mr-3 mt-1">✓</span>
                            <span class="text-gray-700 leading-relaxed">Waspadai tekanan atau pemaksaan dalam situasi yang seharusnya aman</span>
                        </li>
                        <li class="flex items-start">
                            <span class="text-green-500 font-bold text-xl mr-3 mt-1">✓</span>
                            <span class="text-gray-700 leading-relaxed">Kenali batasan pribadi dan jangan ragu untuk mengatakannya dengan tegas</span>
                        </li>
                        <li class="flex items-start">
                            <span class="text-green-500 font-bold text-xl mr-3 mt-1">✓</span>
                            <span class="text-gray-700 leading-relaxed">Catat atau dokumentasikan kejadian yang mencurigakan jika memungkinkan</span>
                        </li>
                        <li class="flex items-start">
                            <span class="text-green-500 font-bold text-xl mr-3 mt-1">✓</span>
                            <span class="text-gray-700 leading-relaxed">Cari dukungan dari orang yang dipercaya atau profesional jika mengalami atau menyaksikan kekerasan</span>
                        </li>
                        <li class="flex items-start">
                            <span class="text-green-500 font-bold text-xl mr-3 mt-1">✓</span>
                            <span class="text-gray-700 leading-relaxed">Pahami bahwa korban bukan yang bersalah dalam situasi kekerasan seksual</span>
                        </li>
                    </ul>
                </div>

                <!-- Warning Box -->
                <div class="bg-gradient-to-r from-red-50 to-pink-50 border-l-4 border-red-500 rounded-xl p-6 mt-8">
                    <div class="flex items-center mb-3">
                        <svg class="w-6 h-6 text-red-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z"></path>
                        </svg>
                        <h4 class="text-xl font-semibold text-red-700">Peringatan Penting</h4>
                    </div>
                    <p class="text-red-800 font-medium">
                        Jika Anda atau seseorang yang Anda kenal mengalami kekerasan seksual, segera cari bantuan profesional. Jangan menunda untuk melaporkan atau mencari dukungan psikologis.
                    </p>
                </div>
            </div>
        </div>
    </div>

<style>
   .px-4 {
    padding-left: 10rem;
    padding-right: 1rem;
    margin-left: auto;
    margin-right: auto;
}
</style>
@endsection


