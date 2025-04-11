<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { font-family: Arial, sans-serif; background: #d2c3e0; }
        .nav-bar { background: #5c5470; padding: 10px; text-align: center; }
        .nav-bar a { color: white; margin: 0 15px; text-decoration: none; font-weight: bold; }
        .dashboard-container {
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin: 40px auto;
            width: 80%;
            text-align: center;
        }
        .dashboard-title { color: #4a3b69; font-size: 2rem; }
        .info-card {
            background: #b5a1d4;
            padding: 20px;
            border-radius: 10px;
            color: white;
            font-weight: bold;
            text-align: center;
            margin: 10px;
        }
        .info-card p { font-weight: normal; }
    </style>
</head>
<body>
    <div class="nav-bar">
        <a href="dashboard.html">Dashboard</a>
        <a href="edit_profile.html">Edit Profile</a>
        <a href="register.html">Register</a>
        <a href="uploaded_files.html">Uploaded Files</a>
        <a href="users.html">Users</a>
    </div>
    
    <div class="dashboard-container">
        <h2 class="dashboard-title">Dashboard</h2>
        <div class="d-flex justify-content-center">
            <div class="info-card col-md-3">
                <h5>Recent Uploads</h5>
                <p>3 new files uploaded.</p>
            </div>
            <div class="info-card col-md-3">
                <h5>Profile Views</h5>
                <p>50 views this week.</p>
            </div>
            <div class="info-card col-md-3">
                <h5>Messages</h5>
                <p>5 unread messages.</p>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Harum distinctio a dolorem culpa repellendus nemo fugiat illo, ducimus quaerat doloremque rerum explicabo expedita quod recusandae tempora earum fuga obcaecati? Odio.</p>
            </div>
        </div>
    </div>
    
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>