@include('admin.layout.header')

<body class="hold-transition sidebar-mini layout-fixed" style="font-family: 'Poppins', sans-serif;">
    <div class="wrapper">

        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light shadow-sm"
             style="background-color: #f8f9fa;">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"
                       style="color: #2E7D32; transition: 0.3s;">
                        <i class="fas fa-bars"></i>
                    </a>
                </li>
            </ul>

            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a href="{{ route('logout') }}" class="nav-link d-flex align-items-center"
                       style="color: #2E7D32; font-weight: 500; transition: 0.3s;">
                        <i class="fas fa-sign-out-alt mr-1"></i> Logout
                    </a>
                </li>
            </ul>
        </nav>

        <!-- Sidebar -->
        <aside class="main-sidebar elevation-4"
               style="background-color: #2E7D32; color: white;">

            <!-- Brand Logo -->
            <a href="{{ route('faculty.dashboard') }}" class="brand-link text-center"
               style="background-color: #2E7D32; border-bottom: 1px solid #27642a;">
                <i class="fas fa-graduation-cap text-white mr-2"></i>
                <span class="brand-text font-weight-light text-white">Faculty Portal</span>
            </a>

            <div class="sidebar">
                <!-- User Panel -->
                <div class="user-panel mt-3 pb-3 mb-3 d-flex align-items-center">
                    <div class="image">
                        <i class="fas fa-user-circle img-circle text-white fa-2x mr-2"></i>
                    </div>
                    <div class="info">
                        <a href="#" class="d-block text-white">{{ Auth::user()->name }}</a>
                    </div>
                </div>

                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column"
                        data-widget="treeview" role="menu" data-accordion="false">

                        <li class="nav-item">
                            <a href="{{ route('faculty.dashboard') }}"
                               class="nav-link {{ request()->routeIs('faculty.dashboard') ? 'active' : '' }}"
                               style="color: white;">
                                <i class="nav-icon fas fa-tachometer-alt"></i>
                                <p>Dashboard</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('faculty.classes.index') }}"
                               class="nav-link {{ request()->routeIs('faculty.classes.*') ? 'active' : '' }}"
                               style="color: white;">
                                <i class="nav-icon fas fa-chalkboard"></i>
                                <p>My Classes</p>
                            </a>
                        </li>

                        <li class="nav-header text-light mt-3">CLASS MANAGEMENT</li>
                        <li class="nav-item">
                            <a href="#" class="nav-link" style="color: white;">
                                <i class="nav-icon fas fa-file-alt"></i>
                                <p>
                                    Syllabi
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('faculty.syllabus.index') }}" class="nav-link"
                                       style="color: white;">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>View Uploaded Syllabi</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </nav>
            </div>
        </aside>

        <!-- Content -->
        <div class="content-wrapper">
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0" style="color:#2E7D32;">My Classes</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="{{ route('faculty.dashboard') }}">Dashboard</a></li>
                                <li class="breadcrumb-item active">My Classes</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>

            <section class="content">
                <div class="container-fluid">
                    @if (session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif

                    @if (session('error'))
                        <div class="alert alert-danger">{{ session('error') }}</div>
                    @endif

                    <div class="card border-0 shadow-sm">
                        <div class="card-header" style="background-color: #2E7D32; color: white;">
                            <h3 class="card-title">Classes Assigned to Me</h3>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                @if (count($classes) > 0)
                                    <table id="classesTable" class="table table-bordered table-striped">
                                        <thead class="text-center">
                                            <tr>
                                                <th>Section</th>
                                                <th>Subject</th>
                                                <th>Code</th>
                                                <th>School Year</th>
                                                <th>Semester</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($classes as $class)
                                                <tr>
                                                    <td>{{ $class->section_name }}</td>
                                                    <td>{{ $class->subject_name }}</td>
                                                    <td>{{ $class->subject_code }}</td>
                                                    <td>{{ $class->school_year }}</td>
                                                    <td>{{ $class->semester }}</td>
                                                    <td class="text-center">
                                                        <a href="{{ route('faculty.classes.details', [
                                                            'sectionId' => $class->section_id,
                                                            'subjectId' => $class->subject_id,
                                                            'schoolYear' => $class->school_year,
                                                            'semester' => $class->semester
                                                        ]) }}"
                                                           class="btn btn-success btn-sm" style="background-color:#2E7D32;border:none;">
                                                            <i class="fas fa-eye"></i> View
                                                        </a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                @else
                                    <div class="alert alert-info">No classes assigned yet</div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>

        <!-- Footer -->
        <footer class="main-footer">
            <strong>Copyright &copy; 2025 <a href="#">Pangasinan State University</a>.</strong>
            All rights reserved.
            <div class="float-right d-none d-sm-inline-block">
                <b>Version</b> 1.0.0
            </div>
        </footer>
    </div>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/js/adminlte.min.js"></script>

    <script>
        $(document).ready(function() {
            @if (count($classes) > 0)
                $('#classesTable').DataTable({
                    "paging": true,
                    "lengthChange": false,
                    "searching": true,
                    "ordering": true,
                    "info": true,
                    "autoWidth": false,
                    "responsive": true
                });
            @endif
        });
    </script>

    <style>
        .nav-sidebar .nav-link.active {
            background-color: #539820 !important;
            color: #fff !important;
        }
        .nav-sidebar .nav-link:hover {
            background-color: #539820 !important;
            color: #fff !important;
            transform: scale(1.03);
            transition: 0.3s;
        }
    </style>
</body>
</html>
