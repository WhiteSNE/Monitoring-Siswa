<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Kelas;
use App\Models\Siswa;
use App\Models\Jurusan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class SiswaController extends Controller
{
    public function index()
    {
        $siswas = Siswa::with(['jurusan', 'kelas'])->get();
        return view('admin.datasiswa.datasiswa', compact('siswas'));
    }

    public function create()
    {
        $jurusans = Jurusan::all();
        $kelases = Kelas::all();
        return view('admin.datasiswa.create', compact('jurusans', 'kelas'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nisn' => 'required|numeric|unique:users,username', // Cek unique di kolom username tabel users
            'nama_siswa' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'tanggal_lahir' => 'required|date',
            'jurusan_id' => 'required|exists:jurusans,id',
            'kelas_id' => 'required|exists:kelas,id',
            'jenis_kelamin' => 'required|in:L,P',
        ]);

        DB::beginTransaction();

        try {
            // 3. Buat User baru
            $user = User::create([
                'name' => $request->nama_siswa,
                'username' => $request->nisn, // NISN disimpan sebagai username
                'email' => $request->email,
                'password' => Hash::make($request->tanggal_lahir), // Password default dari tgl lahir
                'role' => 'siswa', // Role otomatis
            ]);

            // 4. Buat Siswa baru dan hubungkan dengan User
            Siswa::create([
                'user_id' => $user->id, // <-- Kunci penghubung
                'nisn' => $request->nisn,
                'nama_siswa' => $request->nama_siswa,
                'tanggal_lahir' => $request->tanggal_lahir,
                'jurusan_id' => $request->jurusan_id,
                'kelas_id' => $request->kelas_id,
                'jenis_kelamin' => $request->jenis_kelamin,
                'no_telp' => $request->no_telp,
                'alamat' => $request->alamat,
            ]);

            DB::commit(); // Simpan perubahan jika semua berhasil

            return redirect()->route('admin.datasiswa.index')->with('success', 'Siswa berhasil ditambahkan.');
        } catch (\Exception $e) {
            DB::rollBack(); // Batalkan semua jika ada error
            return redirect()->back()->with('error', 'Gagal menambahkan siswa. Error: ' . $e->getMessage())->withInput();
        }
    }

    public function edit($id)
    {
        $jurusans = Jurusan::all();
        $kelas = Kelas::all();
        return view('admin.datasiswa.edit', compact('siswa', 'jurusans', 'kelass'));
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
