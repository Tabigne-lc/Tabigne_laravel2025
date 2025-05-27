<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>My Uploaded Files</title>

    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

    <style>
       body {
    background-color: #d1c1e1; /* Prelude */
}

.nav-bar {
    background: #7b89d5; /* Chetwode Blue */
    padding: 10px;
    text-align: center;
}

.nav-bar a {
    color: white;
    margin: 0 15px;
    text-decoration: none;
    font-weight: bold;
}

.filter-card {
    background-color: #b3a8e1; /* Cold Purple */
    border: 2px solid #4b70b4; /* San Marino */
    border-radius: 8px;
    padding: 1rem;
    color: #4b70b4; /* San Marino */
}

.profile-container {
    background: white;
    padding: 30px;
    border-radius: 10px;
    box-shadow: 0 0 10px rgba(216, 151, 194, 0.1); /* light pinkish shadow */
    margin: 40px auto;
    width: 50%;
}

.profile-title {
    color: #4b70b4; /* San Marino */
    font-size: 2rem;
    text-align: center;
}

.btn-primary {
    background: #b3a8e1; /* Cold Purple */
    border-color: #b3a8e1;
    color: white;
}

.btn-primary:hover {
    background: #7b89d5; /* Chetwode Blue */
    border-color: #7b89d5;
}

.btn-success {
    background: #e5a4c2; /* Kobi */
    border-color: #e5a4c2;
    color: white;
}

.btn-success:hover {
    background: #d88aad; /* Slightly deeper Kobi, feel free to adjust */
    border-color: #d88aad;
}

.btn-danger {
    background: #4b70b4; /* San Marino */
    border-color: #4b70b4;
    color: white;
}

.btn-danger:hover {
    background: #3a0938; /* Dark purple for contrast */
    border-color: #3a0938;
}

.table-light th {
    background-color: #b3a8e1; /* Cold Purple */
    color: #4b70b4; /* San Marino */
}

h2 {
    color: #4b70b4; /* San Marino */
}

    </style>
</head>

<body>
    @include('nav') <!-- Includes the navigation bar partial view -->

    <div class="container mt-5"> <!-- Bootstrap container with top margin -->
        <div class="d-flex justify-content-between align-items-center mb-4"> <!-- Flex container for heading and button -->
            <h2 class="mb-0">My Uploaded Files</h2> <!-- Section heading -->
            <a href="{{ route('upload.create') }}" class="btn btn-primary">Upload Files</a> <!-- Link to upload page -->
        </div>

        @if (session('success')) <!-- Check if there's a success message in the session -->
        <div class="alert alert-success">{{ session('success') }}</div> <!-- Display success alert -->
        @endif

        <div class="filter-card mb-4"> <!-- Container for filter/search form -->
            <form method="GET" action="{{ route('upload.index') }}" class="row gy-2 gx-3 align-items-center"> <!-- Form with GET method to filter files -->
                <div class="col-md-4"> <!-- First column: filename input -->
                    <input type="text" name="filename" class="form-control" placeholder="Search by filename"
                        value="{{ request()->input('filename') }}"> <!-- Retain previous search input -->
                </div>
                <div class="col-md-4"> <!-- Second column: file type dropdown -->
                    <select name="type" class="form-select">
                        <option value="">All File Types</option> <!-- Default option -->
                        <option value="application/pdf" {{ request()->input('type') == 'application/pdf' ? 'selected' : '' }}>PDF</option> <!-- Selected if current filter is PDF -->
                        <option value="image/png" {{ request()->input('type') == 'image/png' ? 'selected' : '' }}>PNG</option> <!-- Selected if PNG -->
                        <option value="image/jpeg" {{ request()->input('type') == 'image/jpeg' ? 'selected' : '' }}>JPEG</option> <!-- Selected if JPEG -->
                        <option value="application/vnd.openxmlformats-officedocument.wordprocessingml.document" {{ request()->input('type') == 'application/vnd.openxmlformats-officedocument.wordprocessingml.document' ? 'selected' : '' }}>DOCX</option> <!-- Selected if DOCX -->
                        <option value="text/plain" {{ request()->input('type') == 'text/plain' ? 'selected' : '' }}>TXT</option> <!-- Selected if TXT -->
                    </select>
                </div>
                <div class="col-md-4"> <!-- Third column: buttons -->
                    <div class="d-flex flex-wrap justify-content-md-end justify-content-start gap-2"> <!-- Button alignment -->
                        <button type="submit" class="btn btn-primary">Filter</button> <!-- Submit form to apply filters -->
                        <a href="{{ route('upload.index') }}" class="btn btn-outline-secondary">Clear</a> <!-- Clear filters and reload -->
                    </div>
                </div>
            </form>
        </div>

        <div class="table-responsive"> <!-- Responsive table wrapper -->
            <table class="table table-hover table-striped align-middle"> <!-- Bootstrap styled table -->
                <thead class="table-light"> <!-- Light-colored table header -->
                    <tr>
                        <th>Filename</th> <!-- Column: Filename -->
                        <th>Type</th> <!-- Column: MIME type -->
                        <th>Uploaded</th> <!-- Column: Upload timestamp -->
                        <th>Actions</th> <!-- Column: Download/Delete buttons -->
                    </tr>
                </thead>
                <tbody>
                    @forelse ($uploads as $upload) <!-- Loop through uploads or show message if empty -->
                    <tr>
                        <td>{{ $upload->original_filename }}</td> <!-- Show original filename -->
                        <td>{{ $upload->type }}</td> <!-- Show file type -->
                        <td>{{ $upload->created_at->format('Y-m-d H:i') }}</td> <!-- Show formatted upload date -->
                        <td>
                            <a href="{{ route('upload.download', $upload) }}"
                                class="btn btn-sm btn-success me-1">Download</a> <!-- Download button -->
                            <form action="{{ route('upload.destroy', $upload) }}" method="POST" class="d-inline"> <!-- Delete form -->
                                @csrf <!-- CSRF protection -->
                                @method('DELETE') <!-- Spoof DELETE request -->
                                <button type="submit" onclick="return confirm('Are you sure?')"
                                    class="btn btn-sm btn-danger">Delete</button> <!-- Confirm before deleting -->
                            </form>
                        </td>
                    </tr>
                    @empty <!-- If no uploads found -->
                    <tr>
                        <td colspan="4" class="text-center text-muted">No uploaded files found.</td> <!-- Message for empty state -->
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="d-flex justify-content-center mt-4"> <!-- Pagination alignment -->
            {{ $uploads->onEachSide(1)->links('pagination::bootstrap-5') }} <!-- Laravel pagination with Bootstrap 5 styling -->
        </div>
    </div>
</body>

</html>
