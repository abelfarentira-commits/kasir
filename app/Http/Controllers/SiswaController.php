<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Siswa;
use Illuminate\Support\Facades\Storage;
use Barryvdh\DomPDF\Facade\Pdf; // Import Facade PDF

class SiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Filter search
        $siswas = Siswa::query()
            ->when($request->search, function ($query, $search) {
                $query->where(function ($q) use ($search) {
                    $q->where('nama_siswa', 'like', "%{$search}%")
                      ->orWhere('nis', 'like', "%{$search}%");
                });
            })
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('siswa.index', compact('siswas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('siswa.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'nama_siswa' => 'required|string|max:255',
            'nis'        => 'required|string|max:10|unique:siswas,nis',
            'jurusan'    => 'required|string|max:255',
            'kelas'      => 'required|string|max:255',
            'email'      => 'required|email|unique:siswas,email',
            'foto'       => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        // Upload foto
        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')
                ->store('foto-siswa', 'public');
        }

        Siswa::create($data);

        return redirect()
            ->route('siswa.index')
            ->with('success', 'Siswa berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Siswa $siswa)
    {
        return view('siswa.show', compact('siswa'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Siswa $siswa)
    {
        return view('siswa.edit', compact('siswa'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Siswa $siswa)
    {
        $data = $request->validate([
            'nama_siswa' => 'required|string|max:255',
            'nis'        => 'required|string|max:10|unique:siswas,nis,' . $siswa->id,
            'jurusan'    => 'required|string|max:255',
            'kelas'      => 'required|string|max:255',
            'email'      => 'required|email|unique:siswas,email,' . $siswa->id,
            'foto'       => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        // Jika ada foto baru
        if ($request->hasFile('foto')) {

            // Hapus foto lama
            if ($siswa->foto && Storage::disk('public')->exists($siswa->foto)) {
                Storage::disk('public')->delete($siswa->foto);
            }

            // Upload foto baru
            $data['foto'] = $request->file('foto')
                ->store('foto-siswa', 'public');
        }

        $siswa->update($data);

        return redirect()
            ->route('siswa.index')
            ->with('success', 'Siswa berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Siswa $siswa)
    {
        // Hapus foto dari storage
        if ($siswa->foto && Storage::disk('public')->exists($siswa->foto)) {
            Storage::disk('public')->delete($siswa->foto);
        }

        // Hapus data siswa
        $siswa->delete();

        return redirect()
            ->route('siswa.index')
            ->with('success', 'Siswa berhasil dihapus.');
    }

    public function cetakPdf()
    {
        // 1. Ambil semua data siswa
        $siswas = Siswa::all();

        // 2. Load view khusus untuk PDF dan kirim datanya
        // Kita set ukuran kertas A4 dan orientasi landscape agar tabel muat
        $pdf = Pdf::loadView('siswa.pdf', compact('siswas'))
                  ->setPaper('a4', 'landscape');

        // 3. Stream pdf ke browser (agar bisa dipreview dulu sebelum download)
        return $pdf->stream('laporan-data-siswa.pdf');
    }
}
