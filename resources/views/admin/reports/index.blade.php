@extends('admin.layout.app')

@section('content')

<!-- Google Font -->
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

<style>
    body, h1, h2, h3, h4, h5, h6, table, label, p, td, th {
        font-family: 'Poppins', sans-serif !important;
    }

    body {
        background: #F3FFF7; /* light mint background */
    }

    /* Summary Cards */
    .summary-card {
        border: none;
        border-radius: 16px;
        color: white;
        box-shadow: 0 6px 15px rgba(0,0,0,0.12);
        transition: transform 0.3s, box-shadow 0.3s;
    }
    .summary-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0,0,0,0.15);
    }

    /* Card header */
    .card-header-custom {
        border-radius: 16px 16px 0 0;
        font-weight: 600;
        box-shadow: 0 2px 6px rgba(0,0,0,0.1);
    }

    /* Table Styling */
    table {
        border-radius: 12px;
        overflow: hidden;
    }
    thead {
        background: #E8F5E9;
        color: #2E7D32;
        font-weight: 600;
    }
    tbody tr:nth-of-type(odd) {
        background: #F9FFFB;
    }
</style>

<div class="container-fluid py-4">

    <h2 class="mb-4 text-success"><i class="fas fa-file-alt"></i> Reports Dashboard</h2>

    <!-- Summary Cards -->
    <div class="row mb-4">
        <div class="col-md-4 mb-3">
            <div class="card summary-card text-center" style="background: linear-gradient(135deg, #A5D6A7, #66BB6A);">
                <div class="card-body">
                    <h6 class="mb-1">Total Uploaded Reports</h6>
                    <h3 class="fw-bold">{{ $totalReports }}</h3>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-3">
            <div class="card summary-card text-center" style="background: linear-gradient(135deg, #81C784, #43A047);">
                <div class="card-body">
                    <h6 class="mb-1">Unique Subjects Covered</h6>
                    <h3 class="fw-bold">{{ $uniqueSubjects }}</h3>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-3">
            <div class="card summary-card text-center" style="background: linear-gradient(135deg, #66BB6A, #2E7D32);">
                <div class="card-body">
                    <h6 class="mb-1">Faculty Contributors</h6>
                    <h3 class="fw-bold">{{ $facultyCount }}</h3>
                </div>
            </div>
        </div>
    </div>

    <!-- Reports Table -->
    <div class="card shadow-sm">
        <div class="card-header card-header-custom bg-success text-white">
            <h5 class="mb-0">Uploaded Reports</h5>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-striped mb-0 align-middle">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Subject</th>
                            <th>Faculty</th>
                            <th>File</th>
                            <th>School Year</th>
                            <th>Semester</th>
                            <th>Uploaded At</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($reports as $report)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $report->subject->name ?? 'N/A' }}</td>
                                <td>{{ $report->faculty->name ?? 'N/A' }}</td>
                                <td>
                                    <a href="{{ asset('storage/' . $report->file_path) }}" target="_blank" class="text-success">
                                        {{ $report->original_filename }}
                                    </a>
                                </td>
                                <td>{{ $report->school_year }}</td>
                                <td>{{ $report->semester }}</td>
                                <td>{{ $report->upload_timestamp->format('M d, Y h:i A') }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center text-muted py-4">No reports uploaded yet.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>

@endsection
