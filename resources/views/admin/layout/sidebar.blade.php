<!-- Sidebar -->
<aside class="main-sidebar elevation-4" style="background-color: #2E7D32; color: #fff; font-family: 'Poppins', 'Roboto', sans-serif;">
    <!-- Brand Logo -->
    <a href="{{ route('admin.dashboard') }}" class="brand-link d-flex align-items-center text-white" style="background-color: #256628;">
        <i class="fas fa-graduation-cap brand-image img-circle elevation-3 ml-2" style="opacity: .9; color: #fff;"></i>
        <span class="brand-text font-weight-semibold ml-2">SJNH Admin Panel</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        @php
            $adminUser = Auth::user();
            $initials = strtoupper(substr($adminUser->name ?? 'Admin', 0, 2));
        @endphp

        <!-- User Panel -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex align-items-center border-bottom" style="border-color: rgba(255,255,255,0.15) !important;">
            <div class="image">
                <div class="img-circle bg-light d-flex align-items-center justify-content-center" style="width: 38px; height: 38px;">
                    <span class="text-success font-weight-bold">{{ $initials }}</span>
                </div>
            </div>
            <div class="info ml-2">
                <a href="#" class="d-block text-white font-weight-medium">
                    {{ $adminUser->name ?? 'Administrator' }}
                </a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

                <!-- Dashboard -->
                <li class="nav-item">
                    <a href="{{ route('admin.dashboard') }}"
                        class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}"
                        style="{{ request()->routeIs('admin.dashboard') ? 'background-color: #66BB6A; color: #fff;' : 'color: #fff;' }}">
                        <i class="nav-icon fas fa-tachometer-alt text-white"></i>
                        <p>Dashboard</p>
                    </a>
                </li>

                <!-- Manage Faculty -->
                <li class="nav-item">
                    <a href="{{ route('admin.faculty.index') }}"
                        class="nav-link {{ request()->routeIs('admin.faculty.*') ? 'active' : '' }}"
                        style="{{ request()->routeIs('admin.faculty.*') ? 'background-color: #66BB6A; color: #fff;' : 'color: #fff;' }}">
                        <i class="nav-icon fas fa-chalkboard-teacher text-white"></i>
                        <p>Manage Faculty</p>
                    </a>
                </li>

                <!-- Faculty Assignments -->
                <li class="nav-item">
                    <a href="{{ route('admin.assignments.index') }}"
                        class="nav-link {{ request()->routeIs('admin.assignments.*') ? 'active' : '' }}"
                        style="{{ request()->routeIs('admin.assignments.*') ? 'background-color: #66BB6A; color: #fff;' : 'color: #fff;' }}">
                        <i class="nav-icon fas fa-tasks text-white"></i>
                        <p>Faculty Assignments</p>
                    </a>
                </li>
<!-- 🎓 View Grades -->
<li class="nav-item">
    <a href="{{ route('admin.grades.index') }}"
       class="nav-link {{ request()->routeIs('admin.grades.index') ? 'active' : '' }}"
       style="{{ request()->routeIs('admin.grades.index') ? 'background-color: #66BB6A; color: #fff;' : 'color: #fff;' }}">
       <i class="nav-icon fas fa-graduation-cap"></i>
       <p>View Grades</p>
    </a>
</li>
<!-- 📄 View Reports -->
<li class="nav-item">
    <a href="{{ route('admin.reports.index') }}"
       class="nav-link {{ request()->routeIs('admin.reports.index') ? 'active' : '' }}"
       style="{{ request()->routeIs('admin.reports.index') ? 'background-color: #66BB6A; color: #fff;' : 'color: #fff;' }}">
       <i class="nav-icon fas fa-file-alt text-white"></i>
       <p>View Reports</p>
    </a>
</li>
  <!-- Enrollment Requests -->
<!--               <li class="nav-item">
    <a class="nav-link d-flex justify-content-between align-items-center {{ request()->routeIs('admin.enrollments.requests') ? 'active' : '' }}" 
       href="{{ route('admin.enrollments.requests') }}">
        Enrollment Requests
        @if($pendingEnrollmentCount > 0)
            <span class="badge bg-danger ms-2">{{ $pendingEnrollmentCount }}</span>
        @endif
    </a>
</li> -->


                <!-- All Enrollments -->
           <!--      <li class="nav-item">
                    <a href="{{ route('admin.enrollments.index') }}"
                       class="nav-link {{ request()->routeIs('admin.enrollments.index') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-file-alt"></i>
                        <p>All Enrollments</p>
                    </a>
                </li>
 -->
<!--  🧾 Enrollment Requests -->
<!-- <li class="nav-item">
    <a href="{{ route('admin.enrollments.requests') }}"
       class="nav-link {{ request()->routeIs('admin.enrollments.*') ? 'active' : '' }}">
       <i class="fas fa-file-alt"></i>
       <p>Enrollment Requests</p>
    </a>
</li> -->

<!-- 📊 System Overview -->
<li class="nav-item">
    <a href="{{ route('admin.activities.index') }}"
       class="nav-link {{ request()->routeIs('admin.activities.index') ? 'active' : '' }}"
       style="{{ request()->routeIs('admin.activities.index') ? 'background-color: #66BB6A; color: #fff;' : 'color: #fff;' }}">
       <i class="nav-icon fas fa-chart-line text-white"></i>
       <p>System Overview</p>
    </a>
</li>


<!-- 📢 Manage Announcements -->
<li class="nav-item">
    <a href="{{ route('admin.announcements.index') }}"
       class="nav-link {{ request()->routeIs('admin.announcements.*') ? 'active' : '' }}"
       style="{{ request()->routeIs('admin.announcements.*') ? 'background-color: #66BB6A; color: #fff;' : 'color: #fff;' }}">
       <i class="nav-icon fas fa-bullhorn text-white"></i>
       <p>Manage Announcements</p>
    </a>
</li>

                <!-- 📢 Manage Announcements -->
                <li class="nav-item">
                    <a href="{{ route('admin.announcements.index') }}"
                        class="nav-link {{ request()->routeIs('admin.announcements.*') ? 'active' : '' }}"
                        style="{{ request()->routeIs('admin.announcements.*') ? 'background-color: #66BB6A; color: #fff;' : 'color: #fff;' }}">
                        <i class="nav-icon fas fa-bullhorn text-white"></i>
                        <p>Announcements</p>
                    </a>
                </li>

                <!-- 🕒 Login History -->
                <li class="nav-item">
                    <a href="{{ route('admin.loginHistory') }}"
                        class="nav-link {{ request()->routeIs('admin.loginHistory') ? 'active' : '' }}"
                        style="{{ request()->routeIs('admin.loginHistory') ? 'background-color: #66BB6A; color: #fff;' : 'color: #fff;' }}">
                        <i class="nav-icon fas fa-history text-white"></i>
                        <p>Login History</p>
                    </a>
                </li>

                <!-- 🚪 Logout -->
                <li class="nav-item mt-4">
                    <a href="{{ route('logout') }}" class="nav-link" style="background-color: #c62828; color: #fff;">
                        <i class="nav-icon fas fa-sign-out-alt text-white"></i>
                        <p>Logout</p>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
    <!-- /.sidebar -->
</aside>


<!-- Sidebar Hover / Active Styles -->
<style>
    .nav-sidebar .nav-link:hover {
        background-color: #388E3C !important;
        color: #fff !important;
    }
    .nav-sidebar .nav-link.active {
        background-color: #66BB6A !important;
        color: #fff !important;
        font-weight: 600;
    }
    .brand-link:hover {
        background-color: #1b5e20 !important;
        text-decoration: none;
    }
</style>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
@if(session('success'))
    Swal.fire({
        icon: 'success',
        title: "Success",
        text: "{{ session('success') }}",
        timer: 2000,
        showConfirmButton: false,
    });
@endif

@if(session('error'))
    Swal.fire({
        icon: 'error',
        title: "Error",
        text: "{{ session('error') }}",
    });
@endif
</script>
