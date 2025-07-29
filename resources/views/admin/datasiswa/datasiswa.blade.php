@extends('layouts.admin')

@section('content')
<div class="px-6">
    <x-primary-button class="!bg-blue-600 h-9 w-40 justify-center">
        <a href="{{ route('siswas.create') }}">
            + Tambah Siswa
        </a>
    </x-primary-button>
    <section class="flex flex-col justify-center gap-4 mt-4 w-full">
        <div class="flex flex-start h-20 bg-white rounded-md">
            <p class="text-xl font-bold px-5 py-5">Data Siswa</p>
        </div>
        <x-table :headers="$headers" :rows="$rows" />
    </section>
</div>

@endsection