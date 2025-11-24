@extends('admin.layout.app')

@section('content')

<!-- Google Font -->
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

<style>
    body, h1, h2, h3, h4, h5, h6, table, label, p, td, th {
        font-family: 'Poppins', sans-serif !important;
    }

    body {
        background: #F3FFF7; /* Very light mint */
    }

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

    .card-header-custom {
        border-radius: 16px 16px 0 0;
        font-weight: 600;
        box-shadow: 0 2px 6px rgba(0,0,0,0.1);
    }

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

    <h2 class="mb-4 text-success"><i class="fas fa-chart-line"></i> System Overview</h2>

    <!-- Summary Cards -->
    <div class="row mb-4">
        <div class="col-md-3 mb-3">
            <div class="card summary-card text-center" style="background: linear-gradient(135deg, #A5D6A7, #66BB6A);">
                <div class="card-body">
                    <h6 class="mb-1">Total Students</h6>
                    <h3 class="fw-bold">{{ $totalStudents }}</h3>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="card summary-card text-center" style="background: linear-gradient(135deg, #81C784, #43A047);">
                <div class="card-body">
                    <h6 class="mb-1">Faculty Members</h6>
                    <h3 class="fw-bold">{{ $totalFaculty }}</h3>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="card summary-card text-center" style="background: linear-gradient(135deg, #66BB6A, #2E7D32);">
                <div class="card-body">
                    <h6 class="mb-1">Subjects</h6>
                    <h3 class="fw-bold">{{ $totalSubjects }}</h3>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="card summary-card text-center" style="background: linear-gradient(135deg, #A5D6A7, #388E3C);">
                <div class="card-body">
                    <h6 class="mb-1">Sections</h6>
                    <h3 class="fw-bold">{{ $totalSections }}</h3>
                </div>
            </div>
        </div>
    </div>

    <!-- System Activity Stats -->
    <div class="row mb-4">
        <div class="col-md-4 mb-3">
            <div class="card shadow-sm rounded-16">
                <div class="card-body">
                    <h6 class="text-muted mb-1">Uploaded Syllabi</h6>
                    <h3 class="fw-bold">{{ $uploadedSyllabi }}</h3>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-3">
            <div class="card shadow-sm rounded-16">
                <div class="card-body">
                    <h6 class="text-muted mb-1">Active Grading Systems</h6>
                    <h3 class="fw-bold">{{ $gradingSystems }}</h3>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-3">
            <div class="card shadow-sm rounded-16">
                <div class="card-body">
                    <h6 class="text-muted mb-1">Total Enrollments</h6>
                    <h3 class="fw-bold">{{ $totalEnrollments }}</h3>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Activity -->
    <div class="card shadow-sm">
        <div class="card-header card-header-custom bg-success text-white">
            <h5 class="mb-0"><i class="fas fa-history"></i> Recent Faculty Uploads</h5>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-striped mb-0 align-middle">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Faculty</th>
                            <th>Subject</th>
                            <th>Filename</th>
                            <th>Uploaded</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($recentUploads as $upload)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $upload->faculty->name ?? 'N/A' }}</td>
                                <td>{{ $upload->subject->name ?? 'N/A' }}</td>
                                <td>{{ $upload->original_filename }}</td>
                                <td>{{ $upload->upload_timestamp->diffForHumans() }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center text-muted py-4">No recent uploads</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>

@endsection
