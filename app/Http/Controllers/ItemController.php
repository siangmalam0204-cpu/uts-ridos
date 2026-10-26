<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ItemController extends Controller
{
    // Menampilkan daftar barang
    public function index(Request $request)
    {
        $search = $request->input('search');

        $items = Item::query()
            ->when($search, function ($query, $search) {
                $query->where(function ($q) use ($search) {
                    $q->where('kode_barang', 'like', "%{$search}%")
                        ->orWhere('nama_barang', 'like', "%{$search}%")
                        ->orWhere('kategori', 'like', "%{$search}%")
                        ->orWhere('lokasi_simpan', 'like', "%{$search}%");
                });
            })
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return Inertia::render('Barang/Index', [
            'items' => $items,
            'filters' => [
                'search' => $search ?? '',
            ],
        ]);
    }

    // Menampilkan form tambah barang
    public function create()
    {
        return Inertia::render('Barang/Create');
    }

    // Menyimpan barang
    public function store(Request $request)
    {
        $validated = $request->validate([
            'kode_barang' => 'required|string|max:50|unique:items,kode_barang',
            'nama_barang' => 'required|string|max:255',
            'kategori' => 'required|string|max:100',
            'jumlah' => 'required|integer|min:0',
            'lokasi_simpan' => 'required|string|max:255',
        ]);

        Item::create($validated);

        return redirect()
            ->route('barang.index')
            ->with('success', 'Barang berhasil ditambahkan.');
    }

    // Menampilkan form edit barang
    public function edit(Item $item)
    {
        return Inertia::render('Barang/Edit', [
            'item' => $item,
        ]);
    }

    // Memperbarui barang
    public function update(Request $request, Item $item)
    {
        $validated = $request->validate([
            'kode_barang' => 'required|string|max:50|unique:items,kode_barang,' . $item->id,
            'nama_barang' => 'required|string|max:255',
            'kategori' => 'required|string|max:100',
            'jumlah' => 'required|integer|min:0',
            'lokasi_simpan' => 'required|string|max:255',
        ]);

        $item->update($validated);

        return redirect()
            ->route('barang.index')
            ->with('success', 'Barang berhasil diperbarui.');
    }

    // Menghapus barang
    public function destroy(Item $item)
    {
        $item->delete();

        return redirect()
            ->route('barang.index')
            ->with('success', 'Barang berhasil dihapus.');
    }
}
