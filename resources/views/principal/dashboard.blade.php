@extends('principal.layout.app')

@section('content')
<div class="row">
    <!-- Students -->
    <div class="col-lg-3 col-6">
        <div class="small-box bg-info">
            <div class="inner">
                <h3>{{ $totalStudents }}</h3>
                <p>Total Students</p>
            </div>
            <div class="icon"><i class="fas fa-user-graduate"></i></div>
        </div>
    </div>

    <!-- Teachers -->
    <div class="col-lg-3 col-6">
        <div class="small-box bg-success">
            <div class="inner">
                <h3>{{ $totalTeachers }}</h3>
                <p>Total Teachers</p>
            </div>
            <div class="icon"><i class="fas fa-chalkboard-teacher"></i></div>
        </div>
    </div>

    <!-- Sections -->
    <div class="col-lg-3 col-6">
        <div class="small-box bg-warning">
            <div class="inner">
                <h3>{{ $totalSections }}</h3>
                <p>Total Sections</p>
            </div>
            <div class="icon"><i class="fas fa-layer-group"></i></div>
        </div>
    </div>

    <!-- Subjects -->
    <div class="col-lg-3 col-6">
        <div class="small-box bg-danger">
            <div class="inner">
                <h3>{{ $totalSubjects }}</h3>
                <p>Total Subjects</p>
            </div>
            <div class="icon"><i class="fas fa-book"></i></div>
        </div>
    </div>
</div>

<div class="row mt-4">
    <div class="col-md-6">
        <div class="card card-primary">
            <div class="card-header"><h3 class="card-title">📊 School Performance Overview</h3></div>
            <div class="card-body">
                <p>Includes attendance, grades, and behavior summaries.</p>
                <a href="#" class="btn btn-primary btn-sm">View Details</a>
            </div>
        </div>
    </div>

    <div class="col-md-6">
        <div class="card card-success">
            <div class="card-header"><h3 class="card-title">📈 Reports Generator</h3></div>
            <div class="card-body">
                <p>Generate automated reports per quarter or school year.</p>
                <a href="#" class="btn btn-success btn-sm">Generate Report</a>
            </div>
        </div>
    </div>
</div>

<div class="row mt-4">
    <div class="col-md-6">
        <div class="card card-warning">
            <div class="card-header"><h3 class="card-title">📅 School Calendar & Events</h3></div>
            <div class="card-body">
                <p>Manage and schedule academic events and activities.</p>
                <a href="#" class="btn btn-warning btn-sm">Open Calendar</a>
            </div>
        </div>
    </div>

    <div class="col-md-6">
        <div class="card card-info">
            <div class="card-header"><h3 class="card-title">💬 Internal Messaging System</h3></div>
            <div class="card-body">
                <p>Communicate with faculty and students in real time.</p>
                <a href="#" class="btn btn-info btn-sm">Open Messages</a>
            </div>
        </div>
    </div>
</div>
@endsection
