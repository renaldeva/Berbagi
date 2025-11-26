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
        $items = Item::where('user_id', auth()->id())->paginate(9);
        return view('user.items.index', compact('items'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('user.items.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nama_barang' => 'required',
            'kategori' => 'required',
            'kondisi' => 'required',
            'deskripsi' => 'nullable',
            'foto' => 'nullable|image|max:3072'
        ]);

        if ($request->hasFile('foto')) {
            // Simpan ke storage/app/public/items
            $data['foto'] = $request->file('foto')->store('items', 'public');
        }

        $data['user_id'] = auth()->id();
        $data['status'] = 'pending';

        Item::create($data);

        return redirect()->route('user.dashboard')->with('success', 'Barang berhasil dikirim!');
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
            'deskripsi' => 'nullable',
            'foto' => 'nullable|image|max:3072'
        ]);

        $data = $req->only(['nama_barang', 'kategori', 'kondisi', 'deskripsi']);

        if ($req->hasFile('foto')) {
            $name = time() . '_' . Str::random(6) . '.' . $req->file('foto')->getClientOriginalExtension();
            $req->file('foto')->storeAs('public/items', $name);

            // disimpan ke database tanpa "storage/"
            $data['foto'] = 'items/' . $name;
        }

        $item->update($data);

        return redirect()->route('user.dashboard')->with('success', 'Barang berhasil diperbarui');
    }

    public function destroy($id)
    {
        $item = Item::findOrFail($id);
        $this->authorizeOwnership($item);

        $item->delete();

        return redirect()->route('user.dashboard')->with('success', 'Barang berhasil dihapus');
    }

    private function authorizeOwnership($item)
    {
        if ($item->user_id != auth()->id()) {
            abort(403, 'Anda tidak memiliki akses');
        }
    }
}
