@include('admin.layout.header')

<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light shadow-sm" style="background-color: #388E3C;">
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
    <div class="content-wrapper" style="background-color: #f9fff9;">
        <!-- Content Header -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-success">User Login History</h1>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">

                @if($histories->isEmpty())
                    <div class="alert alert-info">No login history found.</div>
                @else
                    <div class="card border-0 shadow-sm rounded-3">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover align-middle">
                                    <thead class="table-success">
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
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    @include('admin.layout.footer')

</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE -->
<script src="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/js/adminlte.min.js"></script>

</body>
</html>
