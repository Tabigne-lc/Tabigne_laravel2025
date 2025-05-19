<style>
   body {
    background-color: #f2efe7;
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
}

.navbar {
    background: linear-gradient(90deg, #7b89d5 0%, #4b70b4 100%);
    box-shadow: 0 4px 12px rgba(75, 112, 180, 0.6);
    padding: 0.8rem 1.5rem;
    position: relative;
    z-index: 1000;
}

.navbar-brand,
.nav-link {
    color: white !important;
    padding: 10px 14px;
    border-radius: 6px;
    font-weight: 600;
    position: relative;
    transition: background-color 0.35s ease, color 0.35s ease, transform 0.25s ease;
}

.nav-link:hover {
    color: #d1c1e1 !important;
    background-color: rgba(179, 168, 225, 0.3);
    transform: translateY(-3px);
    box-shadow: 0 4px 8px rgba(123, 137, 213, 0.4);
}

.nav-link::after {
    content: '';
    position: absolute;
    left: 10px;
    bottom: 6px;
    width: 0;
    height: 3px;
    background-color: #d1c1e1;
    border-radius: 2px;
    transition: width 0.35s ease;
}

.nav-link:hover::after {
    width: calc(100% - 20px);
}

.logout-btn {
    background-color: #4b70b4;
    border: none;
    color: white !important;
    margin-left: 15px;
    padding: 8px 18px;
    border-radius: 10px;
    font-weight: 700;
    cursor: pointer;
    box-shadow: 0 4px 12px rgba(75, 112, 180, 0.7);
    transition: background-color 0.3s ease, box-shadow 0.3s ease, transform 0.3s ease;
}

.logout-btn:hover {
    background-color: #7b89d5;
    box-shadow: 0 6px 18px rgba(123, 137, 213, 0.9);
    transform: scale(1.1);
    color: white !important;
}

.navbar-toggler {
    border: 2px solid rgba(255, 255, 255, 0.6);
    border-radius: 6px;
    transition: border-color 0.3s ease;
}

.navbar-toggler:hover {
    border-color: #b3a8e1;
}

.navbar-toggler-icon {
    background-image: url("data:image/svg+xml;charset=utf8,%3Csvg viewBox='0 0 30 30' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath stroke='%23d1c1e1' stroke-width='3' d='M4 7h22M4 15h22M4 23h22'/%3E%3C/svg%3E");
}

</style>

<nav class="navbar navbar-expand-lg">
    <div class="container-fluid">
        <a class="navbar-brand" href="{{ route('dashboard') }}">Dashboard</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarMenu"
            aria-controls="navbarMenu" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarMenu">
            <ul class="navbar-nav me-auto">

                <li class="nav-item"><a class="nav-link" href="{{ route('upload.index') }}">Uploaded Files</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('profile.edit') }}">Edit Profile</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('password.edit') }}">Change Password</a></li>
@php
    $user = \App\Models\Usersinfo::find(session('user_id'));
@endphp

@if($user && $user->user_type === 'Admin')
    <li class="nav-item"><a class="nav-link" href="{{ route('user.list') }}">Users</a></li>
    <li class="nav-item"><a class="nav-link" href="{{ route('admin.reports') }}">Reports</a></li>
@endif
            </ul>
        </div>
        <div class="d-flex">
            <a class="btn logout-btn" href="{{ route('login') }}">Logout</a>
        </div>
    </div>
</nav>