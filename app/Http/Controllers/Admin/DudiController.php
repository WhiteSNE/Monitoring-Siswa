<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Dudi;
use Illuminate\Http\Request;

class DudiController extends Controller
{
    /**
     * Tampilkan daftar data DUDI.
     */
    public function index()
    {
        $headers = [
            'No',
            'Nama Perusahaan',
            'Alamat',
            'Email',
            'Telepon',
            'PIC',
            'Deskripsi',
            'Aksi',
        ];

        $dudis = Dudi::with('User')->get(); // Pastikan relasi 'user' sudah didefinisikan di model Dudi

        $rows = $dudis->map(function ($dudi, $index) {
            return [
                $index + 1,
                $dudi->nama_perusahaan,
                $dudi->alamat,
                $dudi->email_perusahaan ?? '-',
                $dudi->no_telepon_perusahaan ?? '-',
                $dudi->nama_pic,
                $dudi->deskripsi ?? '-',
                '<a href="' . route('dudis.edit', $dudi->id) . '" class="text-blue-600 underline">Edit</a>',
            ];
        });

        return view('admin.datadudi.datadudi', [
            'headers' => $headers,
            'rows' => $rows,
        ]);
    }

    /**
     * Tampilkan form tambah data DUDI.
     */
    public function create()
    {
        return view('admin.datadudi.create');
    }

    /**
     * Simpan data DUDI baru ke database.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id'               => 'required|exists:users,id',
            'nama_perusahaan'       => 'required|string|max:255',
            'alamat'                => 'required|string',
            'email_perusahaan'      => 'nullable|email|max:255',
            'no_telepon_perusahaan' => 'nullable|string|max:20',
            'nama_pic'              => 'required|string|max:255',
            'deskripsi'             => 'nullable|string',
        ]);

        Dudi::create($validated);

        return redirect()->route('dudis.index')->with('success', 'Data berhasil ditambahkan');
    }

    /**
     * Tampilkan form edit data DUDI.
     */
    public function edit($id)
    {
        $dudi = Dudi::findOrFail($id);

        return view('admin.datadudi.edit', compact('dudi'));
    }

    /**
     * Update data DUDI yang sudah ada.
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'nama_perusahaan'       => 'required|string|max:255',
            'alamat'                => 'required|string',
            'email_perusahaan'      => 'nullable|email|max:255',
            'no_telepon_perusahaan' => 'nullable|string|max:20',
            'nama_pic'              => 'required|string|max:255',
            'deskripsi'             => 'nullable|string',
        ]);

        $dudi = Dudi::findOrFail($id);
        $dudi->update($validated);

        return redirect()->route('dudis.index')->with('success', 'Data berhasil diperbarui');
    }
}
