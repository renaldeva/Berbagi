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

        /* LEFT SECTION - Gradient Purple */
        .left-side {
            width:50%;
            background:linear-gradient(160deg, #6a0dad 0%, #8a2be2 40%, #a855f7 100%);
            padding:80px 60px;
            color:white;
            display:flex;
            flex-direction:column;
            justify-content:center;
            position:relative;
            overflow:hidden;
        }
        .left-side::before, .left-side::after {
            content:''; position:absolute; border-radius:50%;
        }
        .left-side::before {
            width:420px; height:420px;
            background:rgba(255,255,255,0.08);
            top:-200px; right:-200px;
            filter:blur(3px);
        }
        .left-side::after {
            width:300px; height:300px;
            background:rgba(255,255,255,0.06);
            bottom:-150px; left:-150px;
        }
        .left-content { position:relative; z-index:2; max-width:500px; }
        .left-side h1 { font-size:3.4rem; font-weight:700; }
        .divider-line {
            width:130px; height:4px; background:white;
            margin:15px 0 25px 0; border-radius:8px;
        }
        .left-side h2 { font-size:1.8rem; font-weight:400; margin-bottom:25px; }

        /* RIGHT SECTION */
        .right-side {
            width:50%;
            background:#faf6ff;
            display:flex; justify-content:center; align-items:center;
            padding:40px;
            position:relative;
            overflow:hidden;
        }
        .circle-decoration-1 {
            position:absolute; width:250px; height:250px;
            background:rgba(168,85,247,0.15);
            border-radius:50%; top:-100px; right:-100px;
        }
        .circle-decoration-2 {
            position:absolute; width:180px; height:180px;
            background:rgba(168,85,247,0.1);
            border-radius:50%; top:30px; right:20px;
        }

        /* CARD */
        .register-card {
            width:450px; max-width:100%; padding:10px;
            position:relative; z-index:2;
        }
        .register-card h3 {
            font-size:2.2rem; font-weight:700;
            color:#4b0082; text-align:center;
        }
        .subtitle {
            text-align:center; font-size:0.95rem;
            color:#6b6b7d; margin-bottom:30px;
        }

        /* INPUT & LABEL */
        .form-label { font-weight:500; color:#4b0082; }
        .form-control {
            padding:12px 16px; border-radius:10px;
            border:1.5px solid #d1c4e9;
            font-size:0.95rem;
            transition:all 0.3s ease;
        }
        .form-control:focus {
            border-color:#a855f7;
            box-shadow:0 0 0 3px rgba(168,85,247,0.18);
        }

        /* INPUT GROUP - Password */
        .input-group .btn {
            border:1px solid #d1c4e9; border-left:none;
            background:white; padding:0 15px; border-radius:0 10px 10px 0;
        }

        /* BUTTON */
        .btn-register {
            background:#a855f7;
            color:white; font-weight:600;
            border:none; border-radius:10px;
            padding:13px; font-size:1rem;
            transition:0.3s;
        }
        .btn-register:hover {
            background:#9333ea; transform:translateY(-2px);
            box-shadow:0 4px 14px rgba(168,85,247,0.35);
        }

        /* LINK */
        .login-link {
            text-align: center;
            margin-top: 20px;
        }

        .login-link a {
            color: #6a0dad;          /* ungu utama */
            text-decoration: none;   /* tidak underline */
            font-weight: 600;
            transition: 0.3s;
        }

        .login-link a:hover {
            text-decoration: underline;  /* underline saat hover */
            color: #4b0082;              /* ungu lebih gelap saat hover */
        }

        .text-danger { font-size:0.85rem; }
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