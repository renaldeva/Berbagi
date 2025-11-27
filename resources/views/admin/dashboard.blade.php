@extends('layouts.app')

@section('sidebar')
@include('admin.sidebar')
@section('content')

<div class="alert alert-purple shadow-sm mt-2">
    Selamat datang <b>Admin</b>!
</div>

<div class="row">

    {{-- Card Total Barang --}}
    <div class="col-md-4">
        <div class="card dashboard-card purple">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-2">
                    <span class="title">Total Barang</span>
                    <i class="fas fa-box-open icon"></i>
                </div>
                <p class="desc">12</p>
            </div>
        </div>
    </div>

    {{-- Card Total Permintaan --}}
    <div class="col-md-4">
        <div class="card dashboard-card soft-purple">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-2">
                    <span class="title">Total Permintaan</span>
                    <i class="fas fa-file-alt icon"></i>
                </div>
                <p class="desc">5</p>
            </div>
        </div>
    </div>

    {{-- Card Total Pengguna --}}
    <div class="col-md-4">
        <div class="card dashboard-card dark-purple">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-2">
                    <span class="title">Total Pengguna</span>
                    <i class="fas fa-users icon"></i>
                </div>
                <p class="desc">4</p>
            </div>
        </div>
    </div>

</div>

<style>

    .alert-purple {
        background: #e8d3ff;
        color: #4B0082;
        font-weight: 600;
        border-radius: 10px;
        border-left: 5px solid #6A0DAD;
    }

    .dashboard-card {
        border: none;
        border-radius: 15px;
        padding: 5px;
        color: #fff;
        transition: 0.25s;
    }

    .dashboard-card.purple {
        background: linear-gradient(135deg, #6A0DAD, #4B0082);
        box-shadow: 0px 5px 15px rgba(106, 13, 173, 0.35);
    }

    .dashboard-card.soft-purple {
        background: linear-gradient(135deg, #9b4dff, #7a2dd6);
        box-shadow: 0px 5px 15px rgba(155, 77, 255, 0.35);
    }

    .dashboard-card.dark-purple {
        background: linear-gradient(135deg, #4B0082, #2e035a);
        box-shadow: 0px 5px 15px rgba(75, 0, 130, 0.4);
    }

    .dashboard-card .title {
        font-size: 18px;
        font-weight: 700;
    }

    .dashboard-card .desc {
        margin: 0;
        font-size: 30px;
        opacity: 0.9;
    }

    .dashboard-card .icon {
        font-size: 32px;
        opacity: 0.8;
    }

    .dashboard-card:hover {
        transform: scale(1.04);
        box-shadow: 0px 8px 18px rgba(0, 0, 0, 0.25);
    }

</style>

@endsection