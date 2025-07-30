@extends('layouts.admin')

@section('content')
<h2 class="text-xl font-bold mb-4">Tambah Guru</h2>

@if ($errors->any())
    <div class="bg-red-100 text-red-700 p-3 rounded mb-4">
        <ul class="list-disc pl-5">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form method="POST" action="{{ route('gurus.store') }}">
    @csrf

    <div class="mb-4">
        <label class="block">NIP</label>
        <input type="text" name="nip" value="{{ old('nip') }}" class="w-full border rounded p-2" required>
    </div>

    <div class="mb-4">
        <label class="block">Tanggal Lahir</label>
        <input type="date" name="tanggal_lahir" value="{{ old('tanggal_lahir') }}" class="w-full border rounded p-2" required>
    </div>

    <div class="mb-4">
        <label class="block">Email</label>
        <input type="email" name="email" value="{{ old('email') }}" class="w-full border rounded p-2" required>
    </div>

    <div class="mb-4">
        <label class="block">Nama Lengkap</label>
        <input type="text" name="nama_lengkap" value="{{ old('nama_lengkap') }}" class="w-full border rounded p-2" required>
    </div>

    <div class="mb-4">
        <label class="block">No Telepon</label>
        <input type="text" name="no_telepon" value="{{ old('no_telepon') }}" class="w-full border rounded p-2">
    </div>

    <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded">Simpan</button>
</form>
@endsection
