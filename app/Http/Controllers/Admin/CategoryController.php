<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::latest()->get();
        return view('admin.categories.index', compact('categories'));
    }

    public function create()
    {
        return view('admin.categories.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_kategori' => 'required|min:2'
        ]);

        Category::create([
            'nama_kategori' => $request->nama_kategori
        ]);

        return redirect()->route('admin.categories.index')->with('success', 'Kategori berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $category = Category::findOrFail($id);
        return view('admin.categories.edit', compact('category'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_kategori' => 'required|min:2'
        ]);

        Category::findOrFail($id)->update([
            'nama_kategori' => $request->nama_kategori
        ]);

        return redirect()->route('admin.categories.index')->with('success', 'Kategori berhasil diperbarui!');
    }

    public function destroy($id)
    {
        Category::findOrFail($id)->delete();
        return back()->with('success', 'Kategori berhasil dihapus!');
    }
}
