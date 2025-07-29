<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\siswa;
use App\Models\jurusan;
use App\Models\kelas;
use Illuminate\Http\Request;

class SiswaController extends Controller
{
    public function index()
    {
        $headers = [
            'No',
            'NISN',
            'Nama Lengkap',
            'Jurusan',
            'Kelas',
            'Alamat',
            'No Telepon',
            'Aksi',
        ];

        $siswas = siswa::with(['jurusan', 'kelas'])->get();
        
        $rows = $siswas->map(function ($siswa, $index) {
            return [
                $index + 1,
                $siswa->nisn,
                $siswa->nama_lengkap,
                $siswa->jurusan?->nama_jurusan ?? '-',
                $siswa->kelas?->nama_kelas ?? '-',
                $siswa->alamat,
                $siswa->no_telepon ?? '-',
                '<a href="' . route('siswas.edit', $siswa->id) . '" class="text-blue-600 underline">Edit</a>',
            ];
        });
        
        return view('admin.datasiswa.datasiswa', compact('headers', 'rows'));
        dd($rows);
    }

    public function create()
    {
        $jurusans = jurusan::all();
        $kelases = kelas::all();
        return view('admin.siswa.create', compact('jurusans', 'kelases'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'nisn' => 'required|string|max:20',
            'nama_lengkap' => 'required|string|max:255',
            'jurusan_id' => 'required|exists:jurusans,id',
            'kelas_id' => 'required|exists:kelas,id',
            'alamat' => 'required|string',
            'no_telepon' => 'nullable|string|max:20',
        ]);

        siswa::create($validated);
        return redirect()->route('siswas.index')->with('success', 'Data siswa berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $siswa = siswa::findOrFail($id);
        $jurusans = jurusan::all();
        $kelases = kelas::all();
        return view('admin.datasiswa.edit', compact('siswa', 'jurusans', 'kelases'));
    }

    public function update(Request $request, $id)
    {
        $siswa = siswa::findOrFail($id);

        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'nisn' => 'required|string|max:20',
            'nama_lengkap' => 'required|string|max:255',
            'jurusan_id' => 'required|exists:jurusans,id',
            'kelas_id' => 'required|exists:kelas,id',
            'alamat' => 'required|string',
            'no_telepon' => 'nullable|string|max:20',
        ]);

        $siswa->update($validated);
        return redirect()->route('siswas.index')->with('success', 'Data siswa berhasil diperbarui.');
    }

    public function destroy($id)
    {
        siswa::destroy($id);
        return redirect()->route('siswas.index')->with('success', 'Data siswa berhasil dihapus.');
    }
}
