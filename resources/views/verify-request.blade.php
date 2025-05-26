<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Verify Your Email</title>
    {{-- Bootstrap CSS CDN --}}
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    
    <div class="container mt-5">
        {{-- Back to login button --}}
        <a class="btn btn-secondary" href="{{ route('login') }}">Go back</a>
        <br><br>

        <h3 class="mb-4">Verify Your Email</h3>

        {{-- Success message after sending verification --}}
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        {{-- Show first error if any --}}
        @if ($errors->any())
            <div class="alert alert-danger">{{ $errors->first() }}</div>
        @endif

        {{-- Form to submit email for verification --}}
        <form action="{{ route('verify.email.send') }}" method="POST">
            @csrf {{-- CSRF token for security --}}
            <div class="mb-3">
                <label>Email Address</label>
                <input type="email" name="email" class="form-control" required>
            </div>
            <button class="btn btn-primary">Send Verification Email</button>
        </form>
    </div>
</body>
</html>
