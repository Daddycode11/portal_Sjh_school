@extends('admin.layout.app')


@section('content')
<div class="container-fluid py-4">
    <h2 class="mb-4 text-success"><i class="fas fa-chart-line"></i> System Overview</h2>

    <!-- Summary Cards -->
    <div class="row mb-4">
        <div class="col-md-3 mb-3">
            <div class="card shadow-sm border-left-primary">
                <div class="card-body">
                    <h6 class="text-muted mb-1">Total Students</h6>
                    <h3 class="fw-bold text-primary">{{ $totalStudents }}</h3>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="card shadow-sm border-left-info">
                <div class="card-body">
                    <h6 class="text-muted mb-1">Faculty Members</h6>
                    <h3 class="fw-bold text-info">{{ $totalFaculty }}</h3>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="card shadow-sm border-left-success">
                <div class="card-body">
                    <h6 class="text-muted mb-1">Subjects</h6>
                    <h3 class="fw-bold text-success">{{ $totalSubjects }}</h3>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="card shadow-sm border-left-warning">
                <div class="card-body">
                    <h6 class="text-muted mb-1">Sections</h6>
                    <h3 class="fw-bold text-warning">{{ $totalSections }}</h3>
                </div>
            </div>
        </div>
    </div>

    <!-- System Activity Stats -->
    <div class="row mb-4">
        <div class="col-md-4 mb-3">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h6 class="text-muted mb-1">Uploaded Syllabi</h6>
                    <h3 class="fw-bold">{{ $uploadedSyllabi }}</h3>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-3">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h6 class="text-muted mb-1">Active Grading Systems</h6>
                    <h3 class="fw-bold">{{ $gradingSystems }}</h3>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-3">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h6 class="text-muted mb-1">Total Enrollments</h6>
                    <h3 class="fw-bold">{{ $totalEnrollments }}</h3>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Activity -->
    <div class="card shadow-sm">
        <div class="card-header bg-success text-white">
            <h5 class="mb-0"><i class="fas fa-history"></i> Recent Faculty Uploads</h5>
        </div>
        <div class="card-body p-0">
            <table class="table table-striped mb-0">
                <thead class="table-light">
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
@endsection
