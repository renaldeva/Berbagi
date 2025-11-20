<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Dashboard' }}</title>

    <!-- Bootstrap -->
    <link 
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" 
        rel="stylesheet"
    >
</head>

<body class="bg-light">

    <nav class="navbar navbar-dark bg-dark p-3">
        <a class="navbar-brand text-white" href="#">
            Aplikasi Berbagi
        </a>

        {{-- <div class="d-flex">
            <a href="/logout" class="btn btn-danger btn-sm">Logout</a>
        </div> --}}
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit">Logout</button>
        </form>   
    </nav>

    <div class="container-fluid">
        <div class="row">

            <!-- SIDEBAR -->
            <div class="col-3 bg-white shadow-sm" style="min-height: 100vh;">
                <h5 class="mt-4">{{ auth()->user()->role }}</h5>
                <hr>

                @yield('sidebar')
            </div>

            <!-- CONTENT -->
            <div class="col-9 p-4">
                <h3 class="mb-3">{{ $title ?? 'Dashboard' }}</h3>

                @yield('content')
            </div>

        </div>
    </div>

    <!-- Bootstrap JS -->
    <script 
        src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js">
    </script>
</body>
</html>
