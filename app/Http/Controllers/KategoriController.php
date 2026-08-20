<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Http\Request;
use App\Http\Requests\KategoriRequest;
use Illuminate\Database\QueryException;

class KategoriController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $kataKunci = $request->query('cari');

        $daftarKategori = Kategori::withCount('alat')
            ->when($kataKunci, function ($query, $kataKunci) {
                $query->where('nama', 'like', '%' . $kataKunci . '%');
            })
            ->orderBy('nama')
            ->paginate(10)
            ->withQueryString();

        return view('kategori.index', compact('daftarKategori', 'kataKunci'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $kategori = new Kategori();

        return view('kategori.form', compact('kategori'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(KategoriRequest $request)
    {
        Kategori::create($request->validated());

        return redirect()
            ->route('kategori.index')
            ->with('sukses', 'Kategori berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Kategori $kategori)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Kategori $kategori)
    {
        return view('kategori.form', compact('kategori'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(KategoriRequest $request, Kategori $kategori)
    {
        $kategori->update($request->validated());

        return redirect()
            ->route('kategori.index')
            ->with('sukses', 'Kategori berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Kategori $kategori)
    {
        try {
            $kategori->delete();
        } catch (QueryException $e) {
            return redirect()
                ->route('kategori.index')
                ->with(
                    'gagal',
                    'Kategori tidak dapat dihapus karena masih dipakai oleh data alat.'
                );
        }

        return redirect()
            ->route('kategori.index')
            ->with('sukses', 'Kategori berhasil dihapus.');
    }
}