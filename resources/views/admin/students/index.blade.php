@extends('admin.layout.app')

@section('content')
<div class="container mt-5">

    <!-- Page Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="fw-bold">Students</h1>
        <a href="{{ route('admin.students.create') }}" class="btn btn-primary shadow-sm">
            + Add New Student
        </a>
    </div>

    <!-- Success message -->
    @if(session('success'))
        <div class="alert alert-success shadow-sm">{{ session('success') }}</div>
    @endif

    <!-- Students Table Card -->
    <div class="card shadow-sm border-0">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>Name</th>
                            <th>Student Number</th>
                            <th>Student ID</th>
                            <th>Major</th>
                            <th>Gender</th>
                            <th>Grade Level</th>
                            <th class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($students as $student)
                            <tr>
                                <td>{{ $student->name }}</td>
                                <td>{{ $student->student_number }}</td>
                                <td>{{ $student->student_id ?? '-' }}</td>
                                <td>{{ $student->major ?? '-' }}</td>
                                <td>{{ $student->gender == 'M' ? 'Male' : 'Female' }}</td>
                                <td>{{ $student->grade_level }}</td>
                                <td class="text-center">
                                    <a href="{{ route('admin.students.edit', $student->id) }}" class="btn btn-sm btn-warning me-1">
                                        Edit
                                    </a>
                                    <form action="{{ route('admin.students.destroy', $student->id) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('Are you sure?');">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-danger">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center text-muted py-4">No students found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>

<style>
    body {
        font-family: 'Poppins', sans-serif;
        background-color: #f9fafb;
    }

    .card {
        border-radius: 12px;
    }

    .table thead th {
        font-weight: 600;
    }

    .table tbody tr:hover {
        background-color: #f1f5f9;
    }

    .btn {
        border-radius: 8px;
        font-weight: 500;
    }

    .fw-bold {
        font-weight: 600;
    }
</style>
@endsection
