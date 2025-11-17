@extends('layouts.client')
@section('title', 'My Grades')

@section('content')
<div class="container py-5">
    <h2 class="text-success mb-4"><i class="fas fa-graduation-cap"></i> My Grades</h2>

    <div class="card shadow-sm">
        <div class="card-body table-responsive">
            <table class="table table-striped">
                <thead class="bg-success text-white">
                    <tr>
                        <th>#</th>
                        <th>Subject Code</th>
                        <th>Subject Name</th>
                        <th>Section</th>
                        <th>Faculty</th>
                        <th>Midterm</th>
                        <th>Final</th>
                        <th>Overall</th>
                        <th>School Year</th>
                        <th>Semester</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($subjectGrades as $index => $grade)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $grade['subject_code'] }}</td>
                        <td>{{ $grade['subject_name'] }}</td>
                        <td>{{ $grade['section_name'] }}</td>
                        <td>{{ $grade['faculty_name'] }}</td>
                        <td>{{ $grade['midterm_grade'] }}</td>
                        <td>{{ $grade['final_grade'] }}</td>
                        <td>
                            <span class="badge {{ $grade['overall_grade'] >= 75 ? 'bg-success' : 'bg-danger' }}">
                                {{ $grade['overall_grade'] }}
                            </span>
                        </td>
                        <td>{{ $grade['school_year'] }}</td>
                        <td>{{ $grade['semester'] }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="card-footer text-center">
            <strong>GPA:</strong> {{ number_format($gpa, 2) }} |
            <strong>Passed:</strong> {{ $passingCount }}/{{ $totalSubjects }}
        </div>
    </div>
</div>
@endsection
