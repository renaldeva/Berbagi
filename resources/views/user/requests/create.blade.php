@extends('layouts.app')

@section('title','Ajukan Permintaan')

@section('content')
<h4 class="mb-3">Ajukan Permintaan Barang</h4>

<div class="row">
    @forelse($items as $item)
    <div class="col-md-4 mb-3">
        <div class="card">

            {{-- Foto barang --}}
            @if($item->foto)
                <img src="{{ asset($item->foto) }}" 
                     class="card-img-top"
                     style="height:160px;object-fit:cover">
            @endif

            <div class="card-body">
                <h5 class="mb-1">{{ $item->nama_barang }}</h5>

                {{-- Badge status --}}
                <span class="badge 
                    @if($item->status == 'tersedia') bg-success
                    @elseif($item->status == 'menunggu') bg-warning
                    @else bg-secondary @endif
                ">
                    {{ ucfirst($item->status) }}
                </span>

                {{-- Form hanya tampil jika barang tersedia --}}
                @if($item->status === 'tersedia')
                    <form action="{{ route('user.requests.store') }}" method="POST" class="mt-2">
                        @csrf
                        <input type="hidden" name="item_id" value="{{ $item->id }}">
                        
                        <textarea name="pesan" 
                                  class="form-control mb-2" 
                                  placeholder="Alasan permintaan (opsional)"></textarea>

                        <button class="btn btn-success btn-sm w-100">
                            Ajukan Permintaan
                        </button>
                    </form>
                @else
                    <p class="text-muted mt-2 mb-0">
                        Tidak dapat diajukan karena status: <b>{{ $item->status }}</b>
                    </p>
                @endif
            </div>

        </div>
    </div>
    @empty
        <p class="text-muted">Belum ada barang tersedia.</p>
    @endforelse
</div>

<div class="mt-3">
    {{ $items->links() }}
</div>

@endsection
