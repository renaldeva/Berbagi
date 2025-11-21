@extends('layouts.app')
@section('title','Ajukan Permintaan')
@section('content')
<h4>Ajukan Permintaan</h4>
<div class="row">
    @foreach($items as $item)
    <div class="col-md-4 mb-3">
        <div class="card">
            @if($item->foto) <img src="{{ asset($item->foto) }}" class="card-img-top" style="height:160px;object-fit:cover"> @endif
            <div class="card-body">
                <h5>{{ $item->nama_barang }}</h5>
                <form action="{{ route('penerima.requests.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="item_id" value="{{ $item->id }}">
                    <textarea name="pesan" class="form-control mb-2" placeholder="Alasan (opsional)"></textarea>
                    <button class="btn btn-success btn-sm">Ajukan</button>
                </form>
            </div>
        </div>
    </div>
    @endforeach
</div>
{{ $items->links() }}
@endsection
