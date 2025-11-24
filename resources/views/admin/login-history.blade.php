@include('admin.layout.header')

<!-- Apply Poppins Font -->
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
<style>
    body, table, th, td, .nav-link, h1, h2, h3, h4, h5, h6 {
        font-family: 'Poppins', sans-serif !important;
    }

    /* Smooth table UI */
    .table th {
        background-color: #C8E6C9 !important;
        color: #2E7D32;
        font-weight: 600;
    }

    .table-hover tbody tr:hover {
        background-color: #eaf7ea !important;
        transition: 0.3s ease;
    }

    /* Rounded card */
    .rounded-3 {
        border-radius: 16px !important;
    }

    /* Navbar clean effect */
    .navbar {
        background-color: #388E3C !important;
        border-bottom: none !important;
    }

    .navbar .nav-link {
        color: white !important;
        font-weight: 500;
    }

    .content-wrapper {
        background-color: #f3fff7 !important;
    }
</style>

<body class="hold-transition sidebar-mini layout-fixed" style="background-color: #f3fff7;">
<div class="wrapper">

    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light shadow-sm">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link text-white" data-widget="pushmenu" href="#" role="button">
                    <i class="fas fa-bars"></i>
                </a>
            </li>
            <li class="nav-item d-none d-sm-inline-block">
                <span class="nav-link text-white font-weight-bold">Login History</span>
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
                <h1 class="m-0 text-success fw-bold">User Login History</h1>
            </div>
        </div>

        <!-- Main Content -->
        <section class="content">
            <div class="container-fluid">

                @if($histories->isEmpty())
                    <div class="alert alert-info shadow-sm">No login history found.</div>
                @else
                    <div class="card border-0 shadow-sm rounded-3">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover align-middle">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>User Name</th>
                                            <th>Student Number</th>
                                            <th>IP Address</th>
                                            <th>Login Time</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($histories as $history)
                                            <tr>
                                                <td>{{ $history->id }}</td>
                                                <td>{{ $history->user->name ?? 'N/A' }}</td>
                                                <td>{{ $history->user->student_number ?? 'N/A' }}</td>
                                                <td>{{ $history->ip_address }}</td>
                                                <td>{{ $history->logged_in_at }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                @endif

            </div>
        </section>
    </div>

    @include('admin.layout.footer')
</div>

<!-- JS Libraries -->
<script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/js/adminlte.min.js"></script>

</body>
</html>
