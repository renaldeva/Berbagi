<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Item;

class ItemAdminController extends Controller
{
    public function index(){
        $items = Item::with('donatur')->paginate(15);
        return view('admin.items.index', compact('items'));
    }

    public function edit($id){ $item = Item::findOrFail($id); return view('admin.items.edit', compact('item')); }

    public function update(Request $req, $id){
        $item = Item::findOrFail($id);
        $req->validate(['status'=>'required|in:menunggu,tersedia,diproses,selesai']);
        $item->update($req->only(['status']));
        return back()->with('success','Status diupdate');
    }

    public function destroy($id){ Item::destroy($id); return back()->with('success','Barang dihapus'); }
}
