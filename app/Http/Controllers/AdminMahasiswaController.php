<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Mahasiswa;

class AdminMahasiswaController extends Controller
{
    public function index()
    {
        $mahasiswas = Mahasiswa::all();
        return view('admin', compact('mahasiswas'));
    }

    public function create()
    {
        return view('create');
    }

    public function store(Request $request)
    {
        // Validasi data dari form tambah data
        $validatedData = $request->validate([
            'nim' => 'required|unique:mahasiswas',
            'nama' => 'required',
            'alamat' => 'required',
            'tanggal_lahir' => 'required|date',
            'gender' => 'required|in:L,P',
            'usia' => 'required',
        ]);

        Mahasiswa::create($validatedData);

        return redirect()->route('admin.index')->with('success', 'Data mahasiswa berhasil ditambahkan');
    }

    public function edit($id)
    {
        $mahasiswa = Mahasiswa::findOrFail($id);
        $mahasiswas = Mahasiswa::all();
        return view('admin', compact('mahasiswa', 'mahasiswas'));
    }

    public function update(Request $request, $id)
    {
        // Validasi data dari form edit data
        $validatedData = $request->validate([
            'nim' => 'required|unique:mahasiswas,nim,'.$id,
            'nama' => 'required',
            'alamat' => 'required',
            'tanggal_lahir' => 'required|date',
            'gender' => 'required|in:L,P',
            'usia' => 'required',
        ]);

        // Cari data mahasiswa berdasarkan ID
        $mahasiswa = Mahasiswa::findOrFail($id);

        // Perbarui data alat pancing
        $mahasiswa->nim = $request->nim;
        $mahasiswa->nama = $request->nama;
        $mahasiswa->alamat = $request->alamat;
        $mahasiswa->tanggal_lahir = $request->tanggal_lahir;
        $mahasiswa->gender = $request->gender;
        $mahasiswa->usia = $request->usia;

        // Simpan perubahan data
        $mahasiswa->save();

        return redirect()->route('admin.index')->with('success', 'Data mahasiswa berhasil diupdate');
    }

    public function destroy($id)
    {
        Mahasiswa::findOrFail($id)->delete();

        return redirect()->route('admin.index')->with('success', 'Data mahasiswa berhasil dihapus');
    }
}