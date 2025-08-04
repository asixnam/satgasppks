@extends('layouts.admin')

@section('title', 'Buat Laporan Kekerasan')

@section('content')
<!-- Error Messages -->
@if ($errors->any())
    <div class="mb-6 bg-red-50 border border-red-200 rounded-lg p-4">
        <div class="flex items-center mb-2">
            <i class="fas fa-exclamation-circle text-red-500 mr-2"></i>
            <h4 class="text-red-800 font-medium">Terdapat kesalahan dalam form:</h4>
        </div>
        <ul class="list-disc list-inside text-red-700 text-sm space-y-1">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<!-- Success Message -->
@if (session('success'))
    <div class="mb-6 bg-green-50 border border-green-200 rounded-lg p-4">
        <div class="flex items-center justify-between">
            <div class="flex items-center">
                <i class="fas fa-check-circle text-green-500 mr-2"></i>
                <span class="text-green-800 font-medium">{{ session('success') }}</span>
            </div>
            <button onclick="this.parentElement.parentElement.remove()" class="text-green-500 hover:text-green-700">
                <i class="fas fa-times"></i>
            </button>
        </div>
    </div>
@endif

<!-- Error Message -->
@if (session('error'))
    <div class="mb-6 bg-red-50 border border-red-200 rounded-lg p-4">
        <div class="flex items-center justify-between">
            <div class="flex items-center">
                <i class="fas fa-exclamation-triangle text-red-500 mr-2"></i>
                <span class="text-red-800 font-medium">{{ session('error') }}</span>
            </div>
            <button onclick="this.parentElement.parentElement.remove()" class="text-red-500 hover:text-red-700">
                <i class="fas fa-times"></i>
            </button>
        </div>
    </div>
@endif

<div class="container mx-auto p-6">
    <div class="bg-white rounded-lg shadow-lg">
        <!-- Header -->
        <div class="border-b px-6 py-4 flex justify-between items-center">
            <h3 class="text-xl font-semibold text-gray-800">Buat Laporan Kekerasan Baru</h3>
            <a href="{{ route('admin.violence-reports.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600 transition text-sm">
                <i class="fas fa-arrow-left mr-2"></i>Kembali
            </a>
        </div>

        <form action="{{ route('admin.violence-reports.store') }}" method="POST" enctype="multipart/form-data" class="p-6">
            @csrf
            
            <!-- Tab Navigation -->
            <div class="border-b mb-6">
                <nav class="flex space-x-8">
                    <button type="button" onclick="showTab('client')" class="tab-btn py-2 px-1 border-b-2 border-blue-500 text-blue-600 font-medium text-sm">
                        <i class="fas fa-user mr-2"></i>Data Klien
                    </button>
                    <button type="button" onclick="showTab('reporter')" class="tab-btn py-2 px-1 border-b-2 border-transparent text-gray-500 hover:text-gray-700 font-medium text-sm">
                        <i class="fas fa-user-tie mr-2"></i>Data Pelapor
                    </button>
                    <button type="button" onclick="showTab('perpetrator')" class="tab-btn py-2 px-1 border-b-2 border-transparent text-gray-500 hover:text-gray-700 font-medium text-sm">
                        <i class="fas fa-user-times mr-2"></i>Data Pelaku
                    </button>
                    <button type="button" onclick="showTab('violence')" class="tab-btn py-2 px-1 border-b-2 border-transparent text-gray-500 hover:text-gray-700 font-medium text-sm">
                        <i class="fas fa-exclamation-triangle mr-2"></i>Data Kekerasan
                    </button>
                </nav>
            </div>

            <!-- Tab Contents - UNTUK CREATE (hanya oldData) -->
            <x-form.tab-client :old-data="old('client_data', [])" />
            <x-form.tab-reporter :old-data="old('reporter_data', [])" />
            <x-form.tab-perpetrator :old-data="old('perpetrator_data', [])" />
            <x-form.tab-violence :old-data="old('violance_data', [])" />
            
            <!-- Footer -->
            <div class="border-t pt-6 mt-6 flex justify-between">
                <a href="{{ route('admin.violence-reports.index') }}" class="bg-gray-500 text-white px-6 py-2 rounded hover:bg-gray-600 transition text-sm">
                    <i class="fas fa-times mr-2"></i>Batal
                </a>
                <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700 transition text-sm">
                    <i class="fas fa-save mr-2"></i>Simpan Laporan
                </button>
            </div>
        </form>
    </div>
</div>

<script>
function showTab(tabName) {
    // Hide all tabs
    document.querySelectorAll('.tab-content').forEach(tab => {
        tab.classList.add('hidden');
    });
    
    // Remove active state from all tab buttons
    document.querySelectorAll('.tab-btn').forEach(btn => {
        btn.classList.remove('border-blue-500', 'text-blue-600');
        btn.classList.add('border-transparent', 'text-gray-500');
    });
    
    // Show selected tab
    document.getElementById(tabName).classList.remove('hidden');
    
    // Add active state to clicked button
    event.target.classList.remove('border-transparent', 'text-gray-500');
    event.target.classList.add('border-blue-500', 'text-blue-600');
}
</script>

@endsection