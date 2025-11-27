<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\Category;
use Illuminate\Support\Str;

class ItemController extends Controller
{
    // =============================
    // LIST DATA USER
    // =============================
    public function index()
    {
        $items = Item::where('user_id', auth()->id())->paginate(9);
        return view('user.items.index', compact('items'));
    }

    // =============================
    // FORM TAMBAH
    // =============================
    public function create()
    {
        $categories = Category::all();
        return view('user.items.create', compact('categories'));
    }

    // =============================
    // PROSES TAMBAH BARANG
    // =============================
    public function store(Request $request)
    {
        $request->validate([
            'nama_barang' => 'required',
            'deskripsi' => 'required',
            'kondisi' => 'required',
            'category_id' => 'required',   // wajib
            'foto' => 'nullable|image|max:3072'
        ]);

        $item = new Item();
        $item->nama_barang = $request->nama_barang;
        $item->deskripsi = $request->deskripsi;
        $item->kondisi = $request->kondisi;
        $item->category_id = $request->category_id;
        $item->user_id = auth()->id();    // wajib → memperbaiki error not null

        // upload foto
        if ($request->hasFile('foto')) {
            $item->foto = $request->file('foto')->store('items', 'public');
        }

        $item->status = 'pending';
        $item->save();

        return redirect()->back()->with('success', 'Barang berhasil ditambahkan!');
    }

    // =============================
    // DETAIL ITEM USER
    // =============================
    public function show($id)
    {
        $item = Item::findOrFail($id);
        $this->authorizeOwnership($item);

        return view('user.items.show', compact('item'));
    }

    // =============================
    // FORM EDIT
    // =============================
    public function edit($id)
    {
        $item = Item::findOrFail($id);
        $this->authorizeOwnership($item);

        $categories = Category::all();
        return view('user.items.edit', compact('item', 'categories'));
    }

    // =============================
    // PROSES UPDATE BARANG
    // =============================
    public function update(Request $req, $id)
    {
        $item = Item::findOrFail($id);
        $this->authorizeOwnership($item);

        $req->validate([
            'nama_barang' => 'required',
            'category_id' => 'required',
            'kondisi' => 'required',
            'deskripsi' => 'nullable',
            'foto' => 'nullable|image|max:3072'
        ]);

        $data = $req->only(['nama_barang', 'category_id', 'kondisi', 'deskripsi']);

        if ($req->hasFile('foto')) {
            $name = time() . '_' . Str::random(6) . '.' . $req->file('foto')->getClientOriginalExtension();
            $req->file('foto')->storeAs('public/items', $name);
            $data['foto'] = 'items/' . $name;
        }

        $item->update($data);

        return redirect()->route('user.dashboard')->with('success', 'Barang berhasil diperbarui');
    }

    // =============================
    // DELETE BARANG
    // =============================
    public function destroy($id)
    {
        $item = Item::findOrFail($id);
        $this->authorizeOwnership($item);

        $item->delete();

        return redirect()->route('user.dashboard')->with('success', 'Barang berhasil dihapus');
    }

    // =============================
    // CEK PEMILIK
    // =============================
    private function authorizeOwnership($item)
    {
        if ($item->user_id != auth()->id()) {
            abort(403, 'Anda tidak memiliki akses');
        }
    }
}
