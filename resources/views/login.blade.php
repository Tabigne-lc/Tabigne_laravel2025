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

    {{-- Show success message if exists --}}
    @if (session('success'))
    <!-- Display a Bootstrap success alert if a success message exists in the session -->
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif

    <!-- Container for the login form -->
    <div class="login-container">
        {{-- Login form --}}
        <form method="POST" action="{{ route('login') }}">
            <!-- Include CSRF token to protect against cross-site request forgery -->
            @csrf 
            
            <!-- Form heading -->
            <h2>Login</h2>

            {{-- Username input --}}
            <div class="form-group">
                <label for="username">Username</label>
                <!-- Username input with Laravel validation styling -->
                <input type="text" id="username" name="username"
                    class="form-control @error('username') is-invalid @enderror"
                    placeholder="Enter your username" value="{{ old('username') }}">

                {{-- Validation error for username --}}
                @error('username')
                <!-- Show validation error if username is invalid -->
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            {{-- Password input with toggle eye icon --}}
            <div class="form-group">
                <label for="password">Password</label>
                <div class="input-group">
                    <!-- Password input with Bootstrap classes and Laravel error handling -->
                    <input type="password" id="password" name="password"
                        class="form-control @error('password') is-invalid @enderror"
                        placeholder="Enter your password" required>
                    <!-- Eye icon to toggle password visibility -->
                    <span class="input-group-text" onclick="togglePassword()">
                        <i id="togglePasswordIcon" class="bi bi-eye-slash"></i>
                    </span>
                </div>
                
                {{-- Validation error for password --}}
                @error('password')
                <!-- Show validation error if password is invalid -->
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            {{-- Submit button --}}
            <!-- Login button styled with custom class -->
            <button type="submit" class="btn-login">Login</button>

            {{-- Link to registration page --}}
            <!-- Button that redirects to the registration form -->
            <a href="{{ route('register') }}" class="btn btn-outline-secondary">Register</a>

            {{-- Links below form for password reset and email verification --}}
            <div class="mt-4 text-center" style="border-top: 1px solid #ccc; padding-top: 15px;">
                <!-- Link to forgot password form -->
                <a href="{{ route('password.request') }}" style="display: block; color: #4b70b4; margin-bottom: 10px; font-size: 0.9rem;">
                    Forgot Password?
                </a>
                <!-- Link to email verification form -->
                <a href="{{ route('verify.email.form') }}" style="display: block; color: #4b70b4; font-size: 0.9rem;">
                    Verify Your Email
                </a>
            </div>

            {{-- Show other errors if any --}}
            @if($errors->any())
            <div class="mt-3">
                <!-- Check if email has specific validation errors -->
                @if ($errors->has('email'))
                    <!-- Show first email-related error -->
                    <div class="alert alert-warning text-center">
                        {{ $errors->first('email') }}
                    </div>
                @else
                    <!-- Show any other general error -->
                    <div class="alert alert-warning text-danger text-center">{{ $errors->first() }}</div>
                @endif
            </div>
            @endif
        </form>
    </div>

    <script>
        // Toggle password visibility when icon clicked
        function togglePassword() {
            const input = document.getElementById("password"); // Get the password input field
            const icon = document.getElementById("togglePasswordIcon"); // Get the eye icon

            // If password is hidden, show it and change icon
            if (input.type === "password") {
                input.type = "text";
                icon.classList.remove("bi-eye-slash");
                icon.classList.add("bi-eye");
            } else {
                // Otherwise, hide it and switch icon back
                input.type = "password";
                icon.classList.remove("bi-eye");
                icon.classList.add("bi-eye-slash");
            }
        }
    </script>
</body>

</html>
