@php
    $user = Auth::user();
    $role = $user->role ?? 'guest';
@endphp

<aside class="w-60 bg-white border-r shadow-md px-4 py-6 space-y-4">
    <ul class="space-y-2">
        
    @if ($role === 'admin')
        <li><a href="{{ route('admin.datasiswa') }}" class="block hover:text-blue-600">Data Siswa</a></li>
        <li><a href="{{ route('admin.dataguru') }}" class="block hover:text-blue-600">Data Guru</a></li>
        <li><a href="{{ route('admin.datadudi') }}" class="block hover:text-blue-600">Data Dudi</a></li>
        <li><a href="{{ route('admin.dokumen') }}" class="block hover:text-blue-600">Semua Dokumentasi</a></li>
        <li><a href="{{ route('admin.nilai') }}" class="block hover:text-blue-600">Lihat Nilai Siswa</a></li>
        <li><a href="{{ route('admin.jurusan') }}" class="block hover:text-blue-600">Jurusan</a></li>
        <li><a href="{{ route('admin.kelas') }}" class="block hover:text-blue-600">Kelas</a></li>
        <li><a href="{{ route('admin.role') }}" class="block hover:text-blue-600">Role</a></li>
        <li><a href="{{ route('admin.jabatan') }}" class="block hover:text-blue-600">Jabatan</a></li>
        @endif
        
        @if ($role === 'guru')
        <li><a href="{{ route('guru.dashboard') }}" class="block hover:text-blue-600">Dashboard</a></li>
        <li><a href="{{ route('guru.bimbingan') }}" class="block hover:text-blue-600">Jurnal Siswa Bimbimbingan</a></li>
        <li><a href="{{ route('guru.dokumen') }}" class="block hover:text-blue-600">Dokumen guru</a></li>
        <li><a href="{{ route('guru.jurnal') }}" class="block hover:text-blue-600">Semua jurnal Siswa</a></li>
        <li><a href="{{ route('guru.nilai') }}" class="block hover:text-blue-600">Lihat Semua Nilai Siswa</a></li>
        @endif
        
        @if ($role === 'dudi')
        <li><a href="{{ route('dudi.dashboard') }}" class="block hover:text-blue-600">Dashboard</a></li>
        <li><a href="{{ route('dudi.jurnal') }}" class="block hover:text-blue-600">Lihat Jurnal Siswa PKL</a></li>
        <li><a href="{{ route('dudi.nilai') }}" class="block hover:text-blue-600">Nilai Siswa PKL</a></li>
        @endif
        
        @if ($role === 'siswa')
        <li><a href="{{ route('murid.jurnal') }}" class="block hover:text-blue-600">Jurnal Harian</a></li>
        <li><a href="{{ route('murid.dokumen') }}" class="block hover:text-blue-600">Dokumen Siswa</a></li>
        @endif
    </ul>
</aside>