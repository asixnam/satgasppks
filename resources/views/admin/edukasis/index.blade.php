{{-- resources/views/admin/edukasis/index.blade.php --}}
@extends('admin.dashboard')

@section('content')
    <div class="p-6">
        <h1 class="text-2xl font-bold mb-4">Daftar Edukasi</h1>

        @if (session('success'))
            <div class="bg-green-100 text-green-700 p-2 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        <a href="{{ route('edukasis.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded mb-4 inline-block">+ Tambah
            Edukasi</a>

        <div class="bg-white shadow rounded">
            <table class="min-w-full table-auto">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="px-4 py-2">Judul</th>
                        <th class="px-4 py-2">Gambar</th>
                        <th class="px-4 py-2">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($edukasis as $edukasi)
                        <tr class="border-t">
                            <td class="px-4 py-2">{{ $edukasi->judul }}</td>
                            <td class="px-4 py-2">
                                @if ($edukasi->gambar)
                                    <img src="{{ asset('storage/' . $edukasi->gambar) }}" alt="gambar" class="h-16">
                                @else
                                    Tidak ada
                                @endif
                            </td>
                            <td class="px-4 py-2">
                                <a href="{{ route('edukasis.edit', $edukasi->id) }}"
                                    class="text-blue-600 hover:underline">Edit</a> |
                                <form action="{{ route('edukasis.destroy', $edukasi->id) }}" method="POST" class="inline"
                                    onsubmit="return confirm('Yakin hapus edukasi ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:underline">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="mt-4">
            {{ $edukasis->links() }}
        </div>
    </div>
@endsection
