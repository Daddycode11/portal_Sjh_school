@extends('layouts.client')

@section('content')
<div class="card p-4">
    <h3>Student Enrollment Form</h3>
    <hr>

    @if(session('success'))
        <script>
            Swal.fire('Success', {!! json_encode(session('success')) !!}, 'success');
        </script>
    @endif

    @if(session('error'))
        <script>
            Swal.fire('Error', {!! json_encode(session('error')) !!}, 'error');
        </script>
    @endif

    <form method="POST" action="{{ route('client.enrollment.submit') }}">
        @csrf

        <!-- Grade Level -->
        <div class="mb-3">
            <label for="grade_level">Grade Level</label>
            <select name="grade_level" id="grade_level" class="form-control" required>
                <option value="">Select Grade</option>
                @foreach($gradeLevels as $g)
                    <option value="{{ $g }}">{{ $g }}</option>
                @endforeach
            </select>
        </div>

        <!-- Section -->
        <div class="mb-3">
            <label for="section_id">Section</label>
            <select name="section_id" id="section_id" class="form-control" required>
                <option value="">Select Grade First</option>
            </select>
        </div>

        <!-- School Year -->
        <div class="mb-3">
            <label for="school_year">School Year</label>
            <input type="text" name="school_year" id="school_year" class="form-control" placeholder="2024-2025" required>
        </div>

        <button type="submit" class="btn btn-primary">Submit Enrollment</button>
    </form>
</div>

<script>
document.getElementById('grade_level').addEventListener('change', function() {
    let grade = this.value;
    let dropdown = document.getElementById('section_id');
    dropdown.innerHTML = '<option value="">Loading sections...</option>';

    fetch('/ajax/sections-by-grade/' + grade)
        .then(res => res.json())
        .then(data => {
            dropdown.innerHTML = '<option value="">Select Section</option>';
            data.forEach(section => {
                dropdown.innerHTML += `<option value="${section.id}">${section.name}</option>`;
            });
        })
        .catch(err => {
            console.error(err);
            dropdown.innerHTML = '<option value="">Failed to load sections</option>';
        });
});
</script>
@endsection
