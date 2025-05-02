<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User List</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background-color: #F2EFE7;
        }

        h2 {
            color: #4b70b4;
            font-size: 2rem;
            text-align: center;
        }

        .card {
            border: 1px solid #b3a8e1;
            border-radius: 8px;
            background-color: #ffffff;
        }

        .card-body {
            padding: 1.5rem;
        }

        .form-label {
            color: #4b70b4;
        }

        .form-control {
            border: 1px solid #b3a8e1;
        }

        .btn-primary {
            background-color: #4b70b4;
            border-color: #4b70b4;
            color: white;
        }

        .btn-primary:hover {
            background-color: #9e91c9;
            border-color: #9e91c9;
        }

        .btn-outline-secondary {
            border-color: #b3a8e1;
            color: #4b70b4;
        }

        .btn-outline-secondary:hover {
            background-color: #b3a8e1;
            color: white;
        }

        .btn-danger {
            background-color: #d88aad;
            border-color: #d88aad;
            color: white;
        }

        .btn-danger:hover {
            background-color: #e5a4c2;
            border-color: #e5a4c2;
            color: white;
        }

        .table-primary {
            background-color: #4b70b4;
            color: white;
        }

        .table th,
        .table td {
            text-align: center;
        }

        .alert-success {
            background-color: #4b70b4;
            color: white;
        }

        .alert-danger {
            background-color: #e5a4c2;
            color: white;
        }

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

    @if (session('success'))
        <div class="alert alert-success mt-2">{{ session('success') }}</div>
    @endif

    @if ($errors->has('delete'))
        <div class="alert alert-danger mt-2">{{ $errors->first('delete') }}</div>
    @endif

    <div class="container mt-5">
        <h2>User List</h2>
        <div class="card mb-4 shadow-sm">
            <div class="card-body">
                <form method="GET" action="{{ route('user.list') }}">
                    <div class="row g-3 align-items-end">
                        <div class="col-md-4">
                            <label for="searchName" class="form-label">Search by Name</label>
                            <input type="text" id="searchName" name="name" placeholder="e.g. John"
                                value="{{ request('name') }}" class="form-control">
                        </div>
                        <div class="col-md-4">
                            <label for="searchEmail" class="form-label">Search by Email</label>
                            <input type="text" id="searchEmail" name="email" placeholder="e.g. john@example.com"
                                value="{{ request('email') }}" class="form-control">
                        </div>
                        <div class="col-md-4 d-flex gap-2">
                            <button type="submit" class="btn btn-primary">Filter</button>
                            @if(request('name') || request('email'))
                                <a href="{{ route('user.list') }}" class="btn btn-outline-secondary">Clear Filters</a>
                            @endif
                        </div>
                    </div>
                </form>
            </div>
        </div>


        <div class="table-responsive shadow-sm rounded bg-white p-3">
            <table class="table table-hover align-middle mb-0 bg-white">
                <thead class="table-primary">
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Username</th>
                        <th>Role</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                        <tr>
                            <td>{{ $user->first_name }} {{ $user->last_name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->username }}</td>
                            <td>{{ ucfirst($user->user_type) }}</td>
                            <td class="text-center">
                                <form action="{{ route('user.destroy', $user->id) }}" method="POST" class="d-inline"
                                    onsubmit="return confirm('Are you sure you want to delete this user?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-md">
                                        <i class="bi bi-trash"></i> Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="d-flex justify-content-center mt-4">
            {{ $users->onEachSide(1)->links('pagination::bootstrap-5') }}
        </div>

</body>

</html>
