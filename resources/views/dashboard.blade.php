<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #d2c3e0;
        }

        .nav-bar {
            background: #5c5470;
            padding: 15px;
            text-align: center;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }

        .nav-bar a {
            color: white;
            margin: 0 20px;
            text-decoration: none;
            font-weight: bold;
            font-size: 1.1rem;
        }

        .dashboard-container {
            margin: 50px auto;
            width: 90%;
            max-width: 1200px;
        }

        .dashboard-title {
            text-align: center;
            color: #4a3b69;
            font-size: 2.5rem;
            margin-bottom: 30px;
        }

        .card-box {
            background: #b5a1d4;
            border-radius: 15px;
            padding: 25px;
            color: white;
            transition: transform 0.2s;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        }

        .card-box:hover {
            transform: translateY(-5px);
        }

        .card-box h4 {
            font-weight: bold;
        }

        .footer {
            margin-top: 50px;
            text-align: center;
            font-size: 0.9rem;
            color: #5c5470;
        }
    </style>
</head>
<body>

    <div class="nav-bar">
        <a href="{{ route('dashboard') }}">Dashboard</a>
        <a href="{{ route('edit-password') }}">Edit Password</a>
        <a href="{{ route('edit-profile') }}">Edit Profile</a>
        <a href="{{ route('register') }}">Register</a>
        <a href="{{ route('uploaded-files') }}">Uploaded Files</a>
        <a href="{{route('users')}}">Users</a>
    </div>

    <div class="dashboard-container">
        <h2 class="dashboard-title">Welcome to Your Dashboard!</h2>

      

   

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
