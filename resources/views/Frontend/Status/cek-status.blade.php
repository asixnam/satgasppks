@extends('Layouts.app')

@section('content')

<div class="min-h-screen bg-gradient-to-br from-gray-50 to-blue-50 pt-20 pb-12">
    <div class="container mx-auto px-4 py-8">
        
        <!-- Header Section -->
        <div class="text-center mb-12">
            <div class="inline-flex items-center justify-center w-16 h-16 bg-primary rounded-full mb-4 shadow-lg">
                <i class="fas fa-search text-white text-2xl"></i>
            </div>
            <h1 class="text-3xl md:text-4xl font-bold text-gray-800 mb-3">
                Cek Status Pelaporan
            </h1>
            <p class="text-gray-600 text-lg max-w-2xl mx-auto">
                Masukkan nomor tiket pelaporan Anda untuk melihat status dan perkembangan kasus
            </p>
        </div>

        <!-- Main Content -->
        <div class="max-w-2xl mx-auto">
            
            <!-- Search Form -->
            <div class="bg-white rounded-2xl shadow-xl p-8 mb-8">
                <form id="statusForm" method="GET" class="space-y-6">
                    <div>
                        <label for="ticket_number" class="block text-sm font-semibold text-gray-700 mb-3">
                            <i class="fas fa-ticket-alt text-primary mr-2"></i>
                            Nomor Tiket Pelaporan
                        </label>
                        <div class="relative">
                            <input 
                                type="text" 
                                id="ticket_number" 
                                name="ticket_number"
                                placeholder="Contoh: PPKS-2024-001234"
                                class="w-full px-4 py-4 border-2 border-gray-200 rounded-xl focus:border-primary focus:ring-4 focus:ring-primary/20 transition-all duration-300 text-lg font-medium"
                                required
                            >
                            <div class="absolute right-4 top-1/2 transform -translate-y-1/2">
                                <i class="fas fa-hashtag text-gray-400"></i>
                            </div>
                        </div>
                        <p class="text-sm text-gray-500 mt-2">
                            <i class="fas fa-info-circle mr-1"></i>
                            Nomor tiket diberikan saat Anda mengirim laporan
                        </p>
                        
                        <!-- Error message display -->
                        @if(session('error'))
                            <div class="mt-3 p-3 bg-red-50 border border-red-200 rounded-lg">
                                <p class="text-sm text-red-600">
                                    <i class="fas fa-exclamation-circle mr-1"></i>
                                    {{ session('error') }}
                                </p>
                            </div>
                        @endif
                    </div>

                    <button 
                        type="submit" 
                        class="w-full bg-gradient-to-r from-primary to-accent text-white font-bold py-4 px-6 rounded-xl hover:shadow-lg transform hover:-translate-y-1 transition-all duration-300"
                        id="submitBtn"
                    >
                        <i class="fas fa-search mr-2"></i>
                        <span id="btnText">Cek Status Sekarang</span>
                        <i class="fas fa-spinner fa-spin mr-2 hidden" id="loadingIcon"></i>
                    </button>
                </form>
            </div>

            <!-- Information Cards -->
            <div class="grid md:grid-cols-2 gap-6 mt-8">
                <div class="bg-white rounded-xl shadow-md p-6">
                    <div class="flex items-center mb-4">
                        <div class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center mr-3">
                            <i class="fas fa-clock text-blue-600"></i>
                        </div>
                        <h3 class="font-bold text-gray-800">Waktu Respons</h3>
                    </div>
                    <p class="text-gray-600 text-sm">
                        Tim SATGAS PPKS akan merespons laporan Anda dalam waktu maksimal 2x24 jam pada hari kerja.
                    </p>
                </div>

                <div class="bg-white rounded-xl shadow-md p-6">
                    <div class="flex items-center mb-4">
                        <div class="w-10 h-10 bg-green-100 rounded-lg flex items-center justify-center mr-3">
                            <i class="fas fa-shield-alt text-green-600"></i>
                        </div>
                        <h3 class="font-bold text-gray-800">Kerahasiaan</h3>
                    </div>
                    <p class="text-gray-600 text-sm">
                        Identitas pelapor dan informasi kasus dijamin kerahasiaannya sesuai dengan prosedur yang berlaku.
                    </p>
                </div>
            </div>

            <!-- Help Section -->
            <div class="bg-white rounded-xl shadow-md p-6 mt-6">
                <h3 class="font-bold text-gray-800 mb-4">
                    <i class="fas fa-question-circle text-blue-600 mr-2"></i>
                    Belum Punya Nomor Tiket?
                </h3>
                <p class="text-gray-600 mb-4">
                    Jika Anda belum melaporkan kasus, silakan buat laporan terlebih dahulu.
                </p>
                <a href="{{ route('lapor-kekerasan.create') }}" class="inline-flex items-center px-4 py-2 bg-primary text-white rounded-lg hover:bg-primary/90 transition-colors">
                    <i class="fas fa-plus mr-2"></i>
                    Buat Laporan Baru
                </a>
            </div>

            <!-- Back to Home -->
            <div class="text-center mt-8">
                <a href="/" class="inline-flex items-center text-primary hover:text-accent transition-colors">
                    <i class="fas fa-arrow-left mr-2"></i>
                    Kembali ke Beranda
                </a>
            </div>
        </div>
    </div>
</div>

<script>
document.getElementById('statusForm').addEventListener('submit', function(e) {
    const ticketInput = document.getElementById('ticket_number');
    const submitBtn = document.getElementById('submitBtn');
    const btnText = document.getElementById('btnText');
    const loadingIcon = document.getElementById('loadingIcon');
    
    // Show loading state
    submitBtn.disabled = true;
    btnText.textContent = 'Mencari...';
    loadingIcon.classList.remove('hidden');
    
    // Extract ID from ticket number (assuming format: PPKS-YYYY-XXXXXX where XXXXXX is the ID)
    const ticketNumber = ticketInput.value.trim();
    
    // Basic validation
    if (!ticketNumber.match(/^PPKS-\d{4}-\d{6}$/)) {
        e.preventDefault();
        
        // Reset button state
        submitBtn.disabled = false;
        btnText.textContent = 'Cek Status Sekarang';
        loadingIcon.classList.add('hidden');
        
        // Show error
        alert('Format nomor tiket tidak valid. Gunakan format: PPKS-YYYY-XXXXXX');
        return false;
    }
    
    // Extract the ID (last 6 digits)
    const parts = ticketNumber.split('-');
    const reportId = parts[2]; // This gets the last part (ID)
    
    // Update form action with the extracted ID
    this.action = "{{ url('/cek-status') }}/" + reportId;
});

// Format input while typing
document.getElementById('ticket_number').addEventListener('input', function(e) {
    let value = e.target.value.toUpperCase();
    
    // Remove any non-alphanumeric characters except hyphens
    value = value.replace(/[^A-Z0-9-]/g, '');
    
    // Auto-format to PPKS-YYYY-XXXXXX pattern
    if (value.length > 4 && !value.includes('-')) {
        if (value.startsWith('PPKS')) {
            value = value.slice(0, 4) + '-' + value.slice(4);
        }
    }
    if (value.length > 9 && value.split('-').length === 2) {
        const parts = value.split('-');
        if (parts[1].length > 4) {
            value = parts[0] + '-' + parts[1].slice(0, 4) + '-' + parts[1].slice(4);
        }
    }
    
    // Limit total length
    if (value.length > 15) {
        value = value.slice(0, 15);
    }
    
    e.target.value = value;
});
</script>

<style>
.px-4 {
    padding-left: 1rem;
    padding-right: 1rem;
}

@media (min-width: 1024px) {
    .container {
        max-width: 100%;
    }
}

/* Loading button animation */
#submitBtn:disabled {
    opacity: 0.7;
    cursor: not-allowed;
}
</style>

@endsection