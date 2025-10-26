@include('admin.layout.header')
@include('admin.layout.sidebar')

<!-- Main Content -->
<div class="main-content" style="margin-left: 250px; padding: 2rem; background-color: #f8f9fa; min-height: 100vh;">
    <div class="container-fluid">
        <div class="card shadow-sm border-0">
            <div class="card-header bg-success text-white d-flex justify-content-between align-items-center">
                <h4 class="mb-0">📢 Create Announcement</h4>
                <a href="{{ route('admin.announcements.index') }}" class="btn btn-light btn-sm">
                    <i class="bi bi-arrow-left"></i> Back
                </a>
            </div>

            <div class="card-body">
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                <form action="{{ route('admin.announcements.store') }}" method="POST" class="needs-validation" novalidate>
                    @csrf

                    <div class="mb-3">
                        <label for="title" class="form-label fw-semibold">Title</label>
                        <input type="text" name="title" id="title" class="form-control" placeholder="Enter announcement title" required>
                        <div class="invalid-feedback">Please enter a title.</div>
                    </div>

                    <div class="mb-3">
                        <label for="content" class="form-label fw-semibold">Content</label>
                        <textarea name="content" id="content" rows="5" class="form-control" placeholder="Write the announcement content..." required></textarea>
                        <div class="invalid-feedback">Please enter content.</div>
                    </div>

                    <div class="mb-3">
                        <label for="target_audience" class="form-label fw-semibold">Target Audience</label>
                        <select name="target_audience" id="target_audience" class="form-select">
                            <option value="both">Both</option>
                            <option value="students">Students</option>
                            <option value="faculty">Faculty</option>
                        </select>
                    </div>

                    <div class="mt-4 d-flex justify-content-end gap-2">
                        <button type="submit" class="btn btn-success px-4">
                            <i class="bi bi-send"></i> Post Announcement
                        </button>
                        <a href="{{ route('admin.announcements.index') }}" class="btn btn-secondary px-4">
                            Cancel
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@include('admin.layout.footer')

<!-- Optional JS for form validation -->
<script>
    (() => {
        'use strict'
        const forms = document.querySelectorAll('.needs-validation')
        Array.from(forms).forEach(form => {
            form.addEventListener('submit', event => {
                if (!form.checkValidity()) {
                    event.preventDefault()
                    event.stopPropagation()
                }
                form.classList.add('was-validated')
            }, false)
        })
    })()
</script>
