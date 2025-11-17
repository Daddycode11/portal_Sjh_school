@extends('admin.layouts.app')

@section('content')
<h1 class="text-2xl font-bold mb-4">User Accounts</h1>
<table class="table table-bordered w-full">
    <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Role</th>
            <th>Date Created</th>
        </tr>
    </thead>
    <tbody>
        @foreach($users as $user)
        <tr>
            <td>{{ $user->id }}</td>
            <td>{{ $user->name }}</td>
            <td>{{ $user->email }}</td>
            <td>{{ ucfirst($user->user_role) }}</td>
            <td>{{ $user->created_at->format('Y-m-d') }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
