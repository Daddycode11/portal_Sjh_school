@extends('admin.layout.app')

@section('content')

<!-- Google Font -->
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

<style>
    body, h1, h2, h3, h4, h5, h6, table, label, p, td, th {
        font-family: 'Poppins', sans-serif !important;
    }

    body {
        background: #F3FFF7; /* light mint */
    }

    /* Page Title */
    .page-title {
        background: #388E3C;
        color: white;
        padding: 16px 24px;
        border-radius: 12px;
        font-size: 24px;
        font-weight: 600;
        box-shadow: 0 3px 6px rgba(0,0,0,0.2);
        margin-bottom: 25px;
    }

    /* Summary Cards */
    .summary-card {
        border: none;
        border-radius: 16px;
        box-shadow: 0 6px 15px rgba(0,0,0,0.12);
        color: white;
    }

    /* Data Table */
    .table th {
        background: #E8F5E9 !important;
        color: #2E7D32 !important;
        font-weight: 600;
    }

    .table-striped tbody tr:nth-of-type(odd) {
        background: #F9FFFB !important;
    }

    .card {
        border-radius: 16px !important;
        border: none;
    }

</style>

<div class="container mt-4">

  <div class="page-title">📊 Grading System Overview</div>

  <!-- Summary Cards Row -->
  <div class="row mb-4">

    <!-- Total Subjects -->
    <div class="col-md-4 mb-3">
      <div class="card summary-card text-center" 
           style="background: linear-gradient(135deg, #66BB6A, #43A047);">
        <div class="card-body">
          <h6 class="card-title mb-2">Total Subjects with Grading System</h6>
          <h2 class="fw-bold">{{ $totalSubjects }}</h2>
        </div>
      </div>
    </div>

    <!-- Average Quiz Percentage -->
    <div class="col-md-4 mb-3">
      <div class="card summary-card text-center"
           style="background: linear-gradient(135deg, #81C784, #66BB6A);">
        <div class="card-body">
          <h6 class="card-title mb-2">Average Quiz Percentage</h6>
          <h2 class="fw-bold">{{ $averageQuizPercentage }}%</h2>
        </div>
      </div>
    </div>

    <!-- Active Semester -->
    <div class="col-md-4 mb-3">
      <div class="card summary-card text-center"
           style="background: linear-gradient(135deg, #43A047, #2E7D32);">
        <div class="card-body">
          <h6 class="card-title mb-2">Active Semester</h6>
          <h2 class="fw-bold">{{ $activeSemester }}</h2>
        </div>
      </div>
    </div>

  </div>

  <!-- Data Table -->
  <div class="card shadow-sm">
    <div class="card-body">
      <h5 class="card-title mb-3" style="font-weight: 600;">Detailed Grading System Table</h5>

      <div class="table-responsive">
        <table class="table table-bordered table-striped align-middle">
          <thead>
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
