@extends('admin.layout.app')

@section('content')

<!-- GOOGLE FONT -->
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

<style>
    body, h1, h2, h3, h4, p, table, label, input, select, button {
        font-family: 'Poppins', sans-serif !important;
    }

    body {
        background: #F3FFF7; /* very light mint */
    }

    /* HEADER BAR */
    .page-title {
        background: #388E3C;
        color: white;
        padding: 18px 25px;
        border-radius: 10px;
        font-size: 26px;
        font-weight: 600;
        box-shadow: 0 2px 5px rgba(0,0,0,0.2);
        margin-bottom: 25px;
    }

    /* CARD STYLING */
    .card {
        border-radius: 14px !important;
        overflow: hidden;
        border: none;
        box-shadow: 0 5px 15px rgba(0,0,0,0.08);
    }

    .card-primary .card-header {
        background: linear-gradient(135deg, #66BB6A, #43A047);
        color: white;
        padding: 15px;
    }

    .card-secondary .card-header {
        background: linear-gradient(135deg, #81C784, #66BB6A);
        color: white;
        padding: 15px;
    }

    /* BUTTONS */
    .btn-primary {
        background: #66BB6A !important;
        border-color: #66BB6A !important;
        border-radius: 10px;
        padding: 10px 16px;
        font-weight: 500;
    }
    .btn-primary:hover {
        background: #81C784 !important;
        border-color: #81C784 !important;
    }

    .btn-info, .btn-warning, .btn-danger {
        border-radius: 10px !important;
    }

    /* TABLE */
    table th {
        background: #E8F5E9;
        color: #2E7D32;
        font-weight: 600;
    }
</style>

<div class="container mt-3">

    <div class="page-title">Faculty Assignments</div>

    {{-- Show validation errors & success messages --}}
    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
            @foreach($errors->all() as $err)
                <li>{{ $err }}</li>
            @endforeach
            </ul>
        </div>
    @endif

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <!-- Assignment creation form -->
    <div class="card card-primary mb-4">
        <div class="card-header">
            <h3 class="card-title">Assign Faculty to a Section & Subject</h3>
        </div>

        <form action="{{ route('admin.assignments.store') }}" method="POST">
            @csrf
            <div class="card-body">

                <!-- Faculty -->
                <div class="form-group mb-3">
                    <label for="faculty_id">Select Faculty</label>
                    <select name="faculty_id" id="faculty_id" class="form-control" required>
                        <option value="">-- Choose Faculty --</option>
                        @foreach($faculty as $f)
                            <option value="{{ $f->id }}">{{ $f->name }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Section Name -->
                <div class="form-group mb-3">
                    <label for="section_name">Section Name</label>
                    <input type="text" name="section_name" id="section_name"
                           class="form-control" required>
                </div>

                <!-- Subject Dropdown -->
                <div class="form-group mb-3">
                    <label for="subject_id">Select Subject</label>
                    <select name="subject_id" id="subject_id" class="form-control" required>
                        <option value="">-- Choose Subject --</option>
                        @foreach($subjects as $subj)
                            <option value="{{ $subj->id }}">{{ $subj->name }}</option>
                        @endforeach
                    </select>
                    <small>
                        <a href="{{ route('admin.subjects.create') }}">
                            Add New Subject
                        </a>
                    </small>
                </div>

                <!-- School Year -->
                <div class="form-group mb-3">
                    <label for="school_year">School Year</label>
                    <input type="text" name="school_year" id="school_year"
                           class="form-control" placeholder="e.g. 2025-2026"
                           required>
                </div>

                <!-- Semester -->
                <div class="form-group mb-3">
                    <label for="semester">Semester</label>
                    <select name="semester" id="semester" class="form-control" required>
                        <option value="">-- Choose Semester --</option>
                        <option value="First">First</option>
                        <option value="Second">Second</option>
                        <option value="Summer">Summer</option>
                    </select>
                </div>

            </div>

            <div class="card-footer">
                <button class="btn btn-primary" type="submit">Assign Faculty</button>
            </div>
        </form>
    </div>

    <!-- List of existing assignments -->
    <div class="card card-secondary">
        <div class="card-header">
            <h3 class="card-title">Current Assignments</h3>
        </div>

        <div class="card-body p-0">
            <table class="table table-bordered mb-0">
                <thead>
                <tr>
                    <th>Faculty</th>
                    <th>Section</th>
                    <th>Subject</th>
                    <th>School Year</th>
                    <th>Semester</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                @forelse($assignments as $assign)
                    <tr>
                        <td>{{ $assign->faculty_name }}</td>
                        <td>{{ $assign->section_name }}</td>
                        <td>{{ $assign->subject_name }}</td>
                        <td>{{ $assign->school_year }}</td>
                        <td>{{ $assign->semester }}</td>
                        <td>
                            <a href="{{ route('admin.assignments.facultyClasses', $assign->faculty_id) }}"
                               class="btn btn-sm btn-info">View Classes</a>

                            <a href="{{ route('admin.sections.showStudents', $assign->section_id) }}"
                               class="btn btn-sm btn-warning">Add Students</a>

                            <form action="{{ route('admin.assignments.delete', $assign->id) }}"
                                  method="POST" style="display:inline-block">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-danger"
                                    onclick="return confirm('Are you sure?')">
                                    Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center">No assignments found.</td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>

</div>
@endsection
