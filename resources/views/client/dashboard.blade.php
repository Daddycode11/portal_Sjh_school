@extends('layouts.client')

@section('title', 'Student Dashboard')

@section('styles')
<style>
    body {
        font-family: 'Poppins', 'Roboto', sans-serif;
        background-color: #f3fff8; /* very light mint */
    }

    /* Header Bar */
    .card-header {
        background-color: #388E3C !important; /* medium green */
        color: #fff;
        font-weight: 600;
        border-top-left-radius: 12px !important;
        border-top-right-radius: 12px !important;
        box-shadow: 0 2px 4px rgba(0,0,0,0.15);
    }

    /* Dashboard Card Shades (light → dark) */
    .dashboard-card:nth-child(1) {
        background: linear-gradient(135deg, #A5D6A7, #81C784); /* light green */
    }
    .dashboard-card:nth-child(2) {
        background: linear-gradient(135deg, #81C784, #66BB6A); 
    }
    .dashboard-card:nth-child(3) {
        background: linear-gradient(135deg, #66BB6A, #4CAF50);
    }
    .dashboard-card:nth-child(4) {
        background: linear-gradient(135deg, #4CAF50, #388E3C); /* deeper green */
    }

    .dashboard-card {
        color: #fff;
        border-radius: 14px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.12);
        transition: 0.3s ease;
        min-height: 150px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 1.2rem;
    }

    .dashboard-card:hover {
        transform: translateY(-6px) scale(1.02);
        box-shadow: 0 12px 22px rgba(0,0,0,0.18);
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
        font-size: 2.2rem;
    }

    /* Button Accent */
    .btn-accent,
    .btn-success {
        background-color: #66BB6A !important;
        border-color: #66BB6A !important;
        color: #fff;
        border-radius: 30px;
        padding: 0.45rem 1.2rem;
        transition: 0.3s ease;
    }

    .btn-accent:hover,
    .btn-success:hover {
        background-color: #81C784 !important;
        border-color: #81C784 !important;
        color: #fff;
    }

    /* Table Hover */
    .table-hover tbody tr:hover {
        background-color: #e9f7ee;
    }

    /* Badge */
    .badge-unread {
        font-size: 0.7rem;
        vertical-align: top;
        margin-left: 5px;
    }

    /* Assessment Color Coding */
    .assessment-today {
        background-color: #d4edda !important;
    }
    .assessment-week {
        background-color: #fff3cd !important;
    }
    .assessment-later {
        background-color: #e2e3e5 !important;
    }
</style>

@endsection

@section('content')
<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800">Dashboard</h1>
<!-- Enroll Now Button -->
<div class="text-end mb-3">
    <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#enrollModal">
        📝 Enroll Now
    </button>
</div>

<!-- ENROLLMENT MODAL -->
<div class="modal fade @if($errors->any() || session('success')) show @endif" 
     id="enrollModal" tabindex="-1" 
     aria-labelledby="enrollModalLabel" 
     aria-hidden="{{ $errors->any() || session('success') ? 'false' : 'true' }}" 
     style="{{ $errors->any() || session('success') ? 'display:block;' : '' }}">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">📝 Enroll in Senior High School</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">

                @if(session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                    <script>
                        setTimeout(function(){
                            window.location.href = "{{ route('client.dashboard') }}";
                        }, 2000);
                    </script>
                @endif


                <form action="{{ route('test.student.enrollment.submit') }}" method="POST">
                    @csrf



                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif

                    @if(session('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            {{ session('error') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif

                    <div class="mb-3">
                        <label class="form-label">Grade Level</label>
                        <select name="grade_level" class="form-select" required>
                            <option value="Grade 11" {{ old('grade_level')=='Grade 11' ? 'selected' : '' }}>Grade 11</option>
                            <option value="Grade 12" {{ old('grade_level')=='Grade 12' ? 'selected' : '' }}>Grade 12</option>
                        </select>
                        @error('grade_level')<small class="text-danger">{{ $message }}</small>@enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Strand</label>
                        <select name="strand" class="form-select" required>
                            @foreach(['STEM','ABM','HUMSS','GAS','TVL'] as $strand)
                                <option value="{{ $strand }}" {{ old('strand')==$strand ? 'selected' : '' }}>{{ $strand }}</option>
                            @endforeach
                        </select>
                        @error('strand')<small class="text-danger">{{ $message }}</small>@enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Section (optional)</label>
                        <input type="text" name="section" class="form-control" value="{{ old('section') }}">
                        @error('section')<small class="text-danger">{{ $message }}</small>@enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Contact Number</label>
                        <input type="text" name="contact_number" class="form-control" value="{{ old('contact_number') }}" required>
                        @error('contact_number')<small class="text-danger">{{ $message }}</small>@enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Email Address</label>
                        <input type="email" name="email" class="form-control" value="{{ old('email', auth()->user()->email ?? '') }}" required>
                        @error('email')<small class="text-danger">{{ $message }}</small>@enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">School Year</label>
                        <input type="text" name="school_year" class="form-control" value="{{ old('school_year') }}" required>
                        @error('school_year')<small class="text-danger">{{ $message }}</small>@enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Semester</label>
                        <select name="semester" class="form-select" required>
                            <option value="1st" {{ old('semester')=='1st' ? 'selected' : '' }}>1st Semester</option>
                            <option value="2nd" {{ old('semester')=='2nd' ? 'selected' : '' }}>2nd Semester</option>
                        </select>
                        @error('semester')<small class="text-danger">{{ $message }}</small>@enderror
                    </div>

                    <button type="submit" class="btn btn-success">Submit Enrollment</button>
                </form>
            </div>
        </div>
    </div>
</div>


    <!-- Dashboard Cards -->
    <div class="row mb-4">
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="dashboard-card">
                <div>
                    <h6>Total Subjects</h6>
                    <h4 class="count-num">{{ $totalSubjects ?? 0 }}</h4>
                </div>
                <i class="fas fa-book dashboard-icon"></i>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="dashboard-card">
                <div>
                    <h6>Total Sections</h6>
                    <h4 class="count-num">{{ $totalSections ?? 0 }}</h4>
                </div>
                <i class="fas fa-users dashboard-icon"></i>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="dashboard-card">
                <div>
                    <h6>Unread Messages
                        @if(($unreadMessages ?? 0) > 0)
                            <span class="badge bg-danger badge-unread">{{ $unreadMessages }}</span>
                        @endif
                    </h6>
                    <h4 class="count-num">{{ $unreadMessages ?? 0 }}</h4>
                </div>
                <i class="fas fa-envelope dashboard-icon"></i>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="dashboard-card">
                <div>
                    <h6>Upcoming Assessments</h6>
                    <h4 class="count-num">{{ $upcomingAssessments->count() ?? 0 }}</h4>
                </div>
                <i class="fas fa-calendar dashboard-icon"></i>
            </div>
        </div>
    </div>

    <!-- Enrolled Classes & Upcoming Assessments -->
    <div class="row">
        <!-- Classes -->
        <div class="col-lg-6 mb-4">
            <div class="card shadow">
                <div class="card-header"><h6 class="m-0">My Classes</h6></div>
                <div class="card-body">
                    @if(isset($enrollments) && $enrollments->isNotEmpty())
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
                                        <td>{{ $enrollment->subject?->code ?? '-' }} - {{ $enrollment->subject?->name ?? '-' }}</td>
                                        <td>{{ $enrollment->section?->name ?? '-' }}</td>
                                        <td>{{ $enrollment->faculty?->name ?? '-' }}</td>
                                        <td>
                                            <a href="{{ route('client.classes.details', [
                                                'sectionId' => $enrollment->section_id ?? 0,
                                                'subjectId' => $enrollment->subject_id ?? 0,
                                                'schoolYear' => $enrollment->school_year ?? '',
                                                'semester' => $enrollment->semester ?? ''
                                            ]) }}" class="btn btn-sm btn-accent"><i class="fas fa-eye"></i> View</a>
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
                    @else
                        <p class="text-center">You are not enrolled in any classes.</p>
                    @endif
                </div>
            </div>
        </div>

        <!-- Upcoming Assessments -->
        <div class="col-lg-6 mb-4">
            <div class="card shadow">
                <div class="card-header"><h6 class="m-0">Upcoming Assessments</h6></div>
                <div class="card-body">
                    @if(isset($upcomingAssessments) && $upcomingAssessments->isNotEmpty())
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
                                        @php
                                            $today = now()->toDateString();
                                            $endOfWeek = now()->endOfWeek()->toDateString();
                                            if($assessment->schedule_date == $today) $rowClass = 'assessment-today';
                                            elseif($assessment->schedule_date <= $endOfWeek) $rowClass = 'assessment-week';
                                            else $rowClass = 'assessment-later';
                                        @endphp
                                        <tr class="{{ $rowClass }}">
                                            <td>{{ $assessment->subject?->code ?? '-' }}</td>
                                            <td>{{ $assessment->title ?? '-' }}</td>
                                            <td>{{ ucfirst(str_replace('_',' ',$assessment->type ?? '')) }}</td>
                                            <td>
                                                {{ $assessment->schedule_date ? date('M d, Y', strtotime($assessment->schedule_date)) : '-' }}
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
                    @else
                        <p class="text-center">No upcoming assessments scheduled.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<script>
    // Keep modal open if validation errors exist
    @if($errors->any())
        var myModal = new bootstrap.Modal(document.getElementById('enrollModal'));
        myModal.show();
    @endif

    // Count-up animation for cards
    document.querySelectorAll('.count-num').forEach(card => {
        let value = parseInt(card.innerText) || 0;
        let count = 0;
        let interval = setInterval(() => {
            card.innerText = count++;
            if(count > value) clearInterval(interval);
        }, 20);
    });
</script>
@endsection
