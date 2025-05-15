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
        #password-strength {
            font-size: 0.9rem;
        }
        .strength-weak { color: #dc3545; }
        .strength-medium { color: #ffc107; }
        .strength-strong { color: #28a745; }
    </style>
</head>
<body>
    <nav class="nav bar navbar-expanded-lg">
        <div class="container">
            <a class="navbar-brand" href="#">

            </a>
        </div>

    </nav>


    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card p-4 shadow-sm">
                    <h2 class="mb-3">Register</h2>
                    <form method="POST" action="{{ route('register.save') }}">
                        @csrf
                        <div class="mb-3">
                            <label for="firstname" class="form-label">First Name</label>
                            <input type="text" class="form-control @error('firstname') is-invalid @enderror"
                                id="firstname" name="firstname" value="{{ old('firstname') }}">
                            @error('firstname')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="lastname" class="form-label">Last Name</label>
                            <input type="text" class="form-control @error('lastname') is-invalid @enderror"
                                id="lastname" name="lastname" value="{{ old('lastname') }}">
                            @error('lastname')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="bod" class="form-label">Date of Birth</label>
                            <input type="date" class="form-control @error('bod') is-invalid @enderror" id="bod"
                                name="bod" value="{{ old('bod') }}">
                            @error('bod')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror

                        </div>
                        <div class="mb-3">
                            <label for="sex" class="form-label">Sex</label>
                            <select class="form-control @error('sex') is-invalid @enderror" id="sex" name="sex">
                                <option value="" disabled {{ old('sex') ? '' : 'selected' }}>Select</option>
                                <option value="Male" {{ old('sex') == 'Male' ? 'selected' : '' }}>Male</option>
                                <option value="Female" {{ old('sex') == 'Female' ? 'selected' : '' }}>Female</option>
                            </select>
                            @error('sex')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" id="email"
                                name="email" value="{{ old('email') }}">
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="username" class="form-label">Username</label>
                            <input type="text" class="form-control @error('username') is-invalid @enderror"
                                id="username" name="username" value="{{ old('username') }}">
                            @error('username')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror

                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control @error('password') is-invalid @enderror"
                                id="password" name="password">
                            <div id="password-strength" class="mt-1 fw-semibold"></div>
                            @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3 form-check">
                            <input type="checkbox" class="form-check-input @error('terms') is-invalid @enderror"
                                id="terms" name="terms" {{ old('terms') ? 'checked' : '' }}>
                            @error('terms')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror

                            <label class="form-check-label" for="terms">I agree with the Privacy Policy and Terms and
                                Conditions</label>
                        </div>
                        <button type="submit" class="btn btn-primary w-100">Register</button>
                        <br><br>
                        <a href="{{ route('login') }}" class="btn btn-secondary w-100">Go Back</a>
                    </form>

                </div>

            </div>

        </div>
    </div>
    <script src="{{ asset('js/password-strength.js') }}"></script>

</body>

</html>
