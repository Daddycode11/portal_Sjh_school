<aside class="main-sidebar elevation-4" style="background-color: #2E7D32; color: #fff; font-family: 'Poppins', 'Roboto', sans-serif;">
    <!-- Brand Logo -->
    <a href="{{ route('faculty.dashboard') }}" class="brand-link text-white" style="background-color: #256b29; border-bottom: 1px solid #1b511f;">
        <i class="fas fa-user-tie brand-image img-circle elevation-3 mt-1 text-white" style="opacity: .9"></i>
        <span class="brand-text font-weight-semibold ml-2">Faculty Portal</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        @php
            $facultyUser = Auth::user();
            $initials = strtoupper(substr($facultyUser->name ?? 'Faculty', 0, 2));

            $assignedClass = DB::table('section_subject')
                ->where('faculty_id', $facultyUser->id)
                ->join('sections', 'section_subject.section_id', '=', 'sections.id')
                ->join('subjects', 'section_subject.subject_id', '=', 'subjects.id')
                ->select(
                    'section_subject.*',
                    'sections.name as section_name',
                    'subjects.name as subject_name'
                )
                ->first();

            $firstAssessment = null;
            if ($assignedClass) {
                $firstAssessment = DB::table('assessments')
                    ->where('faculty_id', $facultyUser->id)
                    ->where('subject_id', $assignedClass->subject_id)
                    ->where('school_year', $assignedClass->school_year)
                    ->where('semester', $assignedClass->semester)
                    ->first();
            }
        @endphp

        <!-- Sidebar user panel -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex align-items-center border-bottom" style="border-color: rgba(255,255,255,0.2);">
            <div class="image">
                <div class="img-circle elevation-2 bg-light d-flex align-items-center justify-content-center"
                     style="width: 36px; height: 36px;">
                    <span class="text-success font-weight-bold">{{ $initials }}</span>
                </div>
            </div>
            <div class="info ml-2">
                <a href="#" class="d-block text-white font-weight-semibold">{{ $facultyUser->name ?? 'Faculty User' }}</a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

                <!-- Dashboard -->
                <li class="nav-item">
                    <a href="{{ route('faculty.dashboard') }}" 
                       class="nav-link {{ request()->routeIs('faculty.dashboard') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-tachometer-alt text-white"></i>
                        <p class="text-white">Faculty Dashboard</p>
                    </a>
                </li>

                <!-- My Classes -->
                <li class="nav-item">
                    <a href="{{ route('faculty.classes.index') }}" 
                       class="nav-link {{ request()->routeIs('faculty.classes.*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-chalkboard text-white"></i>
                        <p class="text-white">My Classes</p>
                    </a>
                </li>

                <!-- Syllabi -->
                <li class="nav-header text-white-50 mt-3">SYLLABUS</li>
                <li class="nav-item">
                    <a href="{{ route('faculty.syllabus.index') }}" 
                       class="nav-link {{ request()->routeIs('faculty.syllabus.*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-file-upload text-white"></i>
                        <p class="text-white">Upload / View Syllabi</p>
                    </a>
                </li>

                <!-- Seat Plan -->
                <li class="nav-header text-white-50 mt-3">SEAT PLAN</li>
                <li class="nav-item">
                    @if($assignedClass)
                        <a href="{{ route('faculty.seatplan.create', [
                            'sectionId' => $assignedClass->section_id,
                            'subjectId' => $assignedClass->subject_id,
                            'schoolYear' => $assignedClass->school_year,
                            'semester' => $assignedClass->semester
                        ]) }}" 
                        class="nav-link {{ request()->routeIs('faculty.seatplan.*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-users text-white"></i>
                            <p class="text-white">Generate Seat Plan</p>
                        </a>
                    @else
                        <a href="{{ route('faculty.classes.index') }}" class="nav-link text-white">
                            <i class="nav-icon fas fa-users text-white"></i>
                            <p>Generate Seat Plan</p>
                        </a>
                    @endif
                </li>

                <!-- Assessments -->
                <li class="nav-header text-white-50 mt-3">ASSESSMENTS</li>
                <li class="nav-item">
                    <a href="{{ $assignedClass 
                        ? route('faculty.assessment.create', [
                            'sectionId' => $assignedClass->section_id,
                            'subjectId' => $assignedClass->subject_id,
                            'schoolYear' => $assignedClass->school_year,
                            'semester' => $assignedClass->semester
                        ]) 
                        : route('faculty.classes.index') }}" 
                        class="nav-link {{ request()->routeIs('faculty.assessment.create') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-file-signature text-white"></i>
                        <p class="text-white">Schedule Quiz/Activity</p>
                    </a>
                </li>

                <!-- Scores Management -->
                <li class="nav-item">
                    <a href="{{ $firstAssessment 
                        ? route('faculty.scores.manage', ['assessmentId' => $firstAssessment->id]) 
                        : ($assignedClass 
                            ? route('faculty.classes.details', [
                                'sectionId' => $assignedClass->section_id,
                                'subjectId' => $assignedClass->subject_id,
                                'schoolYear' => $assignedClass->school_year,
                                'semester' => $assignedClass->semester
                            ]) 
                            : route('faculty.classes.index')) }}" 
                        class="nav-link {{ request()->routeIs('faculty.scores.*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-calculator text-white"></i>
                        <p class="text-white">Input Student Scores</p>
                    </a>
                </li>

                <!-- Analytics & Reports -->
                <li class="nav-header text-white-50 mt-3">ANALYTICS & REPORTS</li>
                <li class="nav-item">
                    <a href="{{ $assignedClass 
                        ? route('faculty.analytics', [
                            'sectionId' => $assignedClass->section_id,
                            'subjectId' => $assignedClass->subject_id,
                            'schoolYear' => $assignedClass->school_year,
                            'semester' => $assignedClass->semester
                        ]) 
                        : route('faculty.classes.index') }}" 
                        class="nav-link {{ request()->routeIs('faculty.analytics') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-chart-line text-white"></i>
                        <p class="text-white">Student Analytics</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ $assignedClass 
                        ? route('faculty.reports.generate', [
                            'sectionId' => $assignedClass->section_id,
                            'subjectId' => $assignedClass->subject_id,
                            'schoolYear' => $assignedClass->school_year,
                            'semester' => $assignedClass->semester
                        ]) 
                        : route('faculty.classes.index') }}" 
                        class="nav-link {{ request()->routeIs('faculty.reports.*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-file-pdf text-white"></i>
                        <p class="text-white">Generate Reports</p>
                    </a>
                </li>

                <!-- Messages -->
                <li class="nav-item">
                    <a href="{{ route('faculty.messages.index') }}" 
                       class="nav-link {{ request()->routeIs('faculty.messages.*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-comments text-white"></i>
                        <p class="text-white">
                            Messages
                            @if(isset($unreadMessagesCount) && $unreadMessagesCount > 0)
                                <span class="badge badge-danger right">{{ $unreadMessagesCount }}</span>
                            @endif
                        </p>
                    </a>
                </li>

                <!-- Logout -->
                <li class="nav-item mt-4">
                    <a href="{{ route('logout') }}" class="nav-link" style="background-color: #c62828;">
                        <i class="nav-icon fas fa-sign-out-alt text-white"></i>
                        <p class="text-white">Logout</p>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</aside>

<!-- Sidebar Style -->
<style>
    .nav-sidebar .nav-link {
        transition: all 0.2s ease-in-out;
        border-radius: 6px;
        margin: 2px 6px;
    }

    .nav-sidebar .nav-link:hover {
        background-color: #388E3C !important;
        transform: scale(1.03);
    }

    .nav-sidebar .nav-link.active {
        background-color: #43A047 !important;
    }

    .nav-icon {
        width: 20px;
        opacity: 0.95;
    }

    .nav-header {
        font-size: 0.8rem;
        letter-spacing: 0.5px;
    }
</style>
