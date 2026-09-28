<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Barryvdh\DomPDF\Facade\Pdf;

class GuruController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Filter search
        $gurus = Guru::query()
            ->when($request->search, function ($query, $search) {
                $query->where(function ($q) use ($search) {
                    $q->where('nama_guru', 'like', "%{$search}%")
                      ->orWhere('nip', 'like', "%{$search}%");
                });
            })
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('guru.index', compact('gurus'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('guru.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'nama_guru'      => 'required|string|max:255',
            'nip'            => 'required|string|max:20|unique:gurus,nip',
            'mata_pelajaran' => 'required|string|max:255',
            'jenis_kelamin'  => 'required|string|max:255',
            'email'          => 'required|email|unique:gurus,email',
            'foto'           => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        // Upload foto
        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')
                ->store('foto-guru', 'public');
        }

        Guru::create($data);

        return redirect() ->route('guru.index')->with('success', 'Guru berhasil ditambahkan.');
    }
    public function show(Guru $guru)
    {
        return view('guru.show', compact('guru'));
    }
    public function edit(Guru $guru)
    {
        return view('guru.edit', compact('guru'));
    }
    public function update(Request $request, Guru $guru)
    {
        $data = $request->validate([
            'nama_guru'      => 'required|string|max:255',
            'nip'            => 'required|string|max:20|unique:gurus,nip,' . $guru->id,
            'mata_pelajaran' => 'required|string|max:255',
            'kelas'          => 'required|string|max:255',
            'email'          => 'required|email|unique:gurus,email,' . $guru->id,
            'foto'           => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        // Jika ada foto baru
        if ($request->hasFile('foto')) {

            // Hapus foto lama
            if ($guru->foto && Storage::disk('public')->exists($guru->foto)) {
                Storage::disk('public')->delete($guru->foto);
            }

            // Upload foto baru
            $data['foto'] = $request->file('foto')
                ->store('foto-guru', 'public');
        }

        $guru->update($data);

        return redirect()
            ->route('guru.index')
            ->with('success', 'Data guru berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Guru $guru)
    {
        // Hapus foto dari storage
        if ($guru->foto && Storage::disk('public')->exists($guru->foto)) {
            Storage::disk('public')->delete($guru->foto);
        }

        // Hapus data guru
        $guru->delete();

        return redirect()
            ->route('guru.index')
            ->with('success', 'Data guru berhasil dihapus.');
    }

    /**
     * Cetak data guru ke PDF.
     */
    public function cetakPdf()
    {
        // Ambil semua data guru
        $gurus = Guru::all();

        // Load view khusus PDF
        $pdf = Pdf::loadView('guru.pdf', compact('gurus'))
                  ->setPaper('a4', 'landscape');

        // Preview PDF di browser
        return $pdf->stream('laporan-data-guru.pdf');
    }
}
