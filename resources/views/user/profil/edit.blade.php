@extends('layouts.app')

@section('content')

<div class="container mt-4">

    <a href="{{ route('user.profil.index') }}" class="btn btn-secondary mb-3">
        <i class="fa fa-arrow-left"></i> Kembali
    </a>

    <div class="card p-4">

        <h4>Edit Profil</h4>
        <hr>

        <form action="{{ route('user.profil.update') }}" method="POST" enctype="multipart/form-data">
        @csrf


            <!-- Nama -->
            <div class="mb-3">
                <label for="name" class="form-label">Nama Lengkap</label>
                <input 
                    type="text"
                    name="name"
                    class="form-control"
                    value="{{ old('name', $user->name) }}"
                    required
                >
            </div>

            <!-- Email -->
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input 
                    type="email"
                    name="email"
                    class="form-control"
                    value="{{ old('email', $user->email) }}"
                    required
                >
            </div>

            <!-- Foto -->
            <div class="mb-3">
                <label class="form-label">Foto Profil</label><br>

                <img 
                    src="{{ $user->photo ? asset('uploads/profile/'.$user->photo) : 'https://ui-avatars.com/api/?name='.$user->name }}" 
                    width="90"
                    class="rounded mb-3"
                >

                <input type="file" name="photo" class="form-control">
            </div>

            <button class="btn btn-primary">
                <i class="fa fa-save"></i> Simpan Perubahan
            </button>
        </form>

    </div>
</div>

@endsection
