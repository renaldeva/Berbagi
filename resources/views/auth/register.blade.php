<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Berbagi</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <style>
        * { margin:0; padding:0; box-sizing:border-box; }
        body { font-family: 'Poppins', sans-serif; min-height:100vh; overflow-x:hidden; }

        .container-split { display:flex; min-height:100vh; }

        /* Left Side */
        .left-side {
            width:50%;
            background:linear-gradient(135deg, #22c55e 0%, #16a34a 50%, #15803d 100%);
            padding:80px 60px;
            color:white;
            display:flex;
            flex-direction:column;
            justify-content:center;
            position:relative;
            overflow:hidden;
        }
        .left-side::before, .left-side::after { content:''; position:absolute; border-radius:50%; }
        .left-side::before { width:400px; height:400px; background:rgba(255,255,255,0.1); top:-200px; right:-200px; }
        .left-side::after { width:300px; height:300px; background:rgba(255,255,255,0.08); bottom:-150px; left:-150px; }
        .left-content { position:relative; z-index:2; max-width:500px; }
        .left-side h1 { font-size:3.5rem; font-weight:700; margin-bottom:0; letter-spacing:1px; }
        .divider-line { width:120px; height:3px; background:white; margin:15px 0 20px 0; }
        .left-side h2 { font-size:1.8rem; font-weight:400; margin-bottom:30px; }
        .left-side p { font-size:1rem; line-height:1.7; font-weight:300; opacity:0.95; }

        /* Right Side */
        .right-side {
            width:50%;
            background:#f5f5f5;
            display:flex;
            align-items:center;
            justify-content:center;
            padding:40px;
            position:relative;
            overflow:hidden;
        }
        .circle-decoration-1 { position:absolute; width:250px; height:250px; background:rgba(34,197,94,0.15); border-radius:50%; top:-100px; right:-100px; }
        .circle-decoration-2 { position:absolute; width:180px; height:180px; background:rgba(34,197,94,0.1); border-radius:50%; top:20px; right:20px; }

        .register-card { width:450px; max-width:100%; position:relative; z-index:2; }
        .register-card h3 { font-size:2rem; font-weight:600; color:#1f2937; margin-bottom:8px; text-align:center; }
        .register-card .subtitle { color:#6b7280; font-size:0.95rem; margin-bottom:35px; text-align:center; }

        .form-label { font-weight:500; color:#374151; margin-bottom:8px; font-size:0.9rem; }
        .form-control { padding:12px 16px; border:1px solid #d1d5db; border-radius:8px; font-size:0.95rem; transition:all 0.3s; }
        .form-control:focus { border-color:#22c55e; box-shadow:0 0 0 3px rgba(34,197,94,0.1); outline:none; }

        .input-group { position:relative; }
        .input-group .form-control { padding:12px 50px 12px 16px; }
        .input-group .btn { position:absolute; right:0; top:0; height:100%; border:1px solid #d1d5db; border-left:none; background:white; color:#6b7280; border-radius:0 8px 8px 0; padding:0 15px; transition:all 0.3s; z-index:10; }
        .input-group .btn:hover { background:#f9fafb; color:#374151; }
        .input-group .form-control:focus ~ .btn { border-color:#22c55e; }

        .btn-register { background:#22c55e; color:white; border:none; font-weight:600; border-radius:8px; padding:13px; font-size:1rem; transition:all 0.3s; width:100%; margin-top:10px; }
        .btn-register:hover { background:#16a34a; transform:translateY(-2px); box-shadow:0 4px 12px rgba(34,197,94,0.3); }

        .login-link { text-align:center; margin-top:25px; color:#6b7280; font-size:0.9rem; }
        .login-link a { color:#22c55e; text-decoration:none; font-weight:600; }
        .login-link a:hover { color:#16a34a; text-decoration:underline; }

        .text-danger { font-size:0.85rem; margin-top:5px; }
    </style>
</head>
<body>

<div class="container-split">

    <!-- Left Side -->
    <div class="left-side">
        <div class="left-content">
            <h1>WELCOME</h1>
            <div class="divider-line"></div>
            <h2>Sahabat Berbagi</h2>
            <p>Barang bekasmu punya cerita baru untuk orang yang membutuhkannya.</p>
        </div>
    </div>

    <!-- Right Side -->
    <div class="right-side">
        <div class="circle-decoration-1"></div>
        <div class="circle-decoration-2"></div>

        <div class="register-card">
            <h3>Register</h3>
            <p class="subtitle">Buat akun untuk menggunakan Berbagi</p>

            <form action="{{ route('register') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label class="form-label">Nama</label>
                    <input type="text" class="form-control" name="name" placeholder="Masukkan nama Anda" value="{{ old('name') }}" required>
                    @error('name') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <input type="email" class="form-control" name="email" placeholder="Masukkan email Anda" value="{{ old('email') }}" required>
                    @error('email') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Password</label>
                    <div class="input-group">
                        <input type="password" class="form-control" name="password" id="password" placeholder="Masukkan password" required>
                        <button type="button" class="btn btn-outline-secondary" id="togglePassword">
                            <i class="bi bi-eye" id="iconEye"></i>
                        </button>
                    </div>
                    @error('password') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Konfirmasi Password</label>
                    <div class="input-group">
                        <input type="password" class="form-control" name="password_confirmation" id="confirmPassword" placeholder="Konfirmasi password" required>
                        <button type="button" class="btn btn-outline-secondary" id="toggleConfirmPassword">
                            <i class="bi bi-eye" id="iconEyeConfirm"></i>
                        </button>
                    </div>
                    <small id="matchMessage" class="text-danger" style="display:none;">Password tidak sama</small>
                </div>
                <!-- Tombol Kirim OTP -->
                <div class="mb-3">
                    <button type="button" class="btn-register w-100 mb-2" id="sendOtpBtn">Kirim OTP ke Email</button>
                </div>
                <!-- Pesan OTP -->
                <div id="otpMessage" class="text-danger mb-2" style="display:none;"></div>

                <!-- Input OTP dan Timer -->
                <div class="mb-3" id="otpSection" style="display:none;">
                    <label class="form-label">OTP Verifikasi Email</label>
                    <input type="text" name="otp" class="form-control" placeholder="Masukkan OTP" maxlength="6">
                    <small class="text-muted">OTP akan kadaluarsa dalam <span id="otpTimer">120</span> detik</small>
                </div>
                <button type="submit" class="btn-register w-100" id="registerBtn" style="display:none;">Register</button>
            </form>
            <div class="login-link">
                Sudah punya akun? <a href="{{ route('login') }}">Masuk</a>
            </div>
        </div>
    </div>

</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    // Toggle Password
    const toggle = document.getElementById('togglePassword');
    const password = document.getElementById('password');
    const icon = document.getElementById('iconEye');
    toggle.addEventListener('click', () => {
        password.type = password.type === 'password' ? 'text' : 'password';
        icon.classList.toggle('bi-eye');
        icon.classList.toggle('bi-eye-slash');
    });

    const toggleConfirm = document.getElementById('toggleConfirmPassword');
    const confirmPassword = document.getElementById('confirmPassword');
    const iconConfirm = document.getElementById('iconEyeConfirm');
    toggleConfirm.addEventListener('click', () => {
        confirmPassword.type = confirmPassword.type === 'password' ? 'text' : 'password';
        iconConfirm.classList.toggle('bi-eye');
        iconConfirm.classList.toggle('bi-eye-slash');
    });

    // Validasi password sama
    const matchMessage = document.getElementById('matchMessage');
    const form = document.querySelector('form');
    form.addEventListener('submit', function(e) {
        if (password.value !== confirmPassword.value) {
            e.preventDefault();
            matchMessage.style.display = 'block';
        }
    });

    password.addEventListener('input', () => matchMessage.style.display = 'none');
    confirmPassword.addEventListener('input', () => matchMessage.style.display = 'none');

    // OTP
    const sendOtpBtn = document.getElementById('sendOtpBtn');
    const otpSection = document.getElementById('otpSection');
    const registerBtn = document.getElementById('registerBtn');
    const otpTimer = document.getElementById('otpTimer');
    const otpMessage = document.getElementById('otpMessage'); // div untuk pesan OTP

    let timerInterval = null;

    sendOtpBtn.addEventListener('click', () => {
        const email = document.querySelector('input[name="email"]').value.trim();
        if (!email) {
            otpMessage.innerText = 'Masukkan email terlebih dahulu';
            otpMessage.style.color = 'red';
            otpMessage.style.display = 'block';
            return;
        }

        if (timerInterval) clearInterval(timerInterval); // hentikan timer lama jika ada

        fetch("{{ route('send.otp') }}", {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrfToken
            },
            body: JSON.stringify({ email })
        })
        .then(res => res.json())
        .then(data => {
            if (data.success) {
                otpSection.style.display = 'block';
                registerBtn.style.display = 'block';
                sendOtpBtn.style.display = 'none';

                otpMessage.innerText = data.message;
                otpMessage.style.color = 'green';
                otpMessage.style.display = 'block';

                let timeLeft = 120;
                otpTimer.innerText = timeLeft;

                timerInterval = setInterval(() => {
                    timeLeft--;
                    otpTimer.innerText = timeLeft;

                    if (timeLeft <= 0) {
                        clearInterval(timerInterval);
                        otpMessage.innerText = 'OTP sudah kadaluarsa, silakan kirim ulang';
                        otpMessage.style.color = 'red';
                        otpSection.style.display = 'none';
                        registerBtn.style.display = 'none';
                        sendOtpBtn.style.display = 'block';
                    }
                }, 1000);
            } else {
                otpMessage.innerText = data.message || 'Gagal mengirim OTP';
                otpMessage.style.color = 'red';
                otpMessage.style.display = 'block';
            }
        })
        .catch(err => {
            otpMessage.innerText = 'Terjadi kesalahan saat mengirim OTP';
            otpMessage.style.color = 'red';
            otpMessage.style.display = 'block';
            console.error('Error fetch OTP:', err);
        });
    });
});
</script>
</body>
</html>
