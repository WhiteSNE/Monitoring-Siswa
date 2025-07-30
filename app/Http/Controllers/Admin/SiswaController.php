<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Siswa;
use App\Models\Jurusan;
use App\Models\Kelas;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class SiswaController extends Controller
{
    public function index()
    {
        $headers = [
            'No',
            'NISN',
            'Nama Lengkap',
            'Tanggal Lahir',
            'Email',
            'No Telepon',
            'Alamat',
            'Jurusan',
            'Kelas',
            'Aksi',
        ];

        $siswas = Siswa::with(['jurusan', 'kelas', 'user'])->get();

        $rows = $siswas->map(function ($siswa, $index) {
            return [
                $index + 1,
                $siswa->nisn,
                $siswa->nama_lengkap,
                $siswa->tanggal_lahir ?? '-',
                $siswa->user?->email ?? '-',
                $siswa->no_telepon ?? '-',
                $siswa->alamat ?? '-',
                $siswa->jurusan?->nama_jurusan ?? '-',
                $siswa->kelas?->nama_kelas ?? '-',
                '<a href="' . route('siswas.edit', $siswa->id) . '" class="text-blue-600 underline">Edit</a>',
            ];
        });

        return view('admin.datasiswa.datasiswa', compact('headers', 'rows'));
    }

    public function create()
    {
        $jurusans = Jurusan::all();
        $kelases = Kelas::all();
        return view('admin.datasiswa.create', compact('jurusans', 'kelases'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nisn' => 'required|string|max:20|unique:siswas,nisn',
            'nama_lengkap' => 'required|string|max:255',
            'tanggal_lahir' => 'required|date',
            'jurusan_id' => 'required|exists:jurusans,id',
            'kelas_id' => 'required|exists:kelas,id',
            'alamat' => 'required|string',
            'no_telepon' => 'nullable|string|max:20',
        ]);

        $email = $validated['nisn'] . '@siswa.test';

        // Cek apakah user sudah ada
        $existingUser = User::where('email', $email)->first();
        if ($existingUser) {
            return redirect()->back()->withErrors(['email' => 'User dengan NISN tersebut sudah ada.']);
        }

        // Buat user baru
        $user = User::create([
            'name' => $validated['nama_lengkap'],
            'email' => $email,
            'password' => Hash::make(date('Ymd', strtotime($validated['tanggal_lahir']))),
            'role' => 'siswa',
        ]);

        // Buat data siswa
        Siswa::create([
            'user_id' => $user->id,
            'nisn' => $validated['nisn'],
            'nama_lengkap' => $validated['nama_lengkap'],
            'tanggal_lahir' => $validated['tanggal_lahir'],
            'jurusan_id' => $validated['jurusan_id'],
            'kelas_id' => $validated['kelas_id'],
            'alamat' => $validated['alamat'],
            'no_telepon' => $validated['no_telepon'] ?? null,
        ]);

        return redirect()->route('siswas.index')->with('success', 'Data siswa berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $siswa = Siswa::findOrFail($id);
        $jurusans = Jurusan::all();
        $kelases = Kelas::all();

        return view('admin.datasiswa.edit', compact('siswa', 'jurusans', 'kelases'));
    }

    public function update(Request $request, $id)
    {
        $siswa = Siswa::findOrFail($id);

        $validated = $request->validate([
            'nisn' => 'required|string|max:20|unique:siswas,nisn,' . $siswa->id,
            'nama_lengkap' => 'required|string|max:255',
            'tanggal_lahir' => 'required|date',
            'jurusan_id' => 'required|exists:jurusans,id',
            'kelas_id' => 'required|exists:kelas,id',
            'alamat' => 'required|string',
            'no_telepon' => 'nullable|string|max:20',
        ]);

        $siswa->update($validated);

        // Perbarui nama user juga
        if ($siswa->user) {
            $siswa->user->update([
                'name' => $validated['nama_lengkap'],
            ]);
        }

        return redirect()->route('siswas.index')->with('success', 'Data siswa berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $siswa = Siswa::findOrFail($id);
        $user = $siswa->user;

        $siswa->delete();
        if ($user) $user->delete();

        return redirect()->route('siswas.index')->with('success', 'Data siswa berhasil dihapus.');
    }
}
