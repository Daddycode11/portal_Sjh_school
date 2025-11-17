@extends('layouts.admin')

@section('content')
<h3>Enrollment Requests</h3>
<hr>

<table class="table table-bordered table-striped">
    <thead>
        <tr>
            <th>Student</th>
            <th>Grade</th>
            <th>Section</th>
            <th>School Year</th>
            <th>Status</th>
            <th>Actions</th>
        </tr>
    </thead>

    <tbody>
    @foreach($requests as $req)
        <tr>
            <td>{{ $req->student->name }}</td>
            <td>{{ $req->grade_level }}</td>
            <td>{{ $req->section->name }}</td>
            <td>{{ $req->school_year }}</td>
            <td>{{ ucfirst($req->status) }}</td>
            <td>
                @if($req->status == 'pending')
                <form method="POST" action="{{ route('admin.enrollment.approve', $req->id) }}" class="d-inline">
                    @csrf
                    <button class="btn btn-success btn-sm">Approve</button>
                </form>

                <form method="POST" action="{{ route('admin.enrollment.reject', $req->id) }}" class="d-inline">
                    @csrf
                    <input type="hidden" name="remarks" value="No valid documents">
                    <button class="btn btn-danger btn-sm">Reject</button>
                </form>
                @else
                    <em>N/A</em>
                @endif
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
@endsection
