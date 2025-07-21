@extends('admin.dashboard')

@section('content')
    <div class="p-6">
        <h1 class="text-2xl font-bold mb-4">Profil Tim</h1>
        <a href="{{ route('tims.create') }}" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded">Tambah
            Anggota</a>

        <table class="mt-4 w-full bg-white shadow rounded">
            <thead>
                <tr>
                    <th class="px-4 py-2 border">Nama</th>
                    <th class="px-4 py-2 border">Posisi</th>
                    <th class="px-4 py-2 border">Foto</th>
                    <th class="px-4 py-2 border">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($tims as $tim)
                    <tr>
                        <td class="border px-4 py-2">{{ $tim->nama }}</td>
                        <td class="border px-4 py-2">{{ $tim->posisi }}</td>
                        <td class="border px-4 py-2">
                            @if ($tim->foto)
                                <img src="{{ asset('storage/' . $tim->foto) }}" class="h-16 rounded"
                                    alt="Foto {{ $tim->nama }}">
                            @endif
                        </td>
                        <td class="border px-4 py-2">
                            <a href="{{ route('tims.edit', $tim->id) }}" class="text-blue-500 hover:underline">Edit</a>
                            <form action="{{ route('tims.destroy', $tim->id) }}" method="POST" class="inline"
                                onsubmit="return confirm('Yakin hapus?')">
                                @csrf
                                @method('DELETE')
                                <button class="text-red-500 hover:underline ml-2">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
