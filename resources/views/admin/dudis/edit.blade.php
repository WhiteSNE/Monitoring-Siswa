@extends('layouts.admin')

@section('content')
<form method="POST" action="{{ route('dudis.update', $dudi->id) }}">
    @csrf
    @method('PUT')
    
    <div>
        <label>Nama Perusahaan</label>
        <input type="text" name="nama_perusahaan" value="{{ old('nama_perusahaan', $dudi->nama_perusahaan) }}" class="w-full border rounded" required>
    </div>

    <div>
        <label>Alamat</label>
        <textarea name="alamat" class="w-full border rounded" required>{{ old('alamat', $dudi->alamat) }}</textarea>
    </div>

    <div>
        <label>Email</label>
        <input type="email" name="email_perusahaan" value="{{ old('email_perusahaan', $dudi->email_perusahaan) }}" class="w-full border rounded">
    </div>

    <div>
        <label>Telepon</label>
        <input type="text" name="no_telepon_perusahaan" value="{{ old('no_telepon_perusahaan', $dudi->no_telepon_perusahaan) }}" class="w-full border rounded">
    </div>

    <div>
        <label>Penanggung Jawab</label>
        <input type="text" name="nama_pic" value="{{ old('nama_pic', $dudi->nama_pic) }}" class="w-full border rounded" required>
    </div>

    <div>
        <label>Deskripsi</label>
        <textarea name="deskripi" class="w-full border rounded">{{ old('deskripi', $dudi->deskripi) }}</textarea>
    </div>

    <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded">Simpan</button>
</form>
@endsection