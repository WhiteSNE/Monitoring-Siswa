@extends('layouts.admin')

@section('content')
    <form action="{{ route('siswas.store') }}" method="POST" class="space-y-4">
        @csrf

        <input type="hidden" name="user_id" value="{{ auth()->id() }}">

        <div>
            <label class="block">Nomor NISN</label>
            <input type="text" name="nisn" class="w-full border rounded" required>
        </div>

        <div>
            <label class="block">Nama Lengkap</label>
            <input type="text" name="nama_lengkap" class="w-full border rounded" required>
        </div>

        <div>
            <label class="block">Jurusan</label>
            <select name="jurusan_id" class="w-full border rounded" required>
                <option value="">-- Pilih Jurusan --</option>
                @foreach ($jurusans as $jurusan)
                    <option value="{{ $jurusan->id }}">{{ $jurusan->nama_jurusan }}</option>
                @endforeach
            </select>
        </div>

        <div>
            <label class="block">Kelas</label>
            <select name="kelas_id" class="w-full border rounded" required>
                <option value="">-- Pilih Kelas --</option>
                @foreach ($kelases as $kelas)
                    <option value="{{ $kelas->id }}">{{ $kelas->nama_kelas }}</option>
                @endforeach
            </select>
        </div>

        <div>
            <label class="block">Alamat</label>
            <input type="text" name="alamat" class="w-full border rounded" required>
        </div>

        <div>
            <label class="block">No Telepon</label>
            <input type="text" name="no_telepon" class="w-full border rounded">
        </div>

        <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded">Simpan</button>
    </form>
@endsection
