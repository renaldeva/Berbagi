<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            height: 100vh;
            margin: 0;
            background: linear-gradient(135deg, #6A0DAD, #9A4DFF);
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Poppins', sans-serif;
        }

        .card-register {
            width: 28rem;
            border-radius: 18px;
            background: #ffffffee;
            backdrop-filter: blur(10px);
            box-shadow: 0 10px 25px rgba(0,0,0,0.3);
        }

        .title {
            color: #6A0DAD;
            font-weight: 700;
        }

        .btn-purple-soft {
            background: #fff;
            color: #6A0DAD;
            border: 2px solid #6A0DAD;
            font-weight: 600;
            transition: 0.3s ease;
        }

        .btn-purple-soft:hover {
            background: #6A0DAD;
            color: #fff;
        }

        label {
            font-weight: 600;
            color: #5a0080;
        }
    </style>
</head>
<body>

    <div class="card card-register p-4">
        <h3 class="text-center title mb-4">Register</h3>

        <form action="/register" method="POST">
            @csrf

            <div class="mb-3">
                <label>Nama</label>
                <input type="text" name="name" required class="form-control">
            </div>

            <div class="mb-3">
                <label>Email</label>
                <input type="email" name="email" required class="form-control">
            </div>

            <div class="mb-3">
                <label>Password</label>
                <input type="password" name="password" required class="form-control">
            </div>

            <button class="btn btn-purple-soft w-100">Register</button>
        </form>
    </div>

</body>
</html>
