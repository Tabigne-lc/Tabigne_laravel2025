<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Password</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { font-family: Arial, sans-serif; background: #d1c1e1; }
        .nav-bar { background: #7b89d5; padding: 10px; text-align: center; }
        .nav-bar a { color: white; margin: 0 15px; text-decoration: none; font-weight: bold; }
        .profile-container {
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin: 40px auto;
            width: 50%;
        }
        .profile-title { color: #4b70b4; font-size: 2rem; text-align: center; }
        .btn-primary { background: #b3a8e1; border-color: #b3a8e1; color: white; }
        .btn-primary:hover { background: #9e91c9; border-color: #9e91c9; }
        .btn-success { background: #e5a4c2; border-color: #e5a4c2; color: white; }
        .btn-success:hover { background: #d88aad; border-color: #d88aad; }
    </style>
</head>
<body>
@include('nav')


    @if (session('success') || $errors->any())
        <div class="toast-container position-fixed top-0 end-0 p-3" style="z-index: 9999">
            <div id="feedbackToast"
                class="toast align-items-center text-white {{ session('success') ? 'bg-success' : 'bg-danger' }} border-0"
                role="alert">
                <div class="d-flex">
                    <div class="toast-body">
                        @if(session('success'))
                            {{ session('success') }}
                        @else
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        @endif
                    </div>
                    <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"
                        aria-label="Close"></button>
                </div>
            </div>
        </div>
    @endif

    <div class="profile-container">
        <h2 class="profile-title">Edit Password</h2>
        <form method="POST" action="{{ route('password.update') }}">
            @csrf
            <div class="form-group">
                <label for="old_password">Old Password</label>
                <input type="password" class="form-control @error('old_password') is-invalid @enderror"
                    id="old_password" name="old_password" placeholder="Enter your old password" required>
                @error('old_password')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="new_password">New Password</label>
                <input type="password" class="form-control @error('new_password') is-invalid @enderror"
                    id="new_password" name="new_password" placeholder="Enter new password" required>
                @error('new_password')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="confirm_password">Confirm New Password</label>
                <input type="password" class="form-control @error('confirm_password') is-invalid @enderror"
                    id="confirm_password" name="confirm_password" placeholder="Confirm New Password" required>
                @error('confirm_password')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary">Save Changes</button>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const toastEl = document.getElementById('feedbackToast');
            if (toastEl) {
                const toast = new bootstrap.Toast(toastEl, { delay: 3000 });
                toast.show();
            }
        });
    </script>
</body>
</html>
