<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lupa Password - Berbagi</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <style>
        * { margin:0; padding:0; box-sizing:border-box; }
        body { font-family: 'Poppins', sans-serif; min-height:100vh; overflow-x:hidden; }

        .container-split { display:flex; min-height:100vh; }

        .left-side {
            width:50%;
            background:linear-gradient(135deg, #6a0dad 0%, #8a2be2 50%, #ba55d3 100%);
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
        
        .circle-decoration-1, .circle-decoration-2 { position: absolute; border-radius: 50%; }
        .circle-decoration-1 { width: 250px; height: 250px; background: rgba(138,43,226,0.15); top: -100px; right: -100px; }
        .circle-decoration-2 { width: 180px; height: 180px; background: rgba(138,43,226,0.1); top: 20px; right: 20px; }

        .card-auth { width:450px; max-width:100%; position:relative; z-index:2; }
        .card-auth h3 { font-size:2rem; font-weight:600; color:#1f2937; margin-bottom:8px; text-align:center; }
        .card-auth .subtitle { color:#6b7280; font-size:0.95rem; margin-bottom:35px; text-align:center; }

        .form-label { font-weight:500; color:#374151; margin-bottom:8px; font-size:0.9rem; }
        .form-control { padding:12px 16px; border:1px solid #d1d5db; border-radius:8px; font-size:0.95rem; transition:all 0.3s; }
        .form-control:focus { border-color:#22c55e; box-shadow:0 0 0 3px rgba(34,197,94,0.1); outline:none; }

        .input-group { position:relative; }
        .input-group .form-control { padding:12px 50px 12px 16px; }
        .input-group .btn { position:absolute; right:0; top:0; height:100%; border:1px solid #d1d5db; border-left:none; background:white; color:#6b7280; border-radius:0 8px 8px 0; padding:0 15px; transition:all 0.3s; z-index:10; }
        .input-group .btn:hover { background:#f9fafb; color:#374151; }
        .input-group .form-control:focus ~ .btn { border-color:#22c55e; }

        .btn-action { background:#6a0dad; color:white; border:none; font-weight:600; border-radius:8px; padding:13px; font-size:1rem; transition:all 0.3s; width:100%; margin-top:10px; }
        .btn-action:hover { background:#8a2be2; transform:translateY(-2px); box-shadow:0 4px 12px rgba(34,197,94,0.3); }

        .link-login { text-align:center; margin-top:25px; color:#6b7280; font-size:0.9rem; }
        .link-login a { color:#6a0dad; text-decoration:none; font-weight:600; }
        .link-login a:hover { color:#4b0082; text-decoration:underline; }

        .text-danger { font-size:0.85rem; margin-top:5px; }
    </style>
</head>
<body>
<div class="container-split">
    <div class="left-side">
        <div class="left-content">
            <h1>FORGOT</h1>
            <div class="divider-line"></div>
            <h2>Password</h2>
            <p>Masukkan email Anda untuk menerima kode OTP verifikasi.</p>
        </div>
    </div>

    <div class="right-side">
        <div class="circle-decoration-1"></div>
        <div class="circle-decoration-2"></div>

        <div class="card-auth">
            <h3>Lupa Password</h3>
            <p class="subtitle">Masukkan email untuk reset password</p>

            <form id="forgotForm" method="POST">
                @csrf
                <!-- Email -->
                <div class="mb-3" id="emailSection">
                    <label class="form-label">Email</label>
                    <input type="email" name="email" class="form-control" placeholder="Masukkan email Anda" required>
                    <div id="otpMessage" class="text-danger mt-1" style="display:none;"></div>
                </div>

                <!-- OTP -->
                <div class="mb-3" id="otpSection" style="display:none;">
                    <label class="form-label">Kode OTP</label>
                    <input type="text" name="otp" class="form-control" placeholder="Masukkan OTP" maxlength="6" required>
                    <small class="text-muted">OTP akan kadaluarsa dalam <span id="otpTimer">120</span> detik</small>
                </div>

                <!-- New Password -->
                <div id="passwordSection" style="display:none;">
                    <div class="mb-3">
                        <label class="form-label">Password Baru</label>
                        <div class="input-group">
                            <input type="password" name="password" id="password" class="form-control" placeholder="Masukkan password baru" required>
                            <button type="button" class="btn btn-outline-secondary" id="togglePassword">
                                <i class="bi bi-eye" id="iconEye"></i>
                            </button>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Konfirmasi Password</label>
                        <div class="input-group">
                            <input type="password" name="password_confirmation" id="confirmPassword" class="form-control" placeholder="Konfirmasi password" required>
                            <button type="button" class="btn btn-outline-secondary" id="toggleConfirmPassword">
                                <i class="bi bi-eye" id="iconEyeConfirm"></i>
                            </button>
                        </div>
                        <small id="matchMessage" class="text-danger" style="display:none;">Password tidak sama</small>
                    </div>
                </div>

                <button type="button" class="btn-action w-100" id="sendOtpBtn">Kirim OTP</button>
                <button type="submit" class="btn-action w-100" id="resetBtn" style="display:none;">Reset Password</button>
            </form>

            <div class="link-login">
                Kembali ke <a href="{{ route('login') }}">Login</a>
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

    const matchMessage = document.getElementById('matchMessage');
    const form = document.getElementById('forgotForm');

    // Kirim OTP
    const sendOtpBtn = document.getElementById('sendOtpBtn');
    const otpSection = document.getElementById('otpSection');
    const passwordSection = document.getElementById('passwordSection');
    const resetBtn = document.getElementById('resetBtn');
    const otpTimer = document.getElementById('otpTimer');
    const otpMessage = document.getElementById('otpMessage');

    let timerInterval = null;

    sendOtpBtn.addEventListener('click', () => {
        const email = form.querySelector('input[name="email"]').value.trim();
        if (!email) {
            otpMessage.innerText = 'Masukkan email terlebih dahulu';
            otpMessage.style.display = 'block';
            return;
        }

        if (timerInterval) clearInterval(timerInterval);

        fetch("{{ route('forgot.send.otp') }}", { // gunakan nama route yang benar
            method:'POST',
            headers: {
                'Content-Type':'application/json',
                'X-CSRF-TOKEN': csrfToken
            },
            body: JSON.stringify({ email })
        })
        .then(res => res.json())
        .then(data => {
            if (data.success) {
                otpSection.style.display = 'block';
                resetBtn.style.display = 'block';
                sendOtpBtn.style.display = 'none';

                otpMessage.innerText = data.message;
                otpMessage.style.color = 'green';
                otpMessage.style.display = 'block';

                let timeLeft = 120;
                otpTimer.innerText = timeLeft;

                timerInterval = setInterval(() => {
                    timeLeft--;
                    otpTimer.innerText = timeLeft;
                    if (timeLeft <=0) {
                        clearInterval(timerInterval);
                        otpMessage.innerText = 'OTP sudah kadaluarsa';
                        otpMessage.style.color = 'red';
                        otpSection.style.display = 'none';
                        resetBtn.style.display = 'none';
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
            console.error(err);
        });
    });
    
    // Event OTP input change / blur
    const otpInput = form.querySelector('input[name="otp"]');
    otpInput.addEventListener('blur', () => {
        const email = form.querySelector('input[name="email"]').value;
        const otp = otpInput.value;

        if(otp.length === 6){
            fetch("{{ route('forgot.verify.otp') }}", {
                method: 'POST',
                headers: {
                    'Content-Type':'application/json',
                    'X-CSRF-TOKEN': csrfToken
                },
                body: JSON.stringify({ email, otp })
            })
            .then(res => res.json())
            .then(data => {
                if(data.success){
                    // Tampilkan password section
                    passwordSection.style.display = 'block';
                } else {
                    otpMessage.innerText = data.message;
                    otpMessage.style.color = 'red';
                    otpMessage.style.display = 'block';
                    passwordSection.style.display = 'none';
                }
            })
            .catch(err => {
                console.error(err);
                otpMessage.innerText = 'Terjadi kesalahan';
                otpMessage.style.color = 'red';
                otpMessage.style.display = 'block';
            });
        }
    });

    // Submit form reset password
    form.addEventListener('submit', function(e){
        if (passwordSection.style.display === 'block' && password.value !== confirmPassword.value) {
            e.preventDefault();
            matchMessage.style.display = 'block';
            return;
        }

        e.preventDefault();

        const formData = {
            email: form.querySelector('input[name="email"]').value,
            otp: form.querySelector('input[name="otp"]').value,
            password: password.value,
            password_confirmation: confirmPassword.value
        };

        fetch("{{ route('forgot.reset.password') }}", { // ini sudah benar sesuai web.php
            method:'POST',
            headers:{
                'Content-Type':'application/json',
                'X-CSRF-TOKEN': csrfToken
            },
            body: JSON.stringify(formData)
        })
        .then(res=>res.json())
        .then(data=>{
            if(data.success){
                alert('Password berhasil diubah! Silakan login ulang.');
                window.location.href = "{{ route('login') }}";
            }else{
                otpMessage.innerText = data.message || 'Terjadi kesalahan';
                otpMessage.style.color = 'red';
                otpMessage.style.display = 'block';
            }
        })
        .catch(err=>{
            otpMessage.innerText = 'Terjadi kesalahan';
            otpMessage.style.color = 'red';
            otpMessage.style.display = 'block';
            console.error(err);
        });
    });

});
</script>
</body>
</html>