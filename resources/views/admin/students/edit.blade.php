@extends('admin.layout.app')

@section('content')
<div class="container mt-3">
    <h1>Edit Student</h1>

    <form action="{{ route('admin.students.update', $student->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" class="form-control" name="name" value="{{ $student->name }}" required>
        </div>

        <div class="mb-3">
            <label for="student_id" class="form-label">Student ID</label>
            <input type="text" class="form-control" name="student_id" value="{{ $student->student_id }}" required>
        </div>

        <div class="mb-3">
            <label for="major" class="form-label">Major</label>
            <input type="text" class="form-control" name="major" value="{{ $student->major }}">
        </div>

        <div class="mb-3">
            <label for="gender" class="form-label">Gender</label>
            <select class="form-select" name="gender" required>
                <option value="Male" {{ $student->gender == 'Male' ? 'selected' : '' }}>Male</option>
                <option value="Female" {{ $student->gender == 'Female' ? 'selected' : '' }}>Female</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="grade_level" class="form-label">Grade Level</label>
            <input type="text" class="form-control" name="grade_level" value="{{ $student->grade_level }}" required>
        </div>

        <button type="submit" class="btn btn-success">Update Student</button>
        <a href="{{ route('admin.students.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection
