@extends('layouts.admin')

@section('content')

    <form action="{{ route('dudis.store') }}" method="POST" class="space-y-4">
        @csrf

        <div>
            <label class="block">Nama Perusahaan</label>
            <input type="text" name="nama_perusahaan" class="w-full border rounded" required>
        </div>

        <div>
            <label class="block">Alamat</label>
            <textarea name="alamat" class="w-full border rounded" required></textarea>
        </div>

        <div>
            <label class="block">Email</label>
            <input type="email" name="email_perusahaan" class="w-full border rounded">
        </div>

        <div>
            <label class="block">No Telepon</label>
            <input type="text" name="no_telepon_perusahaan" class="w-full border rounded">
        </div>

        <div>
            <label class="block">Nama PIC</label>
            <input type="text" name="nama_pic" class="w-full border rounded" required>
        </div>

        <div>
            <label class="block">Deskripsi</label>
            <textarea name="deskripi" class="w-full border rounded"></textarea>
        </div>

        {{-- Sementara hardcode user_id --}}
        <input type="hidden" name="user_id" value="{{ auth()->id() }}">

        <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded">Simpan</button>
    </form>
@endsection
