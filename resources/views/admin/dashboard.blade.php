@extends('layouts.admin')

@section('content')
<div class="flex flex-row justify-center md:flex-row gap-4 w-full">
    <x-card class="flex-1 border p-6 shadow text-center" rounded="rounded-full">
            <div class="mt-2 text-gray-600">Total Guru</div>
            <div class="text-2xl font-bold">124</div>
    </x-card>
    <x-card class="flex-1 border p-6 shadow text-center">
            <div class="mt-2 text-gray-600">Total Siswa</div>
            <div class="text-2xl font-bold">543</div>
    </x-card>
    <x-card class="flex-1 border p-6 shadow text-center">
            <div class="mt-2 text-gray-600">Total Dudi</div>
            <div class="text-2xl font-bold">32</div>
    </x-card>
</div>

@endsection