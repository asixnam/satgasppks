@extends('admin.dashboard')

@section('content')
<div class="min-h-screen bg-gray-50 py-8">
    <div class="max-w-2xl mx-auto px-6">
        <!-- Header -->
        <div class="bg-white rounded-lg shadow-sm mb-6 p-6">
            <h1 class="text-2xl font-bold text-gray-800 mb-2">Edit Visi & Misi</h1>
            <p class="text-gray-600">Perbarui visi dan misi organisasi Anda</p>
        </div>

        <!-- Form -->
        <div class="bg-white rounded-lg shadow-sm p-6">
            <form action="{{ route('visi-misi.update', $visiMisi->id) }}" method="POST" class="space-y-6">
                @csrf
                @method('PUT')
                
                <!-- Visi Field -->
                <div>
                    <label for="visi" class="block text-sm font-medium text-gray-700 mb-2">
                        Visi
                    </label>
                    <textarea 
                        name="visi" 
                        id="visi"
                        rows="4" 
                        class="w-full px-4 py-3 border border-gray-200 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors resize-vertical" 
                        placeholder="Masukkan visi organisasi..."
                        required>{{ $visiMisi->visi }}</textarea>
                </div>

                <!-- Misi Field -->
                <div>
                    <label for="misi" class="block text-sm font-medium text-gray-700 mb-2">
                        Misi
                    </label>
                    <textarea 
                        name="misi" 
                        id="misi"
                        rows="6" 
                        class="w-full px-4 py-3 border border-gray-200 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors resize-vertical" 
                        placeholder="Masukkan misi organisasi..."
                        required>{{ $visiMisi->misi }}</textarea>
                </div>

                <!-- Buttons -->
                <div class="flex gap-3 pt-4">
                    <button 
                        type="submit" 
                        class="px-6 py-3 bg-green-600 hover:bg-green-700 text-white font-medium rounded-lg transition-colors duration-200 flex items-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        Update
                    </button>
                    
                    <a 
                        href="{{ route('visi-misi.index') }}" 
                        class="px-6 py-3 bg-gray-100 hover:bg-gray-200 text-gray-700 font-medium rounded-lg transition-colors duration-200 flex items-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                        </svg>
                        Kembali
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
/* Custom scrollbar untuk textarea */
textarea::-webkit-scrollbar {
    width: 6px;
}

textarea::-webkit-scrollbar-track {
    background: #f1f1f1;
    border-radius: 3px;
}

textarea::-webkit-scrollbar-thumb {
    background: #c1c1c1;
    border-radius: 3px;
}

textarea::-webkit-scrollbar-thumb:hover {
    background: #a8a8a8;
}
</style>
@endsection