@extends('layouts.admin')

@section('content')
<div class="p-6">
<x-primary-button class="!bg-blue-600 h-8 w-40 justify-center">
<a href="{{ route('dudis.create') }}">
    + Tambah DUDI
</a>
</x-primary-button>
<section class="flex flex-col justify-center gap-4 mt-5 w-full">
<div class="flex flex-start h-20 bg-white rounded-md">
    <p class="text-xl font-bold px-5 py-5">Data Tempat PKL</p>
</div>
<x-table :headers="$headers" :rows="$rows" />
</section>
</div>

@endsection