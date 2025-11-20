<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link 
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" 
        rel="stylesheet">
</head>
<body class="bg-light">

<div class="container d-flex justify-content-center align-items-center" style="height: 100vh;">
    <div class="card shadow" style="width: 28rem;">
        <div class="card-body">

            <h4 class="text-center mb-4">Register</h4>

            <form action="/register" method="POST">
                @csrf

                <div class="mb-3">
                    <label class="form-label">Nama</label>
                    <input type="text" name="name" required class="form-control">
                </div>

                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <input type="email" name="email" required class="form-control">
                </div>

                <div class="mb-3">
                    <label class="form-label">Password</label>
                    <input type="password" name="password" required class="form-control">
                </div>

                <div class="mb-3">
                    <label class="form-label">Role</label>
                    <select class="form-control" name="role">
                        <option value="admin">Admin</option>
                        <option value="donator">Donator</option>
                        <option value="penerima">Penerima</option>
                    </select>
                </div>

                <button class="btn btn-success w-100">Register</button>

            </form>
        </div>
    </div>
</div>

</body>
</html>
