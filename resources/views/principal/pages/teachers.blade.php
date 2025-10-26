@extends('principal.layout.app')

@section('content')
<div class="container py-5" style="font-family: 'Poppins', sans-serif;">
    <h1 class="text-3xl font-semibold text-red-800 mb-4">
        Teachers Management 
    </h1>

    
    <div class="card border-0 shadow-lg rounded-3 overflow-hidden position-relative">
        <!-- Notification Badge (Top Right Corner) -->
        @if($totalTeachers > 0)
            <span class="position-absolute top-0 end-0 translate-middle badge rounded-pill bg-success shadow-sm animate-pulse me-3 mt-3">
                {{ $totalTeachers }}
            </span>
        @endif

        <div class="card-body p-4" style="background: #f9fff9;">
            @if($teachers->count() > 0)
                <div class="table-responsive">
                    <table class="table table-hover align-middle text-center mb-0">
                        <thead style="background: linear-gradient(90deg, #A5D6A7, #66BB6A); color: white;">
                            <tr>
                                <th scope="col">Name</th>
                                <th scope="col">Email</th>
                                <th scope="col">Course</th>
                                <th scope="col">Date Joined</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($teachers as $teacher)
                                <tr style="background-color: #ffffff;">
                                    <td class="fw-medium text-gray-700">{{ $teacher->name }}</td>
                                    <td class="text-gray-600">{{ $teacher->email }}</td>
                                    <td class="text-gray-600">{{ $teacher->course ?? 'N/A' }}</td>
                                    <td class="text-gray-600">{{ $teacher->created_at->format('M d, Y') }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="mt-3 d-flex justify-content-center">
                    {{ $teachers->links() }}
                </div>
            @else
                <p class="text-muted text-center mb-0 py-3">No teachers found.</p>
            @endif
        </div>
    </div>
</div>

<style>
    .animate-pulse {
    animation: pulse 1.5s infinite;
}

@keyframes pulse {
    0% { transform: scale(1); opacity: 1; }
    50% { transform: scale(1.2); opacity: 0.85; }
    100% { transform: scale(1); opacity: 1; }
}

.badge.bg-success {
    font-size: 0.8rem;
    padding: 0.45em 0.7em;
}

    body {
        background-color: #F1F8E9; /* very light mint */
    }

    .card {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .card:hover {
        transform: translateY(-4px);
        box-shadow: 0 6px 15px rgba(102, 187, 106, 0.3);
    }

    .table thead th {
        border: none;
        font-weight: 600;
    }

    .table tbody tr:hover {
        background-color: #E8F5E9; /* light green hover */
    }

    .btn {
        border-radius: 25px;
        background-color: #66BB6A;
        color: white;
        font-weight: 500;
        transition: background-color 0.3s ease;
    }

    .btn:hover {
        background-color: #81C784;
    }

    @media (max-width: 768px) {
        .text-3xl {
            font-size: 1.5rem;
        }

        table {
            font-size: 0.9rem;
        }
    }
</style>
@endsection
