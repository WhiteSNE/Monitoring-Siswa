<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\kelas;
use Illuminate\Http\Request;

class KelasController extends Controller
{
    public function index()
    {
        $kelases = kelas::all();
        return view('admin.kelases.index', compact('kelases'));
    }

    public function create()
    {
        return view('admin.kelases.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255|unique:kelas,nama',
        ]);

        kelas::create($validated);
        return redirect()->route('kelases.index')->with('success', 'Kelas berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $kelas = kelas::findOrFail($id);
        return view('admin.kelases.edit', compact('kelas'));
    }

    public function update(Request $request, $id)
    {
        $kelas = kelas::findOrFail($id);

        $validated = $request->validate([
            'nama' => 'required|string|max:255|unique:kelas,nama,' . $kelas->id,
        ]);

        $kelas->update($validated);
        return redirect()->route('kelases.index')->with('success', 'Kelas berhasil diperbarui.');
    }

    public function destroy($id)
    {
        kelas::destroy($id);
        return redirect()->route('kelases.index')->with('success', 'Kelas berhasil dihapus.');
    }
}
