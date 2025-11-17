@extends('admin.layout.app')

@section('content')
<div class="container mt-4">
    <h3>📄 Student Enrollments</h3>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-striped table-hover mt-3">
        <thead>
            <tr>
                <th>#</th>
                <th>Student Name</th>
                <th>Grade Level</th>
                <th>Strand</th>
                <th>Section</th>
                <th>Contact</th>
                <th>Email</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($enrollments as $enrollment)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $enrollment->student_name }}</td>
                <td>{{ $enrollment->grade_level }}</td>
                <td>{{ $enrollment->strand }}</td>
                <td>{{ $enrollment->section ?? '-' }}</td>
                <td>{{ $enrollment->contact_number }}</td>
                <td>{{ $enrollment->email }}</td>
                <td>
                    @if($enrollment->status == 'Pending')
                        <span class="badge bg-warning text-dark">Pending</span>
                    @elseif($enrollment->status == 'Approved')
                        <span class="badge bg-success">Approved</span>
                    @else
                        <span class="badge bg-danger">Rejected</span>
                    @endif
                </td>
                <td>
                    @if($enrollment->status == 'Pending')
                    <form action="{{ route('admin.enrollments.approve', $enrollment->id) }}" method="POST" class="d-inline">
                        @csrf
                        <button class="btn btn-sm btn-success">Approve</button>
                    </form>
                    <form action="{{ route('admin.enrollments.reject', $enrollment->id) }}" method="POST" class="d-inline">
                        @csrf
                        <button class="btn btn-sm btn-danger">Reject</button>
                    </form>
                    @else
                        <span class="text-muted">-</span>
                    @endif
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="9" class="text-center">No enrollments found.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
