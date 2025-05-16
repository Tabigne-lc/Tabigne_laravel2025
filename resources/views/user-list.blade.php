<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User List</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

    <style>
       body {
    background: linear-gradient(135deg, #d1c1e1 0%, #e5a4c2 100%);
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    margin: 0;
    padding: 0;
    color: #4b70b4;
}

h2, .profile-title {
    color: #4b70b4;
    font-size: 2.2rem;
    font-weight: 700;
    text-align: center;
    margin-bottom: 1.5rem;
    text-shadow: 1px 1px 2px rgba(75, 112, 180, 0.5);
}

.card {
    background: #ffffff;
    border-radius: 12px;
    border: 1px solid #b3a8e1;
    box-shadow: 0 4px 10px rgba(123, 137, 213, 0.3);
    max-width: 600px;
    margin: 1.5rem auto;
    transition: box-shadow 0.3s ease;
}

.card:hover {
    box-shadow: 0 8px 20px rgba(75, 112, 180, 0.4);
}

.card-body {
    padding: 2rem;
}

.form-label {
    display: block;
    margin-bottom: 0.5rem;
    font-weight: 600;
    color: #7b89d5;
}

.form-control {
    width: 100%;
    padding: 0.6rem 1rem;
    border: 1.5px solid #b3a8e1;
    border-radius: 8px;
    font-size: 1rem;
    color: #4b70b4;
    background-color: #f9f8ff;
    box-shadow: inset 0 1px 3px rgba(179, 168, 225, 0.4);
    transition: border-color 0.3s ease, box-shadow 0.3s ease;
}

.form-control:focus {
    border-color: #7b89d5;
    box-shadow: 0 0 6px #7b89d5;
    outline: none;
}

.btn-primary {
    background-color: #4b70b4;
    border: none;
    padding: 0.7rem 2rem;
    border-radius: 10px;
    font-weight: 700;
    color: white;
    cursor: pointer;
    box-shadow: 0 4px 10px rgba(75, 112, 180, 0.6);
    transition: background-color 0.3s ease, box-shadow 0.3s ease;
}

.btn-primary:hover {
    background-color: #7b89d5;
    box-shadow: 0 6px 14px rgba(123, 137, 213, 0.8);
}

.btn-outline-secondary {
    background: transparent;
    border: 2px solid #b3a8e1;
    color: #4b70b4;
    padding: 0.6rem 1.8rem;
    border-radius: 10px;
    font-weight: 600;
    cursor: pointer;
    transition: background-color 0.3s ease, color 0.3s ease;
}

.btn-outline-secondary:hover {
    background-color: #b3a8e1;
    color: white;
}

.btn-danger {
    background-color: #e5a4c2;
    border: none;
    padding: 0.7rem 2rem;
    border-radius: 10px;
    font-weight: 700;
    color: #4b70b4;
    cursor: pointer;
    box-shadow: 0 4px 10px rgba(229, 164, 194, 0.7);
    transition: background-color 0.3s ease, box-shadow 0.3s ease;
}

.btn-danger:hover {
    background-color: #d88aad;
    box-shadow: 0 6px 14px rgba(216, 138, 173, 0.8);
    color: white;
}

.table-primary {
    background-color: #4b70b4;
    color: white;
    font-weight: 600;
}

.table th,
.table td {
    text-align: center;
    padding: 0.75rem 1rem;
}

.alert-success {
    background-color: #7b89d5;
    color: white;
    padding: 1rem;
    border-radius: 8px;
    box-shadow: 0 2px 8px rgba(123, 137, 213, 0.5);
}

.alert-danger {
    background-color: #e5a4c2;
    color: #4b70b4;
    padding: 1rem;
    border-radius: 8px;
    box-shadow: 0 2px 8px rgba(229, 164, 194, 0.6);
}

.nav-bar {
    background: linear-gradient(90deg, #7b89d5 0%, #4b70b4 100%);
    padding: 12px 0;
    text-align: center;
    box-shadow: 0 4px 12px rgba(75, 112, 180, 0.7);
}

.nav-bar a {
    color: white;
    margin: 0 20px;
    text-decoration: none;
    font-weight: 700;
    font-size: 1.1rem;
    transition: color 0.3s ease;
}

.nav-bar a:hover {
    color: #d1c1e1;
}

.profile-container {
    background: #ffffff;
    padding: 3rem 2.5rem;
    border-radius: 16px;
    box-shadow: 0 6px 20px rgba(75, 112, 180, 0.15);
    max-width: 600px;
    margin: 40px auto;
}

.btn-success {
    background-color: #e5a4c2;
    border: none;
    color: #4b70b4;
    padding: 0.7rem 2rem;
    border-radius: 10px;
    font-weight: 700;
    cursor: pointer;
    box-shadow: 0 4px 10px rgba(229, 164, 194, 0.7);
    transition: background-color 0.3s ease, box-shadow 0.3s ease;
}

.btn-success:hover {
    background-color: #d88aad;
    box-shadow: 0 6px 14px rgba(216, 138, 173, 0.8);
    color: white;
}

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
