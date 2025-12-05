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

    <!-- FONT AWESOME -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <style>
        /* ======================================
            THEME COLOR
        ====================================== */
        :root {
            --purple-dark: #3b1e54;
            --purple-medium: #5f2f8e;
            --purple-soft: #9d4edd;
            --purple-bg: #f5e8ff;
        }

        body {
            background: var(--purple-bg) !important;
            font-family: 'Poppins', sans-serif;
        }

        /* ======================================
            NAVBAR
        ====================================== */
        .navbar {
            background: linear-gradient(135deg, #6a0dad 0%, #8a2be2 50%, #ba55d3 100%) !important;
            box-shadow: 0 3px 10px rgba(0,0,0,0.2);
        }

        .navbar-brand {
            font-weight: 600;
            letter-spacing: .5px;
        }

        .logout-btn {
            background: var(--purple-soft);
            border: none;
            padding: 6px 14px;
            border-radius: 6px;
            color: #fff;
            font-weight: 500;
            transition: .3s;
        }
        .logout-btn:hover {
            background: #7a38c9;
            transform: scale(1.05);
        }

        /* ======================================
            SIDEBAR
        ====================================== */
        .sidebar {
            background: white;
            min-height: 100vh;
            border-right: 3px solid var(--purple-soft);
            padding-top: 25px;
            box-shadow: 5px 0 12px rgba(0,0,0,0.05);
        }

        .sidebar h5 {
            font-weight: 600;
            color: var(--purple-medium);
        }

        .sidebar a {
            padding: 12px 14px;
            display: block;
            border-radius: 6px;
            margin-bottom: 6px;
            color: #4a4a4a;
            font-weight: 500;
            transition: .25s;
        }

        .sidebar a:hover {
            background: var(--purple-soft);
            color: white !important;
            transform: translateX(4px);
        }

        /* ======================================
            CONTENT
        ====================================== */
        .content-wrapper h3 {
            font-weight: 600;
            color: var(--purple-dark);
        }

        .content-wrapper {
            background: transparent;
        }

        /* CARD STYLE EXAMPLE */
        .card-purple {
            background: white;
            border-left: 5px solid var(--purple-soft);
            border-radius: 12px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.05);
            padding: 20px;
            transition: .3s;
        }

        .card-purple:hover {
            transform: scale(1.02);
        }

    </style>
</head>

<body>

    <!-- NAVBAR -->
    <nav class="navbar navbar-dark p-3">
        <a class="navbar-brand text-white" href="#">
            <i class="fas fa-hand-holding-heart"></i> Berbagi
        </a>  
    </nav>

    <div class="container-fluid">
        <div class="row">

            {{-- Jika halaman BUKAN profil, tampilkan sidebar --}}
        @if (!request()->routeIs('user.profil.*'))
            <div class="col-3 sidebar">
                <hr>
                @yield('sidebar')
            </div>

            <div class="col-9 p-4 content-wrapper">
                <h3 class="mb-3">{{ $title ?? 'Dashboard' }}</h3>
                @yield('content')
            </div>

        @else
            <div class="col-12 p-4 content-wrapper">
                @yield('content')
            </div>
        @endif
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script 
        src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js">
    </script>
</body>
</html>