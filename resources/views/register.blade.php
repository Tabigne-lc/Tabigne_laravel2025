<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { font-family: Arial, sans-serif; background: #d1c1e1; }
        .nav-bar { background: #7b89d5; padding: 10px; text-align: center; }
        .nav-bar a { color: white; margin: 0 15px; text-decoration: none; font-weight: bold; }
        .register-container {
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin: 40px auto;
            width: 50%;
        }
        .register-title { color: #4b70b4; font-size: 2rem; text-align: center; }
        .btn-primary { background: #b3a8e1; border-color: #b3a8e1; color: white; }
        .btn-primary:hover { background: #9e91c9; border-color: #9e91c9; }
        .btn-success { background: #e5a4c2; border-color: #e5a4c2; color: white; }
        .btn-success:hover { background: #d88aad; border-color: #d88aad; }
    </style>
</head>
<body>
    <div class="nav-bar">
        <a href="dashboard.blade.php">Dashboard</a>
        <a href="{{ route('dashboard') }}">Dashboard</a>
        <a href="{{ route('edit-password') }}">Edit Password</a>
        <a href="{{ route('edit-profile') }}">Edit Profile</a>
        <a href="{{ route('register') }}">Register</a>
        <a href="{{ route('uploaded-files') }}">Uploaded Files</a>
        <a href="{{ route('users') }}">Users</a>
    </div>
    
    <div class="register-container">
        <h2 class="register-title">Register</h2>
        <form>
            <div class="form-group">
                <label for="first_name">First Name</label>
                <input type="text" class="form-control" id="first_name" placeholder="Enter your first name" required>
            </div>

            <div class="form-group">
                <label for="last_name">Last Name</label>
                <input type="text" class="form-control" id="last_name" placeholder="Enter your last name" required>
            </div>

            <div class="form-group">
                <label for="sex">Sex</label>
                <select class="form-control" id="sex" required>
                    <option value="">Select your sex</option>
                    <option value="Male">Male</option>
                    <option value="Female">Female</option>
                </select>
            </div>

            <div class="form-group">
                <label for="birthday">Birthday</label>
                <input type="date" class="form-control" id="birthday" required>
            </div>

            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" class="form-control" id="username" placeholder="Choose a username" required>
            </div>

            <div class="form-group">
                <label for="email">Email Address</label>
                <input type="email" class="form-control" id="email" placeholder="Enter your email" required>
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" class="form-control" id="password" placeholder="Enter password" required>
            </div>

            <div class="form-group form-check">
                <input type="checkbox" class="form-check-input" id="terms" required>
                <label class="form-check-label" for="terms">Do you agree with our Privacy Policy and Terms and Conditions?</label>
            </div>

            <button type="submit" class="btn btn-success btn-block">Register</button>
        </form>
    </div>
    
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
