<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #d1c1e1;
            /* Prelude */
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
        }

        h2 {
            color: #4b70b4;
            /* San Marino */
            margin-bottom: 30px;
            text-align: center;
        }

        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
            color: #4b70b4;
        }

        input[type="text"],
        input[type="password"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .btn-login {
            background-color: #e5a4c2;
            /* Kobi */
            color: white;
            border: none;
            padding: 12px;
            width: 100%;
            border-radius: 5px;
            cursor: pointer;
            font-weight: bold;
        }

        .btn-login:hover {
            background-color: #b3a8e1;
            /* Cold Purple */
        }

        .btn-outline-secondary {
            margin-top: 10px;
            width: 100%;
            color: #4b70b4;
            border-color: #4b70b4;
            border-radius: 5px;
            padding: 10px;
            font-weight: bold;
            text-align: center;
            display: inline-block;
            text-decoration: none;
        }

        .btn-outline-secondary:hover {
            background-color: #9e91c9;
            color: white;
            border-color: #9e91c9;
        }

        .input-group {
            position: relative;
        }

        .input-group-text {
            position: absolute;
            right: 10px;
            top: 10px;
            cursor: pointer;
        }

        .invalid-feedback {
            color: red;
            font-size: 0.875rem;
        }
    </style>
</head>

<body>
    @if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif

    <div class="login-container">
        <form method="POST" action="{{ route('login') }}">
            @csrf
            <h2>Login</h2>

            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" id="username" name="username"
                    class="form-control @error('username') is-invalid @enderror"
                    placeholder="Enter your username" value="{{ old('username') }}">
                @error('username')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <div class="input-group">
                    <input type="password" id="password" name="password"
                        class="form-control @error('password') is-invalid @enderror"
                        placeholder="Enter your password" required>
                    <span class="input-group-text" onclick="togglePassword()">
                        <i id="togglePasswordIcon" class="bi bi-eye-slash"></i>
                    </span>
                </div>
                @error('password')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn-login">Login</button>
            <a href="{{ route('register') }}" class="btn btn-outline-secondary">Register</a>

            <!-- Add this line to provide the "Forgot Password?" link -->
            <p class="text-center mt-3">
                <a href="{{ route('password.request') }}">Forgot Password?</a>
                <a href="{{ route('verify.email.form') }}" class="mx-3">Verify Your Email</a>
            </p>
            
            @if($errors->any())
            <div class="mt-3">
                @if ($errors->has('email'))
                    <div class="alert alert-warning text-center">
                        {{ $errors->first('email') }}
                    </div>
                @else
                    <div class="alert alert-warning text-danger text-center">{{ $errors->first() }}</div>
                @endif
            </div>
        @endif
    </div>
        </form>
    </div>

    <script>
        function togglePassword() {
            const input = document.getElementById("password");
            const icon = document.getElementById("togglePasswordIcon");

            // if (input.type === "password") {
            //     input.type = "text";
            //     icon.classList.remove("bi-eye-slash");
            //     icon.classList.add("bi-eye");
            // } else {
            //     input.type = "password";
            //     icon.classList.remove("bi-eye");
            //     icon.classList.add("bi-eye-slash");
            // }
            

        }
    </script>
</body>

</html>