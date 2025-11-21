<?php
namespace App\Http\Controllers\Penerima;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\RequestDonation;
use App\Models\Item;

class RequestController extends Controller
{
    public function index(){
        $requests = RequestDonation::where('id_penerima', auth()->id())->with('item')->paginate(10);
        return view('penerima.requests.index', compact('requests'));
    }

    public function create(){
        $items = Item::where('status','tersedia')->with('donatur')->paginate(10);
        return view('penerima.requests.create', compact('items'));
    }

    public function store(Request $req){
        $req->validate(['item_id'=>'required|exists:items,id','pesan'=>'nullable|string']);
        RequestDonation::create([
            'item_id'=>$req->item_id,
            'id_penerima'=>auth()->id(),
            'pesan'=>$req->pesan,
            'status'=>'menunggu'
        ]);
        return redirect()->route('penerima.requests.index')->with('success','Permintaan terkirim');
    }

    public function destroy($id){
        $r = RequestDonation::findOrFail($id);
        if($r->id_penerima != auth()->id()) abort(403);
        $r->delete();
        return back()->with('success','Permintaan dibatalkan');
    }
}
