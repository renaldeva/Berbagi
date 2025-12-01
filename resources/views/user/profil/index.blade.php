<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil</title>

    <style>
        body {
            margin: 0;
            font-family: "Poppins", sans-serif;
            background: #F4F1FF;
            color: #1A1A1A;
        }

        /* Header */
        .header {
            background: #6A4DFF;
            padding: 50px 20px 90px;
            text-align: center;
            color: white;
            border-bottom-left-radius: 35px;
            border-bottom-right-radius: 35px;
        }

        /* Avatar bulat */
        .avatar {
            width: 110px;
            height: 110px;
            border-radius: 50%;
            background: white;
            overflow: hidden;
            margin: 0 auto 15px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.2);
        }

        .avatar img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .header h2 {
            margin: 0;
            font-size: 26px;
            font-weight: 700;
        }

        .header p {
            margin: 5px 0 0;
            opacity: 0.9;
            font-size: 14px;
        }

        /* Container */
        .container {
            max-width: 600px;
            margin: -40px auto 40px;
            padding: 0 20px;
        }

        /* Card menu */
        .card {
            background: white;
            padding: 20px;
            border-radius: 18px;
            box-shadow: 0 4px 16px rgba(0,0,0,0.06);
        }

        .list-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 15px 0;
            border-bottom: 1px solid #eee;
            cursor: pointer;
        }

        .list-item:last-child {
            border-bottom: none;
        }

        .list-left {
            display: flex;
            align-items: center;
            gap: 12px;
            font-size: 15px;
        }

        .icon {
            width: 26px;
            height: 26px;
            background: #EEE9FF;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #6A4DFF;
            font-size: 14px;
        }

        .arrow {
            color: #6A4DFF;
            font-size: 18px;
            font-weight: bold;
        }

        .logout {
            margin-top: 25px;
            text-align: center;
            font-weight: 600;
            color: #E74C3C;
            cursor: pointer;
        }
    </style>
</head>

<body>

    <!-- Header Profil -->
    <div class="header">

        <div class="avatar">
            <img src="https://ui-avatars.com/api/?name={{ urlencode($user->name) }}&background=6A4DFF&color=fff&size=200">
        </div>

        <h2>{{ $user->name }}</h2>
        <p>{{ $user->email }}</p>
    </div>

    <div class="container">

        <div class="card">

            <a href="{{ route('profil.edit') }}" style="text-decoration:none; color:inherit;">
                <div class="list-item">
                    <div class="list-left">
                        <div class="icon">✎</div>
                        Edit Profil
                    </div>
                    <div class="arrow">›</div>
                </div>
            </a>

            <a href="{{ route('profil.password') }}" style="text-decoration:none; color:inherit;">
                <div class="list-item">
                    <div class="list-left">
                        <div class="icon">🔒</div>
                        Reset Password
                    </div>
                    <div class="arrow">›</div>
                </div>
            </a>

        </div>

        <div class="logout" onclick="document.getElementById('logout-form').submit();">
            Logout
        </div>

        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display:none;">
            @csrf
        </form>

    </div>

</body>
</html>
