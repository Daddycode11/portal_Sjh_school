<!-- Include Fonts -->
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">

<!-- Sidebar -->
<aside id="sidebar" class="main-sidebar elevation-4" 
       style="background-color: #2e7d32; font-family: 'Poppins', 'Roboto', sans-serif; color: white; position: fixed; height: 100%; width: 250px; transition: all 0.3s ease; z-index: 1000;">
       
    <!-- Brand Logo -->
    <a href="{{ route('principal.dashboard') }}" class="brand-link text-center" 
       style="background-color: #2e7d32; border-bottom: 1px solid rgba(255,255,255,0.1); display: flex; align-items: center; justify-content: center; padding: 15px;">
        
        <span class="brand-text font-weight-bold text-white">SJNH Principal Panel</span>
    </a>

    <div class="sidebar text-white p-2">
        @php
            $principalUser = Auth::user();
            $initials = strtoupper(substr($principalUser->name ?? 'P', 0, 2));
        @endphp

        <!-- User Panel -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex align-items-center">
            <div class="image">
                <div class="img-circle elevation-2 bg-primary"
                     style="width: 38px; height: 38px; display: flex; align-items: center; justify-content: center;">
                    <span class="text-white font-weight-bold">{{ $initials }}</span>
                </div>
            </div>
            <div class="info ml-2">
                <a href="#" class="d-block text-white font-weight-medium">{{ $principalUser->name ?? 'Principal' }}</a>
                <small style="color: rgba(255,255,255,0.7);">Principal</small>
            </div>
        </div>

        <!-- Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" style="list-style: none; padding-left: 0;">
                <li class="nav-item">
                    <a href="{{ route('principal.dashboard') }}"
                       class="nav-link {{ request()->routeIs('principal.dashboard') ? 'active' : '' }} text-white">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('principal.teachers.index') }}" class="nav-link text-white">
                        <i class="nav-icon fas fa-chalkboard-teacher"></i>
                        <p>Teachers</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('principal.students.index') }}" class="nav-link text-white">
                        <i class="nav-icon fas fa-user-graduate"></i>
                        <p>Students</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('principal.sections.index') }}" class="nav-link text-white">
                        <i class="nav-icon fas fa-layer-group"></i>
                        <p>Sections</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('principal.subjects.index') }}" class="nav-link text-white">
                        <i class="nav-icon fas fa-book"></i>
                        <p>Subjects</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('principal.reports.index') }}" class="nav-link text-white">
                        <i class="nav-icon fas fa-chart-line"></i>
                        <p>Reports</p>
                    </a>
                </li>

                <li class="nav-header mt-3 text-uppercase" style="color: rgba(255,255,255,0.6); font-size: 0.75rem;">Account</li>
                <li class="nav-item">
                    <a href="{{ route('principal.settings') }}" class="nav-link text-white">
                        <i class="nav-icon fas fa-cog"></i>
                        <p>Settings</p>
                    </a>
                </li>

                <li class="nav-item mt-3">
                    <a href="{{ route('logout') }}" class="nav-link bg-danger text-white" style="border-radius: 6px;">
                        <i class="nav-icon fas fa-sign-out-alt"></i>
                        <p>Logout</p>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</aside>

<!-- Sidebar Toggle Button -->
<button id="sidebarToggle" class="d-md-none" 
        style="position: fixed; top: 15px; left: 15px; background: #2e7d32; color: white; border: none; border-radius: 4px; padding: 10px; z-index: 1100;">
    <i class="fas fa-bars"></i>
</button>

<!-- Sidebar Responsive Script -->
<script>
    const sidebar = document.getElementById('sidebar');
    const toggleBtn = document.getElementById('sidebarToggle');

    toggleBtn.addEventListener('click', () => {
        sidebar.classList.toggle('open');
    });
</script>

<!-- Responsive Sidebar CSS -->
<style>
/* Default Sidebar */
#sidebar {
    left: 0;
}
#sidebar.open {
    left: 0 !important;
}

/* Responsive (Mobile) */
@media (max-width: 768px) {
    #sidebar {
        left: -250px;
        position: fixed;
        top: 0;
        height: 100%;
        width: 250px;
    }
    #sidebar.open {
        left: 0;
    }
    body {
        overflow-x: hidden;
    }
}

/* Hover and Active Effects */
.nav-sidebar .nav-item > .nav-link:hover {
    background-color: #388e3c !important;
    transform: translateX(4px);
    transition: all 0.2s ease;
}

.nav-sidebar .nav-item > .nav-link.active {
    background-color: #43a047 !important;
    font-weight: 600;
}
</style>
