@extends('admin.layout.master')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <h3>📄 Pending Enrollment Requests</h3>
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Student Name</th>
                        <th>Grade Level</th>
                        <th>Strand</th>
                        <th>Section</th>
                        <th>Contact</th>
                        <th>Email</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($pendingEnrollments as $enrollment)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $enrollment->student_name ?? '-' }}</td>
                            <td>{{ $enrollment->grade_level ?? '-' }}</td>
                            <td>{{ $enrollment->strand ?? '-' }}</td>
                            <td>{{ $enrollment->section ?? '-' }}</td>
                            <td>{{ $enrollment->contact_number ?? '-' }}</td>
                            <td>{{ $enrollment->email ?? '-' }}</td>
                            <td>
                                <form action="{{ route('admin.enrollments.approve', $enrollment->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    <button class="btn btn-sm btn-success">Approve</button>
                                </form>
                                <form action="{{ route('admin.enrollments.reject', $enrollment->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    <button class="btn btn-sm btn-danger">Reject</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center">No pending enrollments found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
