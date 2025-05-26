<!-- resources/views/forgot-password.blade.php -->
<!DOCTYPE html>
<html>
<head>
    <title>Forgot Password</title>
    {{-- Bootstrap 4 CSS CDN for styling --}}
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    {{-- Page heading --}}
    <h3 class="text-center mb-4">Forgot Password</h3>

    {{-- Show success message if exists in session --}}
    @if (session('success'))
        <div class="alert alert-success text-center">{{ session('success') }}</div>
    @endif

    {{-- Form to submit email for password reset link --}}
    <form method="POST" action="{{ route('password.email') }}">
        @csrf {{-- CSRF protection --}}
        
        <div class="mb-3">
            {{-- Email input label --}}
            <label for="email" class="form-label">Enter your email address</label>
            
            {{-- Email input field with old input value and validation error handling --}}
            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                   value="{{ old('email') }}" required>
                   
            {{-- Show validation error for email --}}
            @error('email')
                <div class="invalid-feedback d-block">{{ $message }}</div>
            @enderror
        </div>
        
        {{-- Submit button --}}
        <button type="submit" class="btn btn-primary w-100">Send Reset Link</button>
    </form>
</div>
</body>
</html>
