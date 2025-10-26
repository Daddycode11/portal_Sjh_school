@extends('principal.layout.app')

@section('content')
<div class="container py-4">
    <h1 class="mb-4 text-2xl font-bold text-gray-800">Sections Overview</h1>

    <div class="card shadow-sm">
        <div class="card-body text-center text-muted">
            <i class="fas fa-layer-group fa-3x text-warning mb-3"></i>
            <h5>No section data found.</h5>
            <p class="mb-0">This section will list all existing sections and their assigned faculty.</p>
        </div>
    </div>
</div>
@endsection
