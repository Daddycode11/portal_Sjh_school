@include('admin.layout.header')
@include('admin.layout.sidebar')

<!-- Main Content Wrapper -->
<div class="main-content" style="margin-left: 250px; padding: 2rem; background-color: #f8f9fa; min-height: 100vh;">
    <div class="container-fluid">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="text-success fw-bold mb-0">📢 Announcements</h2>
            <a href="{{ route('admin.announcements.create') }}" class="btn btn-success shadow-sm">
                + Create Announcement
            </a>
        </div>

        <!-- Success Alert -->
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <!-- If no announcements -->
        @if($announcements->isEmpty())
            <div class="alert alert-info text-center shadow-sm">
                No announcements yet.
            </div>
        @else
            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <table class="table table-hover align-middle">
                        <thead class="table-success">
                            <tr>
                                <th scope="col">Title</th>
                                <th scope="col">Audience</th>
                                <th scope="col">Posted At</th>
                                <th scope="col" class="text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($announcements as $announcement)
                                <tr>
                                    <td class="fw-semibold">{{ $announcement->title }}</td>
                                    <td>{{ ucfirst($announcement->target_audience) }}</td>
                                    <td>{{ $announcement->posted_at->format('M d, Y h:i A') }}</td>
                                    <td class="text-center">
                                        <form action="{{ route('admin.announcements.destroy', $announcement->id) }}"
                                              method="POST"
                                              onsubmit="return confirm('Are you sure you want to delete this announcement?');"
                                              class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-outline-danger btn-sm">
                                                <i class="bi bi-trash"></i> Delete
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        @endif
    </div>
</div>

@include('admin.layout.footer')
