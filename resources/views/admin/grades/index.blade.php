@extends('admin.layout.app')


@section('content')
<div class="container mt-4">

  <h4 class="mb-4">📊 Grading System Overview</h4>

  <!-- Summary Cards Row -->
  <div class="row mb-4">
    <!-- Total Subjects -->
    <div class="col-md-4">
      <div class="card text-center shadow-sm border-0" style="background: linear-gradient(135deg, #66BB6A, #43A047); color: white;">
        <div class="card-body">
          <h6 class="card-title">Total Subjects with Grading System</h6>
          <h2 class="fw-bold">{{ $totalSubjects }}</h2>
        </div>
      </div>
    </div>

    <!-- Average Quiz Percentage -->
    <div class="col-md-4">
      <div class="card text-center shadow-sm border-0" style="background: linear-gradient(135deg, #42A5F5, #1E88E5); color: white;">
        <div class="card-body">
          <h6 class="card-title">Average Quiz Percentage</h6>
          <h2 class="fw-bold">{{ $averageQuizPercentage }}%</h2>
        </div>
      </div>
    </div>

    <!-- Active Semester -->
    <div class="col-md-4">
      <div class="card text-center shadow-sm border-0" style="background: linear-gradient(135deg, #FFA726, #FB8C00); color: white;">
        <div class="card-body">
          <h6 class="card-title">Active Semester</h6>
          <h2 class="fw-bold">{{ $activeSemester }}</h2>
        </div>
      </div>
    </div>
  </div>

  <!-- Data Table -->
  <div class="card shadow-sm">
    <div class="card-body">
      <h5 class="card-title mb-3">Detailed Grading System Table</h5>
      <div class="table-responsive">
        <table class="table table-bordered table-striped align-middle">
          <thead class="table-dark">
            <tr>
              <th>#</th>
              <th>Subject</th>
              <th>Quiz %</th>
              <th>Unit Test %</th>
              <th>Activity %</th>
              <th>Exam %</th>
              <th>School Year</th>
              <th>Semester</th>
            </tr>
          </thead>
          <tbody>
            @forelse ($gradings as $grading)
            <tr>
              <td>{{ $loop->iteration }}</td>
              <td>{{ $grading->subject->name ?? 'N/A' }}</td>
              <td>{{ $grading->quiz_percentage }}%</td>
              <td>{{ $grading->unit_test_percentage }}%</td>
              <td>{{ $grading->activity_percentage }}%</td>
              <td>{{ $grading->exam_percentage }}%</td>
              <td>{{ $grading->school_year }}</td>
              <td>{{ $grading->semester }}</td>
            </tr>
            @empty
            <tr>
              <td colspan="8" class="text-center">No grading data available.</td>
            </tr>
            @endforelse
          </tbody>
        </table>
      </div>
    </div>
  </div>

</div>
@endsection