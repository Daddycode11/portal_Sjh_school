@extends('principal.layout.app')

@section('content')
<div class="container py-4">
    <h1 class="text-2xl font-bold text-gray-800 mb-4">Teachers Management ({{ $totalTeachers }})</h1>

    <div class="card shadow-sm">
        <div class="card-body">
            @if($teachers->count() > 0)
                <table class="table table-bordered table-striped">
                    <thead class="thead-dark">
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Course</th>
                            <th>Date Joined</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($teachers as $teacher)
                            <tr>
                                <td>{{ $teacher->name }}</td>
                                <td>{{ $teacher->email }}</td>
                                <td>{{ $teacher->course ?? 'N/A' }}</td>
                                <td>{{ $teacher->created_at->format('M d, Y') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="mt-3">
                    {{ $teachers->links() }}
                </div>
            @else
                <p class="text-muted text-center mb-0">No teachers found.</p>
            @endif
        </div>
    </div>
</div>
@endsection
