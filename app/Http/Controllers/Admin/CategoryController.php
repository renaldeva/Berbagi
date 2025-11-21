<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    public function index(){ $cats = Category::paginate(20); return view('admin.categories.index', compact('cats')); }
    public function create(){ return view('admin.categories.create'); }
    public function store(Request $req){ $req->validate(['nama_kategori'=>'required|unique:categories']); Category::create($req->only('nama_kategori')); return redirect()->route('admin.categories.index')->with('success','Kategori dibuat'); }
    public function edit($id){ $cat = Category::findOrFail($id); return view('admin.categories.edit', compact('cat')); }
    public function update(Request $req, $id){ $cat = Category::findOrFail($id); $req->validate(['nama_kategori'=>'required|unique:categories,nama_kategori,'.$id]); $cat->update($req->only('nama_kategori')); return back()->with('success','Kategori diperbarui'); }
    public function destroy($id){ Category::destroy($id); return back()->with('success','Kategori dihapus'); }
}
