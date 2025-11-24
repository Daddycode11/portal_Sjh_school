usePointStyle: true,

@include('admin.layout.header')

<head>
<!-- Bootstrap JS Bundle (includes Popper) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

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
                        <a href="" class="small-box-footer">
                           Total View All <i class="fas fa-arrow-circle-right"></i>
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
                        <a href="" class="small-box-footer">
                            All Approved <i class="fas fa-arrow-circle-right"></i>
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
                        <a href="" class="small-box-footer">
                            All Requests <i class="fas fa-arrow-circle-right"></i>
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
                        <a href="" class="small-box-footer">
                            All Rejected <i class="fas fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>

            </div>
            <!-- END ROW -->

            <!-- CHARTS ROW -->
            <div class="row mt-4">
                <!-- Enrollment Status Pie Chart -->
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Enrollment Status Distribution</h3>
                        </div>
                        <div class="card-body">
                            <canvas id="enrollmentPieChart" style="height:260px;"></canvas>
                        </div>
                    </div>
                </div>

                <!-- Enrollment Trends Bar Chart -->
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Enrollment Trends</h3>
                        </div>
                        <div class="card-body">
                            <canvas id="enrollmentBarChart" style="height:260px;"></canvas>
                        </div>
                    </div>
                </div>
            </div>

            <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    // common minimal styling
                    const subtleText = '#6b7280';
                    const bg = 'transparent';

                    // Pie Chart - Enrollment Status (minimal / clean)
                    const ctxPie = document.getElementById('enrollmentPieChart').getContext('2d');
                    new Chart(ctxPie, {
                        type: 'doughnut',
                        data: {
                            labels: ['Approved', 'Pending', 'Rejected'],
                            datasets: [{
                                data: [{{ $approved }}, {{ $pending }}, {{ $rejected }}],
                                backgroundColor: ['#81C784', '#FFD54F', '#E57373'],
                                borderColor: [bg, bg, bg],
                                borderWidth: 0,
                                hoverOffset: 10
                            }]
                        },
                        options: {
                            maintainAspectRatio: false,
                            cutout: '60%',
                            plugins: {
                                legend: {
                                    display: true,
                                    position: 'bottom',
                                    labels: {
                                        color: subtleText,
                                        padding: 12,
                                        boxWidth: 10
                                    }
                                },
                                tooltip: {
                                    enabled: true,
                                    backgroundColor: '#111827',
                                    titleColor: '#ffffff',
                                    bodyColor: '#f3f4f6',
                                    callbacks: {
                                        label: function(context) {
                                            return context.label + ': ' + context.parsed;
                                        }
                                    }
                                }
                            }
                        }
                    });

                    // Bar Chart - Enrollment Trends (minimal / clean)
                    const ctxBar = document.getElementById('enrollmentBarChart').getContext('2d');
                    new Chart(ctxBar, {
                        type: 'bar',
                        data: {
                            labels: ['Total', 'Approved', 'Pending', 'Rejected'],
                            datasets: [{
                                label: 'Enrollments',
                                data: [{{ $totalEnrollments }}, {{ $approved }}, {{ $pending }}, {{ $rejected }}],
                                backgroundColor: ['#66BB6A', '#81C784', '#FFD54F', '#E57373'],
                                borderColor: ['#66BB6A', '#66BB6A', '#FBC02D', '#EF5350'],
                                borderWidth: 0,
                                borderRadius: 8,
                                maxBarThickness: 40
                            }]
                        },
                        options: {
                            maintainAspectRatio: false,
                            plugins: {
                                legend: { display: false },
                                tooltip: {
                                    enabled: true,
                                    backgroundColor: '#111827',
                                    titleColor: '#ffffff',
                                    bodyColor: '#f3f4f6'
                                }
                            },
                            scales: {
                                x: {
                                    grid: { display: false, drawBorder: false },
                                    ticks: { color: subtleText }
                                },
                                y: {
                                    beginAtZero: true,
                                    grid: {
                                        color: 'rgba(15, 23, 42, 0.04)',
                                        drawBorder: false
                                    },
                                    ticks: {
                                        color: subtleText,
                                        precision: 0
                                    }
                                }
                            },
                            layout: {
                                padding: { top: 6, bottom: 6, left: 6, right: 6 }
                            }
                        }
                    });
                });
            </script>

<!-- STUDENT LIST -->
       <div class="row" id="studentList">
    <div class="col-12">
        <div class="card">
            <div class="card-header d-flex align-items-center justify-content-between">
                <h3 class="card-title">Student List</h3>
                <a href="{{ route('admin.students.create') }}" class="btn btn-sm btn-primary">
                    <i class="fas fa-user-plus"></i> Add Student
                </a>
            </div>
            <div class="card-body">
                <table id="studentTable" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Student ID</th>
                            <th>Major</th>
                            <th>Gender</th>
                            <th>Grade Level</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach ($students as $student)
                        <tr>
                            <td>{{ $student->name }}</td>
                            <td>{{ $student->student_id }}</td>
                            <td>{{ $student->major }}</td>
                            <td>{{ $student->gender }}</td>
                            <td>{{ $student->grade_level }}</td>
                            <td>
                                <!-- Edit Button triggers modal -->
                                <button type="button" class="btn btn-sm btn-warning edit-btn" 
                                        data-bs-toggle="modal" 
                                        data-bs-target="#editModal"
                                        data-id="{{ $student->id }}"
                                        data-name="{{ $student->name }}"
                                        data-student_number="{{ $student->student_number }}"
                                        data-major="{{ $student->major }}"
                                        data-sex="{{ $student->sex }}"
                                        data-year="{{ $student->year }}">
                                    <i class="fas fa-edit"></i> Edit
                                </button>

                                <!-- Delete Button triggers modal -->
                                <button type="button" class="btn btn-sm btn-danger delete-btn" 
                                        data-bs-toggle="modal" 
                                        data-bs-target="#deleteModal"
                                        data-id="{{ $student->id }}"
                                        data-name="{{ $student->name }}">
                                    <i class="fas fa-trash-alt"></i> Remove
                                </button>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Reusable Edit Modal -->
<div class="modal fade" id="editModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog">
    <form id="editForm" method="POST">
      @csrf
      @method('PUT')
      <div class="modal-content">
        <div class="modal-header bg-warning text-white">
          <h5 class="modal-title">Edit Student</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
            <div class="mb-3">
                <label>Name</label>
                <input type="text" name="name" id="editName" class="form-control" required>
            </div>
            <div class="mb-3">
                <label>Student Number</label>
                <input type="text" name="student_number" id="editNumber" class="form-control" required>
            </div>
            <div class="mb-3">
                <label>Major</label>
                <input type="text" name="major" id="editMajor" class="form-control" required>
            </div>
            <div class="mb-3">
                <label>Sex</label>
                <select name="sex" id="editSex" class="form-select" required>
                    <option value="M">Male</option>
                    <option value="F">Female</option>
                </select>
            </div>
            <div class="mb-3">
                <label>Year</label>
                <input type="text" name="year" id="editYear" class="form-control" required>
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn-warning">Update Student</button>
        </div>
      </div>
    </form>
  </div>
</div>

<!-- Reusable Delete Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header bg-danger text-white">
        <h5 class="modal-title">Confirm Delete</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        Are you sure you want to delete <strong id="studentName"></strong>?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        <form id="deleteForm" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">Yes, Delete</button>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- JS for dynamic modals -->
<script>
document.addEventListener('DOMContentLoaded', function () {
    // Delete modal
    var deleteModal = document.getElementById('deleteModal');
    var studentName = document.getElementById('studentName');
    var deleteForm = document.getElementById('deleteForm');
    deleteModal.addEventListener('show.bs.modal', function (event) {
        var button = event.relatedTarget;
        var id = button.getAttribute('data-id');
        var name = button.getAttribute('data-name');
        studentName.textContent = name;
        deleteForm.action = '/admin/students/' + id;
    });

    // Edit modal
    var editModal = document.getElementById('editModal');
    var editForm = document.getElementById('editForm');
    editModal.addEventListener('show.bs.modal', function (event) {
        var button = event.relatedTarget;
        var id = button.getAttribute('data-id');
        document.getElementById('editName').value = button.getAttribute('data-name');
        document.getElementById('editNumber').value = button.getAttribute('data-student_number');
        document.getElementById('editMajor').value = button.getAttribute('data-major');
        document.getElementById('editSex').value = button.getAttribute('data-sex');
        document.getElementById('editYear').value = button.getAttribute('data-year');
        editForm.action = '/admin/students/' + id; // Set form action dynamically
    });
});
</script>


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
                    <a href="" class="btn btn-primary">
                        All Enrollments
                    </a>
                    <a href="" class="btn btn-warning">
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
