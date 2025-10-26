@extends('layouts.client')

@section('title', 'Student Dashboard')

@section('styles')
<style>
    /* ===== Dashboard Green Theme ===== */
    body {
        font-family: 'Poppins', 'Roboto', sans-serif;
        background-color: #f5fff5; /* very light mint background */
    }

    /* Dashboard Cards */
    .dashboard-card {
        background-color: #4CAF50; /* primary green */
        color: #fff;
        border: none;
        border-radius: 12px;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        transition: all 0.3s ease;
        min-height: 150px;
    }

    .dashboard-card:hover {
        transform: translateY(-5px);
        background-color: #43A047; /* slightly darker green on hover */
        box-shadow: 0 8px 16px rgba(0, 0, 0, 0.15);
    }

    .dashboard-card h6 {
        text-transform: uppercase;
        font-size: 0.85rem;
        letter-spacing: 0.5px;
        color: #E8F5E9;
        font-weight: 500;
    }

    .dashboard-card h4 {
        font-weight: 700;
        color: #fff;
    }

    .dashboard-icon {
        opacity: 0.9;
        color: #ffffff;
    }

    /* Accent Button */
    .btn-accent {
        background-color: #4CAF50;
        color: #fff;
        border-radius: 30px;
        transition: all 0.3s ease;
    }

    .btn-accent:hover {
        background-color: #43A047;
        color: #fff;
    }

    /* Card Headers */
    .card-header {
        background-color: #4CAF50;
        color: #fff;
        font-weight: 600;
        border-top-left-radius: 12px !important;
        border-top-right-radius: 12px !important;
    }

    /* Table Hover Effect */
    .table-hover tbody tr:hover {
        background-color: #e8f5e9;
    }
</style>
@endsection

@section('content')
<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800">Dashboard</h1>

    <!-- Dashboard Cards -->
    <div class="row">
        <!-- Total Subjects -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card dashboard-card d-flex align-items-center justify-content-between px-3 py-3">
                <div class="w-100 d-flex justify-content-between align-items-center">
                    <div>
                        <h6>Total Subjects</h6>
                        <h4>{{ $totalSubjects }}</h4>
                    </div>
                    <i class="fas fa-book fa-2x dashboard-icon"></i>
                </div>
            </div>
        </div>

        <!-- Total Sections -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card dashboard-card d-flex align-items-center justify-content-between px-3 py-3">
                <div class="w-100 d-flex justify-content-between align-items-center">
                    <div>
                        <h6>Total Sections</h6>
                        <h4>{{ $totalSections }}</h4>
                    </div>
                    <i class="fas fa-users fa-2x dashboard-icon"></i>
                </div>
            </div>
        </div>

        <!-- Unread Messages -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card dashboard-card d-flex align-items-center justify-content-between px-3 py-3">
                <div class="w-100 d-flex justify-content-between align-items-center">
                    <div>
                        <h6>Unread Messages</h6>
                        <h4>{{ $unreadMessages }}</h4>
                    </div>
                    <i class="fas fa-envelope fa-2x dashboard-icon"></i>
                </div>
            </div>
        </div>

        <!-- Upcoming Assessments -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card dashboard-card d-flex align-items-center justify-content-between px-3 py-3">
                <div class="w-100 d-flex justify-content-between align-items-center">
                    <div>
                        <h6>Upcoming Assessments</h6>
                        <h4>{{ $upcomingAssessments->count() }}</h4>
                    </div>
                    <i class="fas fa-calendar fa-2x dashboard-icon"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Enrolled Classes & Upcoming Assessments -->
    <div class="row">
        <div class="col-lg-6 mb-4">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0">My Classes</h6>
                </div>
                <div class="card-body">
                    @if($enrollments->isEmpty())
                        <p class="text-center">You are not enrolled in any classes.</p>
                    @else
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>Subject</th>
                                        <th>Section</th>
                                        <th>Teacher</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($enrollments->take(5) as $enrollment)
                                    <tr>
                                        <td>{{ $enrollment->subject_code }} - {{ $enrollment->subject_name }}</td>
                                        <td>{{ $enrollment->section_name }}</td>
                                        <td>{{ $enrollment->faculty_name }}</td>
                                        <td>
                                            <a href="{{ route('client.classes.details', [
                                                'sectionId' => $enrollment->section_id,
                                                'subjectId' => $enrollment->subject_id,
                                                'schoolYear' => $enrollment->school_year,
                                                'semester' => $enrollment->semester
                                            ]) }}" class="btn btn-sm btn-accent">
                                                <i class="fas fa-eye"></i> View
                                            </a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        @if($enrollments->count() > 5)
                        <div class="text-center mt-3">
                            <a href="{{ route('client.classes.index') }}" class="btn btn-link">View All Classes</a>
                        </div>
                        @endif
                    @endif
                </div>
            </div>
        </div>

        <!-- Upcoming Assessments Table -->
        <div class="col-lg-6 mb-4">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0">Upcoming Assessments</h6>
                </div>
                <div class="card-body">
                    @if($upcomingAssessments->isEmpty())
                        <p class="text-center">No upcoming assessments scheduled.</p>
                    @else
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>Subject</th>
                                        <th>Title</th>
                                        <th>Type</th>
                                        <th>Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($upcomingAssessments->take(5) as $assessment)
                                    <tr>
                                        <td>{{ $assessment->subject_code }}</td>
                                        <td>{{ $assessment->title }}</td>
                                        <td>{{ ucfirst(str_replace('_', ' ', $assessment->type)) }}</td>
                                        <td>
                                            {{ date('M d, Y', strtotime($assessment->schedule_date)) }}
                                            @if($assessment->schedule_time)
                                                <br>{{ date('h:i A', strtotime($assessment->schedule_time)) }}
                                            @endif
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        @if($upcomingAssessments->count() > 5)
                        <div class="text-center mt-3">
                            <a href="{{ route('client.schedules.index') }}" class="btn btn-link">View All Schedules</a>
                        </div>
                        @endif
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Scores -->
    <div class="row">
        <div class="col-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex justify-content-between align-items-center">
                    <h6 class="m-0">Recent Scores</h6>
                    <a href="{{ route('client.grades.index') }}" class="btn btn-sm btn-accent">View All Grades</a>
                </div>
                <div class="card-body">
                    @if($recentScores->isEmpty())
                        <p class="text-center">No recent scores available.</p>
                    @else
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>Subject</th>
                                        <th>Assessment</th>
                                        <th>Type</th>
                                        <th>Score</th>
                                        <th>Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($recentScores as $score)
                                    <tr>
                                        <td>{{ $score->subject_code }}</td>
                                        <td>{{ $score->assessment_title }}</td>
                                        <td>{{ ucfirst(str_replace('_', ' ', $score->assessment_type)) }}</td>
                                        <td>{{ $score->score }} / {{ $score->max_score }}
                                            ({{ round(($score->score / $score->max_score) * 100, 2) }}%)</td>
                                        <td>{{ date('M d, Y', strtotime($score->created_at)) }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
