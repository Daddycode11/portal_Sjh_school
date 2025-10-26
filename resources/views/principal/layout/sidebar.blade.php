<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ route('principal.dashboard') }}" class="brand-link text-center">
        <i class="fas fa-school brand-image img-circle elevation-3 mt-1 text-light" style="opacity: .9"></i>
        <span class="brand-text font-weight-light">SJNH Principal Panel</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        @php
            $principalUser = Auth::user();
            $initials = strtoupper(substr($principalUser->name ?? 'P', 0, 2));
        @endphp

        <!-- Sidebar User Panel -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex align-items-center">
            <div class="image">
                <div class="img-circle elevation-2 bg-primary"
                    style="width: 38px; height: 38px; display: flex; align-items: center; justify-content: center;">
                    <span class="text-white font-weight-bold">{{ $initials }}</span>
                </div>
            </div>
            <div class="info ml-2">
                <a href="#" class="d-block text-white">
                    {{ $principalUser->name ?? 'Principal' }}
                </a>
                <small class="text-gray-400">Principal</small>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu">

                <!-- Dashboard -->
                <li class="nav-item">
                    <a href="{{ route('principal.dashboard') }}"
                       class="nav-link {{ request()->routeIs('principal.dashboard') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>Dashboard</p>
                    </a>
                </li>

                <!-- Teachers -->
                <li class="nav-item">
                   <a href="{{ route('principal.teachers.index') }}" class="nav-link">
    <i class="nav-icon fas fa-chalkboard-teacher"></i>
    <p>Teachers</p>
</a>

                </li>

                <!-- Students -->
                <li class="nav-item">
                    <a href="{{ route('principal.students.index') }}"
                       class="nav-link {{ request()->routeIs('principal.students.*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-user-graduate"></i>
                        <p>Students</p>
                    </a>
                </li>

                <!-- Sections -->
                <li class="nav-item">
                    <a href="{{ route('principal.sections.index') }}"
                       class="nav-link {{ request()->routeIs('principal.sections.*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-layer-group"></i>
                        <p>Sections</p>
                    </a>
                </li>

                <!-- Subjects -->
                <li class="nav-item">
                    <a href="{{ route('principal.subjects.index') }}"
                       class="nav-link {{ request()->routeIs('principal.subjects.*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-book"></i>
                        <p>Subjects</p>
                    </a>
                </li>

                <!-- Reports -->
                <li class="nav-item">
                    <a href="{{ route('principal.reports.index') }}"
                       class="nav-link {{ request()->routeIs('principal.reports.*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-chart-line"></i>
                        <p>Reports</p>
                    </a>
                </li>

                <!-- Divider -->
                <li class="nav-header mt-3 text-uppercase text-gray-400">Account</li>

                <!-- Settings -->
                <li class="nav-item">
                    <a href="{{ route('principal.settings') }}"
                       class="nav-link {{ request()->routeIs('principal.settings') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-cog"></i>
                        <p>Settings</p>
                    </a>
                </li>

                <!-- Logout -->
                <li class="nav-item mt-3">
    <a href="{{ route('logout') }}" class="nav-link bg-danger text-white">
        <i class="nav-icon fas fa-sign-out-alt"></i>
        <p>Logout</p>
    </a>
</li>

            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
