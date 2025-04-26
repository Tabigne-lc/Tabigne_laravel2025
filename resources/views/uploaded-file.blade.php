<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Uploaded Files</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { font-family: Arial, sans-serif; background: #d1c1e1; }
        .nav-bar { background: #7b89d5; padding: 10px; text-align: center; }
        .nav-bar a { color: white; margin: 0 15px; text-decoration: none; font-weight: bold; }
        .container {
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin: 40px auto;
            width: 70%;
        }
        .table th { background: #b3a8e1; color: white; }
        .btn-danger { background: #e5a4c2; border-color: #e5a4c2; color: white; }
        .btn-danger:hover { background: #d88aad; border-color: #d88aad; }
        .btn-info { background: #4b70b4; border-color: #4b70b4; color: white; }
        .btn-info:hover { background: #3d5a96; border-color: #3d5a96; }
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
    
    <div class="container">
        <h1 class="text-center" style="color: #4b70b4;">Uploaded Files</h1>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>File Name</th>
                    <th>Uploaded On</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>file1.jpg</td>
                    <td>2023-03-10</td>
                    <td>
                        <button class="btn btn-danger btn-sm">Delete</button>
                        <button class="btn btn-info btn-sm">Download</button>
                    </td>
                </tr>
                <!-- Repeat for more files -->
            </tbody>
        </table>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>