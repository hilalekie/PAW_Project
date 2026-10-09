<?php

namespace App\Http\Controllers;

use App\Models\Ruangan;
use Illuminate\Http\Request;

class RuanganController extends Controller
{
    public function index()
    {
        $ruangans = Ruangan::orderBy('nama_ruangan')->get();

        return view('ruangan.index', compact('ruangans'));
    }

    public function create()
    {
        return view('ruangan.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nama_ruangan' => 'required|string|max:100',
            'harga_per_jam' => 'required|integer|min:0',
            'status' => 'required|in:tersedia,dipakai',
        ]);

        Ruangan::create($data);

        return redirect()->route('ruangan.index')
            ->with('success', 'Ruangan berhasil ditambahkan');
    }

    public function edit(Ruangan $ruangan)
    {
        return view('ruangan.edit', compact('ruangan'));
    }

    public function update(Request $request, Ruangan $ruangan)
    {
        $data = $request->validate([
            'nama_ruangan' => 'required|string|max:100',
            'harga_per_jam' => 'required|integer|min:0',
            'status' => 'required|in:tersedia,dipakai',
        ]);

        $ruangan->update($data);

        return redirect()->route('ruangan.index')
            ->with('success', 'Ruangan berhasil diubah');
    }

    public function destroy(Ruangan $ruangan)
    {
        $ruangan->delete();

        return redirect()->route('ruangan.index')
            ->with('success', 'Ruangan berhasil dihapus');
    }
}