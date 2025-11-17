@extends('admin.layout.app')


@section('content')
<div class="container-fluid py-4">
    <h2 class="mb-4 text-success"><i class="fas fa-file-alt"></i> Reports Dashboard</h2>

    <!-- Summary Cards -->
    <div class="row mb-4">
        <div class="col-md-4">
            <div class="card shadow-sm border-left-success">
                <div class="card-body">
                    <h6 class="text-muted mb-1">Total Uploaded Reports</h6>
                    <h3 class="fw-bold text-success">{{ $totalReports }}</h3>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card shadow-sm border-left-info">
                <div class="card-body">
                    <h6 class="text-muted mb-1">Unique Subjects Covered</h6>
                    <h3 class="fw-bold text-info">{{ $uniqueSubjects }}</h3>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card shadow-sm border-left-warning">
                <div class="card-body">
                    <h6 class="text-muted mb-1">Faculty Contributors</h6>
                    <h3 class="fw-bold text-warning">{{ $facultyCount }}</h3>
                </div>
            </div>
        </div>
    </div>

    <!-- Reports Table -->
    <div class="card shadow-sm">
        <div class="card-header bg-success text-white">
            <h5 class="mb-0">Uploaded Reports</h5>
        </div>
        <div class="card-body p-0">
            <table class="table table-striped mb-0">
                <thead class="table-light">
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
@endsection
