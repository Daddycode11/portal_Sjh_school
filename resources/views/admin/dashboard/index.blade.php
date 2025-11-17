@include('admin.layout.header')

<head>
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&family=Roboto:wght@400;500&display=swap" rel="stylesheet">

    <style>
        /* 🌱 General Page Styling */
        body {
            background-color: #f4fff7; /* light mint */
            font-family: 'Poppins', 'Roboto', sans-serif;
        }

        /* 🌳 Header Bar */
        .main-header.navbar {
            background-color: #388E3C !important; /* Medium green */
            color: #fff;
            box-shadow: 0 3px 8px rgba(0, 0, 0, 0.15);
        }

        .main-header .nav-link,
        .main-header .navbar-brand {
            color: #ffffff !important;
        }

        /* 🌈 Dashboard Cards (Green Gradient Tones) */
        .small-box {
            border-radius: 15px !important;
            color: #fff !important;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .small-box:hover {
            transform: translateY(-6px);
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.15);
        }

        .small-box.bg-info {
            background: linear-gradient(135deg, #A5D6A7, #66BB6A);
        }

        .small-box.bg-success {
            background: linear-gradient(135deg, #81C784, #43A047);
        }

        .small-box.bg-warning {
            background: linear-gradient(135deg, #C8E6C9, #66BB6A);
            color: #2E7D32 !important;
        }

        .small-box.bg-danger {
            background: linear-gradient(135deg, #A5D6A7, #2E7D32);
        }

        /* 📦 Card Styling */
        .card {
            border: none !important;
            border-radius: 15px !important;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
            background-color: #ffffff;
        }

        .card-header {
            background: #e8f5e9;
            border-bottom: none;
            border-radius: 15px 15px 0 0;
        }

        .card-title {
            color: #2e7d32;
            font-weight: 600;
        }

        /* 💚 Buttons */
        .btn-primary {
            background-color: #66BB6A !important;
            border-color: #66BB6A !important;
            border-radius: 25px !important;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            background-color: #81C784 !important;
            border-color: #81C784 !important;
            transform: scale(1.05);
        }

        .btn-danger {
            border-radius: 25px !important;
            transition: 0.3s;
        }

        .btn-danger:hover {
            transform: scale(1.05);
        }

        /* 🧾 Tables */
        table.dataTable {
            border-radius: 10px;
            overflow: hidden;
        }

        thead {
            background: #a5d6a7;
            color: #1b5e20;
        }

        /* ⚡ Footer link style for small boxes */
        .small-box-footer {
            background-color: rgba(255, 255, 255, 0.25);
            color: #fff !important;
            border-radius: 0 0 15px 15px;
            transition: background 0.3s ease;
        }

        .small-box-footer:hover {
            background-color: rgba(255, 255, 255, 0.4);
        }

        /* 📱 Responsive Adjustments */
        @media (max-width: 768px) {
            .small-box {
                margin-bottom: 1rem;
            }
        }
    </style>
</head>

<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">
    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#" role="button">
                    <i class="fas fa-bars"></i>
                </a>
            </li>
        </ul>
    </nav>
    <!-- /.navbar -->

   @include('admin.layout.sidebar')

<!-- Content Wrapper -->
<div class="content-wrapper">

    <!-- Content Header -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Admin Dashboard</h1>
                </div>
            </div>
        </div>
    </div>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">

            <!-- STAT BOXES -->
            <div class="row">

                <!-- Total Enrollments -->
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3>{{ $totalEnrollments }}</h3>
                            <p>Total Enrollments</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-users"></i>
                        </div>
                        <a href="{{ route('admin.enrollments.index') }}" class="small-box-footer">
                            View All <i class="fas fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>

                <!-- Approved Enrollments -->
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-success">
                        <div class="inner">
                            <h3>{{ $approved }}</h3>
                            <p>Approved Enrollments</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-check-circle"></i>
                        </div>
                        <a href="{{ route('admin.enrollments.index') }}" class="small-box-footer">
                            View Approved <i class="fas fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>

                <!-- Pending Enrollment Requests -->
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-warning">
                        <div class="inner">
                            <h3>{{ $pending }}</h3>
                            <p>Pending Enrollment Requests</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-user-clock"></i>
                        </div>
                        <a href="{{ route('admin.enrollments.requests') }}" class="small-box-footer">
                            View Requests <i class="fas fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>

                <!-- Rejected Enrollments -->
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-danger">
                        <div class="inner">
                            <h3>{{ $rejected }}</h3>
                            <p>Rejected Enrollments</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-times-circle"></i>
                        </div>
                        <a href="{{ route('admin.enrollments.index') }}" class="small-box-footer">
                            View Rejected <i class="fas fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>

            </div>
            <!-- END ROW -->


                <!-- STUDENT LIST -->
                <div class="row" id="studentList">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header d-flex align-items-center justify-content-between">
                                <h3 class="card-title">Student List</h3>
                                <a href="{{ route('admin.createStudent') }}" class="btn btn-sm btn-primary">
                                    <i class="fas fa-user-plus"></i> Add Student
                                </a>
                            </div>
                            <div class="card-body">
                                <table id="studentTable" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Student Number</th>
                                            <th>Major</th>
                                            <th>Sex</th>
                                    <!--         <th>Course</th> -->
                                            <th>Year</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($students as $student)
                                        <tr>
                                            <td>{{ $student->name }}</td>
                                            <td>{{ $student->student_number }}</td>
                                            <td>{{ $student->major }}</td>
                                            <td>{{ $student->sex }}</td>
                                          <!--   <td>{{ $student->course }}</td> -->
                                            <td>{{ $student->year }}</td>
                                            <td>
                                                <form action="{{ route('admin.deleteStudent', $student->id) }}"
                                                      method="POST"
                                                      style="display:inline-block"
                                                      onsubmit="return confirm('Are you sure?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="btn btn-sm btn-danger">
                                                        <i class="fas fa-trash-alt"></i> Remove
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- SUBJECT LIST -->
                <div class="row mt-4">
                    <div class="col-12">
                        <div class="card card-info">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <h3 class="card-title">Subject List</h3>
                                <a href="{{ route('admin.subjects.create') }}" class="btn btn-sm btn-primary">
                                   <i class="fas fa-plus"></i> Add Subject
                                </a>
                            </div>
                            <div class="card-body">
                                @if(isset($subjects) && count($subjects) > 0)
                                    <table id="subjectTable" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Subject Name</th>
                                                <th>Code</th>
                                                <th>Units</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($subjects as $subj)
                                            <tr>
                                                <td>{{ $subj->id }}</td>
                                                <td>{{ $subj->name }}</td>
                                                <td>{{ $subj->code ?? 'N/A' }}</td>
                                                <td>{{ $subj->units ?? 'N/A' }}</td>
                                                <td>
                                                    <a href="{{ route('admin.editGradingSystem', $subj->id) }}" class="btn btn-sm btn-info">Update Grading</a>
                                                    <a href="{{ route('admin.subjects.edit', $subj->id) }}" class="btn btn-sm btn-warning">Edit Subject</a>
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                @else
                                    <p>No subjects found.</p>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

  
   <!-- STUDENT ENROLLMENTS TABLE -->
<div class="row mt-4">
    <div class="col-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h3 class="card-title">📄 Student Enrollments</h3>
                <div>
                    <a href="{{ route('admin.enrollments.index') }}" class="btn btn-primary">
                        All Enrollments
                    </a>
                    <a href="{{ route('admin.enrollments.requests') }}" class="btn btn-warning">
                        Pending Enrollments
                        <span class="badge bg-light text-dark">{{ $pending ?? 0 }}</span>
                    </a>
                </div>
            </div>
            <div class="card-body">
                @if(session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Student Name</th>
                            <th>Grade Level</th>
                            <th>Strand</th>
                            <th>Section</th>
                            <th>Contact</th>
                            <th>Email</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($enrollments as $enrollment)
                            @php
                                $statusClass = match($enrollment->status ?? '') {
                                    'Pending' => 'bg-warning text-dark',
                                    'Approved' => 'bg-success',
                                    'Rejected' => 'bg-danger',
                                    default => 'bg-secondary'
                                };
                            @endphp
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $enrollment->student_name ?? '-' }}</td>
                                <td>{{ $enrollment->grade_level ?? '-' }}</td>
                                <td>{{ $enrollment->strand ?? '-' }}</td>
                                <td>{{ $enrollment->section ?? '-' }}</td>
                                <td>{{ $enrollment->contact_number ?? '-' }}</td>
                                <td>{{ $enrollment->email ?? '-' }}</td>
                                <td>
                                    <span class="badge {{ $statusClass }}">{{ $enrollment->status ?? 'N/A' }}</span>
                                </td>
                                <td>
                                    @if(($enrollment->status ?? '') === 'Pending')
                                        <form action="{{ route('admin.enrollments.approve', $enrollment->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            <button class="btn btn-sm btn-success" onclick="return confirm('Approve this enrollment?')">Approve</button>
                                        </form>
                                        <form action="{{ route('admin.enrollments.reject', $enrollment->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            <button class="btn btn-sm btn-danger" onclick="return confirm('Reject this enrollment?')">Reject</button>
                                        </form>
                                    @else
                                        <span class="text-muted">-</span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="9" class="text-center">No enrollments found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>


    @include('admin.layout.footer')
</div>

<!-- Scripts -->
<script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/js/adminlte.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap4.min.js"></script>

<script>
    $(function() {
        $('#studentTable').DataTable();
        $('#subjectTable').DataTable();
    });
</script>
</body>
</html>
