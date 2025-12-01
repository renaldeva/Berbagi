<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>

    <style>
        body {
            margin: 0;
            background: #F4F1FF;
            font-family: "Poppins", sans-serif;
        }

        .header {
            background: #6A4DFF;
            padding: 45px 20px;
            text-align: center;
            color: white;
        }

        .header h2 {
            margin: 0;
            font-size: 24px;
            font-weight: 700;
        }

        .container {
            max-width: 520px;
            margin: 30px auto;
            background: white;
            padding: 25px;
            border-radius: 18px;
            box-shadow: 0 4px 16px rgba(0,0,0,0.07);
        }

        label {
            display: block;
            margin-bottom: 6px;
            font-weight: 600;
            color: #333;
        }

        input {
            width: 100%;
            padding: 12px 14px;
            border-radius: 10px;
            border: 1px solid #CCC;
            font-size: 15px;
            margin-bottom: 18px;
        }

        .btn-save {
            width: 100%;
            background: #6A4DFF;
            color: white;
            border: none;
            padding: 14px;
            border-radius: 10px;
            font-size: 16px;
            cursor: pointer;
            font-weight: 600;
        }

        .btn-back {
            text-align: center;
            display: block;
            margin-top: 12px;
            color: #6A4DFF;
            text-decoration: none;
            font-weight: 500;
            font-size: 14px;
        }
    </style>
</head>

<body>

    <div class="header">
        <h2>Reset Password</h2>
    </div>

    <div class="container">

        <form action="{{ route('user.profil.password') }}" method="POST">
            @csrf

            <label>Password Lama</label>
            <input type="password" name="current_password">

            <label>Password Baru</label>
            <input type="password" name="password">

            <label>Konfirmasi Password Baru</label>
            <input type="password" name="password_confirmation">

            <button class="btn-save">Update Password</button>
        </form>

        <a href="{{ route('user.profil') }}" class="btn-back">Kembali ke Profil</a>

    </div>

</body>
</html>
