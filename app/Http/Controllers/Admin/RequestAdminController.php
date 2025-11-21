<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\RequestDonation;

class RequestAdminController extends Controller
{
    public function index(){
        $requests = RequestDonation::with('item','penerima')->paginate(20);
        return view('admin.requests.index', compact('requests'));
    }

    public function update(Request $req, $id){
        $r = RequestDonation::findOrFail($id);
        $req->validate(['status'=>'required|in:menunggu,diterima,ditolak,batal']);
        $r->update(['status'=>$req->status]);
        return back()->with('success','Status permintaan diperbarui');
    }

    public function destroy($id){ RequestDonation::destroy($id); return back()->with('success','Permintaan dihapus'); }
}
