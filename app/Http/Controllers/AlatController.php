<?php

namespace App\Http\Controllers;

use App\Http\Requests\AlatRequest;
use App\Models\Alat;
use App\Models\Kategori;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AlatController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $kataKunci = $request->query('cari');
        $kategoriId = $request->query('kategori_id');

        $daftarAlat = Alat::with('kategori')
            ->when($kataKunci, function ($query, $kataKunci) {
                $query->where(function ($q) use ($kataKunci) {
                    $q->where('nama', 'like', '%' . $kataKunci . '%')
                        ->orWhere('kode_alat', 'like', '%' . $kataKunci . '%');
                });
            })
            ->when($kategoriId, function ($query, $kategoriId) {
                $query->where('kategori_id', $kategoriId);
            })
            ->orderBy('kode_alat')
            ->paginate(10)
            ->withQueryString();

        $daftarKategori = Kategori::orderBy('nama')->get();

        return view('alat.index', compact(
            'daftarAlat',
            'daftarKategori',
            'kataKunci',
            'kategoriId'
        ));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $alat = new Alat();

        $daftarKategori = Kategori::orderBy('nama')->get();

        return view('alat.form', compact('alat', 'daftarKategori'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AlatRequest $request)
{
    $data = $request->validated();

    if ($request->hasFile('foto')) {

        $file = $request->file('foto');

        $namaFile = uniqid() . '.' . $file->extension();

        $file->storeAs(
            'alat',
            $namaFile,
            'gambar'
        );

        $data['foto'] = $namaFile;
    }

    Alat::create($data);

    return redirect()
        ->route('alat.index')
        ->with('sukses', 'Data alat berhasil ditambahkan.');
}

    /**
     * Display the specified resource.
     */
    public function show(Alat $alat)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Alat $alat)
    {
        $daftarKategori = Kategori::orderBy('nama')->get();

        return view('alat.form', compact('alat', 'daftarKategori'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AlatRequest $request, Alat $alat)
    {
        $data = $request->validated();

    if ($request->hasFile('foto')) {

        // Hapus foto lama
        $this->hapusFoto($alat->foto);

        // Ambil foto baru
        $file = $request->file('foto');

        // Buat nama file
        $namaFile = uniqid() . '.' . $file->extension();

        // Simpan ke public/gambar/alat
        $file->storeAs(
            'alat',
            $namaFile,
            'gambar'
        );

        // Simpan nama file ke database
        $data['foto'] = $namaFile;
    }

    // Update data alat
    $alat->update($data);

    return redirect()
        ->route('alat.index')
        ->with('sukses', 'Data alat berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Alat $alat)
    {
        try {
            $fotoLama = $alat->foto;

            $alat->delete();

            $this->hapusFoto($fotoLama);
        } catch (QueryException $e) {
            return redirect()
                ->route('alat.index')
                ->with(
                    'gagal',
                    'Alat tidak dapat dihapus karena sudah pernah dipinjam.'
                );
        }

        return redirect()
            ->route('alat.index')
            ->with('sukses', 'Data alat berhasil dihapus.');
    }

    private function hapusFoto(?string $lokasiFoto): void
    {
        if (
            $lokasiFoto &&
            Storage::disk('gambar')->exists('alat/' . $lokasiFoto)
        ) {
            Storage::disk('gambar')->delete('alat/' . $lokasiFoto);
        }
    }
}
