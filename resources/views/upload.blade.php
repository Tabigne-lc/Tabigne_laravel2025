<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Uploaded Files</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet" />
    <style>
       body {
    font-family: Arial, sans-serif;
    background:rgb(177, 148, 216); /* Light purple background */
    margin: 0;
    padding: 0;
    color: #4b70b4;
}

        .nav-bar {
            background: linear-gradient(90deg, #7b89d5, #4b70b4);
            padding: 12px 0;
            text-align: center;
            box-shadow: 0 3px 10px rgba(75, 112, 180, 0.4);
            border-radius: 0 0 12px 12px;
        }

        .nav-bar a {
            color: white;
            margin: 0 18px;
            text-decoration: none;
            font-weight: 700;
            font-size: 1.1rem;
            padding: 6px 14px;
            border-radius: 6px;
            transition: background-color 0.3s ease, color 0.3s ease;
            display: inline-block;
        }

        .nav-bar a:hover {
            background-color: #b3a8e1;
            color: #4b70b4;
            box-shadow: 0 4px 12px rgba(179, 168, 225, 0.7);
            transform: translateY(-2px);
        }

     .container {
    background:rgb(150, 129, 172); /* very light lavender */
    padding: 36px 48px;
    border-radius: 20px;
    box-shadow: 0 8px 25px rgba(123, 137, 213, 0.25);
    margin: 50px auto;
    width: 70%;
    color: #4b70b4;
}

        h1 {
            color: #4b70b4;
            font-weight: 700;
            margin-bottom: 30px;
            text-align: center;
            text-shadow: 1px 1px 3px rgba(123, 137, 213, 0.5);
        }

        .alert-success {
            background-color: #7b89d5;
            color: white;
            border-radius: 8px;
            padding: 12px 20px;
            box-shadow: 0 3px 10px rgba(75, 112, 180, 0.4);
            margin-bottom: 25px;
        }

        .form-group label {
            font-weight: 600;
            color: #4b70b4;
        }

        .form-control {
            border: 1.5px solid #b3a8e1;
            border-radius: 8px;
            padding: 10px 12px;
            font-size: 1rem;
            color: #4b70b4;
        }

        .form-control:focus {
            border-color: #7b89d5;
            box-shadow: 0 0 8px rgba(123, 137, 213, 0.5);
            outline: none;
        }

        button.btn-primary {
            background-color: #4b70b4;
            border-color: #4b70b4;
            color: white;
            font-weight: 700;
            padding: 10px 28px;
            border-radius: 12px;
            transition: background-color 0.3s ease;
        }

        button.btn-primary:hover {
            background-color: #7b89d5;
            border-color: #7b89d5;
        }

        .table th {
            background: #b3a8e1;
            color: white;
            font-weight: 600;
            text-align: center;
        }

        .btn-danger {
            background: #e5a4c2;
            border-color: #e5a4c2;
            color: white;
            font-weight: 600;
            border-radius: 10px;
            transition: background-color 0.3s ease;
        }

        .btn-danger:hover {
            background: #d88aad;
            border-color: #d88aad;
        }

        .btn-info {
            background: #4b70b4;
            border-color: #4b70b4;
            color: white;
            font-weight: 600;
            border-radius: 10px;
            transition: background-color 0.3s ease;
        }

        .btn-info:hover {
            background: #3d5a96;
            border-color: #3d5a96;
        }
    </style>
</head>

<body>

    @include('nav')

    <div class="container">
        <h1>Upload a file</h1>

        {{-- Success message --}}
        @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        {{-- Upload form --}}
        <form action="{{ route('upload.store') }}" method="POST" enctype="multipart/form-data" class="mb-4">
            @csrf
            <div class="form-group">
                <label for="file">Choose Files</label>
                <input type="file" name="file[]" class="form-control @error('file.*') is-invalid @enderror" multiple
                    required />
                @error('file.*')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary mt-2">Upload</button>
        </form>

    </div>

</body>

</html>
