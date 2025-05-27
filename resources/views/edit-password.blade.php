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
    <!-- Include the navigation bar using a Blade partial -->
    @include('nav')

    <!-- Check if there is a success message in session or any validation errors -->
    @if (session('success') || $errors->any())
        <!-- Container for the toast message, positioned at the top right corner -->
        <div class="toast-container position-fixed top-0 end-0 p-3" style="z-index: 9999">
            <!-- Toast element with dynamic background class (green for success, red for error) -->
            <div id="feedbackToast"
                class="toast align-items-center text-white {{ session('success') ? 'bg-success' : 'bg-danger' }} border-0"
                role="alert">
                <!-- Flex container for toast content -->
                <div class="d-flex">
                    <!-- Main toast message content -->
                    <div class="toast-body">
                        <!-- If success message exists, show it -->
                        @if(session('success'))
                            {{ session('success') }}
                        <!-- Otherwise, list all error messages -->
                        @else
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        @endif
                    </div>
                    <!-- Close button for dismissing the toast -->
                    <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"
                        aria-label="Close"></button>
                </div>
            </div>
        </div>
    @endif

    <!-- Main container for the password change form -->
    <div class="profile-container">
        <!-- Heading for the form -->
        <h2 class="profile-title">Edit Password</h2>
        <!-- Form to update password, sent via POST to password.update route -->
        <form method="POST" action="{{ route('password.update') }}">
            <!-- CSRF token for security -->
            @csrf

            <!-- Old password input field -->
            <div class="form-group">
                <label for="old_password">Old Password</label>
                <input type="password" class="form-control @error('old_password') is-invalid @enderror"
                    id="old_password" name="old_password" placeholder="Enter your old password" required>
                <!-- Show validation error for old password if any -->
                @error('old_password')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- New password input field -->
            <div class="form-group">
                <label for="new_password">New Password</label>
                <input type="password" class="form-control @error('new_password') is-invalid @enderror"
                    id="new_password" name="new_password" placeholder="Enter new password" required>
                <!-- Show validation error for new password if any -->
                @error('new_password')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Confirm new password input field -->
            <div class="form-group">
                <label for="confirm_password">Confirm New Password</label>
                <input type="password" class="form-control @error('confirm_password') is-invalid @enderror"
                    id="confirm_password" name="confirm_password" placeholder="Confirm New Password" required>
                <!-- Show validation error for confirmation field if any -->
                @error('confirm_password')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Submit button to save the changes -->
            <button type="submit" class="btn btn-primary">Save Changes</button>
        </form>
    </div>

    <!-- Bootstrap 5 JavaScript bundle for components like toast -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Wait until the DOM content is fully loaded
        document.addEventListener('DOMContentLoaded', function () {
            // Get the toast element by its ID
            const toastEl = document.getElementById('feedbackToast');
            // If it exists, create and show the toast
            if (toastEl) {
                const toast = new bootstrap.Toast(toastEl, { delay: 3000 }); // Show for 3 seconds
                toast.show();
            }
        });
    </script>
</body>

</html>
