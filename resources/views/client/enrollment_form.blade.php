@extends('layouts.client')

@section('title', 'Student Enrollment')

@section('styles')
<style>
    body {
        font-family: 'Poppins', 'Roboto', sans-serif;
        background-color: #f5fff5;
    }

    .card {
        border-radius: 12px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.1);
    }

    .btn-accent {
        background-color: #4CAF50;
        color: #fff;
        border-radius: 30px;
        transition: all 0.3s ease;
    }

    .btn-accent:hover {
        background-color: #43A047;
        color: #fff;
    }

    .form-label {
        font-weight: 600;
    }

    .text-danger {
        font-size: 0.875rem;
    }
</style>
@endsection

@section('content')
<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-lg-8">

            <div class="card shadow">
                <div class="card-header bg-success text-white">
                    <h5 class="m-0">📝 Student Enrollment Form</h5>
                </div>
                <div class="card-body">

                    @if(session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif

                    <form action="{{ route('test.student.enrollment.submit') }}" method="POST">
                        @csrf

                        <div class="mb-3">
                            <label class="form-label">Full Name</label>
                            <input type="text" name="student_name" class="form-control" 
                                value="{{ old('student_name', auth()->user()->name ?? '') }}" required>
                            @error('student_name')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Grade Level</label>
                            <select name="grade_level" class="form-select" required>
                                <option value="">-- Select Grade Level --</option>
                                <option value="Grade 11" {{ old('grade_level')=='Grade 11' ? 'selected' : '' }}>Grade 11</option>
                                <option value="Grade 12" {{ old('grade_level')=='Grade 12' ? 'selected' : '' }}>Grade 12</option>
                            </select>
                            @error('grade_level')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Strand</label>
                            <select name="strand" class="form-select" required>
                                <option value="">-- Select Strand --</option>
                                @foreach(['STEM','ABM','HUMSS','GAS','TVL'] as $strand)
                                    <option value="{{ $strand }}" {{ old('strand')==$strand ? 'selected' : '' }}>{{ $strand }}</option>
                                @endforeach
                            </select>
                            @error('strand')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Section (optional)</label>
                            <input type="text" name="section" class="form-control" value="{{ old('section') }}">
                            @error('section')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Contact Number</label>
                            <input type="text" name="contact_number" class="form-control" value="{{ old('contact_number') }}" required>
                            @error('contact_number')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Email Address</label>
                            <input type="email" name="email" class="form-control" value="{{ old('email', auth()->user()->email ?? '') }}" required>
                            @error('email')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-accent">Submit Enrollment</button>
                    </form>

                </div>
            </div>

        </div>
    </div>
</div>
@endsection
