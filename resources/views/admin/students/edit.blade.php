@extends('admin.layout.app')

@section('content')
<div class="container mt-3">
    <h1>Edit Student</h1>

    @if($errors->any())
        <div class="alert alert-danger">
            <ul>@foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>
        </div>
    @endif

    <form action="{{ route('admin.students.update', $student->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group mb-3">
            <label>Full Name</label>
            <input type="text" name="name" class="form-control" value="{{ old('name', $student->name) }}" required>
        </div>

        <div class="form-group mb-3">
            <label>Student Number</label>
            <input type="text" name="student_number" class="form-control" value="{{ old('student_number', $student->student_number) }}" required>
        </div>

        <div class="form-group mb-3">
            <label>Student ID (optional)</label>
            <input type="text" name="student_id" class="form-control" value="{{ old('student_id', $student->student_id) }}">
        </div>

        <div class="form-group mb-3">
            <label>Major (optional)</label>
            <input type="text" name="major" class="form-control" value="{{ old('major', $student->major) }}">
        </div>

        <div class="form-group mb-3">
            <label>Gender</label>
            <select name="gender" class="form-control" required>
                <option value="">-- Select --</option>
                <option value="M" {{ old('gender', $student->gender)=='M' ? 'selected' : '' }}>Male</option>
                <option value="F" {{ old('gender', $student->gender)=='F' ? 'selected' : '' }}>Female</option>
            </select>
        </div>

        <div class="form-group mb-3">
            <label>Grade Level</label>
            <input type="text" name="grade_level" class="form-control" value="{{ old('grade_level', $student->grade_level) }}" required>
        </div>

        <div class="form-group mb-3">
            <label>Password <small>(Leave blank to keep current)</small></label>
            <input type="password" name="password" class="form-control">
        </div>

        <div class="form-group mb-3">
            <label>Confirm Password</label>
            <input type="password" name="password_confirmation" class="form-control">
        </div>

        <input type="hidden" name="user_role" value="client">

        <button type="submit" class="btn btn-success">Update Student</button>
        <a href="{{ route('admin.students.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection
