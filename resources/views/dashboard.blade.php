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
    background: linear-gradient(135deg, #e5a4c2 0%, #d1c1e1 100%);
    margin: 0;
    padding: 0;
    color: #4b70b4;
}

.nav-bar {
    background: linear-gradient(90deg, #7b89d5 0%, #4b70b4 100%);
    padding: 18px 0;
    text-align: center;
    box-shadow: 0 4px 12px rgba(75, 112, 180, 0.5);
    border-radius: 0 0 15px 15px;
}

.nav-bar a {
    color: white;
    margin: 0 24px;
    text-decoration: none;
    font-weight: 700;
    font-size: 1.2rem;
    padding: 6px 12px;
    border-radius: 8px;
    transition: background-color 0.3s ease, color 0.3s ease;
    position: relative;
}

.nav-bar a:hover {
    background-color: #b3a8e1;
    color: #4b70b4;
    box-shadow: 0 4px 12px rgba(179, 168, 225, 0.7);
    transform: translateY(-3px);
}

.dashboard-container {
    margin: 60px auto;
    width: 90%;
    max-width: 1200px;
    padding: 0 15px;
}

.dashboard-title {
    text-align: center;
    color: #4b70b4;
    font-size: 2.8rem;
    font-weight: 700;
    margin-bottom: 40px;
    text-shadow: 1px 1px 3px rgba(75, 112, 180, 0.3);
}

.card-box {
    background: linear-gradient(145deg, #b3a8e1, #7b89d5);
    border-radius: 20px;
    padding: 30px 25px;
    color: white;
    box-shadow: 0 8px 20px rgba(75, 112, 180, 0.3);
    transition: transform 0.25s ease, box-shadow 0.25s ease;
}

.card-box:hover {
    transform: translateY(-8px);
    box-shadow: 0 12px 30px rgba(75, 112, 180, 0.5);
}

.card-box h4 {
    font-weight: 800;
    font-size: 1.6rem;
    margin-bottom: 10px;
    text-shadow: 1px 1px 2px rgba(75, 112, 180, 0.4);
}

.footer {
    margin-top: 60px;
    text-align: center;
    font-size: 1rem;
    color: #7b89d5;
    font-weight: 600;
    padding-bottom: 30px;
}

       /* Added margin below navigation bar */
        .container {

            margin-top: 40px;
        }
    </style>
</head>
<body>

@include('nav')

<div class="container">

        <h2>Welcome to your Dashboard,  {{ session('user')->first_name }}!</h2>
    </div>

      

   

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
