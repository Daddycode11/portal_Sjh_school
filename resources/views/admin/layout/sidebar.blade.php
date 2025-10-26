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
                <div class="img-circle bg-light d-flex align-items-center justify-content-center"
                    style="width: 38px; height: 38px;">
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
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">

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

                <!-- Logout -->
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
