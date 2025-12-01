@extends('layouts.app')

@section('content')

<div class="container mt-4">

    {{-- Tombol kembali --}}
    <a href="{{ route('user.dashboard') }}" class="btn btn-secondary mb-3">
        ← Kembali
    </a>

    <h3>Profil Saya</h3>
    <hr>

    <div class="card p-4">
        <div class="d-flex align-items-center">
            <img 
                src="{{ $user->photo ? asset('uploads/profile/'.$user->photo) : 'https://ui-avatars.com/api/?name='.$user->name }}" 
                class="rounded-circle me-3" 
                width="90">
            
            <div>
                <h5>{{ $user->name }}</h5>
                <p class="mb-0">{{ $user->email }}</p>
            </div>
        </div>

        {{-- Tombol edit & password --}}
        <a href="{{ route('user.profil.edit') }}" class="btn btn-primary mt-3 w-100">
            Edit Profil
        </a>

        <a href="{{ route('user.profil.password') }}" class="btn btn-warning mt-3 w-100">
            Ganti Password
        </a>
    </div>

</div>

@endsection
