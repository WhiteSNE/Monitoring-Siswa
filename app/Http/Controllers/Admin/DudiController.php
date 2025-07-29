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

    public function edit($id)
    {
        $dudi = Dudi::findOrFail($id);
        return view('admin.dudi.edit', compact('dudi'));
    }
}
