@extends('layouts.bootstrap')

@section('title', 'Admin Dashboard')

@section('content')
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 mb-4">
        <div>
            <h1 class="h3 mb-1">Feedback Dashboard</h1>
            <p class="text-muted mb-0">View and manage all submitted feedback.</p>
        </div>
        <a href="{{ route('feedback.create') }}" class="btn btn-outline-primary">View Public Form</a>
    </div>

    @if (session('success'))
        <div class="alert alert-success" role="alert">
            {{ session('success') }}
        </div>
    @endif

    <div class="card shadow-sm border-0">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th scope="col" class="text-nowrap">ID</th>
                            <th scope="col">Title</th>
                            <th scope="col" style="min-width: 200px;">Message</th>
                            <th scope="col">Status</th>
                            <th scope="col" class="text-nowrap">Created At</th>
                            <th scope="col" class="text-nowrap">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($feedbacks as $feedback)
                            <tr>
                                <td>{{ $feedback->id }}</td>
                                <td class="fw-medium">{{ $feedback->title }}</td>
                                <td>{{ Str::limit($feedback->message, 80) }}</td>
                                <td>
                                    <span class="badge text-bg-secondary">{{ $feedback->status->label() }}</span>
                                </td>
                                <td class="text-nowrap">{{ $feedback->created_at->format('M d, Y H:i') }}</td>
                                <td>
                                    <form action="{{ route('admin.feedbacks.status.update', $feedback) }}"
                                          method="POST"
                                          class="d-flex flex-wrap gap-2 align-items-center">
                                        @csrf
                                        @method('PATCH')

                                        <select name="status" class="form-select form-select-sm" style="width: auto;">
                                            @foreach (\App\Enums\FeedbackStatus::cases() as $status)
                                                <option value="{{ $status->value }}"
                                                    @selected($feedback->status === $status)>
                                                    {{ $status->label() }}
                                                </option>
                                            @endforeach
                                        </select>

                                        <button type="submit" class="btn btn-sm btn-primary">Update</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center text-muted py-5">
                                    No feedback has been submitted yet.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        @if ($feedbacks->hasPages())
            <div class="card-footer bg-white">
                {{ $feedbacks->links() }}
            </div>
        @endif
    </div>
@endsection
