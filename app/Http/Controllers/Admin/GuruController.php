<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Guru;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Carbon;

class GuruController extends Controller
{
    public function index()
    {
        $headers = ['No', 'NIP', 'Nama Lengkap', 'Email', 'No Telepon', 'Aksi'];

        $gurus = Guru::with('User')->get();

        $rows = $gurus->map(function ($guru, $index) {
            return [
                $index + 1,
                $guru->nip,
                $guru->nama_lengkap,
                $guru->email,
                $guru->no_telepon ?? '-',
                '<a href="' . route('gurus.edit', $guru->id) . '" class="text-blue-600 underline">Edit</a>',
            ];
        });

        return view('admin.dataguru.dataguru', compact('headers', 'rows'));
    }

    public function create()
    {
        return view('admin.dataguru.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nip'           => 'required|string|max:20|unique:gurus,nip',
            'nama_lengkap'  => 'required|string|max:255',
            'tanggal_lahir' => 'required|date',
            'email'         => 'nullable|email|unique:users,email',
            'no_telepon'    => 'nullable|string|max:20',
        ]);

        // Format password default dari tanggal lahir: dd/mm/YYYY
        $passwordDefault = Carbon::parse($validated['tanggal_lahir'])->format('d/m/Y');

        // Buat user baru
        $user = User::create([
            'name'     => $validated['nama_lengkap'],
            'email'    => $validated['email'] ?? $validated['nip'] . '@example.com',
            'password' => Hash::make($passwordDefault),
            'role'     => 'guru',
        ]);

        // Buat data guru
        Guru::create([
            'user_id'       => $user->id,
            'nip'           => $validated['nip'],
            'nama_lengkap'  => $validated['nama_lengkap'],
            'tanggal_lahir' => $validated['tanggal_lahir'],
            'no_telepon'    => $validated['no_telepon'],
            'email'         => $validated['email'] ?? null,
        ]);

        return redirect()->route('gurus.index')->with('success', 'Data guru berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $guru = Guru::with('user')->findOrFail($id);
        return view('admin.dataguru.edit', compact('guru'));
    }

    public function update(Request $request, $id)
    {
        $guru = Guru::with('user')->findOrFail($id);

        $validated = $request->validate([
            'nip'           => 'required|string|max:20|unique:gurus,nip,' . $guru->id,
            'nama_lengkap'  => 'required|string|max:255',
            'tanggal_lahir' => 'required|date',
            'email'         => 'nullable|email|unique:users,email,' . $guru->user_id,
            'no_telepon'    => 'nullable|string|max:20',
        ]);

        // Update user
        $guru->user->update([
            'name'  => $validated['nama_lengkap'],
            'email' => $validated['email'] ?? $guru->user->email,
        ]);

        // Update guru
        $guru->update($validated);

        return redirect()->route('gurus.index')->with('success', 'Data guru berhasil diperbarui.');
    }

    public function destroy($id)
    {
        Guru::destroy($id); // Cascade hapus user jika diatur di migrasi

        return redirect()->route('gurus.index')->with('success', 'Data guru berhasil dihapus.');
    }
}
