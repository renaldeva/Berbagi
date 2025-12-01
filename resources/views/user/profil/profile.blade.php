@extends('layouts.app')

@section('content')

<div class="container mt-4">
    <div class="row">
        <!-- Profil -->
        <div class="col-md-4">
            <div class="card p-3">
                <h5>Foto Profil</h5>
                <hr>

                <div class="text-center">
                    @if(Auth::user()->photo)
                        <img src="{{ asset('uploads/profile/' . Auth::user()->photo) }}" class="img-thumbnail" width="180">
                    @else
                        <img src="https://ui-avatars.com/api/?name={{ Auth::user()->name }}" class="img-thumbnail" width="180">
                    @endif
                </div>

                <form action="{{ route('profil.update') }}" method="POST" enctype="multipart/form-data" class="mt-3">
                    @csrf
                    <label class="form-label">Ganti Foto</label>
                    <input type="file" name="photo" class="form-control">
                    <button class="btn btn-primary mt-2">Update Foto</button>
                </form>
            </div>
        </div>

        <!-- Identitas -->
        <div class="col-md-8">
            <div class="card p-3">
                <h5>Informasi Profil</h5>
                <hr>

                <form action="{{ route('profil.update') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Nama</label>
                        <input type="text" name="name" class="form-control" value="{{ Auth::user()->name }}">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" name="email" class="form-control" value="{{ Auth::user()->email }}">
                    </div>

                    <button class="btn btn-success">Simpan Perubahan</button>
                </form>

                <hr>

                <h5>Ganti Password</h5>

                <form action="{{ route('profil.password.update') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Password Saat Ini</label>
                        <input type="password" name="current_password" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Password Baru</label>
                        <input type="password" name="new_password" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Konfirmasi Password Baru</label>
                        <input type="password" name="new_password_confirmation" class="form-control">
                    </div>

                    <button class="btn btn-warning">Update Password</button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
