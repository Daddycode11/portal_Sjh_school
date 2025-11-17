@extends('layouts.admin')
@section('content')
<div class="container mt-4">
    <h3>Enrollment Requests</h3>

    @foreach($requests as $req)
    <div class="card mb-3 p-3">
        <h5>{{ $req->student->name }}</h5>
        <p>Grade Level: {{ $req->gradeLevel->name }}</p>
        <p>Section: {{ $req->section->name ?? 'No preference' }}</p>
        <p>School Year: {{ $req->school_year }}</p>
        <p>Status: <strong>{{ ucfirst($req->status) }}</strong></p>

        @if($req->status == 'pending')
        <form action="{{ route('admin.enrollment.approve', $req->id) }}" method="POST" class="d-inline">
            @csrf
            <button class="btn btn-success">Approve</button>
        </form>

        <form action="{{ route('admin.enrollment.reject', $req->id) }}" method="POST" class="d-inline">
            @csrf
            <button class="btn btn-danger">Reject</button>
        </form>
        @endif
    </div>
    @endforeach
</div>
@endsection
