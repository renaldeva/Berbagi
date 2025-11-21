<?php
namespace App\Http\Controllers\Donator;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\Category;
use Illuminate\Support\Str;

class ItemController extends Controller
{
    public function index(){
        $items = Item::where('id_donatur', auth()->id())->paginate(10);
        return view('donator.items.index', compact('items'));
    }

    public function create(){
        $categories = Category::all();
        return view('donator.items.create', compact('categories'));
    }

    public function store(Request $req){
        $req->validate(['nama_barang'=>'required','kategori'=>'required','kondisi'=>'required','foto'=>'nullable|image|max:2048']);

        $data = $req->only(['nama_barang','kategori','kondisi','deskripsi']);
        $data['id_donatur'] = auth()->id();

        if($req->hasFile('foto')){
            $file = $req->file('foto');
            $name = time().'_'.Str::random(6).'.'.$file->getClientOriginalExtension();
            $file->storeAs('public/items', $name);
            $data['foto'] = 'storage/items/'.$name;
        }

        Item::create($data);
        return redirect()->route('donator.items.index')->with('success','Barang tersimpan');
    }

    public function edit($id){
        $item = Item::findOrFail($id);
        $this->authorizeOwnership($item);
        $categories = Category::all();
        return view('donator.items.edit', compact('item','categories'));
    }

    public function update(Request $req,$id){
        $item = Item::findOrFail($id); $this->authorizeOwnership($item);
        $req->validate(['nama_barang'=>'required','kategori'=>'required','kondisi'=>'required','foto'=>'nullable|image|max:2048']);
        $data = $req->only(['nama_barang','kategori','kondisi','deskripsi']);
        if($req->hasFile('foto')){ $file=$req->file('foto'); $name=time().'_'.Str::random(6).'.'.$file->getClientOriginalExtension(); $file->storeAs('public/items',$name); $data['foto']='storage/items/'.$name; }
        $item->update($data);
        return redirect()->route('donator.items.index')->with('success','Barang diupdate');
    }

    public function destroy($id){
        $item = Item::findOrFail($id); $this->authorizeOwnership($item);
        $item->delete();
        return back()->with('success','Barang dihapus');
    }

    private function authorizeOwnership($item){
        if($item->id_donatur != auth()->id()) abort(403);
    }
}
