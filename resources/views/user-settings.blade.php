<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Users</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background-color: #F2EFE7;
        }

        .navbar {
            background-color: #4b70b4;
        }

        .navbar-brand,
        .nav-link {
            color: white !important;
        }

        .nav-link:hover {
            background-color: #9e91c9;
            color: white;
        }

        .logout-btn {
            background-color: #4b70b4;
            border-color: #4b70b4;
            color: white !important;
        }

        .logout-btn:hover {
            background-color: #9e91c9;
            border-color: #9e91c9;
            color: white !important;
        }

        .container {
            margin-top: 20px;
        }

        h2 {
            color: #4b70b4;
            font-size: 2rem;
            text-align: center;
        }

        .table {
            border-radius: 8px;
            background-color: #ffffff;
        }

        .table thead {
            background-color: #b3a8e1;
            color: white;
        }

        .table tbody {
            background-color: #ffffff;
        }

        .table th, .table td {
            text-align: center;
            padding: 1rem;
        }

        .btn {
            border-radius: 8px;
        }

        .btn-danger {
            background-color: #d88aad;
            border-color: #d88aad;
            color: white;
        }

        .btn-danger:hover {
            background-color: #e5a4c2;
            border-color: #e5a4c2;
            color: white;
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
        <!-- <a href="{{route('users')}}">Users</a> -->
         <!-- Only show the "Users" link to admins -->
    @if(session('user') && session('user')->user_type === 'Admin')
        <a href="{{ route('user.list') }}">Users</a>
        
    </div>
    @include('nav')
    
    <div class="container mt-4">
        <h2>User Management</h2>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <!-- Example user row (replace with dynamic data) -->
                <tr>
                    <td>1</td>
                    <td>John Doe</td>
                    <td>john@example.com</td>
                    <td>Admin</td>
                    <td>
                        <form action="{{ route('user.destroy', 1) }}" method="POST" class="d-inline"
                            onsubmit="return confirm('Are you sure you want to delete this user?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-md">
                                <i class="bi bi-trash"></i> Delete
                            </button>
                        </form>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</body>
</html>
