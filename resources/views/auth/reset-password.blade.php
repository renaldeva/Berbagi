<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<div class="card">
    <h3>Reset Password</h3>
    <p>Masukkan kode verifikasi yang dikirim ke email Anda, serta password baru.</p>

    <form method="POST" action="{{ route('forgot-password.reset') }}">
        @csrf
        <input type="hidden" name="email" value="{{ $email }}">
        <input type="text" name="verification_code" placeholder="Kode Verifikasi" class="form-control" required>
        <input type="password" name="password" placeholder="Password Baru" class="form-control" required>
        <input type="password" name="password_confirmation" placeholder="Konfirmasi Password" class="form-control" required>
        <button type="submit" class="btn-login">Reset Password</button>
    </form>
</div>

</body>
</html>