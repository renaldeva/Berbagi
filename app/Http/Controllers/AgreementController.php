<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Agreement;
use App\Models\RequestDonation;

class AgreementController extends Controller
{
    public function create($requestId){
        $r = RequestDonation::findOrFail($requestId);
        return view('agreements.create', compact('r'));
    }

    public function store(Request $req, $requestId){
        $req->validate(['tanggal'=>'required|date','waktu'=>'required','lokasi'=>'required|string']);
        Agreement::create([
            'request_id'=>$requestId,
            'tanggal'=>$req->tanggal,
            'waktu'=>$req->waktu,
            'lokasi'=>$req->lokasi,
            'status'=>'terjadwal'
        ]);
        return redirect()->back()->with('success','Perjanjian dibuat');
    }

    public function index(){
        $agreements = Agreement::with('requestDonation')->paginate(15);
        return view('agreements.index', compact('agreements'));
    }

    public function destroy($id){ Agreement::destroy($id); return back()->with('success','Perjanjian dihapus'); }
}
