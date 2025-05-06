<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Password Reset</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
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

        .reset-card {
            background-color: #ffffff;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 450px;
        }

        h2 {
            color: #4b70b4; /* San Marino */
            margin-bottom: 30px;
            text-align: center;
        }

        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
            color: #4b70b4;
        }

        input[type="email"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .btn-primary {
            background-color: #e5a4c2; /* Kobi */
            color: white;
            border: none;
            padding: 12px;
            width: 100%;
            border-radius: 5px;
            cursor: pointer;
            font-weight: bold;
        }

        .btn-primary:hover {
            background-color: #b3a8e1; /* Cold Purple */
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

        .invalid-feedback {
            color: red;
            font-size: 0.875rem;
        }

        .text-center {
            text-align: center;
        }

        .mt-3 {
            margin-top: 20px;
        }
    </style>
</head>
<body>

    <div class="reset-card">
        <h2>Reset Your Password</h2>
        
        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('password.email') }}">
            @csrf
            <div class="form-group">
                <label for="email">Email Address</label>
                <input type="email" name="email" id="email" value="{{ old('email') }}" required>
                @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn-primary">Send Password Reset Link</button>
        </form>

        <p class="text-center mt-3">
            <a href="{{ route('login') }}" class="btn-outline-secondary">Back to Login</a>
        </p>
    </div>

</body>
</html>
