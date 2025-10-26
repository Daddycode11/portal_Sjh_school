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
                <!-- ROW of Small Boxes (Stat boxes) -->
                <div class="row">
                    <div class="col-lg-3 col-6">
                        <div class="small-box bg-info">
                            <div class="inner">
                                <h3>{{ $students->count() }}</h3>
                                <p>Total Students</p>
                            </div>
                            <div class="icon">
                                <i class="fas fa-users"></i>
                            </div>
                            <a href="#studentList" class="small-box-footer">
                                View <i class="fas fa-arrow-circle-right"></i>
                            </a>
                        </div>
                    </div>

                    <div class="col-lg-3 col-6">
                        <div class="small-box bg-success">
                            <div class="inner">
                                <h3>{{ $subjects->count() }}</h3>
                                <p>Active Subjects</p>
                            </div>
                            <div class="icon">
                                <i class="fas fa-book"></i>
                            </div>
                            <a href="{{ route('admin.editGradingSystem', 1) }}" class="small-box-footer">
                                Manage Grading <i class="fas fa-arrow-circle-right"></i>
                            </a>
                        </div>
                    </div>

                    <div class="col-lg-3 col-6">
                        <div class="small-box bg-warning">
                            <div class="inner">
                                <h3>5</h3>
                                <p>Pending Registrations</p>
                            </div>
                            <div class="icon">
                                <i class="fas fa-user-clock"></i>
                            </div>
                            <a href="{{ route('admin.createStudent') }}" class="small-box-footer">
                                Add Student <i class="fas fa-arrow-circle-right"></i>
                            </a>
                        </div>
                    </div>

                    <div class="col-lg-3 col-6">
                        <div class="small-box bg-danger">
                            <div class="inner">
                                <h3>12</h3>
                                <p>Reports Generated</p>
                            </div>
                            <div class="icon">
                                <i class="fas fa-chart-bar"></i>
                            </div>
                            <a href="{{ route('admin.syllabi.index') }}" class="small-box-footer">
                                View Syllabi Uploads <i class="fas fa-arrow-circle-right"></i>
                            </a>
                        </div>
                    </div>
                </div>

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
                                            <th>Course</th>
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
                                            <td>{{ $student->course }}</td>
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

            </div>
        </section>
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
