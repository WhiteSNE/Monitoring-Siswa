@extends('layouts.admin')

@section('content')
<form method="POST" action="{{ route('siswas.update', $siswa->id) }}">
    @csrf
    @method('PUT')

    <input type="hidden" name="user_id" value="{{ old('user_id', $siswa->user_id) }}">
    
    <div>
        <label class="block">Nomor NISN</label>
        <input type="text" name="nisn" value="{{ old('nisn', $siswa->nisn) }}" class="w-full border rounded" required>
    </div>

    <div>
        <label class="block">Nama Lengkap</label>
        <input type="text" name="nama_lengkap" value="{{ old('nama_lengkap', $siswa->nama_lengkap) }}" class="w-full border rounded" required>
    </div>

    <div>
        <label class="block">Tanggal Lahir</label>
        <input type="date" name="tanggal_lahir" value="{{ old('tanggal_lahir', \Carbon\Carbon::parse($siswa->tanggal_lahir)->format('Y-m-d')) }}" class="w-full border rounded" required>
    </div>

    <div>
        <label class="block">Jurusan</label>
        <select name="jurusan_id" class="w-full border rounded" required>
            <option value="">-- Pilih Jurusan --</option>
            @foreach ($jurusans as $jurusan)
                <option value="{{ $jurusan->id }}"
                    {{ old('jurusan_id', $siswa->jurusan_id) == $jurusan->id ? 'selected' : '' }}>
                    {{ $jurusan->nama_jurusan }}
                </option>
            @endforeach
        </select>
    </div>

    <div>
        <label class="block">Kelas</label>
        <select name="kelas_id" class="w-full border rounded" required>
            <option value="">-- Pilih Kelas --</option>
            @foreach ($kelases as $kelas)
                <option value="{{ $kelas->id }}"
                    {{ old('kelas_id', $siswa->kelas_id) == $kelas->id ? 'selected' : '' }}>
                    {{ $kelas->nama_kelas }}
                </option>
            @endforeach
        </select>
    </div>

    <div>
        <label class="block">Alamat</label>
        <input type="text" name="alamat" value="{{ old('alamat', $siswa->alamat) }}" class="w-full border rounded" required>
    </div>

    <div>
        <label class="block">Email</label>
        <input type="text" name="email" value="{{ old('email', $siswa->email) }}" class="w-full border rounded">
    </div>

    <div>
        <label class="block">No Telepon</label>
        <input type="text" name="no_telepon" value="{{ old('no_telepon', $siswa->no_telepon) }}" class="w-full border rounded">
    </div>

    <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded mt-4">Simpan</button>
</form>
@endsection
