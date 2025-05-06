<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <style>
        .nav-bar {
            background: #7b89d5; /* Chetwode Blue */
            padding: 10px 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .nav-links {
            display: flex;
            gap: 15px;
        }

        .nav-bar a {
            color: white;
            text-decoration: none;
            font-weight: bold;
        }

        .logout-btn {
            background-color: #4f4763;
            color: #f3e9ff;
            border: none;
            padding: 5px 10px;
            cursor: pointer;
            border-radius: 4px;
            font-weight: bold;
        }
    </style>
</head>

<body>

    <div class="nav-bar">
        <!-- Left Side Links -->
        <div class="nav-links">
            <a href="{{ route('dashboard') }}">Dashboard</a>
            <a href="{{ route('password.edit') }}">Edit Password</a>
            <a href="{{ route('profile.edit') }}">Edit Profile</a>
            <a href="{{ route('upload.index') }}">Uploaded Files</a>

            @php
            $user = \App\Models\Usersinfo::find(session('user'));
            @endphp

            @if($user && $user->user_type === 'Admin')
            <a href="{{ route('user.list') }}">Users</a>
            @endif
        </div>

        <!-- Right Side Logout Button -->
        <form action="{{ route('logout') }}" method="GET">
            @csrf
            <button type="submit" class="logout-btn">Logout</button>
        </form>
    </div>

</body>
</html>
