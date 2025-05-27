<!-- ... same <head> section ... -->

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">


    <style>
        body {
            font-family: Arial, sans-serif;
            background: #d1c1e1;
        }

        .nav-bar {
            background: #7b89d5;
            padding: 10px;
            text-align: center;
        }

        .nav-bar a {
            color: white;
            margin: 0 15px;
            text-decoration: none;
            font-weight: bold;
        }

        .profile-container {
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin: 40px auto;
            width: 50%;
        }

        .profile-title {
            color: #4b70b4;
            font-size: 2rem;
            text-align: center;
        }

        .btn-primary {
            background: #b3a8e1;
            border-color: #b3a8e1;
            color: white;
        }

        .btn-primary:hover {
            background: #9e91c9;
            border-color: #9e91c9;
        }

        .btn-success {
            background: #e5a4c2;
            border-color: #e5a4c2;
            color: white;
        }

        .btn-success:hover {
            background: #d88aad;
            border-color: #d88aad;
        }
    </style>
</head>

<body>

    <!-- Include the navigation bar using Blade include directive -->
    @include('nav')

    <!-- Check if there's a success session message or any validation errors -->
    @if (session('success') || $errors->any())
    <!-- Create a fixed-position container for the toast message -->
    <div class="position-fixed top-0 end-0 p-3" style="z-index: 9999">
        <!-- Bootstrap toast component with conditional color based on success or error -->
        <div class="toast fade show shadow-lg text-white {{ session('success') ? 'bg-success' : 'bg-danger' }}"
            role="alert" style="min-width: 300px;">
            <!-- Use flexbox to align toast content and close button -->
            <div class="d-flex">
                <!-- Toast body content -->
                <div class="toast-body fs-6">
                    <!-- If there's a success message, display it -->
                    @if(session('success'))
                    {{ session('success') }}
                    <!-- Otherwise, list all validation errors -->
                    @else
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    @endif
                </div>
                <!-- Button to close the toast message -->
                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"
                    aria-label="Close"></button>
            </div>
        </div>
    </div>
    @endif

    <!-- Main container for the profile editing form -->
    <div class="profile-container">
        <!-- Heading for the profile section -->
        <h2 class="profile-title">Edit Profile</h2>
        <!-- Start of the profile update form -->
        <form action="{{ route('profile.update') }}" method="POST">
            <!-- Include CSRF token for form security -->
            @csrf
            <!-- First Name field -->
            <div class="form-group">
                <label for="first_name">First Name</label>
                <input type="text"
                    class="form-control @error('first_name') is-invalid @enderror"
                    id="first_name" name="first_name"
                    value="{{ old('first_name', $user->first_name ?? '') }}">
                <!-- Show validation error for first name if any -->
                @error('first_name')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Last Name field -->
            <div class="form-group">
                <label for="last_name">Last Name</label>
                <input type="text"
                    class="form-control @error('last_name') is-invalid @enderror"
                    id="last_name" name="last_name"
                    value="{{ old('last_name', $user->last_name ?? '') }}">
                <!-- Show validation error for last name if any -->
                @error('last_name')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Username field -->
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text"
                    class="form-control @error('username') is-invalid @enderror"
                    id="username" name="username"
                    value="{{ old('username', $user->username ?? '') }}">
                <!-- Show validation error for username if any -->
                @error('username')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Submit button for the form -->
            <button type="submit" class="btn btn-primary mt-3">Save Changes</button>
        </form>
    </div>

    <!-- Include Bootstrap 5 JS bundle for toast and other components -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // When the DOM is fully loaded
        document.addEventListener('DOMContentLoaded', function() {
            // Select the toast element
            const toastEl = document.querySelector('.toast');
            // If a toast exists, initialize and show it
            if (toastEl) {
                const toast = new bootstrap.Toast(toastEl, {
                    delay: 3000 // Duration toast will be visible
                });
                toast.show(); // Show the toast
            }
        });
    </script>
</body>

</html>
