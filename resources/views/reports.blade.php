<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reports</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <style>
        body {
            font-family: Arial, sans-serif;
            background: #d1c1e1;
        }

        .sidebar {
            background: #7b89d5;
            padding: 20px 10px;
            border-radius: 10px;
            height: 100%;
        }

        .sidebar .nav-link {
            color: white;
            background-color: #b3a8e1;
            border: 1px solid #a296c4;
            margin-bottom: 10px;
            text-align: left;
            font-weight: bold;
        }

        .sidebar .nav-link.active {
            background-color: #9e91c9 !important;
        }

        .content-area {
            background: #fff;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        h2, h5 {
            color: #4b70b4;
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

    @include('nav') <!-- Include navigation bar -->

    <div class="container-fluid mt-4">
        <div class="row">
            <!-- Sidebar -->
            <div class="col-md-3">
                <div class="sidebar">
                    <h4 class="text-white text-center mb-4">Reports Menu</h4>
                    <!-- Vertical nav pills for report categories -->
                    <div class="nav flex-column nav-pills" id="reportTabs" role="tablist" aria-orientation="vertical">
                        <a class="nav-link active" id="fileType-tab" data-toggle="pill" href="#fileType" role="tab"
                            aria-controls="fileType" aria-selected="true">File Types</a>
                        <a class="nav-link" id="userRegistration-tab" data-toggle="pill" href="#userRegistration"
                            role="tab" aria-controls="userRegistration" aria-selected="false">User Registration Trend</a>
                        <a class="nav-link" id="birthYear-tab" data-toggle="pill" href="#birthYear" role="tab"
                            aria-controls="birthYear" aria-selected="false">Users by Birth Year</a>
                        <a class="nav-link" id="fileUpload-tab" data-toggle="pill" href="#fileUpload" role="tab"
                            aria-controls="fileUpload" aria-selected="false">File Uploads Trend</a>
                    </div>
                </div>
            </div>

            <!-- Content Area -->
            <div class="col-md-9">
                <div class="content-area">
                    <h2 class="text-center mb-4">System Reports</h2>
                    <!-- Tab panes for each report -->
                    <div class="tab-content" id="reportTabsContent">
                        <div class="tab-pane fade show active" id="fileType" role="tabpanel" aria-labelledby="fileType-tab">
                            <h5>File Types (Pie Chart)</h5>
                            <canvas id="fileTypeChart"></canvas> <!-- Pie chart for file types -->
                        </div>
                        <div class="tab-pane fade" id="userRegistration" role="tabpanel" aria-labelledby="userRegistration-tab">
                            <h5>User Registration Trend (Line Chart)</h5>
                            <canvas id="userRegistrationChart"></canvas> <!-- Line chart for user registration -->
                        </div>
                        <div class="tab-pane fade" id="birthYear" role="tabpanel" aria-labelledby="birthYear-tab">
                            <h5>Users by Birth Year (Bar Chart)</h5>
                            <canvas id="birthYearChart"></canvas> <!-- Bar chart for birth year distribution -->
                        </div>
                        <div class="tab-pane fade" id="fileUpload" role="tabpanel" aria-labelledby="fileUpload-tab">
                            <h5>File Uploads Trend (Line Chart)</h5>
                            <canvas id="fileUploadChart"></canvas> <!-- Line chart for file uploads -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Chart.js scripts -->
    <script>
        // Pie chart for File Types
        new Chart(document.getElementById('fileTypeChart'), {
            type: 'pie',
            data: {
                labels: {!! json_encode($fileTypes->pluck('type')) !!}, // File type labels
                datasets: [{
                    data: {!! json_encode($fileTypes->pluck('count')) !!}, // Corresponding counts
                    backgroundColor: ['#f87979', '#a2d5f2', '#b4f2e1', '#ffe066'], // Colors for slices
                }]
            }
        });

        // Line chart for User Registration Trend
        new Chart(document.getElementById('userRegistrationChart'), {
            type: 'line',
            data: {
                labels: {!! json_encode($userRegistrations->pluck('month')) !!}, // Months
                datasets: [{
                    label: 'User Registrations',
                    data: {!! json_encode($userRegistrations->pluck('total')) !!}, // Number of registrations per month
                    borderColor: '#7b89d5',
                    fill: false
                }]
            }
        });

        // Bar chart for Users by Birth Year
        new Chart(document.getElementById('birthYearChart'), {
            type: 'bar',
            data: {
                labels: {!! json_encode($birthYears->pluck('year')) !!}, // Birth years
                datasets: [{
                    label: 'Users by Birth Year',
                    data: {!! json_encode($birthYears->pluck('count')) !!}, // Counts per year
                    backgroundColor: '#9e91c9'
                }]
            }
        });

        // Line chart for File Uploads Trend
        new Chart(document.getElementById('fileUploadChart'), {
            type: 'line',
            data: {
                labels: {!! json_encode($fileUploads->pluck('month')) !!}, // Months
                datasets: [{
                    label: 'File Uploads',
                    data: {!! json_encode($fileUploads->pluck('total')) !!}, // Upload counts per month
                    borderColor: '#b3a8e1',
                    fill: false
                }]
            }
        });
    </script>

    <!-- jQuery and Bootstrap JS for tab functionality -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>

</body>


</html>
