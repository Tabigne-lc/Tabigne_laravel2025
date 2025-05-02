
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Registration Success</title>
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
        #password-strength {
            font-size: 0.9rem;
        }
        .strength-weak { color: #dc3545; }
        .strength-medium { color: #ffc107; }
        .strength-strong { color: #28a745; }
    </style>
</head>
<body>
    <div class="container mt-5">
        <h2>Registration Successful</h2>
        <ul class="list-group">
            <li class="list-group-item"><strong>First Name:</strong> {{ $data['firstname'] ?? '' }}</li>
            <li class="list-group-item"><strong>Middle Name:</strong> {{ $data['middlename'] ?? '' }}</li>
            <li class="list-group-item"><strong>Last Name:</strong> {{ $data['lastname'] ?? '' }}</li>
            <li class="list-group-item"><strong>Birthday:</strong> {{ $data['bod'] ?? '' }}</li>
            <li class="list-group-item"><strong>Sex:</strong> {{ $data['sex'] ?? '' }}</li>
            <li class="list-group-item"><strong>Email:</strong> {{ $data['email'] ?? '' }}</li>
            <li class="list-group-item"><strong>Username:</strong> {{ $data['username'] ?? '' }}</li>
            <li class="list-group-item"><strong>Accepted Terms:</strong> {{ isset($data['terms']) ? 'Yes' : 'No' }}</li>
        </ul>
        <a href="login" class="btn btn-primary"> Go back</a>
    </div>
</body>
</html>
