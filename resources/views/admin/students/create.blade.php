@extends('admin.layout.app')

@section('content')
<div class="container mt-3">
    <h1>Add New Student</h1>

    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.students.store') }}" method="POST">
        @csrf

        <div class="form-group mb-3">
            <label for="name">Full Name</label>
            <input type="text" name="name" class="form-control" value="{{ old('name') }}" required>
        </div>

        <div class="form-group mb-3">
            <label for="student_id">Student ID</label>
            <input type="text" name="student_id" class="form-control" value="{{ old('student_id') }}" required>
        </div>

        <div class="form-group mb-3">
            <label for="major">Major</label>
            <input type="text" name="major" class="form-control" value="{{ old('major') }}">
        </div>

        <div class="form-group mb-3">
            <label for="gender">Gender</label>
            <select name="gender" class="form-control" required>
                <option value="">-- Select --</option>
                <option value="Male" {{ old('gender')=='Male' ? 'selected' : '' }}>Male</option>
                <option value="Female" {{ old('gender')=='Female' ? 'selected' : '' }}>Female</option>
            </select>
        </div>

        <div class="form-group mb-3">
            <label for="grade_level">Grade Level</label>
            <input type="text" name="grade_level" class="form-control" value="{{ old('grade_level') }}" required>
        </div>

        <button type="submit" class="btn btn-primary">Add Student</button>
        <a href="{{ route('admin.students.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection
