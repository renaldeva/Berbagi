<!DOCTYPE html>
<html>
<head>
    <title>Login - Berbagi</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Poppins', sans-serif; min-height: 100vh; overflow-x: hidden; }

        .container-split { display: flex; min-height: 100vh; }

        .left-side {
            width: 50%;
            background: linear-gradient(135deg, #22c55e 0%, #16a34a 50%, #15803d 100%);
            padding: 80px 60px;
            color: white;
            display: flex;
            flex-direction: column;
            justify-content: center;
            position: relative;
            overflow: hidden;
        }

        .left-side::before, .left-side::after {
            content: '';
            position: absolute;
            border-radius: 50%;
        }
        .left-side::before { width: 400px; height: 400px; top: -200px; right: -200px; background: rgba(255,255,255,0.1); }
        .left-side::after { width: 300px; height: 300px; bottom: -150px; left: -150px; background: rgba(255,255,255,0.08); }

        .left-content { position: relative; z-index: 2; max-width: 500px; }
        .left-side h1 { font-size: 3.5rem; font-weight: 700; margin-bottom: 0; letter-spacing: 1px; }
        .divider-line { width: 120px; height: 3px; background: white; margin: 15px 0 20px 0; }
        .left-side h2 { font-size: 1.8rem; font-weight: 400; margin-bottom: 30px; }
        .left-side p { font-size: 1rem; line-height: 1.7; font-weight: 300; opacity: 0.95; }

        .right-side {
            width: 50%;
            background: #f5f5f5;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 40px;
            position: relative;
            overflow: hidden;
        }

        .circle-decoration-1, .circle-decoration-2 { position: absolute; border-radius: 50%; }
        .circle-decoration-1 { width: 250px; height: 250px; background: rgba(34,197,94,0.15); top: -100px; right: -100px; }
        .circle-decoration-2 { width: 180px; height: 180px; background: rgba(34,197,94,0.1); top: 20px; right: 20px; }

        .login-card { width: 450px; max-width: 100%; position: relative; z-index: 2; }
        .login-card h3 { font-size: 2rem; font-weight: 600; color: #1f2937; margin-bottom: 8px; }
        .login-card .subtitle { color: #6b7280; font-size: 0.95rem; margin-bottom: 35px; }

        .form-label { font-weight: 500; color: #374151; margin-bottom: 8px; font-size: 0.9rem; }
        .form-control {
            padding: 12px 16px;
            border: 1px solid #d1d5db;
            border-radius: 8px;
            font-size: 0.95rem;
            transition: all 0.3s;
        }
        .form-control:focus { border-color: #22c55e; box-shadow: 0 0 0 3px rgba(34,197,94,0.1); outline: none; }

        .password-toggle { position: relative; }
        .password-toggle input { padding-right: 45px; }
        .toggle-icon { position: absolute; right: 15px; top: 50%; transform: translateY(-50%); cursor: pointer; color: #6b7280; font-size: 1.1rem; }

        .btn-login {
            background: #22c55e; color: white; border: none; font-weight: 600; border-radius: 8px; padding: 13px;
            font-size: 1rem; transition: all 0.3s; width: 100%; margin-top: 10px;
        }
        .btn-login:hover { background: #16a34a; transform: translateY(-2px); box-shadow: 0 4px 12px rgba(34,197,94,0.3); }

        .forgot-password { color: #22c55e; text-decoration: none; font-weight: 500; font-size: 0.9rem; }
        .forgot-password:hover { color: #16a34a; text-decoration: underline; }

        .register-link { text-align: center; margin-top: 25px; color: #6b7280; font-size: 0.9rem; }
        .register-link a { color: #22c55e; text-decoration: none; font-weight: 600; }
        .register-link a:hover { color: #16a34a; text-decoration: underline; }

        @media (max-width: 768px) { .container-split { flex-direction: column; } .left-side, .right-side { width: 100%; min-height: auto; } }
    </style>
</head>
<body>

<div class="container-split">
    <div class="left-side">
        <div class="left-content">
            <h1>WELCOME</h1>
            <div class="divider-line"></div>
            <h2>Sahabat Berbagi</h2>
            <p>Barang bekasmu punya cerita baru untuk orang yang membutuhkannya.</p>
        </div>
    </div>

    <div class="right-side">
        <div class="circle-decoration-1"></div>
        <div class="circle-decoration-2"></div>

        <div class="login-card">
            @if(session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif

            <h3>Login ke Akun Anda</h3>
            <p class="subtitle">Selamat datang kembali! Silakan masukkan data Anda untuk mengakses akun Anda.</p>

            <form method="POST" action="/login">
                @csrf
                <div class="mb-3">
                    <label class="form-label">Alamat Email</label>
                    <input type="email" class="form-control" name="email" placeholder="Masukkan Email" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Password</label>
                    <div class="password-toggle">
                        <input type="password" class="form-control" name="password" id="passwordField" placeholder="Password" required>
                        <span class="toggle-icon" onclick="togglePassword()">&#128065;</span>
                    </div>
                </div>
                <!-- Hanya link lupa password, checkbox remember me dihapus -->
                <div class="mb-3 text-end">
                    <a href="/forgot-password" class="forgot-password">Lupa password?</a>
                </div>
                <button class="btn-login" type="submit">Login</button>
            </form>

            <div class="register-link">Belum punya akun? <a href="/register">Register</a></div>
        </div>
    </div>
</div>

<script>
    function togglePassword() {
        const field = document.getElementById('passwordField');
        const icon = document.querySelector('.toggle-icon');
        if(field.type === 'password') { field.type='text'; icon.innerHTML='&#128584;'; }
        else { field.type='password'; icon.innerHTML='&#128065;'; }
    }
</script>

</body>
</html>
