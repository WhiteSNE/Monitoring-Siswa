<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\jurusan;
use Illuminate\Http\Request;

class JurusanController extends Controller
{
    public function index()
    {
        $headers =[
            'No',
            'Nama Jurusan',
        ];

        $jurusans = jurusan::all();

        $rows = $jurusans->map(function($jurusans, $index){
            return [
                $index + 1,
                $jurusans->nama_jurusan ?? '-',
                '<a href="' . route('jurusans.edit', $jurusans->id) . '" class="text-blue-600 underline">Edit</a>',
            ];
        });
        
        return view('admin.jurusans.jurusan', compact('headers', 'rows'));
    }

    public function create()
    {
        return view('admin.jurusans.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255|unique:jurusans,nama',
        ]);

        jurusan::create($validated);
        return redirect()->route('jurusans.index')->with('success', 'Jurusan berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $jurusan = jurusan::findOrFail($id);
        return view('admin.jurusans.edit', compact('jurusan'));
    }

    public function update(Request $request, $id)
    {
        $jurusan = jurusan::findOrFail($id);

        $validated = $request->validate([
            'nama' => 'required|string|max:255|unique:jurusans,nama,' . $jurusan->id,
        ]);

        $jurusan->update($validated);
        return redirect()->route('jurusans.index')->with('success', 'Jurusan berhasil diperbarui.');
    }

    public function destroy($id)
    {
        jurusan::destroy($id);
        return redirect()->route('jurusans.index')->with('success', 'Jurusan berhasil dihapus.');
    }
}
