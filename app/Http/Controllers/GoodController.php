<?php

namespace App\Http\Controllers;

use App\Models\Good;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GoodController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $goods = Good::all();
        return view('dashboard.goods.index', compact('goods'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('dashboard.goods.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'nama' => 'required|string|max:255',
            'harga_jual' => 'required|numeric|min:0',
            'keterangan' => 'nullable|string',
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $data = $request->only(['nama', 'harga_jual', 'keterangan']);

        if ($request->hasFile('gambar')) {
            $data['gambar'] = $request->file('gambar')->store('goods', 'public');
        }

        Good::create($data);

        return redirect()->route('goods.index')->with('success', 'Barang berhasil disimpan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Good $good)
    {
        //

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Good $good)
    {
        //
        return view('dashboard.goods.edit', compact('good'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Good $good)
    {
        //
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'harga_jual' => 'required|numeric|min:0',
            'keterangan' => 'nullable|string',
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        if ($request->hasFile('gambar')) {
            // Hapus gambar lama jika ada
            if ($good->gambar && Storage::exists('public/' . $good->gambar)) {
                Storage::delete('public/' . $good->gambar);
            }

            $validated['gambar'] = $request->file('gambar')->store('goods', 'public');
        }

        $good->update($validated);

        return redirect()->route('goods.index')->with('success', 'Barang berhasil diupdate.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Good $good)
    {
        // Hapus gambar jika ada
        if ($good->gambar && Storage::disk('public')->exists($good->gambar)) {
            Storage::disk('public')->delete($good->gambar);
        }

        // Hapus data barang
        $good->delete();

        return redirect()->route('goods.index')->with('success', 'Barang berhasil dihapus.');
    }
}
