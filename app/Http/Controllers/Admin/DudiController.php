<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\dudi;
use Illuminate\Http\Request;

class DudiController extends Controller
{
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

        $dudis = dudi::with('User')->get(); // pastikan relasi user sudah benar

        $rows = $dudis->map(function ($dudi, $index) {
            return [
                $index + 1,
                $dudi->nama_perusahaan,
                $dudi->alamat,
                $dudi->email_perusahaan ?? '-',
                $dudi->no_telepon_perusahaan ?? '-',
                $dudi->nama_pic,
                $dudi->deskripi ?? '-',
                '<a href="' . route('dudis.edit', $dudi->id) . '" class="text-blue-600 underline">Edit</a>',
            ];
        });

        return view('admin.datadudi.datadudi', [
            'headers' => $headers,
            'rows' => $rows,
        ]);
    }

    public function create()
    {
        return view('admin.dudis.create');
    }
    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'nama_perusahaan' => 'required|string|max:255',
            'alamat' => 'required|string',
            'email_perusahaan' => 'nullable|email|max:20',
            'no_telepon_perusahaan' => 'nullable|string|max:20',
            'nama_pic' => 'required|string|max:255',
            'deskripi' => 'nullable|string',
        ]);

        dudi::create($validated);
        return redirect()->route('dudis.index')->with('Success', 'Data berhasil ditambahkan');
    }
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'nama_perusahaan' => 'required|string|max:255',
            'alamat' => 'required|string',
            'email_perusahaan' => 'nullable|email|max:20',
            'no_telepon_perusahaan' => 'nullable|string|max:20',
            'nama_pic' => 'required|string|max:255',
            'deskripi' => 'nullable|string',
        ]);

        $dudi = Dudi::findOrFail($id);
        $dudi->update($validated);

        return redirect()->route('dudis.index')->with('success', 'Data berhasil diperbarui');
    }

    public function edit($id)
    {
        $dudi = Dudi::findOrFail($id);
        return view('admin.dudis.edit', compact('dudi'));
    }
}
