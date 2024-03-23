<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Mahasiswa;

class MahasiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $mahasiswas = Mahasiswa::orderByDesc('nim')->get();
        $totalMahasiswa = Mahasiswa::count();
        $statistikGender = Mahasiswa::select('gender', DB::raw('count(*) as total'))
            ->groupBy('gender')
            ->pluck('total', 'gender')
            ->toArray();

        // Inisialisasi variabel $statistikGender
        $statistikGender = [
            'L' => 0, // Inisialisasi jumlah mahasiswa laki-laki
            'P' => 0, // Inisialisasi jumlah mahasiswa perempuan
        ];

        // Menghitung jumlah mahasiswa berdasarkan gender
        foreach ($mahasiswas as $mahasiswa) {
            if ($mahasiswa->gender === 'L') {
                $statistikGender['L']++; // Menambah jumlah mahasiswa laki-laki
            } else if ($mahasiswa->gender === 'P') {
                $statistikGender['P']++; // Menambah jumlah mahasiswa perempuan
            }
        }

        // Mengirim data ke tampilan
        return view('home', [
            'mahasiswas' => $mahasiswas,
            'totalMahasiswa' => $mahasiswas->count(),
            'statistikGender' => $statistikGender,
        ]);

        return view('home', compact('mahasiswas', 'totalMahasiswa', 'statistikGender'));
    }

    public function search(Request $request)
    {
        $search = $request->get('search');
        $mahasiswas = Mahasiswa::where('nama', 'like', '%' . $search . '%')->get();
        $totalMahasiswa = $mahasiswas->count();
        $statistikGender = $mahasiswas->groupBy('gender')->map->count();

        return view('home', compact('mahasiswas', 'totalMahasiswa', 'statistikGender'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}