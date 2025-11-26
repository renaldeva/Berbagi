<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\Category;
use Illuminate\Support\Str;

class ItemController extends Controller
{
    public function index()
    {
        // Tampilkan semua item milik user yang login
        $items = Item::where('user_id', auth()->id())->paginate(10);
        return view('user.items.index', compact('items'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('user.items.create', compact('categories'));
    }

    public function store(Request $req)
    {
        $req->validate([
            'nama_barang' => 'required',
            'kategori' => 'required',
            'kondisi' => 'required',
            'foto' => 'nullable|image|max:2048'
        ]);

        $data = $req->only(['nama_barang', 'kategori', 'kondisi', 'deskripsi']);
        $data['user_id'] = auth()->id(); // default user

        // Upload foto
        if ($req->hasFile('foto')) {
            $file = $req->file('foto');
            $name = time() . '_' . Str::random(6) . '.' . $file->getClientOriginalExtension();
            $file->storeAs('public/items', $name);
            $data['foto'] = 'storage/items/' . $name;
        }

        Item::create($data);

        return redirect()->route('user.items.index')->with('success', 'Barang berhasil disimpan');
    }

    public function edit($id)
    {
        $item = Item::findOrFail($id);
        $this->authorizeOwnership($item);

        $categories = Category::all();
        return view('user.items.edit', compact('item', 'categories'));
    }

    public function update(Request $req, $id)
    {
        $item = Item::findOrFail($id);
        $this->authorizeOwnership($item);

        $req->validate([
            'nama_barang' => 'required',
            'kategori' => 'required',
            'kondisi' => 'required',
            'foto' => 'nullable|image|max:2048'
        ]);

        $data = $req->only(['nama_barang', 'kategori', 'kondisi', 'deskripsi']);

        if ($req->hasFile('foto')) {
            $file = $req->file('foto');
            $name = time() . '_' . Str::random(6) . '.' . $file->getClientOriginalExtension();
            $file->storeAs('public/items', $name);
            $data['foto'] = 'storage/items/' . $name;
        }

        $item->update($data);

        return redirect()->route('user.items.index')->with('success', 'Barang berhasil diperbarui');
    }

    public function destroy($id)
    {
        $item = Item::findOrFail($id);
        $this->authorizeOwnership($item);

        $item->delete();

        return back()->with('success', 'Barang berhasil dihapus');
    }

    private function authorizeOwnership($item)
    {
        if ($item->user_id != auth()->id()) {
            abort(403, 'Anda tidak memiliki akses ke item ini');
        }
    }
}
