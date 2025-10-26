@extends('layouts.client')

@section('title', 'My Grades')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="h3 text-gray-800 mb-0">My Grades</h1>
<a href="{{ route('client.grades.exportPDF') }}" class="btn btn-danger">
    <i class="fas fa-file-pdf"></i> Download PDF
</a>

</div>
@if(empty($subjectGrades))
    <div class="card shadow mb-4">
        <div class="card-body text-center">
            <p>No grade records available.</p>
        </div>
    </div>
@else
    <!-- Overall GPA Cards -->
    <div class="row">
        @php
            $totalGrades = 0;
            $totalSubjects = count($subjectGrades);
            foreach($subjectGrades as $grade) {
                $totalGrades += $grade['overall_grade'];
            }
            $gpa = $totalSubjects > 0 ? $totalGrades / $totalSubjects : 0;

            $passingCount = 0;
            foreach($subjectGrades as $grade) {
                if($grade['overall_grade'] >= 75) $passingCount++;
            }
            $performancePercentage = $totalSubjects > 0 ? ($passingCount / $totalSubjects) * 100 : 0;
        @endphp

        <!-- GPA Cards -->
        @php
            $cards = [
                ['title' => 'Overall Average', 'value' => number_format($gpa, 2), 'icon' => 'graduation-cap', 'color' => 'primary'],
                ['title' => 'Subjects Passed', 'value' => "$passingCount / $totalSubjects", 'icon' => 'check', 'color' => 'success'],
                ['title' => 'Subjects Failed', 'value' => ($totalSubjects - $passingCount) . " / $totalSubjects", 'icon' => 'exclamation-triangle', 'color' => 'warning'],
                ['title' => 'Overall Performance', 'value' => number_format($performancePercentage, 0) . '%', 'icon' => 'clipboard-list', 'color' => 'info']
            ];
        @endphp

        @foreach($cards as $index => $card)
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-{{ $card['color'] }} shadow h-100 py-2 hover-shadow-sm transition-all">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-{{ $card['color'] }} text-uppercase mb-1">
                                    {{ $card['title'] }}
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $card['value'] }}</div>
                                @if($card['title'] === 'Overall Performance')
                                    <div class="progress progress-sm mt-2">
                                        <div class="progress-bar bg-info" role="progressbar"
                                            style="width: {{ $performancePercentage }}%"
                                            aria-valuenow="{{ $performancePercentage }}" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                @endif
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-{{ $card['icon'] }} fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <!-- Grade Table -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Grade Report</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-striped" id="dataTable" width="100%" cellspacing="0">
                    <thead class="thead-light">
                        <tr>
                            <th>Subject Code</th>
                            <th>Subject Name</th>
                            <th>Section</th>
                            <th>Faculty</th>
                            <th>Midterm</th>
                            <th>Final</th>
                            <th>Overall</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($subjectGrades as $grade)
                            <tr>
                                <td>{{ $grade['subject_code'] }}</td>
                                <td>{{ $grade['subject_name'] }}</td>
                                <td>{{ $grade['section_name'] }}</td>
                                <td>{{ $grade['faculty_name'] }}</td>
                                <td>{{ number_format($grade['midterm_grade'], 2) }}</td>
                                <td>{{ number_format($grade['final_grade'], 2) }}</td>
                                <td>{{ number_format($grade['overall_grade'], 2) }}</td>
                                <td>
                                    @if($grade['overall_grade'] >= 75)
                                        <span class="badge badge-success px-3 py-1">Passing</span>
                                    @else
                                        <span class="badge badge-danger px-3 py-1">Failing</span>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('client.classes.details', [
                                        'sectionId' => $grade['section_id'],
                                        'subjectId' => $grade['subject_id'],
                                        'schoolYear' => $grade['school_year'],
                                        'semester' => $grade['semester']
                                    ]) }}" class="btn btn-sm btn-primary">
                                        <i class="fas fa-eye"></i> Details
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Charts Section -->
    <div class="row">
        <div class="col-xl-8 col-lg-7">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Grade Distribution</h6>
                </div>
                <div class="card-body text-center">
                    <div id="loadingBar" class="spinner-border text-primary" role="status">
                        <span class="sr-only">Loading...</span>
                    </div>
                    <div class="chart-bar d-none">
                        <canvas id="gradeDistributionChart"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-4 col-lg-5">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Grade Summary</h6>
                </div>
                <div class="card-body text-center">
                    <div class="chart-pie pt-4">
                        <canvas id="gradeSummaryChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
$(document).ready(function() {
    $('#dataTable').DataTable({
        responsive: true,
        pageLength: 5
    });

    @if(!empty($subjectGrades))
        const grades = @json(array_column($subjectGrades, 'overall_grade'));
        const subjectLabels = @json(array_column($subjectGrades, 'subject_code'));
        const ctxBar = document.getElementById('gradeDistributionChart').getContext('2d');
        const ctxPie = document.getElementById('gradeSummaryChart').getContext('2d');

        setTimeout(() => {
            $('#loadingBar').addClass('d-none');
            $('.chart-bar').removeClass('d-none');

            new Chart(ctxBar, {
                type: 'bar',
                data: {
                    labels: subjectLabels,
                    datasets: [{
                        label: 'Overall Grade',
                        data: grades,
                        backgroundColor: grades.map(g => g >= 75 ? '#1cc88a' : '#e74a3b'),
                        borderColor: grades.map(g => g >= 75 ? '#169c6c' : '#c53030'),
                        borderWidth: 1
                    }]
                },
                options: {
                    maintainAspectRatio: false,
                    scales: {
                        y: { beginAtZero: true, max: 100 },
                        x: { grid: { display: false } }
                    }
                }
            });

            new Chart(ctxPie, {
                type: 'doughnut',
                data: {
                    labels: ['Passing', 'Failing'],
                    datasets: [{
                        data: [{{ $passingCount }}, {{ $totalSubjects - $passingCount }}],
                        backgroundColor: ['#1cc88a', '#e74a3b'],
                        hoverBackgroundColor: ['#169c6c', '#c53030']
                    }]
                },
                options: {
                    maintainAspectRatio: false,
                    cutout: '70%',
                    plugins: { legend: { position: 'bottom' } }
                }
            });
        }, 500);
    @endif
});
</script>
@endsection
