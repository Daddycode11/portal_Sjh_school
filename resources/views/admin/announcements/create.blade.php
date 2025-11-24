@include('admin.layout.header')
@include('admin.layout.sidebar')

<!-- Main Content -->
<div class="main-content" style="margin-left: 250px; padding: 2rem; background-color: #f3fff7; min-height: 100vh; font-family: 'Poppins', sans-serif;">
    <div class="container-fluid">
        <div class="card shadow-sm border-0 rounded-16">
            <div class="card-header d-flex justify-content-between align-items-center" style="background-color: #388E3C; color: white; box-shadow: 0 4px 6px rgba(0,0,0,0.1);">
                <h4 class="mb-0 fw-bold">📢 Create Announcement</h4>
                <a href="{{ route('admin.announcements.index') }}" class="btn btn-light btn-sm rounded-pill">
                    <i class="bi bi-arrow-left"></i> Back
                </a>
            </div>

            <div class="card-body">
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show shadow-sm rounded" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                <form action="{{ route('admin.announcements.store') }}" method="POST" class="needs-validation" novalidate>
                    @csrf

                    <div class="mb-3">
                        <label for="title" class="form-label fw-semibold">Title</label>
                        <input type="text" name="title" id="title" class="form-control rounded-pill" placeholder="Enter announcement title" required>
                        <div class="invalid-feedback">Please enter a title.</div>
                    </div>

                    <div class="mb-3">
                        <label for="content" class="form-label fw-semibold">Content</label>
                        <textarea name="content" id="content" rows="5" class="form-control rounded-16" placeholder="Write the announcement content..." required></textarea>
                        <div class="invalid-feedback">Please enter content.</div>
                    </div>

                    <div class="mb-3">
                        <label for="target_audience" class="form-label fw-semibold">Target Audience</label>
                        <select name="target_audience" id="target_audience" class="form-select rounded-pill">
                            <option value="both">Both</option>
                            <option value="students">Students</option>
                            <option value="faculty">Faculty</option>
                        </select>
                    </div>

                    <div class="mt-4 d-flex justify-content-end gap-2">
                        <button type="submit" class="btn shadow-sm rounded-pill" style="background-color: #66BB6A; color: white; transition: 0.3s;" onmouseover="this.style.backgroundColor='#81C784'" onmouseout="this.style.backgroundColor='#66BB6A'">
                            <i class="bi bi-send"></i> Post Announcement
                        </button>
                        <a href="{{ route('admin.announcements.index') }}" class="btn btn-secondary rounded-pill px-4 shadow-sm">
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
