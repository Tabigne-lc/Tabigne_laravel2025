<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #d1c1e1; /* Prelude */
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .login-container {
            background-color: #ffffff;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
            width: 350px;
            text-align: center;
        }

        h2 {
            color: #4b70b4; /* San Marino */
            margin-bottom: 30px;
        }

        input[type="text"],
        input[type="password"] {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .btn-login {
            background-color: #e5a4c2; /* Kobi */
            color: white;
            border: none;
            padding: 12px;
            width: 100%;
            border-radius: 5px;
            cursor: pointer;
            font-weight: bold;
        }

        .btn-login:hover {
            background-color: #b3a8e1; /* Cold Purple */
        }

        .footer-text {
            margin-top: 20px;
            color: #7b89d5; /* Chetwode Blue */
            font-size: 0.9rem;
        }
    </style>
</head>
<body>

    <div class="login-container">
        <h2>Login</h2>
        <form>
            <input type="text" placeholder="Username" required>
            <input type="password" placeholder="Password" required>
            <button type="submit" class="btn-login">Login</button>
        </form>
        <p class="footer-text">Don't have an account? <a href="#" style="color:#4b70b4;">Register here</a></p>
    </div>

</body>
</html>
